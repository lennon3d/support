<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin gallery controller
class Videos extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mvideos" );
	}
	
	public function index() {
		if ($this->permissions->videos ["see"] != "1")
			$this->mfunctions->noPermission ();
		$videos = $this->mvideos->getAllVideos ();
		$data ["videos"] = $videos;
		$data ["target"] = "videos";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new video
	public function insertVideo() {
		if ($this->permissions->videos ["create"] != "1")
			$this->mfunctions->noPermission ();
		foreach($this->_LANGS as $lang){
			$data["post"]["title_$lang->code"] = "";
			$data["post"]["description_$lang->code"] = "";
			$data["post"]["thumb_url_$lang->code"] = "";
			$data["post"]["video_url_$lang->code"] = "";
			$data["post"]["status_$lang->code"] = "";
		}
		if ($_POST) {
			$common_id = $this->mvideos->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', "%s " . lang ( "exist" ) );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_video_title' )." - " . $lang->language, 'trim|required|is_unique[videos.title]' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_video";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
					$query = $this->mvideos->insertVideo ( array (
						"title" => trim($_POST ["title_$lang->code"]),
						"description" => trim($_POST ["description_$lang->code"]),
						"thumb_url" => trim($_POST ["thumb_url_$lang->code"]),
						"lang" => $lang->code,
						"video_url" => trim($_POST ["video_url_$lang->code"]),
						"common_id" => $common_id,
						"order" => 0 ,
						"status" => (isset($_POST["status_$lang->code"])?1:0)
							 
					) );
				}
				if ($query > 0)
					$this->mfunctions->actionReport ( "videos", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/videos", "refresh" );
			}
		} else {
			$data ["target"] = "insert_video";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed video
	public function modifyVideo($video_id, $atts = array()) {
		if ($this->permissions->videos ["modify"] != "1")
			$this->mfunctions->noPermission ();
		$data ["langs"] = $this->mfunctions->getAllLangs ();
		if ($video_id != "") {
			$video = $this->mvideos->getVideoById ( $video_id );
			if ($video) {
				$data ["video"] = $video;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					foreach($this->_LANGS as $lang){
						$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_video_title' )." - " . $lang->language, "trim|required|callback_checkTitleExist[$video_id]" );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_video";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
							$query = $this->mvideos->modifyVideo ( $video_id, $lang->code, array (
								"title" => trim($_POST ["title_$lang->code"]),
								"description" => trim($_POST ["description_$lang->code"]),
								"thumb_url" => trim($_POST ["thumb_url_$lang->code"]),
								"video_url" => trim($_POST ["video_url_$lang->code"]),
								"status" => (isset($_POST["status_$lang->code"])?1:0)
							) );
						}
						if ($query > 0)
							$this->mfunctions->actionReport ( "videos", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/videos", "refresh" );
					}
				} else {
					$data ["target"] = "modify_video";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed video
	public function deleteVideo($video_id) {
		if ($this->permissions->videos ["delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($video_id != "") {
			$query = $this->mvideos->deleteVideo ( $video_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if ($query > 0)
				$this->mfunctions->actionReport ( "videos", "delete" );
			redirect ( base_url () . "admin/videos", "refresh" );
		}
	}
	
	// check video title exist for video modify
	public function checkTitleExist($title, $video_id) {
		$request = $this->mvideos->checkTitleExist ( $video_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set videos order
	public function setOrder() {
		if ($_POST) {
			$this->mvideos->setVideosOrder ( $_POST ["video"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "videos", "set_order" );
			redirect ( base_url () . "admin/videos", "refresh" );
		}
	}
}