<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin Slider controller
class Slider extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mslider" );
	}
	
	public function index() {
		if ($this->permissions->slider ["see"] != "1")
			$this->mfunctions->noPermission();
		$slides = $this->mslider->getAllSlides ();
		$data ["slides"] = $slides;
		$data ["target"] = "slider";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new slide
	public function insertSlide() {
		if ($this->permissions->slider ["create"] != "1")
			$this->mfunctions->noPermission();
		$data ["langs"] = $this->mfunctions->getAllLangs ();
		$data ["pages"] = $this->mfunctions->getALlPages ();
		if ($_POST) {
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_rules ( 'photo_url', lang ( 'enter_slide_photo' ), 'required' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_slider";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->mslider->insertSlide ( array (
						"photo_url" => $_POST ["photo_url"],
						"url" => $_POST ["url"] 
				) );
				if ($query > 0)
					$this->mfunctions->actionReport ( "slider", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/slider", "refresh" );
			}
		} else {
			$data ["target"] = "insert_slider";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed slide
	public function modifySlide($slide_id, $atts = array()) {
		if ($this->permissions->slider ["modify"] != "1")
			$this->mfunctions->noPermission();
		$data ["langs"] = $this->mfunctions->getAllLangs ();
		$data ["pages"] = $this->mfunctions->getALlPages ();
		if ($slide_id != "") {
			$slide = $this->mslider->getSlideById ( $slide_id );
			if ($slide) {
				$data ["slide"] = $slide;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_rules ( 'photo_url', lang ( 'enter_slide_photo' ), "required" );
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_slider";
						$this->load->view ( "admin/index", $data );
					} else {
						$query = $this->mslider->modifySlide ( $slide_id, array (
								"photo_url" => $_POST ["photo_url"],
								"url" => $_POST ["url"] 
						) );
						if ($query > 0)
							$this->mfunctions->actionReport ( "slider", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/slider", "refresh" );
					}
				} else {
					$data ["target"] = "modify_slider";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed slide
	public function deleteSlide($slide_id) {
		if ($this->permissions->slider ["delete"] != "1")
			$this->mfunctions->noPermission();
		if ($slide_id != "") {
			$query = $this->mslider->deleteSlide ( $slide_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if ($query > 0)
				$this->mfunctions->actionReport ( "slider", "delete" );
			redirect ( base_url () . "admin/slider", "refresh" );
		}
	}
	
	// check slide photo exist for modify
	public function checkPhotoUrlExist($url, $slide_id) {
		$request = $this->mslider->checkPhotoUrlExist ( $slide_id, $url );
		if (! $request) {
			$this->form_validation->set_message ( 'checkPhotoUrlExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set slides order
	public function setOrder() {
		if ($_POST) {
			$this->mslider->setSlidesOrder ( $_POST ["slider"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "slider", "set_order" );
			redirect ( base_url () . "admin/slider", "refresh" );
		}
	}
}