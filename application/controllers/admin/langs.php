<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin languages controller
class Langs extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mlangs" );
	}
	public function index() {
		if ($this->permissions->languages ["lang_see"] != "1")
			$this->mfunctions->noPermission ();
		$langs = $this->mlangs->getAllLangs ();
		$data ["langs"] = $langs;
		$data ["target"] = "langs";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new language
	public function insertLang() {
		if ($this->permissions->languages ["lang_create"] != "1")
			$this->mfunctions->noPermission ();
		if ($_POST) {
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			$this->form_validation->set_rules ( 'language', lang ( 'enter_language' ), 'required|is_unique[languages.language]' );
			$this->form_validation->set_rules ( 'code', lang ( 'enter_code' ), 'required|is_unique[languages.code]' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_lang";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->mlangs->insertLang ( array (
						"language" => $_POST ["language"],
						"code" => $_POST ["code"],
						"default" => "0" 
				) );
				if ($query == 1) {
					$this->mfunctions->actionReport ( "languages", "insert" );
					$this->session->set_userdata ( array (
							"msg" => "1" 
					) );
					redirect ( base_url () . "admin/langs", "refresh" );
				} else {
					$data ["msg"] = "-1";
					$data ["message"] = $query;
					$data ["target"] = "insert_lang";
					$this->load->view ( "admin/index", $data );
				}
			}
		} else {
			$data ["target"] = "insert_lang";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify an existed language
	public function modifyLang($lang_id) {
		if ($this->permissions->languages ["lang_modify"] != "1")
			$this->mfunctions->noPermission ();
		if ($lang_id != "") {
			$lang = $this->mlangs->getLangById ( $lang_id );
			if ($lang) {
				$data ["lang"] = $lang;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_rules ( 'language', lang ( 'enter_language' ), "required|callback_checkLanguageExist[$lang_id]" );
					$this->form_validation->set_rules ( 'code', lang ( 'enter_code' ), "required|callback_checkCodeExist[$lang_id]" );
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_lang";
						$this->load->view ( "admin/index", $data );
					} else {
						$query = $this->mlangs->modifyLang ( $lang_id, array (
								"language" => $_POST ["language"],
								"code" => $_POST ["code"] 
						) );
						if ($query > 0) {
							$this->mfunctions->actionReport ( "languages", "modify" );
							$this->session->set_userdata ( array (
									"msg" => "1" 
							) );
							redirect ( base_url () . "admin/langs", "refresh" );
						} else {
							$data ["msg"] = "-1";
							$data ["message"] = lang ( "operation_error" );
							$data ["target"] = "modify_lang";
							$this->load->view ( "admin/index", $data );
						}
					}
				} else {
					$data ["target"] = "modify_lang";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// set default language
	public function setDefaultLang() {
		if ($_POST) {
			$this->mlangs->setDefaultLang ( $_POST ["lang"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "languages", "change_default" );
			redirect ( base_url () . "admin/langs", "refresh" );
		}
	}
	
	// check language language exist for modify
	public function checkLanguageExist($language, $lang_id) {
		$request = $this->mlangs->checkLanguageExist ( $lang_id, $language );
		if (! $request) {
			$this->form_validation->set_message ( 'checkLanguageExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// check language code exist for modify
	public function checkCodeExist($code, $lang_id) {
		$request = $this->mlangs->checkCodeExist ( $lang_id, $code );
		if (! $request) {
			$this->form_validation->set_message ( 'checkCodeExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// delete an existed language
	public function deleteLang($lang_id) {
		if ($this->permissions->languages ["lang_delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($lang_id != "") {
			$lang = $this->mlangs->getLangById ( $lang_id );
			if ($lang->default == "1") {
				$data ["msg"] = "-1";
				$data ["message"] = lang ( "cant_delete_default_lang" );
				$langs = $this->mlangs->getAllLangs ();
				$data ["langs"] = $langs;
				$data ["target"] = "langs";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->mlangs->deleteLang ( $lang_id );
				if ($query == 1) {
					$this->session->set_userdata ( array (
							"msg" => 1 
					) );
				} else {
					$data ["msg"] = "-1";
					$data ["message"] = "حصل خطأ أثناء عملية حذف اللغة يرجى مراجعة صلاحيات الملفات";
					$langs = $this->mlangs->getAllLangs ();
					$data ["langs"] = $langs;
					$data ["target"] = "langs";
					$this->load->view ( "admin/index", $data );
				}
				if ($query == 1)
					$this->mfunctions->actionReport ( "languages", "delete" );
				redirect ( base_url () . "admin/langs", "refresh" );
			}
		}
	}
}