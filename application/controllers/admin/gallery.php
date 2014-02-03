<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin gallery controller
class Gallery extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mgallery" );
	}
	
	public function index() {
		if ($this->permissions->gallery ["see"] != "1")
			$this->mfunctions->noPermission();
		$photos = $this->mgallery->getAllPhotos ();
		$data ["photos"] = $photos;
		$data ["target"] = "gallery";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new photo to gallery
	public function insertPhoto() {
		if ($this->permissions->gallery ["create"] != "1")
			$this->mfunctions->noPermission();
		foreach($this->_LANGS as $lang){
			$data["post"]["title_$lang->code"] = "";
			$data["post"]["thumb_url_$lang->code"] = "";
			$data["post"]["photo_url_$lang->code"] = "";
			$data["post"]["description_$lang->code"] = "";
			$data["post"]["status_$lang->code"] = "";
		}
		if ($_POST) {
			$common_id = $this->mgallery->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_photo_title' )." - " . $lang->language, 'trim|required|is_unique[gallery.title]' );
				$this->form_validation->set_rules ( 'thumb_url_'.$lang->code, lang ( 'enter_photo_thumb' ) ." - " . $lang->language, 'trim|required' );
				$this->form_validation->set_rules ( 'photo_url_'.$lang->code, lang ( 'enter_photo_photo' ) ." - " . $lang->language, 'trim|required' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_photo";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
					$query = $this->mgallery->insertPhoto ( array (
						"title" => trim($_POST ["title_$lang->code"]),
						"description" => trim($_POST ["description_$lang->code"]),
						"thumb_url" => trim($_POST ["thumb_url_$lang->code"]),
						"photo_url" => trim($_POST ["photo_url_$lang->code"]) ,
						"lang" => $lang->code,
						"common_id" => $common_id,
						"order" => 0 ,
						"status" => (isset($_POST["status_$lang->code"])?1:0)								
					) );
				}
				if ($query > 0)
					$this->mfunctions->actionReport ( "gallery", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/gallery", "refresh" );
			}
		} else {
			$data ["target"] = "insert_photo";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed photo in gallery
	public function modifyPhoto($photo_id, $atts = array()) {
		if ($this->permissions->gallery ["modify"] != "1")
			$this->mfunctions->noPermission();
		if ($photo_id != "") {
			$photo = $this->mgallery->getPhotoById ( $photo_id );
			if ($photo) {
				$data ["photo"] = $photo;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					foreach($this->_LANGS as $lang){
						$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_photo_title' )." - " . $lang->language, "trim|required|callback_checkTitleExist[$photo_id]" );
						$this->form_validation->set_rules ( 'thumb_url_'.$lang->code, lang ( 'enter_photo_thumb' ) ." - " . $lang->language, 'trim|required' );
						$this->form_validation->set_rules ( 'photo_url_'.$lang->code, lang ( 'enter_photo_photo' ) ." - " . $lang->language, 'trim|required' );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_photo";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
							$query = $this->mgallery->modifyPhoto ( $photo_id, $lang->code, array (
								"title" => trim($_POST ["title_$lang->code"]),
								"description" => trim($_POST ["description_$lang->code"]),
								"thumb_url" => trim($_POST ["thumb_url_$lang->code"]),
								"photo_url" => trim($_POST ["photo_url_$lang->code"]) ,
								"status" => (isset($_POST["status_$lang->code"])?1:0)	
							) );
						}
						if ($query > 0)
							$this->mfunctions->actionReport ( "gallery", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/gallery", "refresh" );
					}
				} else {
					$data ["target"] = "modify_photo";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed photo in gallery
	public function deletePhoto($photo_id) {
		if ($this->permissions->gallery ["delete"] != "1")
			$this->mfunctions->noPermission();
		if ($photo_id != "") {
			$query = $this->mgallery->deletePhoto ( $photo_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if ($query > 0)
				$this->mfunctions->actionReport ( "gallery", "delete" );
			redirect ( base_url () . "admin/gallery", "refresh" );
		}
	}
	
	// check photo title exist for photo in gallery
	public function checkTitleExist($title, $photo_id) {
		$request = $this->mgallery->checkTitleExist ( $photo_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set photos order
	public function setOrder() {
		if ($_POST) {
			$this->mgallery->setPhotosOrder ( $_POST ["photo"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "gallery", "set_order" );
			redirect ( base_url () . "admin/gallery", "refresh" );
		}
	}
}