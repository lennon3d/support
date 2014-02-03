<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin Links controller
class Links extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mlinks" );
	}
	
	public function index() {
		if ($this->permissions->links ["links_see"] != "1")
			$this->mfunctions->noPermission();
		$links = $this->mlinks->getAllLinks();
		$data ["links"] = $links;
		$data ["target"] = "links";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new link
	public function insertLink() {
		if ($this->permissions->links ["links_create"] != "1")
			$this->mfunctions->noPermission();
			foreach($this->_LANGS as $lang){
			$data["post"]["title_$lang->code"] = "";
			$data["post"]["url_$lang->code"] = "";
			$data["post"]["photo_url_$lang->code"] = "";
			$data["post"]["status_$lang->code"] = "";
		}
		$data["pages"] = $this->mfunctions->getALlPages();
		if ($_POST) {
			$common_id = $this->mlinks->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_link_title' )." - " . $lang->language, 'trim|required|is_unique[links.title]' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_link";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
				$query = $this->mlinks->insertLink( array (
						"title" => trim($_POST ["title_$lang->code"]),
						"photo_url" => trim($_POST ["photo_url_$lang->code"]),
						"lang" => $lang->code,
						"url" => $_POST ["url_$lang->code"],
						"common_id" => $common_id,
						"order" => 0 ,
						"status" => (isset($_POST["status_$lang->code"])?1:0)
				) );
				}
				if($query>0)
					$this->mfunctions->actionReport("links", "insert");
				$this->session->set_userdata ( array (
						"msg" => "1"
				) );
				redirect ( base_url () . "admin/links", "refresh" );
			}
		} else {
			$data ["target"] = "insert_link";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed link
	public function modifyLink($link_id, $atts = array()) {
		if ($this->permissions->links["links_modify"] != "1")
			$this->mfunctions->noPermission();
		$data["pages"] = $this->mfunctions->getALlPages();
		if ($link_id != "") {
			$link = $this->mlinks->getLinkById ( $link_id);
			if ($link) {
				$data ["link"] = $link;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
					foreach($this->_LANGS as $lang){
						$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_link_title' )." - " . $lang->language, "trim|required|callback_checkTitleExist[$link_id]" );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_link";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
							$query = $this->mlinks->modifyLink( $link_id, $lang->code, array (
								"title" => trim($_POST ["title_$lang->code"]),
								"photo_url" => trim($_POST ["photo_url_$lang->code"]),
								"url" => $_POST ["url_$lang->code"],
								"status" => (isset($_POST["status_$lang->code"])?1:0)
							) );
						}
						if($query>0)
							$this->mfunctions->actionReport("links", "modify");
						$this->session->set_userdata ( array (
								"msg" => "1"
						) );
						redirect ( base_url () . "admin/links", "refresh" );
					}
				} else {
					$data ["target"] = "modify_link";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed link
	public function deleteLink($link_id) {
		if ($this->permissions->links["links_delete"] != "1")
			$this->mfunctions->noPermission();
		if ($link_id != "") {
			$query = $this->mlinks->deleteLink( $link_id );
			$this->session->set_userdata ( array (
					"msg" => 1
			) );
			if($query>0)
				$this->mfunctions->actionReport("links", "delete");
			redirect ( base_url () . "admin/links", "refresh" );
		}
	}
	
	// check link title exist for modify
	public function checkTitleExist($title, $link_id) {
		$request = $this->mlinks->checkTitleExist ( $link_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set links order
	public function setOrder() {
		if ($_POST) {
			$this->mlinks->setLinksOrder ( $_POST ["link"] );
			$this->session->set_userdata ( array (
					"msg" => "1"
			) );
				$this->mfunctions->actionReport("links", "set_order");
			redirect ( base_url () . "admin/links", "refresh" );
		}
	}
	
}