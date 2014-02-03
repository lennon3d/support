<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin Banners controller
class Channels extends AdminController {
	var $WHATS_SET;
	function __construct() {
		parent::__construct ();
		$this->load->model ( "whats/msend" );
		$this->load->model ( "whats/mchannels" );
		$this->WHATS_SET = $this->mwhats->getSettings ();
	}
	public function index() {
		if ($this->permissions->whats_channels ["see"] != "1")
			$this->mfunctions->noPermission ();
		if (isset ( $_POST ["assign_channel"] )) {
			$query = $this->mchannels->assignChannel ( $_POST ["channel"], $_POST ["user_select"] );
			if ($query > 0) {
				$this->mfunctions->actionReport ( "whats_channels", "assign_channel_user" );
				$this->session->set_flashdata ( array (
						"msg" => 1
				) );
				redirect ( $this->session->userdata ( "referer_url" ) );
			} else {
				$this->session->set_flashdata ( array (
						"msg" => "-1",
						"message" => lang ( "database_error" )
				) );
				redirect ( $this->session->userdata ( "referer_url" ) );
			}
		}
		if (isset ( $_POST ["set_options"] )) {
			if (! isset ( $_POST ["channel_radio"] )) {
				$this->session->set_flashdata ( array (
						"msg" => "-1",
						"message" => lang ( "unchecked_channel_radio" )
				) );
				redirect ( $this->session->userdata ( "referer_url" ) );
			}
			// set test channel
			if ($_POST ["set_options"] == "test") {
				$set = $this->mwhats->getSettings ();
				$query = $this->mchannels->assignChannel ( $_POST ["channel_radio"], $set->test_user );
				if ($query > 0) {
					$this->mfunctions->actionReport ( "whats_channels", "set_test_channel" );
					$this->session->set_flashdata ( array (
							"msg" => 1
					) );
					redirect ( $this->session->userdata ( "referer_url" ) );
				} else {
					$this->session->set_flashdata ( array (
							"msg" => "-1",
							"message" => lang ( "database_error" )
					) );
					redirect ( $this->session->userdata ( "referer_url" ) );
				}
			}
			// set notify messages channel
			if ($_POST ["set_options"] == "notify") {
				$set = $this->mwhats->getSettings ();
				$query = $this->mchannels->assignChannel ( $_POST ["channel_radio"], $set->notify_user );
				if ($query > 0) {
					$this->mfunctions->actionReport ( "whats_channels", "set_notify_channel" );
					$this->session->set_flashdata ( array (
							"msg" => 1
					) );
					redirect ( $this->session->userdata ( "referer_url" ) );
				} else {
					$this->session->set_flashdata ( array (
							"msg" => "-1",
							"message" => lang ( "database_error" )
					) );
					redirect ( $this->session->userdata ( "referer_url" ) );
				}
			}
		}
		$search = array(
				"user" => ($this->input->get_post("user")?$this->input->get_post("user"):""),
				"added_by" => ($this->input->get_post("add_by")?$this->input->get_post("added_by"):""),
				"phone" => ($this->input->get_post("phone")?$this->input->get_post("phone"):""),
				"status" => ($this->input->get_post("status")?$this->input->get_post("status"):""),
				"reason" => ($this->input->get_post("reason")?$this->input->get_post("reason"):""),
		);
		$page = ($this->input->get_post("page") ? trim ( $this->input->get_post("page") ) : 0);
		$limit = ($this->input->get_post("limit") ? trim ( $this->input->get_post("limit") ) : 500);
		$data ["test_user"] = $this->mchannels->getUserChannel ( $this->WHATS_SET->test_user );
		$data ["notify_user"] = $this->mchannels->getUserChannel ( $this->WHATS_SET->notify_user );
		$data ["users"] = $this->musers->getAllUsers ();
		$data ["target"] = "whats_channels";
		$data["limit"] = $limit;
		$data["page_num"] = $page;
		$data["search"] = $search;
		$data ["channels"] = $this->mchannels->getAllChannels ( $limit, $page*$limit, $search );
		$this->load->view ( "admin/index", $data );
	}

