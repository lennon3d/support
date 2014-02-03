<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin News controller
class News extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mnews" );
	}
	
	public function index() {
		if ($this->permissions->news ["news_see"] != "1")
			$this->mfunctions->noPermission();
		$news = $this->mnews->getAllNews();
		$data ["news"] = $news;
		$data ["target"] = "news";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new new
	public function insertNew() {
		if ($this->permissions->news ["news_create"] != "1")
			$this->mfunctions->noPermission();
		foreach($this->_LANGS as $lang){
			$data["post"]["title_$lang->code"] = "";
			$data["post"]["url_$lang->code"] = "";
			$data["post"]["thumb_url_$lang->code"] = "";
			$data["post"]["status_$lang->code"] = "";
			$data["post"]["position_$lang->code"] = "";
			$data["post"]["short_description_$lang->code"] = "";
		}
		$data["pages"] = $this->mfunctions->getALlPages();
		if ($_POST) {
			$common_id = $this->mnews->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_new_title' )." - " . $lang->language, 'trim|required|is_unique[news.title]' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_new";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
					$query = $this->mnews->insertNew( array (
						"title" => trim($_POST ["title_$lang->code"]),
						"short_description" => trim($_POST ["short_description_$lang->code"]),
						"thumb_url" => trim($_POST ["thumb_url_$lang->code"]),
						"lang" => $lang->code,
						"url" => trim($_POST ["url_$lang->code"]),
						"position" => $_POST["position_$lang->code"],
						"common_id" => $common_id,
						"order" => 0 ,
						"status" => (isset($_POST["status_$lang->code"])?1:0)
					) );
				}
				if($query>0)
					$this->mfunctions->actionReport("news", "insert");
				$this->session->set_userdata ( array (
						"msg" => "1"
				) );
				redirect ( base_url () . "admin/news", "refresh" );
			}
		} else {
			$data ["target"] = "insert_new";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed new
	public function modifyNew($new_id, $atts = array()) {
		if ($this->permissions->news["news_modify"] != "1")
			$this->mfunctions->noPermission();
		$data["pages"] = $this->mfunctions->getALlPages();
		if ($new_id != "") {
			$new = $this->mnews->getNewById ( $new_id);
			if ($new) {
				$data ["new"] = $new;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					foreach($this->_LANGS as $lang){
						$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_new_title' )." - " . $lang->language, "trim|required|callback_checkTitleExist[$new_id]" );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_new";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
							$query = $this->mnews->modifyNew( $new_id, $lang->code, array (
								"title" => trim($_POST ["title_$lang->code"]),
								"short_description" => trim($_POST ["short_description_$lang->code"]),
								"thumb_url" => trim($_POST ["thumb_url_$lang->code"]),
								"url" => trim($_POST ["url_$lang->code"]),
								"position" => $_POST["position_$lang->code"],
								"status" => (isset($_POST["status_$lang->code"])?1:0)										
							) );
						}
						if($query>0)
							$this->mfunctions->actionReport("news", "modify");
						$this->session->set_userdata ( array (
								"msg" => "1"
						) );
						redirect ( base_url () . "admin/news", "refresh" );
					}
				} else {
					$data ["target"] = "modify_new";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed new
	public function deleteNew($new_id) {
		if ($this->permissions->news["news_delete"] != "1")
			$this->mfunctions->noPermission();
		if ($new_id != "") {
			$query = $this->mnews->deleteNew( $new_id );
			$this->session->set_userdata ( array (
					"msg" => 1
			) );
			if($query>0)
				$this->mfunctions->actionReport("news", "delete");
			redirect ( base_url () . "admin/news", "refresh" );
		}
	}
	
	// check new title exist for modify
	public function checkTitleExist($title, $new_id) {
		$request = $this->mnews->checkTitleExist ( $new_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set news order
	public function setOrder() {
		if ($_POST) {
			$this->mnews->setNewsOrder ( $_POST ["new"] );
			$this->session->set_userdata ( array (
					"msg" => "1"
			) );
				$this->mfunctions->actionReport("news", "set_order");
			redirect ( base_url () . "admin/news", "refresh" );
		}
	}
	
}