<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin Services controller
class Services extends  AdminController{
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mservices" );
	}
	
	public function index() {
		if ($this->permissions->services["see"] != "1")
			$this->mfunctions->noPermission ();
		$services = $this->mservices->getAllServices ();
		$data ["services"] = $services;
		$data ["target"] = "services";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new service
	public function insertService() {
		foreach($this->_LANGS as $lang){
			$data["post"]["url_$lang->code"] = "";
			$data["post"]["title_$lang->code"] = "";
			$data["post"]["thumb_$lang->code"] = "";
			$data["post"]["out_url_$lang->code"] = "http://";
			$data["post"]["status_$lang->code"] = "1";
		}
		if ($this->permissions->services ["create"] != "1")
			$this->mfunctions->noPermission ();
		$data ["pages"] = $this->mfunctions->getAllPages ();
		if ($_POST) {
			$common_id = $this->mservices->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'title_'.$lang->code,  lang("language")." ".$lang->language.": ". lang ( 'enter_service_title' ), 'trim|required' );
				if($_POST["url_$lang->code"] == "0")
					$this->form_validation->set_rules('out_url_'. $lang->code, lang("language")." ".$lang->language.": ". lang ( 'enter_out_url' ), 'required|callback_checkUrl');
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_service";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
				$query = $this->mservices->insertService ( array (
						"thumb" => trim($_POST ["thumb_$lang->code"]),
						"url" => trim($_POST ["url_$lang->code"]),
						"title" => trim($_POST ["title_$lang->code"]),
						"out_url" => trim($_POST ["out_url_$lang->code"]),
						"lang" => $lang->code,
						"common_id" => $common_id,
						"order" => 0 ,
						"status" => (isset($_POST["status_$lang->code"])?1:0)
				) );
				}
				if ($query > 0)
					$this->mfunctions->actionReport ( "services", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/services", "refresh" );
			}
		} else {
			$data ["target"] = "insert_service";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed service
	public function modifyService($service_id, $atts = array()) {
		if ($this->permissions->services ["modify"] != "1")
			$this->mfunctions->noPermission ();
		$data ["pages"] = $this->mfunctions->getAllPages ();
		if ($service_id != "") {
			$service = $this->mservices->getServiceById ( $service_id );
			if ($service) {
				$data ["service"] = $service;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					foreach($this->_LANGS as $lang){
						//$this->form_validation->set_rules ( 'photo_url_'.$lang->code, lang("language")." ".$lang->language.": ". lang ( 'enter_service_photo' ), "trim|required|" );
						$this->form_validation->set_rules ( 'title_'.$lang->code,  lang("language")." ".$lang->language.": ". lang ( 'enter_service_title' ), 'trim|required' );
						if($_POST["url_$lang->code"] == "0")
							$this->form_validation->set_rules('out_url_'. $lang->code, lang("language")." ".$lang->language.": ". lang ( 'enter_out_url' ), 'required|callback_checkUrl');
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_service";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
						$query = $this->mservices->modifyService ( $service_id,$lang->code, array (
								"thumb" => trim($_POST ["thumb_$lang->code"]),
								"url" => trim($_POST ["url_$lang->code"]),
								"title" => trim($_POST ["title_$lang->code"]),
								"out_url" => trim($_POST ["out_url_$lang->code"]),
								"status" => (isset($_POST["status_$lang->code"])?1:0)
						) );
						}
						if ($query > 0)
							$this->mfunctions->actionReport ( "services", "insert" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/services", "refresh" );
					}
				} else {
					$data ["target"] = "modify_service";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}

	//check out url if begin with http://
	public function checkUrl($url) {
		if (! filter_var($url, FILTER_VALIDATE_URL)) {
			$this->form_validation->set_message ( 'checkUrl', " %s " . lang ( "invalid_url" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// delete an existed service
	public function deleteService($service_id) {
		if ($this->permissions->services ["delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($service_id != "") {
			$query = $this->mservices->deleteService ( $service_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if ($query > 0)
				$this->mfunctions->actionReport ( "services", "delete" );
			redirect ( base_url () . "admin/services", "refresh" );
		}
	}
	
	// set services order
	public function setOrder() {
		if ($_POST) {
			$this->mservices->setServicesOrder ( $_POST ["services"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "services", "set_order" );
			redirect ( base_url () . "admin/services", "refresh" );
		}
	}
}