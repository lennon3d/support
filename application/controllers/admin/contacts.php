<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin contacts controller
class Contacts extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mcontactus" );
	}
	
	public function index() {
		if ($this->permissions->contacts ["see"] != "1")
			$this->mfunctions->noPermission();
		$contacts = $this->mcontactus->getAllContacts ();
		$data ["contacts"] = $contacts;
		$data ["target"] = "contacts";
		$this->load->view ( "admin/index", $data );
	}
	
	// show contact us form
	public function showContactus($contact_id) {
		if ($this->permissions->contacts ["see"] != "1")
			$this->mfunctions->noPermission();
		$contact = $this->mcontactus->getContactById ( $contact_id );
		$this->db->where("id", $contact_id);
		$this->db->update("contactus_forms", array("seen" => 1));
		$data ["contact"] = $contact;
		$data ["replies"] = $this->mcontactus->getContactReplies ( $contact_id );
		if ($_POST) {
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_rules ( 'content', lang ( 'enter_reply_content' ), 'required' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "show_contact";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->mcontactus->replyContact ( $contact_id, array (
						"user" => $this->session->userdata ( "id" ),
						"content" => $_POST ["content"],
						"contact" => $contact_id,
						"datetime" => time () 
				) );
				if($query>0)
					$this->mfunctions->actionReport("contactus", "reply_contact");
				
				//send notify messages if contact us reply sent
				if ($query > 0) {
					$this->load->model ( "msms" );
					$this->load->model ( "memail" );
					$this->load->model ( "mnotify" );
					$set = $this->mfunctions->getSiteSettings ();
					$notify = $this->mnotify->getNotifyStatus ();
					//notify to admin mobile
					if ($notify ["contactus_reply_admin_mobile"] [0] == "1") {
						$this->msms->sendSms ( array (
								"message" => $notify ["contactus_reply_admin_mobile"] [1],
								"numbers" => $set->admin_mobiles 
						) );
					}
					//notify to admin email
					if ($notify ["contactus_reply_admin_email"] [0] == "1") {
						$emails = explode(",", $set->admin_emails);
						$this->memail->sendEmail( array (
								"message" => $notify ["contactus_reply_admin_email"] [1],
								"address" => $emails,
								"subject" => "Sadaf"
						) );
					}
					//notify to user email
					if ($notify ["contactus_reply_user_email"] [0] == "1") {
						$emails = array($contact->email);
						$this->memail->sendEmail( array (
								"message" => $notify ["contactus_reply_user_email"] [1],
								"address" => $emails,
								"subject" => "Sadaf"
						) );
					}
					//notify to user mobile
					if ($notify ["contactus_reply_user_mobile"] [0] == "1") {
						$mobile = $contact->mobile;
						$this->msms->sendSms ( array (
								"message" => $notify ["contactus_reply_user_mobile"] [1],
								"numbers" => $mobile
						) );
					}
				}

				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/contacts/showContactus/$contact_id", "refresh" );
			}
		} else {
			$data ["target"] = "show_contact";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// delete existed contacts
	public function deleteContacts() {
		if ($this->permissions->contacts ["delete"] != "1")
			$this->mfunctions->noPermission();
		if ($_POST) {
			foreach ( $_POST ["contacts"] as $id ) {
				$this->mcontactus->deleteContact ( $id );
			}
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			$this->mfunctions->actionReport("contactus", "delete");
			redirect ( base_url () . "admin/contacts", "refresh" );
		}
	}
	/*
	// update contact us titles
	public function updateTitles() {
		if ($this->permissions->langs_titles ["see"] != "1")
			$this->mfunctions->noPermission();
		if ($_POST) {
			if ($this->permissions->langs_titles ["modify"] != "1")
				$this->mfunctions->noPermission();
			$count = 0;
			$data ["message"] = "";
			foreach ( $_POST as $key => $value ) {
				$name_array = explode ( "_", $key );
				$name = $name_array [0] . "_" . $name_array [1];
				$lang_code = $name_array [2];
				if ($value == "") {
					$count ++;
					$lang = $this->mfunctions->getLangByCode ( $lang_code );
					$data ["msg"] = "-1";
					$data ["message"] .= lang ( "enter" ) . " " . lang ( $name ) . " ...." . lang ( "language" ) . ": " . $lang->language . "<br/>";
				} else {
					$query = $this->mcontactus->updateTitles ( $lang_code, $name, $value );
					if($query>0)
						$this->mfunctions->actionReport("contactus", "update_titles");
				}
			}
			if ($count == 0) {
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/contacts", "refresh" );
			}
		}
		$data ["contactus_titles"] = $this->mcontactus->getContactusTitles ();
		$data ["target"] = "contactus_titles";
		$data ["langs"] = $this->mfunctions->getAllLangs ();
		$this->load->view ( "admin/index", $data );
	}
	*/
}