	// add new channel
	public function addChannel() {
		$data ["mobile"] = "";
		$data ["hash"] = "";
		$data ["code"] = "";
		$channel_exist = false;
		$pw;
		if ($this->permissions->whats_channels ["create"] != "1")
			$this->mfunctions->noPermission ();
		if ($_POST) {
			$data ["mobile"] = trim ( $_POST ["mobile"] );
			if (isset ( $_POST ["code"] )) {
				$channel = $this->mchannels->getChannelByPhone ( trim ( $_POST ["mobile"] ) );
				$result = $this->mchannels->registerCode ( trim ( $_POST ["mobile"] ), trim ( $_POST ["code"] ) );
				// echo "<pre>";
				// var_dump($result);
				// exit();
				if ($result->status == "fail") {
					$query = $this->mchannels->updateChannel ( $channel->id, array (
							"last_update" => time (),
							"status" => $result->status,
							"reason" => $result->reason
					) );
					$data ["msg"] = "-1";
					$data ["message"] = (isset ( $result->retry_after ) ? lang ( "retry_after" ) . " " . $result->retry_after . " " . lang ( "second" ) : $result->reason);
					$data ["target"] = "whats_enter_code";
					$this->load->view ( "admin/index", $data );
				} else {
					$query = $this->mchannels->updateChannel ( $channel->id, array (
							"hash" => $result->pw,
							"last_update" => time (),
							"status" => $result->status
					) );
					if ($query > 0) {
						$test_channel = $this->mchannels->getUserChannel( $this->WHATS_SET->test_user );
						$this->msend->sendMessage ( $this->USER_ID, $test_channel->phone, $channel->id, $channel->id, $channel->id );
						$this->session->set_flashdata ( array (
								"msg" => "1"
						) );
						redirect ( base_url () . "admin/channels", "refresh" );
					} else {
						$data ["msg"] = "-1";
						$data ["message"] = lang ( "database_error" );
						$data ["target"] = "whats_enter_code";
						$this->load->view ( "admin/index", $data );
					}
				}
			} else {
				$data ["mobile"] = trim ( $_POST ["mobile"] );
				$data ["hash"] = trim ( $_POST ["hash"] );
				$data ["code"] = trim ( $_POST ["begin_code"] );
				$this->form_validation->set_message ( 'required', "%s" );
				$this->form_validation->set_message ( 'numeric', lang ( "numeric" ) );
				$this->form_validation->set_rules ( 'mobile', lang ( 'enter_mobile' ), 'required|numeric|callback_checkMobileLength' );
				if ($this->form_validation->run () == FALSE) {
					$data ["msg"] = "-1";
					$data ["message"] = validation_errors ();
					$data ["target"] = "whats_add_channel";
					$this->load->view ( "admin/index", $data );
				} else {
					$channel = $this->mchannels->getChannelByPhone ( trim ( $_POST ["mobile"] ) );
					if (! $channel) {
						$query = $this->mchannels->addChannel ( array (
								"phone" => trim ( $_POST ["mobile"] ),
								"hash" => trim ( $_POST ["hash"] ),
								"status" => "new",
								"added_by" => $this->USER_ID,
								"last_update" => time (),
								"identity" => $this->mchannels->createIdentity ( trim ( $_POST ["mobile"] ), $this->config->item("whats_pw") ),
								"reason" => ""
						) );
						if ($query > 0) {
							$channel = $this->mchannels->getChannelById ( $query );
							$this->mfunctions->actionReport ( "whats_channels", "insert" );
						} else {
							$this->session->set_flashdata ( array (
									"msg" => "-1",
									"message" => lang ( "database_error" )
							) );
							redirect ( base_url () . "admin/channels/addChannel", "refresh" );
						}
					} else {
						$this->session->set_flashdata ( array (
								"def" => 1,
								"error_message" => lang ( "channel_exist" )
						) );
					}
					if (trim ( $_POST ["hash"] ) != "") {
						$query = $this->mchannels->updateHash ( trim ( $_POST ["mobile"] ), trim ( $_POST ["hash"] ) );
						$cred = $this->mchannels->checkCred ( $channel->phone );
						if ($cred->status == "ok")
							$this->mchannels->updateChannel ( $channel->id, array (
									"status" => $cred->status,
									"hash" => $cred->pw,
									"last_update" => time ()
							) );
						else
							$this->mchannels->updateChannel ( $channel->id, array (
									"status" => $cred->status,
									"last_update" => time (),
									"reason" => $cred->reason
							) );
						$test_channel = $this->mchannels->getUserChannel ( $this->WHATS_SET->test_user );
						$this->msend->sendMessage ( $this->USER_ID, $test_channel->phone, $channel->id, $channel->id, $channel->id );
						$this->session->set_flashdata ( array (
								"msg" => "1",
								"message" => lang ( "hash_updated" )
						) );
						redirect ( base_url () . "admin/channels", "refresh" );
					} elseif (trim ( $_POST ["begin_code"] ) != "") {
						$result = $this->mchannels->registerCode ( trim ( $_POST ["mobile"] ), trim ( $_POST ["begin_code"] ) );
						// echo "<pre>";
						// var_dump($result);
						// exit();
						if ($result->status == "ok") {
							$query = $this->mchannels->updateChannel ( $channel->id, array (
									"status" => "ok",
									"hash" => $result->pw,
									"last_update" => time ()
							) );
							if ($query > 0) {
								$channel = $this->mchannels->getChannelByPhone ( trim ( $_POST ["mobile"] ) );
								$test_channel = $this->mchannels->getUserChannel ( $this->WHATS_SET->test_user );
								$this->msend->sendMessage ( $this->USER_ID, $test_channel->phone, $channel->id, $channel->id, $channel->id );
								$this->session->set_flashdata ( array (
										"msg" => "1"
								) );
								redirect ( base_url () . "admin/channels", "refresh" );
							} else {
								$data ["msg"] = "-1";
								$data ["message"] = lang ( "database_error" );
								$data ["target"] = "whats_enter_code";
								$this->load->view ( "admin/index", $data );
							}
						} else {
							$data ["msg"] = "-1";
							$data ["message"] = (isset ( $result->retry_after ) ? lang ( "retry_after" ) . " " . $result->retry_after . " " . lang ( "second" ) : $result->reason);
							$data ["target"] = "whats_enter_code";
							$this->load->view ( "admin/index", $data );
						}
					} else {
						$cred = $this->mchannels->checkCred ( $channel->phone );
						if ($cred->status == "ok") {
							$query = $this->mchannels->updateChannel ( $channel->id, array (
									"status" => $cred->status,
									"hash" => $cred->pw,
									"last_update" => time ()
							) );
							$this->session->set_flashdata ( array (
									"msg" => "1",
									"message" => lang ( "hash_updated" )
							) );
							redirect ( base_url () . "admin/channels", "refresh" );
						} else {
							$request = $this->mchannels->requestCode ( $_POST ["code_type"], trim ( $_POST ["mobile"] ) );
							if ($request->status == "sent") { // if whatsapp did send code to mobile number
								$this->mchannels->updateChannel ( $channel->id, array (
										"status" => $request->status,
										"last_update" => time (),
								) );
								$data ["msg"] = "1";
								$data ["message"] = lang ( "code_sent" );
								$data ["target"] = "whats_enter_code";
								$this->load->view ( "admin/index", $data );
							} elseif ($request->status == "ok") { // if whatsapp find that you verfied your number from this website before
								$query = $this->mchannels->updateChannel ( $channel->id, array (
										"status" => $request->status,
										"last_update" => time (),
										"hash" => $request->pw
								) );
								if ($query > 0) {
									$channel = $this->mchannels->getChannelByPhone ( trim ( $_POST ["mobile"] ) );
									$test_channel = $this->mchannels->getUserChannel ( $this->WHATS_SET->test_user );
									$this->msend->sendMessage ( $this->USER_ID, $test_channel->phone, $channel->id, $channel->id, $channel->id );
									$this->session->set_flashdata ( array (
											"msg" => "1",
											"message" => lang ( "hash_updated" )
									) );
									redirect ( base_url () . "admin/channels", "refresh" );
								} else {
									$this->session->set_flashdata ( array (
											"msg" => "-1",
											"message" => lang ( "database_error" )
									) );
									redirect ( base_url () . "admin/channels/addChannel", "refresh" );
								}
							} else { // if whatsapp couldn't send code to mobile number
								$this->mchannels->updateChannel ( $channel->id, array (
										"status" => $request->status,
										"reason" => $request->reason,
										"last_update" => time ()
								) );
								$data ["msg"] = "-1";
								$data ["message"] = ($request->reason == "too_recent"  ? lang ( "retry_after" ) . " " . $request->retry_after . " " . lang ( "second" ) : $request->reason);
								$data ["target"] = "whats_add_channel";
								$this->load->view ( "admin/index", $data );
							}
						}

						// $request = $this->mchannels->checkCred("201206579554");
						// echo "<pre>";
						// var_dump($request);
						// exit();
					}
				}
			}
		} else {
			$data ["target"] = "whats_add_channel";
			$this->load->view ( "admin/index", $data );
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

	// delete channel by id
	public function deleteChannel($channel_id) {
		if ($this->permissions->whats_channels ["delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($channel_id != "") {
			$query = $this->mchannels->deleteChannel ( $channel_id );
			if ($query > 0) {
				$this->mfunctions->actionReport ( "whats_channels", "delete" );
				$this->session->set_flashdata ( array (
						"msg" => 1
				) );
				redirect ( base_url () . "admin/channels", "refresh" );
			}
		} else {
			$this->session->set_flashdata ( array (
					"msg" => "-1",
					"message" => lang ( "database_error" )
			) );
			redirect ( base_url () . "admin/channels/addChannel", "refresh" );
		}
	}

	// set test channel
	public function setTestChannel() {
		$query = $this->mwhats->setTestChannel ( $_POST ["test_channel"] );
		if ($query > 0) {
			$this->mfunctions->actionReport ( "whats_channels", "set_test_channel" );
			$this->session->set_flashdata ( array (
					"msg" => 1
			) );
			redirect ( base_url () . "admin/channels", "refresh" );
		} else {
			$this->session->set_flashdata ( array (
					"msg" => "-1",
					"message" => lang ( "database_error" )
			) );
			redirect ( base_url () . "admin/channels", "refresh" );
		}
	}

	// check channel and update new situation
	public function checkChannel($channel_id = "") {
		if ($this->permissions->whats_channels ["modify"] != "1")
			$this->mfunctions->noPermission ();
		if ($channel_id != "") {
			$channel = $this->mchannels->getChannelById ( $channel_id );
			if (! $channel) {
				$this->session->set_flashdata ( array (
						"msg" => "-1",
						"message" => lang ( "choose_right_channel" )
				) );
				redirect ( base_url () . "admin/channels", "refresh" );
			}
			$id = $this->mchannels->checkCred ( $channel->phone );
			if ($id->status == "ok") {
				$query = $this->mchannels->updateChannel ( $channel->id, array (
						"hash" => $id->pw,
						"status" => $id->status,
						"reason" => "",
						"last_update" => time ()
				) );
			} else {
				$this->mchannels->updateChannel ( $channel->id, array (
						"status" => $id->status,
						"reason" => $id->reason,
						"last_update" => time ()
				) );
			}
			$this->session->set_flashdata ( array (
					"msg" => 1
			) );
			redirect ( base_url () . "admin/channels", "refresh" );
		} else {
			redirect ();
		}
	}

	// show channel contacts
	public function channelContacts($channel_id = "") {
		if ($channel_id == "")
			exit ( "no channel" );
		$channel = $this->mchannels->getChannelById($channel_id);
		if(!$channel)
			exit("no valid channel");
		$this->load->model ( "whats/mchannels" );
		$data ["messages"] = $this->mchannels->getChannelConv ( $channel_id );
		//$this->session->set_userdata ( array (
		//		"channel_id" => $channel_id
		//) );
		if (isset ( $_POST ["send-message"] )) {
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'numeric', lang ( "numeric" ) );
			$this->form_validation->set_rules ( 'number', lang ( 'enter_mobile' ), 'required|numeric|callback_checkMobileLength"trim' );
			$this->form_validation->set_rules ( 'message', lang ( 'enter_message' ), 'required|trim' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "channel_contacts";
				$this->load->view ( "admin/index", $data );
			} else {
				$this->load->model ( "whats/msend" );
				$this->msend->sendMessage ( $this->USER_ID, trim ( $_POST ["number"] ), trim ( $_POST ["message"] ), trim ( $_POST ["message"] ), $channel_id );
				$this->session->set_flashdata ( array (
						"msg" => 1
				) );
				redirect ( base_url () . "admin/channels/channelContacts/$channel_id", "refresh" );
			}
		} else {
			$data ["target"] = "channel_contacts";
			$data ["channel_id"] = $channel_id;
			$this->load->view ( "admin/index", $data );
		}
	}

	// show channel conversation with a number
	public function channelConver($channel_id = "", $number = "") {
		if ($channel_id == "" || $number == "")
			exit ( "No channel choosen or number" );
		//$this->session->set_userdata ( array (
	//			"channel_id" => $channel_id
		//) );
		$channel = $this->mchannels->getChannelById($channel_id);
		if(!$channel)
			exit("no valid channel");
		//$this->mchannels->getProfile ( $channel_id, $channel->phone );
		//$this->mchannels->getProfile ( $channel_id, $number );
		$this->mchannels->seeNumberMessages ( $channel_id, $number );
		$data ["messages"] = $this->mchannels->getNumberMessages ( $channel_id, $number );
		$data["channel"] = $channel;
		$data["channel_id"] = $channel_id;
		$data ["target"] = "channel_conver";
		$data ["number"] = $number;
		$this->load->view ( "admin/index", $data );
	}

	// show channel settings
	public function channelSettings($channel_id = "") {
		if ($channel_id == "")
			exit ( "no channel choosen or number" );
		$data ["channel"] = $this->mchannels->getChannelSettings ( $channel_id );
		if ($_POST) {
			$req = $this->mchannels->setChannelStatus ( $channel_id, trim ( $_POST ["status"] ) );
			if ($req) {
				$req = $this->mchannels->setChannelProfilePic ( $channel_id, trim ( $_POST ["profile_pic"] ) );
				//exit();
				if ($req) {
					$this->session->set_flashdata ( array (
							"msg" => 1
					) );
					redirect ( base_url () . "admin/channels/", "refresh" );
				}
			}
			$this->session->set_flashdata ( array (
					"msg" => "-1",
					"message" => lang ( "whats_server_error" )
			) );
			redirect ( base_url () . "admin/channels/channelSettings/$channel_id", "refresh" );
		} else {
			$data ["target"] = "whats_channel_settings";
			$this->load->view ( "admin/index", $data );
		}
	}
	public function test($channel_id = "8") {
		$channel = $this->mchannels->getChannelById ( $channel_id );
		if (! $channel)
			return 4; // invalid channel
		$number = (isset ( $_GET ["number"] ) ? $_GET ["number"] : "");
		$w = new WhatsProt ( $channel->phone, $channel->identity, "", true );
		$w->connect ();
		$w->eventManager ()->bind ( "onSendStatusUpdate", array (
				$this,
				"onSendStatusUpdate"
		) );
		if ($w->getSocket () == NULL)
			return 3; // number is unavailable
		$w->sendStatusUpdate ( trim ( "this is me" ), array (
				"channel_id" => $channel_id
		) );
		$w->loginWithPassword ( $channel->hash );
		var_dump($w->checkNumber($w->getJID("201270736296")));
	}
	function onSendStatusUpdate($mynumber, $status, $channel_id) {
		echo $mynumber . $status;
	}

	/*
	 * public function onGetProfilePicture($from, $type, $data) { echo "sdfsdf"; if ($type == "preview") { $filename = "../assets/uploads/preview_" . $from . ".jpg"; } else { $filename = "../assets/uploads/" . $from . ".jpg"; } $fp = @fopen ( $filename, "w" ); if ($fp) { fwrite ( $fp, $data ); fclose ( $fp ); } } public function onMessage($mynumber, $from, $id, $type, $time, $name, $body) { echo "Message from $name:\n$body\n\n"; } public function test() { $this->load->model ( "whats/msend" ); $w = new WhatsProt ( '201270658479', MWhats::TOKEN, "marwan", false ); $w->connect (); $w->loginWithPassword ( "NP408VRU2tNM544NbgayqIRtMYY=" ); $w->pollMessages (); $msgs = $w->getMessages (); foreach ( $msgs as $m ) { print ($m->NodeString ( "" ) . "\n") ; } // $w->accountInfo(); // $w->sendGetStatus("201270571563"); // $w->getMessages(); // $w->disconnect (); // $w->accountInfo(); // $host = 'https://v.whatsapp.net/v2/exist'; // $query = array( // 'cc' => '20', // 'in' => '1223745705', // 'id' => md5("201223745705") // ); // var_dump($w->getResponse($host, $query)); // $url = file_get_contents("https://v.whatsapp.net/v2/exist?cc=20&in=1067676608&id=".md5("1067676608")); // echo $url; // print_r($this->mchannels->getChannelByPhone("201206579554")); // echo $this->mchannels->assignChannel($this->mchannels->getUnassignedChannel(), 50); // $this->msend->sendChannelMessage("201067676608","201270571563", "number"); } public function test2($channel) { var_dump($this->mchannels->checkNumber("201067676608")); }
	 */
	public function test4() {
		$this->db->select ( "phone" );
		$query = $this->db->get ( "whats_channels" );
		foreach ( $query->result () as $channel ) {
			$id = $this->mchannels->createIdentity ( $channel->phone );
			$this->db->where ( "phone", $channel->phone );
			$this->db->update ( "whats_channels", array (
					"identity" => $id
			) );
			echo $channel->phone . "-------" . $id . "<br/>";
		}
	}
	public function test5() {
		$this->db->select ( "phone" );
		//$this->db->limit ( 2, 100 );
		$query = $this->db->get ( "whats_channels" );
		foreach ( $query->result () as $channel ) {
			$id = $this->mchannels->checkCred ( $channel->phone );
			if ($id->status == "ok") {
				echo $channel->phone . " : 	" . $id->status . "-----" . $id->pw . "<br/>";
				$this->db->where ( "phone", $channel->phone );
				$this->db->update ( "whats_channels", array (
						"hash" => $id->pw,
						"status" => $id->status,
						"reason" => ""
				) );
			} else {
				echo $channel->phone . " : 	" . $id->status . "-----" . $id->reason . "<br/>";
				$this->db->where ( "phone", $channel->phone );
				$this->db->update ( "whats_channels", array (
						"status" => $id->status,
						"reason" => $id->reason
				) );
			}

			// echo $channel->phone . "-------" . $id;
		}
	}

}
