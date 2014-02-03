<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin sms controller
class Email extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "memail" );
	}
	
	public function index() {
		
	}
	
	//set email settings
	public function emailSettings(){
		if ($this->permissions->emailsettings ["see"] != "1")
			$this->mfunctions->noPermission();
		$settings = $this->memail->getEmailSettings();
		$data["settings"] = $settings;
		$data["target"] = "email_settings";
		$this->load->view("admin/index", $data);
	}
	
	//set email settings
	public function setEmailSettings(){
		if ($this->permissions->emailsettings ["modify"] != "1")
			$this->mfunctions->noPermission();
		if($_POST){
			$this->memail->setEmailSettings(array(
					"username" => $_POST["username"],
					"password" => $_POST["password"],
					"server" => $_POST["server"],
					"port" => $_POST["port"],
					"method" => $_POST["method"],
					"sendername" => $_POST["sendername"],
			));
			$query = $this->session->set_userdata(array("msg"=>"1"));
			if($query>0)
				$this->mfunctions->actionReport("email_settings", "modify");
			redirect(base_url()."admin/email/EmailSettings","refresh");
		}
	}
}