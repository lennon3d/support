<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin Banners controller
class Banners extends  AdminController{
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mbanners" );
	}
	
	public function index() {
		if ($this->permissions->banners ["see"] != "1")
			$this->mfunctions->noPermission ();
		$banners = $this->mbanners->getAllBanners ();
		$data ["banners"] = $banners;
		$data ["target"] = "banners";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new banner
	public function insertBanner() {
		foreach($this->_LANGS as $lang){
			$data["post"]["position_$lang->code"] = "";
			$data["post"]["url_$lang->code"] = "";
			$data["post"]["photo_url_$lang->code"] = "";
			$data["post"]["status_$lang->code"] = "";
		}
		if ($this->permissions->banners ["create"] != "1")
			$this->mfunctions->noPermission ();
		$data ["pages"] = $this->mfunctions->getALlPages ();
		if ($_POST) {
			$common_id = $this->mbanners->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'photo_url_'.$lang->code, lang ( 'enter_banner_photo' )." - " . $lang->language, 'trim|required' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_banner";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
				$query = $this->mbanners->insertBanner ( array (
						"photo_url" => trim($_POST ["photo_url_$lang->code"]),
						"url" => trim($_POST ["url_$lang->code"]),
						"position" => $_POST ["position_$lang->code"],
						"lang" => $lang->code,
						"common_id" => $common_id,
						"order" => 0 ,
						"status" => (isset($_POST["status_$lang->code"])?1:0)
				) );
				}
				if ($query > 0)
					$this->mfunctions->actionReport ( "banners", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/banners", "refresh" );
			}
		} else {
			$data ["target"] = "insert_banner";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed banner
	public function modifyBanner($banner_id, $atts = array()) {
		if ($this->permissions->banners ["modify"] != "1")
			$this->mfunctions->noPermission ();
		$data ["langs"] = $this->mfunctions->getAllLangs ();
		$data ["pages"] = $this->mfunctions->getALlPages ();
		if ($banner_id != "") {
			$banner = $this->mbanners->getBannerById ( $banner_id );
			if ($banner) {
				$data ["banner"] = $banner;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					foreach($this->_LANGS as $lang){
						$this->form_validation->set_rules ( 'photo_url_'.$lang->code, lang ( 'enter_banner_photo' )." - " . $lang->language, "trim|required|" );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_banner";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
						$query = $this->mbanners->modifyBanner ( $banner_id,$lang->code, array (
								"photo_url" => trim($_POST ["photo_url_$lang->code"]),
								"url" => $_POST ["url_$lang->code"],
								"position" => $_POST ["position_$lang->code"],
								"status" => (isset($_POST["status_$lang->code"])?1:0)
						) );
						}
						if ($query > 0)
							$this->mfunctions->actionReport ( "banners", "insert" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/banners", "refresh" );
					}
				} else {
					$data ["target"] = "modify_banner";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed banner
	public function deleteBanner($banner_id) {
		if ($this->permissions->banners ["delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($banner_id != "") {
			$query = $this->mbanners->deleteBanner ( $banner_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if ($query > 0)
				$this->mfunctions->actionReport ( "banners", "delete" );
			redirect ( base_url () . "admin/banners", "refresh" );
		}
	}
	
	// set banners order
	public function setOrder() {
		if ($_POST) {
			$this->mbanners->setBannersOrder ( $_POST ["banners"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "banners", "set_order" );
			redirect ( base_url () . "admin/banners", "refresh" );
		}
	}
}