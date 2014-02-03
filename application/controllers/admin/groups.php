<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin groups controller
class Groups extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mgroups" );
	}
	
	public function groups(){
		
	}
	public function mobileGroup($out_data = array()) {
		$data = $out_data;
		static $count = 0;
		static $message = "ارقام لم يتم ادخالها: <br/>";
		static $all_count = 0;
		$data ["mobiles"] = $this->mgroups->getMobileSub ();
		$data ["target"] = "mobile_group";
		if ($_POST) {
			if ($_POST ["type"] == "excel") {
				$file_type = ($_FILES ["userfile"] ["type"] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ? false : true);
				if (! $file_type) {
					$data ["msg"] = "-1";
					if (! $file_type) {
						$data ["message"] = lang ( "choose_excel_file" );
					}
					$this->load->view ( "admin/index", $data );
				} else {
					$config ['upload_path'] = './assets/uploads/';
					$config ['file_name'] = 'sub.xlsx';
					$config ['allowed_types'] = 'xlsx';
					$config ['overwrite'] = true;
					$this->load->library ( 'upload', $config );
					if (! $this->upload->do_upload ()) {
						$data ["msg"] = "-1";
						$data ["message"] = lang ( "choose_excel_file" );
						$this->load->view ( "admin/index", $data );
					} else {
						$mobiles = $this->mgroups->importFromExcel ();
						foreach ( $mobiles as $mobile ) {
							$all_count ++;
							if (count ( $mobile ) == 2) {
								if (is_numeric ( $mobile [1] ) && strlen ( $mobile [1] ) > 9 && strlen ( $mobile [1] ) < 15) {
									if ($this->mgroups->checkMobile ( $mobile [1] )) {
										$this->mgroups->insertSub ( array (
												"name" => $mobile [0],
												"mobile" => $mobile [1] 
										) );
										$this->mfunctions->actionReport ( "groups", "insert_mobiles" );
									} else {
										$message .=  $mobile [1] . ", ";
										$count ++;
									}
								} else {
									$message .= $mobile [1] . ", ";
									$count ++;
								}
							}
						}
						if ($count > 0) {
							$message .= "count of couldn't inserted: " . $count . "<br/>";
							$data ["msg"] = "-1";
							$data ["message"] = $message;
							$data ["mobiles"] = $this->mgroups->getMobileSub ();
							$data ["emails"] = $this->mgroups->getEmailSub ();
							$data ["target"] = "mobile_group";
							$this->load->view ( "admin/index", $data );
						} else {
							$this->session->set_userdata ( array (
									"msg" => "1" 
							) );
							redirect ( base_url () . "admin/groups/mobileGroup", "refresh" );
						}
					}
				}
				// mobiles from text file
			} elseif ($_POST ["type"] == "text") {
				$file_type = ($_FILES ["userfile"] ["type"] != "text/plain" ? false : true);
				if (! $file_type) {
					$data ["msg"] = "-1";
					if (! $file_type) {
						$data ["message"] = lang ( "choose_text_file" );
					}
					$this->load->view ( "admin/index", $data );
				} else {
					$config ['upload_path'] = './assets/uploads/';
					$config ['file_name'] = 'sub.txt';
					$config ['allowed_types'] = 'txt';
					$config ['overwrite'] = true;
					$this->load->library ( 'upload', $config );
					if (! $this->upload->do_upload ()) {
						$data ["msg"] = "-1";
						$data ["message"] = "not text file";
						$this->load->view ( "admin/index", $data );
					} else {
						$mobiles = $this->mgroups->importFromText ( $_POST ["sep"] );
						foreach ( $mobiles as $mobile ) {
							if (count ( $mobile ) == 2) {
								if (is_numeric ( $mobile [1] ) && strlen ( $mobile [1] ) > 9 && strlen ( $mobile [1] ) < 15) {
									if ($this->mgroups->checkMobile ( $mobile [1] )) {
										$this->mgroups->insertSub ( array (
												"name" => $mobile [0],
												"mobile" => $mobile [1] 
										) );
										$this->mfunctions->actionReport ( "groups", "insert_mobiles" );
									} else {
										$message .=  $mobile [1] . ", ";
										$count ++;
									}
								} else {
									$message .= $mobile [1] . ", ";
									$count ++;
								}
							}
						}
						if ($count > 0) {
							$message .= "<br/> number of couldn't inserted: " . $count . "<br/>";
							$data ["msg"] = "-1";
							$data ["message"] = $message;
							$data ["target"] = "mobile_group";
							$data ["mobiles"] = $this->mgroups->getMobileSub ();
							$data ["emails"] = $this->mgroups->getEmailSub ();
							$this->load->view ( "admin/index", $data );
						} else {
							$this->session->set_userdata ( array (
									"msg" => "1" 
							) );
							redirect ( base_url () . "admin/groups/mobileGroup", "refresh" );
						}
					}
				}
			}
		} else {
			$data ["target"] = "mobile_group";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// show email group
	public function emailGroup($out_data = array()) {
		$this->load->helper ( "email" );
		$data = $out_data;
		static $count = 0;
		static $message = "ايميلات لم يتم الدخالها : <br/>";
		static $all_count = 0;
		if ($this->permissions->groups ["see"] != "1")
			$this->mfunctions->noPermission();
		$data ["emails"] = $this->mgroups->getEmailSub ();
		$data ["target"] = "email_group";
		if ($_POST) {
			// emails from excel file
			if ($_POST ["type"] == "excel") {
				$file_type = ($_FILES ["userfile"] ["type"] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ? false : true);
				if (! $file_type) {
					$data ["msg"] = "-1";
					if (! $file_type) {
						$data ["message"] = lang ( "choose_excel_file" );
					}
					$this->load->view ( "admin/index", $data );
				} else {
					$config ['upload_path'] = './assets/uploads/';
					$config ['file_name'] = 'sub.xlsx';
					$config ['allowed_types'] = 'xlsx';
					$config ['overwrite'] = true;
					$this->load->library ( 'upload', $config );
					if (! $this->upload->do_upload ()) {
						$data ["msg"] = "-1";
						$data ["message"] = lang ( "choose_excel_file" );
						$this->load->view ( "admin/index", $data );
					} else {
						$emails = $this->mgroups->importFromExcel ();
						foreach ( $emails as $email ) {
							$all_count ++;
							if (count ( $email ) == 2) {
								if (valid_email ( $email [1] )) {
									if ($this->mgroups->checkEmail ( $email [1] )) {
										$this->mgroups->insertSub ( array (
												"name" => $email [0],
												"email" => $email [1] 
										) );
										$this->mfunctions->actionReport ( "groups", "insert_emails" );
									} else {
										$message .= $email [1] . ", ";
										$count ++;
									}
								} else {
									$message .= $email [1] . ", ";
									$count ++;
								}
							}
						}
						if ($count > 0) {
							$message .= "<br/> count of couldn't inserted: " . $count . "<br/>";
							$data ["msg"] = "-1";
							$data ["message"] = $message;
							$data ["mobiles"] = $this->mgroups->getMobileSub ();
							$data ["emails"] = $this->mgroups->getEmailSub ();
							$data ["target"] = "email_group";
							$this->load->view ( "admin/index", $data );
						} else {
							$this->session->set_userdata ( array (
									"msg" => "1" 
							) );
							redirect ( base_url () . "admin/groups/emailGroup", "refresh" );
						}
					}
				}
				// emails from text file
			} elseif ($_POST ["type"] == "text") {
				$file_type = ($_FILES ["userfile"] ["type"] != "text/plain" ? false : true);
				if (! $file_type) {
					$data ["msg"] = "-1";
					if (! $file_type) {
						$data ["message"] = lang ( "choose_text_file" );
					}
					$this->load->view ( "admin/index", $data );
				} else {
					$config ['upload_path'] = './assets/uploads/';
					$config ['file_name'] = 'sub.txt';
					$config ['allowed_types'] = 'txt';
					$config ['overwrite'] = true;
					$this->load->library ( 'upload', $config );
					if (! $this->upload->do_upload ()) {
						$data ["msg"] = "-1";
						$data ["message"] = "not text file";
						$this->load->view ( "admin/index", $data );
					} else {
						$emails = $this->mgroups->importFromText ( $_POST ["sep"] );
						foreach ( $emails as $email ) {
							if (count ( $email ) == 2) {
								if (valid_email ( $email [1] )) {
									if ($this->mgroups->checkEmail ( $email [1] )) {
										$this->mgroups->insertSub ( array (
												"name" => $email [0],
												"email" => $email [1] 
										) );
										$this->mfunctions->actionReport ( "groups", "insert_emails" );
									} else {
										$message .= ", ";
										$count ++;
									}
								} else {
									$message .= $email [1] . ", ";
									$count ++;
								}
							}
						}
						if ($count > 0) {
							$message .= "count of couldn't inserted: " . $count . "<br/>";
							$data ["msg"] = "-1";
							$data ["message"] = $message;
							$data ["mobiles"] = $this->mgroups->getMobileSub ();
							$data ["emails"] = $this->mgroups->getEmailSub ();
							$data ["target"] = "email_group";
							$this->load->view ( "admin/index", $data );
						} else {
							$this->session->set_userdata ( array (
									"msg" => "1" 
							) );
							redirect ( base_url () . "admin/groups/emailGroup", "refresh" );
						}
					}
				}
			}
		} else {
			$data ["target"] = "email_group";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	//
	public function getFile() {
		echo "<pre>";
		var_dump ( $this->mgroups->importEmailsFromText ( "," ) );
		echo "</pre>";
	}
	
	// delete an existed mobile subscriber
	public function deleteMobileSub() {
		if ($_POST) {
			foreach ( $_POST ["mobile"] as $sub ) {
				$this->mgroups->deleteSub ( $sub );
			}
		}
		$this->mfunctions->actionReport ( "groups", "delete_sub" );
		$this->session->set_userdata ( array (
				"msg" => "1" 
		) );
		redirect ( base_url () . "admin/groups/mobileGroup", "refresh" );
	}
	
	// delete an existed mobile subscriber
	public function deleteEmailSub() {
		if ($_POST) {
			foreach ( $_POST ["email"] as $sub ) {
				$this->mgroups->deleteSub ( $sub );
			}
		}
		$this->mfunctions->actionReport ( "groups", "delete_sub" );
		$this->session->set_userdata ( array (
				"msg" => "1" 
		) );
		redirect ( base_url () . "admin/groups/emailGroup", "refresh" );
	}
	
	// get subscribers emails
	public function getSubsEmails() {
		if (isset ( $_POST ["ids"] )) {
			static $emails = "";
			$ids = explode ( ",", $_POST ["ids"] );
			array_pop ( $ids );
			foreach ( $ids as $id ) {
				$sub = $this->mgroups->getSubById ( $id );
				$emails .= $sub->email . ",";
			}
			echo $emails;
		}
	}
	
	// get subscribers mobiles
	public function getSubsMobiles() {
		if (isset ( $_POST ["ids"] )) {
			static $mobiles = "";
			$ids = explode ( ",", $_POST ["ids"] );
			array_pop ( $ids );
			foreach ( $ids as $id ) {
				$sub = $this->mgroups->getSubById ( $id );
				$mobiles .= $sub->mobile . ",";
			}
			echo $mobiles;
		}
	}
	
	// send email
	public function sendEmail() {
		if (isset ( $_POST ["emails"] )) {
			$this->load->model ( "memail" );
			$emails = explode ( ",", $_POST ["emails"] );
			array_pop ( $emails );
			$request = $this->memail->sendEmail ( array (
					"address" => $emails,
					"subject" => $_POST ["email_subject"],
					"message" => $_POST ["email_content"] 
			) );
			if ($request > 0)
				$this->mfunctions->actionReport ( "groups", "send_email" );
			if ($request == "1") {
				$this->session->set_userdata ( array (
						"msg" => 1 
				) );
				redirect ( base_url () . "admin" . DIRECTORY_SEPARATOR . "groups/emailGroup" );
			} else {
				$this->session->set_userdata ( array (
						"msg" => "-1",
						"message" => $request 
				) );
				redirect ( base_url () . "admin" . DIRECTORY_SEPARATOR . "groups/emailGroup" );
			}
		}
	}
	
	// send sms
	public function sendSms() {
		if (isset ( $_POST ["mobiles_content"] )) {
			$this->load->model ( "msms" );
			$request = $this->msms->sendSms ( array (
					"numbers" => $_POST ["mobiles_content"],
					"message" => $_POST ["sms_content"] 
			) );
			if ($request > 0)
				$this->mfunctions->actionReport ( "groups", "send_sms" );
			if ($request) {
				$this->session->set_userdata ( array (
						"msg" => 1 
				) );
				redirect ( base_url () . "admin" . DIRECTORY_SEPARATOR . "groups/mobileGroup" );
			} else {
				$this->session->set_userdata ( array (
						"msg" => "-1",
						"message" => lang ( "sms_send_error" ) 
				) );
				redirect ( base_url () . "admin" . DIRECTORY_SEPARATOR . "groups/mobileGroup" );
			}
		}
	}
}