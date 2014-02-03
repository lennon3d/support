<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin sms controller
class Sms extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "msms" );
	}
	
	public function index() {
		if ($this->permissions->smsgates ["smsgates_see"] != "1")
			$this->mfunctions->noPermission ();
		$gates = $this->msms->getAllGates ();
		$data ["gates"] = $gates;
		$data ["target"] = "sms_gates";
		$this->load->view ( "admin/index", $data );
	}
	
	// create new sms gate
	public function insertGate() {
		if ($this->permissions->smsgates ["smsgates_create"] != "1")
			$this->mfunctions->noPermission ();
		if ($_POST) {
			$active = (isset ( $_POST ["active"] ) ? "1" : "0");
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_rules ( 'title', lang ( 'enter_gate_title' ), 'required' );
			$this->form_validation->set_rules ( 'send_url', lang ( 'enter_send_url' ), 'required' );
			$this->form_validation->set_rules ( 'sender_name', lang ( 'enter_sender_name' ), 'required' );
			$this->form_validation->set_rules ( 'username', lang ( 'enter_username' ), 'required' );
			$this->form_validation->set_rules ( 'password', lang ( 'enter_password' ), 'required' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_gate";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->msms->insertGate ( array (
						"title" => $_POST ["title"],
						"send_url" => $_POST ["send_url"],
						"sender_name" => $_POST ["sender_name"],
						"username" => $_POST ["username"],
						"password" => $_POST ["password"],
						"default" => 0,
						"method" => $_POST ["method"],
						"success_op" => $_POST ["success_op"],
						"success_status" => $_POST ["success_status"],
						"active" => $active 
				) );
				if ($query > 0)
					$this->mfunctions->actionReport ( "gates", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/sms", "refresh" );
			}
		} else {
			$data ["target"] = "insert_gate";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify sms gate
	public function modifyGate($gate_id = "") {
		if ($this->permissions->smsgates ["smsgates_modify"] != "1")
			$this->mfunctions->noPermission ();
		if ($gate_id != "") {
			$gate = $this->msms->getGateById ( $gate_id );
			if ($gate) {
				$data ["gate"] = $gate;
				if ($_POST) {
					$active = (isset ( $_POST ["active"] ) ? "1" : "0");
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_rules ( 'title', lang ( 'enter_gate_title' ), 'required' );
					$this->form_validation->set_rules ( 'send_url', lang ( 'enter_send_url' ), 'required' );
					$this->form_validation->set_rules ( 'sender_name', lang ( 'enter_sender_name' ), 'required' );
					$this->form_validation->set_rules ( 'username', lang ( 'enter_username' ), 'required' );
					$this->form_validation->set_rules ( 'password', lang ( 'enter_password' ), 'required' );
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_gate";
						$this->load->view ( "admin/index", $data );
					} else {
						$query = $this->msms->modifyGate ( $gate_id, array (
								"title" => $_POST ["title"],
								"send_url" => $_POST ["send_url"],
								"sender_name" => $_POST ["sender_name"],
								"username" => $_POST ["username"],
								"password" => $_POST ["password"],
								"method" => $_POST ["method"],
								"success_op" => $_POST ["success_op"],
								"success_status" => $_POST ["success_status"],
								"active" => $active 
						) );
						if ($query > 0)
							$this->mfunctions->actionReport ( "gates", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/sms", "refresh" );
					}
				} else {
					$data ["target"] = "modify_gate";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete gate
	public function deleteGate($gate_id = "") {
		if ($this->permissions->smsgates ["smsgates_delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($gate_id != "") {
			$gate = $this->msms->getGateById ( $gate_id );
			if ($gate->default == "1") {
				$data ["msg"] = "-1";
				$data ["message"] = lang ( "cant_delete_default_gate" );
				$gates = $this->msms->getAllGates();
				$data ["gates"] = $gates;
				$data ["target"] = "sms_gates";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->msms->deleteGate ( $gate_id );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				if ($query > 0)
					$this->mfunctions->actionReport ( "gates", "delete" );
				redirect ( base_url () . "admin/sms", "refresh" );
			}
		}
	}
	
	// set gate to be default
	public function setDefaultGate() {
		if ($_POST) {
			$this->msms->setDefaultGate ( $_POST ["gate"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "gates", "change_default" );
			redirect ( base_url () . "admin/sms", "refresh" );
		}
	}
}