<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin Banners controller
class Whats extends  AdminController{
	function __construct() {
		parent::__construct ();
		$this->load->model ( "whats/mwhats" );
	}

	public function index() {
		if ($this->permissions->whats ["see"] != "1")
			$this->mfunctions->noPermission ();
	}

	//whats settings handel
	public function settings(){
		//if ($this->permissions->whats_settings ["see"] != "1")
		//	$this->mfunctions->noPermission();
		$data["set"] = $this->mwhats->getSettings();
		$data["target"] = "whats_settings";
		if ($_POST) {
		//	if ($this->permissions->whats_settings ["whats"] != "1")
		//		$this->mfunctions->noPermission();
			$query = $this->mwhats->updateSettings( array (
					"active_service" => (isset ( $_POST ["active_service"] ) ? "1" : "0"),
					"register_points" => trim($_POST ["register_points"]),
					"free_messages" => trim($_POST ["free_messages"]),
					"notify_nick" => trim($_POST ["notify_nick"]),
					"notify_user" => trim($_POST ["notify_user"]),
					"test_user" => trim($_POST ["test_user"])
			) );
			if ($query > 0) {
				$this->session->set_userdata ( array (
						"msg" => "1"
				) );
				redirect ( base_url () . "admin/whats/settings", "refresh" );
			} else {
				$this->session->set_userdata ( array (
						"msg" => "-1",
						"message" => lang ( "database_error" )
				) );
				redirect ( base_url () . "admin/whats/settings", "refresh" );
			}
		}
		$data["users"] = $this->musers->getAllUsers(MFunctions::GROUP_WHATSAPP);
		$this->load->view("admin/index", $data);
	}

	//whats sending settings handel
	public function sendSettings(){
		//if ($this->permissions->whats_settings ["see"] != "1")
		//	$this->mfunctions->noPermission();
		$data["set"] = $this->mwhats->getSettings();
		$data["target"] = "whats_send_settings";
		if ($_POST) {
		//	if ($this->permissions->whats_settings ["whats"] != "1")
		//		$this->mfunctions->noPermission();
			$query = $this->mwhats->updateSettings( array (
					"msg_per_channel" => trim($_POST ["msg_per_channel"] ),
					"channels_loop" => trim($_POST ["channels_loop"]),
					"send_hours" => trim($_POST ["send_hours"]),
					"active_send" => (isset($_POST["active_send"])?1:0),
			) );
			if ($query > 0) {
				$this->session->set_userdata ( array (
						"msg" => "1"
				) );
				redirect ( base_url () . "admin/whats/sendSettings", "refresh" );
			} else {
				$this->session->set_userdata ( array (
						"msg" => "-1",
						"message" => lang ( "database_error" )
				) );
				redirect ( base_url () . "admin/whats/sendSsettings", "refresh" );
			}
		}
		$this->load->view("admin/index", $data);
	}

	public function test(){
		//$w = new WhatsProt('201223745705', $token, "marwan", true);

	//	$w->connect ();
	//	$w->loginWithPassword ("fhCKhNkO7nXVv0tB2VvLpEigUdM=");
		//$w->accountInfo();
		//$w->sendGetStatus("201270571563");
		//$w->getMessages();
		//$w->disconnect ();

		//$w->accountInfo();
		//$host = 'https://v.whatsapp.net/v2/exist';
		//$query = array(
		//		'cc' => '20',
		//		'in' => '1223745705',
		//		'id' => md5("201223745705")
		//);
		//print_r($w->getResponse($host, $query));
	//	$url = file_get_contents("https://v.whatsapp.net/v2/exist?cc=20&in=1067676608&id=".md5("1067676608"));
		//echo $url;
		$this->load->model("whats/msend");
		$htis->msend->sendChannelMessage("201067676608","201206579554");
	}


}