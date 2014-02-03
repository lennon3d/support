<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin FAQ controller
class Faq extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mfaq" );
	}
	public function index() {
		if ($this->permissions->faq ["see"] != "1")
			$this->mfunctions->noPermission ();
		$faqs = $this->mfaq->getAllFaqs ();
		$data ["faqs"] = $faqs;
		$data ["target"] = "faq";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new FAQ
	public function insertFaq() {
		if ($this->permissions->faq ["create"] != "1")
			$this->mfunctions->noPermission ();
		foreach ( $this->_LANGS as $lang ) {
			$data ["post"] ["title_$lang->code"] = "";
			$data ["post"] ["desc_$lang->code"] = "";
			$data ["post"] ["status_$lang->code"] = "1";
		}
		if ($_POST) {
			$common_id = $this->mfaq->getCommonId ();
			foreach ( $_POST as $key => $value ) {
				$data ["post"] [$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			foreach ( $this->_LANGS as $lang ) {
				$this->form_validation->set_rules ( 'title_' . $lang->code, lang ( "language" ) . " " . $lang->language . ": " . lang ( 'enter_faq_title' ), 'trim|required|is_unique[faq.title]' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_faq";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach ( $this->_LANGS as $lang ) {
					$query = $this->mfaq->insertFaq ( array (
							"title" => trim ( $_POST ["title_$lang->code"] ),
							"desc" => $_POST ["desc_$lang->code"],
							"lang" => $lang->code,
							"common_id" => $common_id,
							"order" => 0,
							"status" => (isset ( $_POST ["status_$lang->code"] ) ? 1 : 0) 
					) );
				}
				if ($query > 0)
					$this->mfunctions->actionReport ( "faq", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/faq", "refresh" );
			}
		} else {
			$data ["target"] = "insert_faq";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed FAQ question
	public function modifyFaq($faq_id, $atts = array()) {
		if ($this->permissions->faq ["modify"] != "1")
			$this->mfunctions->noPermission ();
		if ($faq_id != "") {
			$faq = $this->mfaq->getFaqById ( $faq_id );
			if ($faq) {
				$data ["faq"] = $faq;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					foreach ( $this->_LANGS as $lang ) {
						$this->form_validation->set_rules ( 'title_' . $lang->code, lang ( "language" ) . " " . $lang->language . ": " . lang ( 'enter_faq_title' ), "trim|required|callback_checkTitleExist[$faq_id]" );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_faq";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach ( $this->_LANGS as $lang ) {
							$query = $this->mfaq->modifyFaq ( $faq_id, $lang->code, array (
									"title" => trim ( $_POST ["title_$lang->code"] ),
									"desc" => $_POST ["desc_$lang->code"],
									"status" => (isset ( $_POST ["status_$lang->code"] ) ? 1 : 0) 
							) );
						}
						if ($query > 0)
							$this->mfunctions->actionReport ( "faq", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/faq", "refresh" );
					}
				} else {
					$data ["target"] = "modify_faq";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed faq
	public function deleteFaq($faq_id = "") {
		if ($this->permissions->faq ["delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($faq_id != "") {
			$query = $this->mfaq->deleteFaq ( $faq_id );
			if ($query > 0) {
				$this->session->set_userdata ( array (
						"msg" => 1 
				) );
				$this->mfunctions->actionReport ( "faq", "delete" );
			}else{
				$this->session->set_userdata ( array (
						"msg" => "-1",
						"message" => lang("database_error")
				) );				
			}
			redirect ( base_url () . "admin/faq", "refresh" );
		}
		exit ( "no faq id!!" );
	}
	
	// check faq title exist for modify
	public function checkTitleExist($title, $faq_id) {
		$request = $this->mfaq->checkTitleExist ( $faq_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set faq questions order
	public function setOrder() {
		if ($_POST) {
			$this->mfaq->setFaqsOrder ( $_POST ["faq"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "faq", "set_order" );
			redirect ( base_url () . "admin/faq", "refresh" );
		}
	}
}