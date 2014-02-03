<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin pages controller
class Pages extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mpages" );
	}
	
	public function index() {
		if ($this->permissions->pages ["pages_see"] != "1")
			$this->mfunctions->noPermission();
		$pages = $this->mpages->getAllPages ();
		$data ["pages"] = $pages;
		$data ["target"] = "pages";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new page
	public function insertPage() {
		if ($this->permissions->pages ["pages_create"] != "1")
			$this->mfunctions->noPermission();
		foreach($this->_LANGS as $lang){
			$data["post"]["title_$lang->code"] = "";
			$data["post"]["content_$lang->code"] = "";
			$data["post"]["css_$lang->code"] = "";
			$data["post"]["style_$lang->code"] = "";
			$data["post"]["meta_tag_$lang->code"] = "";
			$data["post"]["meta_desc_$lang->code"] = "";
			$data["post"]["active_$lang->code"] = "";
		}
		if ($_POST) {
			$common_id = $this->mpages->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_page_title' )." - " . $lang->language, 'trim|required|is_unique[pages.title]' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_page";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
					$query = $this->mpages->insertPage ( array (
						"title" => trim($_POST ["title_$lang->code"]),
						"content" => trim($_POST ["content_$lang->code"]),
						"css" => trim($_POST ["style_$lang->code"]),
						"lang" => $lang->code,
						"meta_tag" => trim($_POST["meta_tag_$lang->code"]),
						"meta_desc" => trim($_POST["meta_desc_$lang->code"]),
						"active" => (isset($_POST["active_$lang->code"])?1:0),
						"common_id" => $common_id,
				) );
				}
				if($query>0)
					$this->mfunctions->actionReport("pages", "insert");
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/pages", "refresh" );
			}
		} else {
			$data ["target"] = "insert_page";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed page
	public function modifyPage($page_id, $atts = array()) {
		if ($this->permissions->pages ["pages_modify"] != "1")
			$this->mfunctions->noPermission();
		if ($page_id != "") {
			$page = $this->mpages->getPageById ( $page_id );
			if ($page) {
				$data ["page"] = $page;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
					foreach($this->_LANGS as $lang){
						$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_page_title' )." - " . $lang->language, "trim|required|callback_checkPageExist[$page_id]" );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_page";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
						$query = $this->mpages->modifyPage ( $page_id, $lang->code, array (
							"title" => trim($_POST ["title_$lang->code"]),
							"content" => trim($_POST ["content_$lang->code"]),
							"css" => trim($_POST ["style_$lang->code"]),
							"meta_tag" => trim($_POST["meta_tag_$lang->code"]),
							"meta_desc" => trim($_POST["meta_desc_$lang->code"]),
							"active" => (isset($_POST["active_$lang->code"])?1:0)
						) );
						}
						if($query>0)
							$this->mfunctions->actionReport("pages", "modify");
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/pages", "refresh" );
					}
				} else {
					$data ["target"] = "modify_page";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed page
	public function deletePage($page_id) {
		if ($this->permissions->pages ["pages_delete"] != "1")
			$this->mfunctions->noPermission();
		if ($page_id != "") {
			$this->mpages->deletePage ( $page_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
				$this->mfunctions->actionReport("pages", "delete");
			redirect ( base_url () . "admin/pages", "refresh" );
		}
	}
	
	// check page title exist for modify
	public function checkTitleExist($title, $page_id) {
		$request = $this->musers->checkTitleExist ( $page_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// show comments of an existed page
	public function showComments($page_id = "") {
		if ($this->permissions->comments ["see"] != "1")
			$this->mfunctions->noPermission();
		if ($page_id != "") {
			$comments = $this->mpages->getAllPageComments ( $page_id );
			$data["page_id"] = $page_id;
			$data ["comments"] = $comments;
			$data ["target"] = "show_comments";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// insert comment to page
	public function insertComment($page_id = "") {
		if ($this->permissions->comments ["create"] != "1")
			$this->mfunctions->noPermission();
		$comments = $this->mpages->getAllPageComments ( $page_id );
		$data["page_id"] = $page_id;
		$data ["comments"] = $comments;
		if ($_POST) {
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_rules ( 'comment', lang ( 'enter_comment' ), 'required' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "show_comments";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->mpages->insertComment ( $page_id, array (
						"page" => $page_id,
						"comment" => $_POST ["comment"],
						"name" => "0",
						"user" => $this->session->userdata ( "id" ),
						"datetime" => time () ,
				) );
				if($query>0)
					$this->mfunctions->actionReport("pages", "insert_comment");
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/pages/showComments/" . $page_id, "refresh" );
			}
		} else {
			$data ["target"] = "show_comments";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify an existed comment in page
	public function modifyComment($page_id = "", $comment_id = "") {
		if ($this->permissions->comments ["modify"] != "1")
			$this->mfunctions->noPermission();
		$comments = $this->mpages->getAllPageComments ( $page_id );
		$data ["comments"] = $comments;
		$data["page_id"] = $page_id;
		if ($_POST) {
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_rules ( 'comment', lang ( 'enter_comment' ), 'required' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "show_comments";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->mpages->modifyComment ( $comment_id, array (
						"comment" => $_POST ["comment"],
						"user" => $this->session->userdata ( "id" ),
						"datetime" => time () ,
				) );
				if($query>0)
					$this->mfunctions->actionReport("pages", "modify_comment");
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/pages/showComments/" . $page_id, "refresh" );
			}
		} else {
			$data ["target"] = "show_comments";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// delete comments of page
	public function deleteComment($page_id = "", $comment_id = "") {
		if ($this->permissions->comments ["delete"] != "1")
			$this->mfunctions->noPermission();
		$comments = $this->mpages->getAllPageComments ( $page_id );
		$data ["comments"] = $comments;
		if ($page_id != "") {
			$query = $this->mpages->deleteComment ( $comment_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if($query>0)
				$this->mfunctions->actionReport("pages", "delete_comment");
			redirect ( base_url () . "admin/pages/showComments/" . $page_id, "refresh" );
		}
	}
}