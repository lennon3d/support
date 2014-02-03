<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// site main
class User extends SiteController {
	function __construct() {
		parent::__construct ();
	}

	// enter code screen for user verifing registeration
	public function enterCode() {
		if ($this->msite->getUserStatus ( $this->USER_ID ) == MFunctions::REGISTER_STATUS_ACTIVE)
			redirect ( $this->SITE_URL."cp/whatsapp/send/sendMessage" );
		if ($_POST) {
			$status = true;
			$message = "";
			if (isset ( $_POST ["mobile_code"] )) {
				$user_mobile_code = $this->msite->getMobileCode ( $this->USER_ID );
				if ($user_mobile_code == trim ( $_POST ["mobile_code"] )) {
					if ($this->msite->getUserStatus ( $this->USER_ID ) == MFunctions::REGISTER_STATUS_BOTH)
						$this->msite->updateStatus ( $this->USER_ID, MFunctions::REGISTER_STATUS_EMAIL );
					else {
						$this->msite->updateStatus ( $this->USER_ID, MFunctions::REGISTER_STATUS_ACTIVE );
					}
				} else {
					$message .= lang ( "error_mobile_code" );
					$status = false;
				}
			}

			if (isset ( $_POST ["email_code"] )) {
				$user_email_code = $this->msite->getEmailCode ( $this->USER_ID );
				if ($user_email_code == trim ( $_POST ["email_code"] )) {
					if ($this->msite->getUserStatus ( $this->USER_ID ) == MFunctions::REGISTER_STATUS_BOTH)
						$this->msite->updateStatus ( $this->USER_ID, MFunctions::REGISTER_STATUS_MOBILE );
					else {
						$this->msite->updateStatus ( $this->USER_ID, MFunctions::REGISTER_STATUS_ACTIVE );
					}
				} else {
					$status = false;
					$message .= lang ( "error_email_code" );
				}
			}
			if ($status) {
				$this->session->set_flashdata ( array (
						"msg" => "1"
				) );
				redirect ( $this->SITE_URL. "cp/whatsapp/send/sendMessage" );
			} else {
				$this->session->set_flashdata ( array (
						"msg" => "-1",
						"message" => $message
				) );
				redirect ( base_url () . $this->_seg . "/user/enterCode" );
			}
		}
		$data ["target"] = "enter_code";
		$this->load->view ( "site/index", $data );
	}

