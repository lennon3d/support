<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin guests controller
class Guests extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "msite" );
		$this->mfunctions->deleteGuests ();
	}
	
	public function index() {
	}
	
	// get online guests
	public function onlineGuests() {
		$guests = $this->msite->getAllOnlineGuests ();
		$data ["guests"] = $guests;
		$data ["target"] = "online_guests";
		$this->load->view ( "admin/index", $data );
	}
	
	// block an online guest
	public function blockGuest($guest_id) {
		$guest = $this->msite->getGuestById ( $guest_id );
		$guests = $this->msite->getAllOnlineGuests ();
		
		if ($guest) {
			$block = $this->msite->getBlockedIp ( $guest->ipaddress );
			if (! $block) {
				$this->msite->blockIp ( $guest->ipaddress );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
					$this->mfunctions->actionReport("guests", "block_ip");
				redirect ( base_url () . "admin/guests/onlineGuests", "refresh" );
			} else {
				$data ["msg"] = "-1";
				$data ["message"] = lang ( "blocked_ip_exist" );
				$data ["guests"] = $guests;
				$data ["target"] = "online_guests";
				$this->load->view ( "admin/index", $data );
			}
		} else {
			$data ["msg"] = "-1";
			$data ["message"] = lang ( "operation_error" );
			$data ["guests"] = $guests;
			$data ["target"] = "online_guests";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// show blocked ip
	public function blockedIps() {
		if ($this->permissions->blockip ["see"] != "1")
			$this->mfunctions->noPermission();
		$ips = $this->msite->getAllBlockedIps ();
		$data ["ips"] = $ips;
		$data ["target"] = "blocked_ips";
		$this->load->view ( "admin/index", $data );
	}
	
	// unblock an existed ip address
	public function unBlockGuest($id = "") {
		$ips = $this->msite->getAllBlockedIps ();
		if ($id != "") {
			$this->msite->unBlockGuest ( $id );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
				$this->mfunctions->actionReport("guests", "unblock_ip");
			redirect ( base_url () . "admin/guests/blockedIps", "refresh" );
		} else {
			$data ["ips"] = $ips;
			$data ["target"] = "blocked_ips";
			$this->load->view ( "admin/index", $data );
		}
	}
}