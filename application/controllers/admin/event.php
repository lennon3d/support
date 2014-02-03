<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin Events controller
class Event extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mevent" );
	}
	public function index() {
		if ($this->permissions->event["see"] != "1")
			$this->mfunctions->noPermission ();
		$events = $this->mevent->getAllEvents();
		$data ["events"] = $events;
		$data ["target"] = "event";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new event
	public function insertEvent() {
		if ($this->permissions->event ["create"] != "1")
			$this->mfunctions->noPermission ();
		foreach ( $this->_LANGS as $lang ) {
			$data ["post"] ["title_$lang->code"] = "";
			$data ["post"] ["desc_$lang->code"] = "";
			$data ["post"] ["location_$lang->code"] = "";
			$data ["post"] ["from_$lang->code"] = "";
			$data ["post"] ["to_$lang->code"] = "";
			$data ["post"] ["status_$lang->code"] = "1";
		}
		if ($_POST) {
			$common_id = $this->mevent->getCommonId ();
			foreach ( $_POST as $key => $value ) {
				$data ["post"] [$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			foreach ( $this->_LANGS as $lang ) {
				$this->form_validation->set_rules ( 'title_' . $lang->code, lang ( "language" ) . " " . $lang->language . ": " . lang ( 'enter_event_title' ), 'trim|required|is_unique[event.title]' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_event";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach ( $this->_LANGS as $lang ) {
					$query = $this->mevent->insertEvent ( array (
							"title" => trim ( $_POST ["title_$lang->code"] ),
							"desc" => $_POST ["desc_$lang->code"],
							"location" => $_POST ["location_$lang->code"],
							"from" => strtotime($_POST ["from_$lang->code"]),
							"to" => strtotime($_POST ["to_$lang->code"]),
							"lang" => $lang->code,
							"common_id" => $common_id,
							"status" => (isset ( $_POST ["status_$lang->code"] ) ? 1 : 0) 
					) );
				}
				if ($query > 0)
					$this->mfunctions->actionReport ( "event", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/event", "refresh" );
			}
		} else {
			$data ["target"] = "insert_event";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed FAQ question
	public function modifyEvent($event_id, $atts = array()) {
		if ($this->permissions->event ["modify"] != "1")
			$this->mfunctions->noPermission ();
		if ($event_id != "") {
			$event = $this->mevent->getEventById ( $event_id );
			if ($event) {
				$data ["event"] = $event;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					foreach ( $this->_LANGS as $lang ) {
						$this->form_validation->set_rules ( 'title_' . $lang->code, lang("language")." ".$lang->language.": ". lang ( 'enter_event_title' ), "trim|required|callback_checkTitleExist[$event_id]" );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_event";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach ( $this->_LANGS as $lang ) {
							$query = $this->mevent->modifyEvent ( $event_id, $lang->code, array (
									"title" => trim ( $_POST ["title_$lang->code"] ),
									"desc" => $_POST ["desc_$lang->code"],
									"location" => $_POST ["location_$lang->code"],
									"from" => strtotime($_POST ["from_$lang->code"]),
									"to" => strtotime($_POST ["to_$lang->code"]),
									"status" => (isset ( $_POST ["status_$lang->code"] ) ? 1 : 0) 
							) );
						}
						if ($query > 0)
							$this->mfunctions->actionReport ( "event", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/event", "refresh" );
					}
				} else {
					$data ["target"] = "modify_event";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed event
	public function deleteEvent($event_id = "") {
		if ($this->permissions->event["delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($event_id != "") {
			$query = $this->mevent->deleteEvent( $event_id );
			if ($query > 0) {
				$this->session->set_userdata ( array (
						"msg" => 1
				) );
				$this->mfunctions->actionReport ( "event", "delete" );
			}else{
				$this->session->set_userdata ( array (
						"msg" => "-1",
						"message" => lang("database_error")
				) );
			}
			redirect ( base_url () . "admin/event", "refresh" );
		}
		exit ( "no faq id!!" );
	}
	
	// check event title exist for modify
	public function checkTitleExist($title, $event_id) {
		$request = $this->mevent->checkTitleExist ( $event_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set event questions order
	public function setOrder() {
		if ($_POST) {
			$this->mevent->setEventsOrder ( $_POST ["event"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "event", "set_order" );
			redirect ( base_url () . "admin/event", "refresh" );
		}
	}
}