	// forget password form
	public function forgetPassword() {
		if ($this->session->userdata ( "validated" ))
			redirect ();
		$data ["target"] = "forget_password";
		if ($_POST) {
			$data ["username"] = trim ( $this->security->xss_clean ( $_POST ["username"] ) );
			$data ["mobile"] = trim ( $this->security->xss_clean ( $_POST ["mobile"] ) );

			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'numeric', "* " . lang ( "numeric" ) );
			if ($_POST ["forget_type"] == "mobile")
				$this->form_validation->set_rules ( 'mobile', "* " . lang ( "entermobile" ), "trim|required|numeric|callback_checkMobileLength" );
			else
				$this->form_validation->set_rules ( 'username', "* " . lang ( "enterusername" ), "trim|required|callback_checkUsernameLength" );

			if ($this->form_validation->run () == FALSE) {
				$data ["message"] = validation_errors ();
				$data ["status"] = "-1";
				$this->load->view ( "site/index", $data );
			} else {
				$req = $this->msite->forgetPassword ( $_POST ["forget_type"], ($_POST ["forget_type"] == "mobile" ? $data ["mobile"] : $data ["username"]) );
				if ($req > 0) {
					$data ["message"] = lang ( "forget_success" );
					$data ["title"] = lang ( "reget_password" );
					$data ["target"] = "success_page";
					$this->load->view ( "site/index", $data );
				} else {
					$data ["message"] = lang ( $_POST ["forget_type"] ) . " " . lang ( "not_exist" );
					$data ["status"] = "-1";
					$this->load->view ( "site/index", $data );
				}
			}
		} else {
			$this->load->view ( "site/index", $data );
		}
	}

	// login function
	public function login() {
		if ($this->session->userdata ( "validated" ))
			redirect ( $this->SITE_URL."cp/whatsapp/send/sendMessage" );
		$data ["username"] = (isset ( $_POST ["username"] ) ? $_POST ["username"] : "");
		if ($_POST) {
			$result = $this->mfunctions->validate ();
			if (! $result) {
				$data ["status"] = "-1";
				$data ["message"] = lang ( "invalid_login" );
			} else {
				redirect ( $this->SITE_URL."cp/whatsapp/send/sendMessage" );
			}
		}
		$data ["target"] = "login";
		$this->load->view ( "site/index", $data );
	}

	// log out when user name press logout
	public function logout() {
		$this->session->sess_destroy ();
		redirect ( base_url () . $this->_seg );
	}

	// guest register page
	public function register() {
		if ($this->session->userdata ( "validated" ))
			redirect ();
		if ($this->_set->register_active) {
			$phone = (isset ( $_POST ["phone"] ) ? $_POST ["phone"] : "");
			$birthdate = (isset ( $_POST ["birthdate"] ) ? $_POST ["birthdate"] : "");
			$country = (isset ( $_POST ["country"] ) ? $_POST ["country"] : "");
			$data ["countries"] = $this->mfunctions->getCountries ();
			$data ["name"] = "";
			$data ["username"] = "";
			$data ["mobile"] = "";
			$data ["phone"] = "";
			$data ["email"] = "";
			$data ["birthdate"] = "";
			$data ["country"] = "";
			$data ["register"] = 1;
			$data ["target"] = "register";
			$data ["set"] = $this->_set;
			if ($_POST) {
				$data ["name"] = trim ( $_POST ["name"] );
				$data ["username"] = trim ( $_POST ["username"] );
				$data ["mobile"] = trim ( $_POST ["mobile"] );
				$data ["email"] = trim ( $_POST ["email"] );
				if (! isset ( $_POST ["menu"] )) {
					$data ["birthdate"] = trim ( $_POST ["birthdate"] );
					$data ["phone"] = trim ( $_POST ["phone"] );
					$data ["country"] = trim ( $_POST ["country"] );
				}
				$this->form_validation->set_message ( 'required', "%s" );
				$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
				$this->form_validation->set_message ( 'valid_email', "* " . lang ( "validemail" ) );
				$this->form_validation->set_message ( 'min_length', "* " . "%s " . lang ( "min_length" ) );
				$this->form_validation->set_message ( 'matches', "* " . lang ( "password_no_match" ) );
				$this->form_validation->set_message ( 'numeric', "* " . lang ( "numeric" ) );

				$this->form_validation->set_rules ( 'repassword', "* " . lang ( "enter_repassword" ), 'required' );
				$this->form_validation->set_rules ( 'password', "* " . lang ( 'enter_password' ), 'required|matches[repassword]' );
				$this->form_validation->set_rules ( 'name', "* " . lang ( "entername" ), "trim|required" );
				$this->form_validation->set_rules ( 'email', "* " . lang ( "enteremail" ), "trim|required|valid_email|is_unique[users.email]" );
				$this->form_validation->set_rules ( 'mobile', "* " . lang ( "entermobile" ), "trim|required|numeric|is_unique[users.mobile]|max_length[15]|callback_checkMobileLength|callback_checkWhatsRegistered" );
				$this->form_validation->set_rules ( 'username', "* " . lang ( "enterusername" ), "trim|required|is_unique[users.username]|callback_checkUsernameLength" );
				$this->form_validation->set_rules ( 'captcha', "* " . lang ( "enter_captcha" ), "trim|required|callback_checkCaptcha" );
				if ($this->form_validation->run () == FALSE) {
					$this->session->set_userdata ( array (
							"captcha" => rand ( 10000, 99999 )
					) );
					$data ["message"] = validation_errors ();
					$data ["status"] = "-1";
					$this->load->view ( "site/index", $data );
				} else {
					$mobile_code = rand ( "1111", "999999" );
					$email_code = rand ( "1111", "999999" );
					$request = $this->msite->register ( array (
							"name" => trim ( $this->security->xss_clean ( $_POST ["name"] ) ),
							"email" => trim ( $this->security->xss_clean ( $_POST ["email"] ) ),
							"mobile" => trim ( $this->security->xss_clean ( $_POST ["mobile"] ) ),
							"country" => trim ( $this->security->xss_clean ( $country ) ),
							"phone" => trim ( $this->security->xss_clean ( $phone ) ),
							"password" => trim ( $this->security->xss_clean ( $_POST ["password"] ) ),
							"username" => trim ( $this->security->xss_clean ( $_POST ["username"] ) ),
							"birth_date" => trim ( $this->security->xss_clean ( $birthdate ) ),
							"mobile_code" => $mobile_code,
							"email_code" => $email_code,
							"create_time" => time (),
							"seen" => 0,
							"group" => $_POST ["group_id"],
							"active" => 1
					) );
					if ($request > 0) {
						$this->load->model ( "whats/msend" );
						$this->mfunctions->validate ();
						$this->load->model ( "msms" );
						$this->load->model ( "memail" );
						$this->load->model ( "mnotify" );
						$notify = $this->mnotify->getNotifyStatus ();
						// notify to admin mobile
						if ($notify ["register_admin_mobile"] [0] == "1") {
							$this->msms->sendSms ( array (
									"message" => $notify ["register_admin_mobile"] [1],
									"numbers" => $this->_set->admin_mobiles
							) );
						}
						// notify to admin email
						if ($notify ["register_admin_email"] [0] == "1") {
							$emails = explode ( ",", $this->_set->admin_emails );
							$this->memail->sendEmail ( array (
									"message" => $notify ["register_admin_email"] [1],
									"address" => $emails,
									"subject" => $this->_titles [$this->_seg] ["set_companyname"]
							) );
						}
						// notify to user email
						if ($notify ["register_user_email"] [0] == "1") {
							$emails = array (
									trim ( $_POST ["email"] )
							);
							$this->memail->sendEmail ( array (
									"message" => $notify ["register_user_email"] [1],
									"address" => $emails,
									"subject" => $this->_titles [$this->_seg] ["set_companyname"]
							) );
						}
						// notify to user mobile
						if ($notify ["register_user_mobile"] [0] == "1") {
							$mobile = trim ( $_POST ["mobile"] );
							$this->msms->sendSms ( array (
									"message" => $notify ["register_user_mobile"] [1],
									"numbers" => $mobile
							) );
						}

						if ($this->_set->register_mobile) {
							$mobile = trim ( $_POST ["mobile"] );
							// send whatsapp code to verify whats app
							if ($_POST ["group_id"] == MFunctions::GROUP_WHATSAPP) {
								$this->msend->sendMessage ( $this->mwhats->getSettings ()->test_user, trim ( $_POST ["mobile"] ), $mobile_code );
								if ($this->msite->getUserStatus ( $request ) == MFunctions::REGISTER_STATUS_EMAIL)
									$this->msite->updateStatus ( $request, MFunctions::REGISTER_STATUS_BOTH );
								else
									$this->msite->updateStatus ( $request, MFunctions::REGISTER_STATUS_MOBILE );
							} else {
								$this->msms->sendSms ( array (
										"message" => "your code is: $mobile_code",
										"numbers" => $mobile
								) );
							}
							if ($this->msite->getUserStatus ( $request ) == MFunctions::REGISTER_STATUS_EMAIL)
								$this->msite->updateStatus ( $request, MFunctions::REGISTER_STATUS_BOTH );
							else
								$this->msite->updateStatus ( $request, MFunctions::REGISTER_STATUS_MOBILE );
						}
						if ($this->_set->register_email) {
							$emails = array (
									trim ( $_POST ["email"] )
							);
							$this->memail->sendEmail ( array (
									"message" => "Your code is: $email_code",
									"address" => $emails,
									"subject" => $this->_titles [$this->_seg] ["set_companyname"]
							) );
							if ($this->msite->getUserStatus ( $request ) == MFunctions::REGISTER_STATUS_MOBILE)
								$this->msite->updateStatus ( $request, MFunctions::REGISTER_STATUS_BOTH );
							else
								$this->msite->updateStatus ( $request, MFunctions::REGISTER_STATUS_EMAIL );
						}

						$data ["message"] = lang ( "register_success" );
						$data ["title"] = lang ( "register" );
						$data ["target"] = "success_page";
						$this->load->view ( "site/index", $data );
					} else {
						$data ["message"] = lang ( "register_error" );
						$data ["status"] = "-1";
						$this->load->view ( "site/index", $data );
					}
				}
			} else {
				$this->load->view ( "site/index", $data );
			}
		} else {
			$data ["register"] = 0;
			$this->load->view ( "site/index", $data );
		}
	}

	// check username length
	public function checkUsernameLength($str) {
		if (strlen ( $str ) < 6) {
			$this->form_validation->set_message ( 'checkUsernameLength', lang ( "usernamemore6" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}

	// check captcha word
	public function checkCaptcha($str) {
		if ($str != $this->session->userdata ( "captcha" )) {
			$this->form_validation->set_message ( 'checkCaptcha', lang ( "captcha_not_match" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}

	// check mobile length
	public function checkMobileLength($str) {
		if (strlen ( $str ) < 9) {
			$this->form_validation->set_message ( 'checkMobileLength', lang ( "mobilemore9" ) );
			return FALSE;
		} elseif (strlen ( $str ) > 15) {
			$this->form_validation->set_message ( 'checkMobileLength', lang ( "mobileless15" ) );
			return false;
		} else {
			return TRUE;
		}
	}

	// get captcha image
	public function captchaImage() {
		$img = imagecreatefromjpeg ( base_url () . "assets/site/images/texture.jpg" );
		$security_number = (! $this->session->userdata ( "captcha" )) ? 'error' : $this->session->userdata ( "captcha" );
		$image_text = $security_number;
		$red = rand ( 100, 255 );
		$green = rand ( 100, 255 );
		$blue = rand ( 100, 255 );
		$text_color = imagecolorallocate ( $img, 255 - $red, 255 - $green, 255 - $blue );
		$text = imagettftext ( $img, 16, rand ( - 10, 10 ), rand ( 10, 30 ), rand ( 25, 35 ), $text_color, "assets/site/fonts/courbd.ttf", $image_text );
		header ( "Content-type:image/jpeg" );
		imagejpeg ( $img );
	}

	// change password for user
	public function changePassword() {
		if ($this->session->userdata ( "validated" )) {
			if ($_POST) {
				$this->form_validation->set_message ( 'required', "%s" );
				$this->form_validation->set_rules ( 'last_password', "* " . lang ( "enter_last_password" ), 'required|callback_checkLastPassword' );
				$this->form_validation->set_rules ( 'repassword', "* " . lang ( "enter_repassword" ), 'required' );
				$this->form_validation->set_rules ( 'password', "* " . lang ( 'enter_password' ), 'required|matches[repassword]' );
				if ($this->form_validation->run () == FALSE) {
					$data ["message"] = validation_errors ();
					$data ["status"] = "-1";
					$data ["target"] = "change_password";
					$this->load->view ( "site/index", $data );
				} else {
					$request = $this->musers->changePassword ( $this->session->userdata ( "id" ), $this->security->xss_clean ( trim ( $_POST ["password"] ) ) );
					if ($request) {
						$data ["message"] = lang ( "change_password_success" );
						$data ["title"] = lang ( "change_password" );
						$data ["target"] = "success_page";
						$this->load->view ( "site/index", $data );
					} else {
						$data ["message"] = lang ( "database_error" );
						$data ["status"] = "-1";
						$data ["target"] = "change_password";
						$this->load->view ( "site/index", $data );
					}
				}
			} else {
				$data ["target"] = "change_password";
				$this->load->view ( "site/index", $data );
			}
		} else
			redirect ();
	}

	// check user last password
	public function checkLastPassword($str) {
		$user = $this->musers->getUserById ( $this->session->userdata ( 'id' ) );
		if (crypt ( $str, $user->salt ) == $user->password)
			return true;
		else {
			$this->form_validation->set_message ( 'checkLastPassword', lang ( "checkLastPassword" ) );
			return false;
		}
	}

	// edit profile for user
	public function editProfile() {
		if ($this->session->userdata ( "validated" )) {
			$user_id = $this->session->userdata ( "id" );
			$data ["user"] = $this->musers->getUserById ( $user_id );
			$data ["countries"] = $this->mfunctions->getCountries ();
			if ($_POST) {
				$this->form_validation->set_message ( 'required', "%s" );
				$this->form_validation->set_message ( 'valid_email', lang ( "valid_email" ) );
				$this->form_validation->set_rules ( 'name', lang ( 'enter_name' ), 'required' );
				$this->form_validation->set_rules ( 'username', lang ( 'enter_username' ), "required|callback_checkUserExist[$user_id]" );
				$this->form_validation->set_rules ( 'email', lang ( 'enter_email' ), "required|valid_email|callback_checkEmailExist[$user_id]" );
				$this->form_validation->set_rules ( 'mobile', lang ( 'enter_mobile' ), "required|numeric|callback_checkMobileLength|callback_checkWhatsRegistered" );
				if ($this->form_validation->run () == FALSE) {
					$data ["message"] = validation_errors ();
					$data ["status"] = "-1";
					$data ["target"] = "edit_profile";
					$this->load->view ( "site/index", $data );
				} else {
					$request = $this->musers->modifyUser ( $user_id, array (
							"name" => $this->security->xss_clean ( trim ( $_POST ["name"] ) ),
							"username" => $this->security->xss_clean ( trim ( $_POST ["username"] ) ),
							"email" => $this->security->xss_clean ( trim ( $_POST ["email"] ) ),
							"mobile" => $this->security->xss_clean ( trim ( $_POST ["mobile"] ) ),
							"phone" => $this->security->xss_clean ( trim ( $_POST ["phone"] ) ),
							"country" => $this->security->xss_clean ( trim ( $_POST ["country"] ) ),
							"birth_date" => $this->security->xss_clean ( trim ( $_POST ["birthdate"] ) )
					) );
					if ($request) {
						$data ["message"] = lang ( "edit_profile_success" );
						$data ["title"] = lang ( "edit_profile" );
						$data ["target"] = "success_page";
						$this->load->view ( "site/index", $data );
					} else {
						$data ["message"] = lang ( "database_error" );
						$data ["status"] = "-1";
						$data ["target"] = "edit_profile";
						$this->load->view ( "site/index", $data );
					}
				}
			} else {
				$data ["target"] = "edit_profile";
				$this->load->view ( "site/index", $data );
			}
		} else
			redirect ();
	}

	// check email exist for modify
	public function checkEmailExist($email, $user_id) {
		$request = $this->musers->checkEmailExist ( $user_id, $email );
		if (! $request) {
			$this->form_validation->set_message ( 'checkEmailExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}

	// check user exist for modify
	public function checkUserExist($user, $user_id) {
		$request = $this->musers->checkUserExist ( $user_id, $user );
		if (! $request) {
			$this->form_validation->set_message ( 'checkUserExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}

	// check if mobile number WhatsAPP registered
	public function checkWhatsRegistered($str) {
		$this->load->model ( "whats/mwhats" );
		$request = $this->mwhats->checkNumber ( $str );
		if (! $request) {
			$this->form_validation->set_message ( 'checkWhatsRegistered', lang ( "no_whats_registered" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
}