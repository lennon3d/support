<?php
class MEmail extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->library ( "SMTP/phpmailer" );
	}
	
	// get email settings
	public function getEmailSettings() {
		$query = $this->db->get ( "emailsettings" );
		return $query->row ();
	}
	
	// set email settings
	public function setEmailSettings($atts = array()) {
		$this->db->where ( "id", "1" );
		return $this->db->update ( "emailsettings", array (
				"server" => $atts ["server"],
				"port" => $atts ["port"],
				"method" => $atts ["method"],
				"username" => $atts ["username"],
				"password" => $atts ["password"] 
		) );
	}
	
	// send email $atts=array("address","subject","message");
	public function sendEmail($atts = array()) {
		$settings = $this->getEmailSettings ();
		$mail = new PHPMailer ();
		if ($settings->method == "SMTP") {
			$mail->IsSMTP ();
			$mail->Host = $settings->server;
			$mail->Port = $settings->port;
			$mail->SMTPSecure = 'ssl';
			$mail->SMTPAuth = true;
			
			$mail->Username = $settings->username;
			$mail->Password = $settings->password;
			
			$mail->From = $settings->username;
			$mail->FromName = $settings->sendername;
		} else {
			$mail->setFrom ( $settings->sendername, $settings->sendername );
		}
		$mail->IsHTML ( true );
		foreach ( $atts ["address"] as $address )
			$mail->AddAddress ( $address );
		$mail->Subject = $atts ["subject"];
		$mail->MsgHTML ( $atts ["message"] );
		if (! $mail->Send ()) {
			return $mail->ErrorInfo;
		} else {
			$this->db->insert ( "emailreport", array (
					"emails" => implode(",", $atts ["address"]),
					"message" => $atts ["message"],
					"datetime" => time () 
			) );
			return 1;
		}
	}
}