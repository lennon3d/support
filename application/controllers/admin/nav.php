<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin Navigator controller
class Nav extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mnav" );
	}
	
	public function index() {
		if ($this->permissions->nav ["nav_see"] != "1")
			$this->mfunctions->noPermission();
		$navs = $this->mnav->getAllNavs ();
		$data ["navs"] = $navs;
		$data ["target"] = "nav";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new nav link
	public function insertNav() {
		if ($this->permissions->nav ["nav_create"] != "1")
			$this->mfunctions->noPermission();
		foreach($this->_LANGS as $lang){
			$data["post"]["title_$lang->code"] = "";
			$data["post"]["url_$lang->code"] = "";
			$data["post"]["status_$lang->code"] = "";
		}
		$data ["pages"] = $this->mfunctions->getALlPages ();
		if ($_POST) {
			$common_id = $this->mnav->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			$is_products = (isset ( $_POST ["is_products"] ) ? "1" : "0");
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_nav_title' )." - " . $lang->language, 'trim|required|is_unique[nav.title]' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_nav";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
					$query = $this->mnav->insertNav ( array (
						"title" => trim($_POST ["title_$lang->code"]),
						"url" => $_POST ["url_$lang->code"],
						"lang" => $lang->code,
						"common_id" => $common_id,
						"order" => 0 ,
						"status" => (isset($_POST["status_$lang->code"])?1:0)
					) );
				}
				if ($query > 0)
					$this->mfunctions->actionReport ( "nav", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/nav", "refresh" );
			}
		} else {
			$data ["target"] = "insert_nav";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed nav link
	public function modifyNav($nav_id, $atts = array()) {
		if ($this->permissions->nav ["nav_modify"] != "1")
			$this->mfunctions->noPermission();
		$data ["pages"] = $this->mfunctions->getALlPages ();
		if ($nav_id != "") {
			$nav = $this->mnav->getNavById ( $nav_id );
			if ($nav) {
				$data ["nav"] = $nav;
				if ($_POST) {
					$is_products = (isset ( $_POST ["is_products"] ) ? "1" : "0");
					$this->form_validation->set_message ( 'required', "%s" );
					foreach($this->_LANGS as $lang){
						$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_nav_title' )." - " . $lang->language, "trim|required|callback_checkTitleExist[$nav_id]" );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_nav";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
							$query = $this->mnav->modifyNav ( $nav_id, $lang->code, array (
								"title" => trim($_POST ["title_$lang->code"]),
								"url" => $_POST ["url_$lang->code"],
								"status" => (isset($_POST["status_$lang->code"])?1:0)
							) );
						}
						if ($query > 0)
							$this->mfunctions->actionReport ( "nav", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/nav", "refresh" );
					}
				} else {
					$data ["target"] = "modify_nav";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed nav link
	public function deleteNav($nav_id) {
		if ($this->permissions->nav ["nav_delete"] != "1")
			$this->mfunctions->noPermission();
		if ($nav_id != "") {
			$query = $this->mnav->deleteNav ( $nav_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if ($query > 0)
				$this->mfunctions->actionReport ( "nav", "delete" );
			redirect ( base_url () . "admin/nav", "refresh" );
		}
	}
	
	// check ىشر title exist for modify
	public function checkTitleExist($title, $nav_id) {
		$request = $this->mnav->checkTitleExist ( $nav_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set nav links order
	public function setOrder() {
		if ($_POST) {
			$this->mnav->setNavsOrder ( $_POST ["nav"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "nav", "set_order" );
			redirect ( base_url () . "admin/nav", "refresh" );
		}
	}
}