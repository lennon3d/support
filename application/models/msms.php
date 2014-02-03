<?php
class MSms extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->lang->load ( "arabic", "arabic" );
	}
	
	// send sms now function
	public function sendSms($atts = array()) {
		$gate = $this->getDefaultGate ();
		$op = $gate->success_op;
		$success = $gate->success_status;
		$url = str_replace ( array (
				"#username",
				"#password",
				"#sender",
				"#message",
				"#numbers" 
		), array (
				$gate->username,
				$gate->password,
				$gate->sender_name,
				$atts ["message"],
				$atts ["numbers"] 
		), $gate->send_url );
		$url = explode ( "?", $url );
		$send_url = $url [0];
		$send_params = $url [1];
		$send_params = explode ( "&", $send_params );
		$params_array = array ();
		foreach ( $send_params as $param ) {
			$eq = explode ( "=", $param );
			$params_array += array (
					$eq [0] => $eq [1] 
			);
		}
		$postdata = http_build_query ( $params_array );
		$opts = array (
				'http' => array (
						'method' => $gate->method,
						'header' => 'Content-type: application/x-www-form-urlencoded',
						'content' => $postdata 
				) 
		);
		$context = stream_context_create ( $opts );
		if ($result = file_get_contents ( $send_url, false, $context )) {
			$operation = $this->operation ( $result, $success, $op );
			$this->smsReport ( array (
					"datetime" => time (),
					"message" => $atts ["message"],
					"status" => ($operation ? "Success: \n\t" : "Failed: \n\t") . $result,
					"mobiles" => $atts ["numbers"],
					"gate" => $gate->title 
			) );
			return $operation;
		} else {
			$this->smsReport ( array (
					"datetime" => time (),
					"message" => $atts ["message"],
					"status" => lang("cant_open_socket"),
					"mobiles" => $atts ["numbers"],
					"gate" => $gate->title 
			) );
			return false;
		}
	}
	
	// create new sms gateway
	public function insertGate($atts = array()) {
		return $this->db->insert ( "smsgates", $atts );
	}
	
	// modify existed smsgate
	public function modifyGate($id, $atts = array()) {
		$this->db->where ( "id", $id );
		return $this->db->update ( "smsgates", $atts );
	}
	
	// get an existed smsgate by id
	public function getGateById($id) {
		$query = $this->db->get_where ( "smsgates", array (
				"id" => $id 
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}
	
	// get all existed sms gateways
	public function getAllGates() {
		$query = $this->db->get ( "smsgates" );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get default sms gateway
	public function getDefaultGate() {
		$query = $this->db->get_where ( "smsgates", array (
				"default" => "1" 
		) );
		if ($query->num_rows () == 1)
			return $query->row ();
		return false;
	}
	
	// set sms gate to be default
	public function setDefaultGate($id) {
		$gates = $this->getAllGates ();
		if ($gates)
			foreach ( $gates as $gate ) {
				$this->db->where ( "id", $gate->id );
				$this->db->update ( "smsgates", array (
						"default" => "0" 
				) );
			}
		$this->db->where ( "id", $id );
		return $this->db->update ( "smsgates", array (
				"default" => "1" 
		) );
	}
	
	// set sms gate to be active
	public function setGateActive($id) {
		$this->db->where ( "id", $id );
		return $this->db->update ( "smsgates", array (
				"active" => "1" 
		) );
	}
	
	// set sms gate to be inactive
	public function setGateInactive($id) {
		$this->db->where ( "id", $id );
		return $this->db->update ( "smsgates", array (
				"active" => "0" 
		) );
	}
	
	// delete existed sms gate
	public function deleteGate($id) {
		$this->db->where ( "id", $id );
		return $this->db->delete ( "smsgates" );
	}
	
	// function to return result of operation choosing a variable as operator
	public function operation($a, $b, $op) {
		switch ($op) {
			case "equal" :
				return ($a == $b ? true : false);
				break;
			case "greater" :
				return ($a > $b ? true : false);
				break;
			case "lesser" :
				return ($a < $b ? true : false);
				break;
			case "contain" :
				return (strpos ( $a, $b ) != "" ? true : false);
				break;
			case "start_with" :
				$len = strlen ( $b );
				return (strsub ( $a, 0, $len ) == $b ? true : false);
				break;
		}
	}
	
	// insert sms report to database
	public function smsReport($atts = array()) {
		return $this->db->insert ( "smsreport", $atts );
	}
}