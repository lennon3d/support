<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin Sponsors controller
class Sponsors extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "msponsors" );
	}
	
	public function index() {
		if ($this->permissions->sponsors["see"] != "1")
			$this->mfunctions->noPermission ();
		$sponsors = $this->msponsors->getAllSponsors();
		$data ["sponsors"] = $sponsors;
		$data ["target"] = "sponsors";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new sponsor
	public function insert() {
		if ($this->permissions->sponsors ["create"] != "1")
			$this->mfunctions->noPermission ();
		foreach($this->_LANGS as $lang){
			$data["post"]["title_$lang->code"] = "";
			$data["post"]["url_$lang->code"] = "";
			$data["post"]["thumb_$lang->code"] = "";
			$data["post"]["status_$lang->code"] = "";
		}
		if ($_POST) {
			$common_id = $this->msponsors->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_sponsor_title' )." - " . $lang->language, 'trim|required|is_unique[sponsors.title]' );
				$this->form_validation->set_rules ( 'thumb_'.$lang->code, lang ( 'enter_sponsor_photo_url' ) ." - " . $lang->language, 'required' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_sponsor";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
				$query = $this->msponsors->insertSponsor ( array (
						"title" => trim($_POST ["title_$lang->code"]),
						"thumb" => trim($_POST ["thumb_$lang->code"]),
						"lang" => $lang->code,
						"url" => trim($_POST ["url_$lang->code"]),
						"common_id" => $common_id,
						"order" => 0 ,
						"status" => (isset($_POST["status_$lang->code"])?1:0)
				) );
				}
				if ($query > 0)
					$this->mfunctions->actionReport ( "sponsors", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/sponsors", "refresh" );
			}
		} else {
			$data ["target"] = "insert_sponsor";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed sponsor
	public function modify($sponsor_id, $atts = array()) {
		if ($this->permissions->sponsors ["modify"] != "1")
			$this->mfunctions->noPermission ();
		if ($sponsor_id != "") {
			$sponsor = $this->msponsors->getSponsorById ( $sponsor_id );
			if ($sponsor) {
				$data ["sponsor"] = $sponsor;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
					foreach($this->_LANGS as $lang){
						$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_sponsor_title' )." - " . $lang->language, "trim|required|callback_checkTitleExist[$sponsor_id]" );
						$this->form_validation->set_rules ( 'thumb_'.$lang->code, lang ( 'enter_sponsor_photo_url' ) ." - " . $lang->language, 'required' );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_sponsor";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
							$query = $this->msponsors->modifySponsor ($sponsor_id,$lang->code, array (
									"title" => trim($_POST ["title_$lang->code"]),
									"thumb" => $_POST ["thumb_$lang->code"],
									"url" => $_POST ["url_$lang->code"],
									"status" => (isset($_POST["status_$lang->code"])?1:0)
							) );
						}
						if ($query > 0)
							$this->mfunctions->actionReport ( "sponsors", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/sponsors", "refresh" );
					}
				} else {
					$data ["target"] = "modify_sponsor";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed sponsor
	public function delete($sponsor_id) {
		if ($this->permissions->sponsors ["delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($sponsor_id != "") {
			$query = $this->msponsors->deleteSponsor ( $sponsor_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if ($query > 0)
				$this->mfunctions->actionReport ( "sponsors", "delete" );
			redirect ( base_url () . "admin/sponsors", "refresh" );
		}
	}
	
	// check sponsor title exist for modify
	public function checkTitleExist($title, $sponsor_id) {
		$request = $this->msponsors->checkTitleExist ( $sponsor_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set sponsors order
	public function setOrder() {
		if ($_POST) {
			$this->msponsors->setSponsorsOrder ( $_POST ["sponsor"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "sponsors", "set_order" );
			redirect ( base_url () . "admin/sponsors", "refresh" );
		}
	}
}