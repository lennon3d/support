<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin notify controller
class Notify extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mnotify" );
	}
	
	public function index() {
		if ($this->permissions->notify ["see"] != "1")
			$this->mfunctions->noPermission();
		if ($_POST) {
			if ($this->permissions->notify ["modify"] != "1")
				$this->mfunctions->noPermission();
			foreach ( $_POST ["message"] as $key => $value ) {
				$this->db->where ( "type", $key );
				$this->db->update ( "notifymessages", array (
						"message" => $value 
				) );
			}
			foreach ( $_POST ["active"] as $key => $value ) {
				$active = ($value == "0" ? 0 : 1);
				$this->db->where ( "type", $key );
				$this->db->update ( "notifymessages", array (
						"active" => $active
				) );
			}
			$this->session->set_userdata ( array (
					"msg" => "1"
			) );
			redirect ( base_url () . "admin/notify", "refresh" );
			
		}
		$data ["target"] = "notify";
		$data ["notifies"] = $this->mnotify->getNotifyMessages ();
		$this->load->view ( "admin/index", $data );
	}
}