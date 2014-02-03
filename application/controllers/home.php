<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// site main
class Home extends SiteController {
	function __construct() {
		parent::__construct ();
	}

	public function index() {
		$page = $this->msite->getPage ( 0, $this->_seg );
		$data ["page"] = $page;
		$data ["target"] = "home";
		$this->load->view ( "site/index", $data );
	}

	/*
	 * public function index() { $data ["target"] = "home"; $data ["blocks"] = $this->msite->getBlocks ( $this->_seg ); $data ["set"] = $this->_set; $this->load->view ( "site/index", $data ); }
	 */

	// get rss of news
	public function rss() {
		$lang_code = $this->uri->segment ( 1 );
		echo $this->mfunctions->getRss ( $lang_code );
	}

	// show products
	public function products() {
		$data ["langs_titles"] = $this->msite->getLangsTitles ();
		$data ["lang"] = $this->uri->segment ( 1 );
		$this->session->set_userdata ( 'refered_uri', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
		if (isset ( $_GET ["product"] )) {
			$product = $this->msite->getProduct ( $_GET ["product"] );
			if (! $product)
				redirect ( site_url ( "" ) );
			$data ["product"] = $product;
			$data ["product_slides"] = $this->msite->getProductSlides ( $_GET ["product"] );
			$data ["target"] = "product";
		} else {
			$data ["target"] = "products";
		}
		$data ["set"] = $this->_set;
		$this->load->view ( "site/index", $data );
	}

	// show news
	public function news() {
		$data ["langs_titles"] = $this->msite->getLangsTitles ();
		$data ["lang_seg"] = $this->uri->segment ( 1 );
		$this->session->set_userdata ( 'refered_uri', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
		$lang_seg = $this->uri->segment ( 1 );
		$data ["news"] = $this->msite->getNews ( $lang_seg );
		$data ["links"] = $this->msite->getLinks ( $lang_seg );
		$data ["target"] = "news";
		$data ["set"] = $this->_set;
		$this->load->view ( "site/index", $data );
	}

	// show gallery
	public function gallery() {
		$data ["langs_titles"] = $this->msite->getLangsTitles ();
		$data ["lang"] = $this->uri->segment ( 1 );
		$this->session->set_userdata ( 'refered_uri', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
		$lang = $this->uri->segment ( 1 );
		$gallery = $this->msite->getGallery ( $lang );
		$data ["gallery"] = $gallery;
		$data ["target"] = "gallery";
		$data ["set"] = $this->_set;
		$this->load->view ( "site/index", $data );
	}

	// show videos
	public function videos() {
		$data ["langs_titles"] = $this->msite->getLangsTitles ();
		$data ["lang"] = $this->uri->segment ( 1 );
		$this->session->set_userdata ( 'refered_uri', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
		$lang_seg = $this->uri->segment ( 1 );
		$data ["set"] = $this->_set;
		if (isset ( $_GET ["video"] )) {
			$this->load->model ( "mvideos" );
			$video = $this->mvideos->getVideoById ( $_GET ["video"] );
			$data ["video"] = $video;
			$data ["target"] = "video";
		} else {
			$data ["videos"] = $this->mfunctions->getVideos ( $lang_seg );
			$data ["target"] = "videos";
		}
		$data ["set"] = $this->_set;
		$this->load->view ( "site/index", $data );
	}

	// show video
	public function showVideo() {
		$data ["set"] = $this->_set;
		if (isset ( $_GET ["video"] )) {
			$this->load->model ( "mvideos" );
			$data ["video"] = $this->mvideos->getVideoById ( $_GET ["video"] );
			$this->load->view ( "site/video-inside", $data );
		}
	}

	// show pages
	public function pages() {
		$this->session->set_userdata ( 'refered_uri', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
		if (isset ( $_GET ["page"] )) {
			$data ["langs_titles"] = $this->msite->getLangsTitles ();
			$data ["lang_seg"] = $this->uri->segment ( 1 );
			$page = $this->msite->getPage ( $_GET ["page"], $this->_seg );
			if ($page->active != "1")
				redirect ( base_url () );
			$data ["page"] = $page;
			$data ["target"] = "page";
			$data ["set"] = $this->_set;
			$this->load->view ( "site/index", $data );
		} else {
			redirect ( base_url () );
		}
	}

	// contact us form
	public function contactus() {
		$data ["name"] = "";
		$data ["email"] = "";
		$data ["title"] = "";
		$data ["body"] = "";
		$data ["target"] = "contactus";
		$data ["set"] = $this->_set;
		if ($_POST) {
			$data ["name"] = $this->security->xss_clean ( trim ( $_POST ["name"] ) );
			$data ["email"] = $this->security->xss_clean ( trim ( $_POST ["email"] ) );
			$data ["title"] = $this->security->xss_clean ( trim ( $_POST ["title"] ) );
			$data ["body"] = $this->security->xss_clean ( trim ( $_POST ["body"] ) );
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'valid_email', "* " . lang ( "entercontactvalidemail" ) );
			$this->form_validation->set_rules ( 'name', "* " . lang ( "entercontactname" ), "trim|xss_clean|required" );
			$this->form_validation->set_rules ( 'email', "* " . lang ( "entercontactemail" ), "trim|xss_clean|required|valid_email" );
			$this->form_validation->set_rules ( 'title', "* " . lang ( "entercontacttitle" ), "required|xss_clean|trim" );
			$this->form_validation->set_rules ( 'body', "* " . lang ( "entercontactmessge" ), "trim|xss_clean|required" );
			if ($this->form_validation->run () == FALSE) {
				$data ["message"] = validation_errors ();
				$data ["status"] = "-1";
				$this->load->view ( "site/index", $data );
			} else {
				$request = $this->msite->submitContactus ( array (
						"name" => $this->security->xss_clean ( trim ( $_POST ["name"] ) ),
						"email" => $this->security->xss_clean ( trim ( $_POST ["email"] ) ),
						"body" => $this->security->xss_clean ( trim ( $_POST ["body"] ) ),
						"title" => $this->security->xss_clean ( trim ( $_POST ["title"] ) ),
						"datetime" => time (),
						"seen" => 0
				) );
				if ($request > 0) {
					$this->load->model ( "msms" );
					$this->load->model ( "memail" );
					$this->load->model ( "mnotify" );
					$notify = $this->mnotify->getNotifyStatus ();
					// notify to admin mobile
					if ($notify ["contactus_new_admin_mobile"] [0] == "1") {
						$this->msms->sendSms ( array (
								"message" => $notify ["contactus_new_admin_mobile"] [1],
								"numbers" => $this->_set->admin_mobiles
						) );
					}
					// notify to admin email
					if ($notify ["contactus_new_admin_email"] [0] == "1") {
						$emails = explode ( ",", $this->_set->admin_emails );
						$this->memail->sendEmail ( array (
								"message" => $notify ["contactus_new_admin_email"] [1],
								"address" => $emails,
								"subject" => $this->_titles [$this->_seg] ["set_companyname"]
						) );
					}
					// notify to user email
					if ($notify ["contactus_new_user_email"] [0] == "1") {
						$emails = array (
								trim ( $_POST ["email"] )
						);
						$this->memail->sendEmail ( array (
								"message" => $notify ["contactus_new_user_email"] [1],
								"address" => $emails,
								"subject" => $this->_titles [$this->_seg] ["set_companyname"]
						) );
					}
					/*
					 * // notify to user mobile if ($notify ["contactus_new_user_mobile"] [0] == "1") { $mobile = $_POST ["mobile"]; $this->msms->sendSms ( array ( "message" => $notify ["contactus_new_user_mobile"] [1], "numbers" => $mobile ) ); }
					 */
					$data ["message"] = lang ( "contactus_success" );
					$data ["title"] = lang ( "contactus" );
					$data ["target"] = "success_page";
					$this->load->view ( "site/index", $data );
				} else {
					$data ["message"] = lang ( "contactus_error" );
					$data ["status"] = "-1";
					$this->load->view ( "site/index", $data );
				}
			}
		} else
			$this->load->view ( "site/index", $data );
	}

	// export to pdf
	public function exportPdf() {
		if (isset ( $_POST ["page"] )) {
			$stylesheet = file_get_contents ( base_url () . 'assets/site/css/pdf.css' );
			$this->load->library ( "MPDF56/mpdf.php", "UTF-8" );
			$this->mpdf = new mPDF ( 'ar' );
			$this->mpdf->SetDirectionality ( 'rtl' );
			$html = "<html><head></head><body>";
			$html .= $_POST ["page"];
			$html .= "</body></html>";
			$html = str_replace ( "\\\"", "\"", $html );
			$this->mpdf->useLang = true;
			$this->mpdf->WriteHTML ( $stylesheet, 1 );
			$this->mpdf->WriteHTML ( $html, 2 );
			$this->mpdf->Output ();
			exit ();
		} else
			redirect ( base_url () );
	}
	/*
	 * // show equipments page public function equipments() { $query = $this->db->get_where ( "equipments", array ( "lang" => "ar" ) ); $data ["equip"] = $query->row (); $data ["langs_titles"] = $this->msite->getLangsTitles (); $data ["lang_seg"] = $this->uri->segment ( 1 ); $data ["set"] = $this->_set; $this->session->set_userdata ( 'refered_uri', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ); $data ["target"] = "equipments"; $this->load->view ( "site/index", $data ); } public function test() { $pro = $this->msite->getProducts ( $this->uri->segment ( 1 ) ); echo "<pre>"; print_r ( $this->_langs [$this->uri->segment ( 1 )] ); echo "</pre>"; } public function getContactusTitles() { $this->db->like ( "title", "contact" ); $query = $this->db->get_where ( "langs_titles", array ( "lang" => $_GET ["lang"] ) ); $array = array (); $titles = $query->result (); foreach ( $titles as $title ) { $array += array ( $title->title => $title->text ); } echo json_encode ( $array ); } // log out when user name press logout public function logout() { $this->session->sess_destroy (); redirect ( base_url () . $this->_seg ); } // get equipments titles and contents to show in website when clicking languages buttons public function getEquips() { $query = $this->db->get_where ( "equipments", array ( "lang" => $_GET ["lang"] ) ); $array = array (); if ($query->num_rows () > 0) foreach ( $query->result () as $equip ) { $array += array ( "title" => $equip->title, "content" => $equip->content ); } echo json_encode ( $array ); }
	 */
	// javascript output to put in site
	public function js() {
		$lang = $this->lang->language;
		header ( 'Content-Type: application/javascript' );
		$query = $this->db->get ( "sitesettings" );
		$settings = $query->row ();
		$url = $settings->site_url;
		$lang_seg = $this->uri->segment ( 1 );
		$content = "var site_url = '" . $url . "';\n";
		$content .= "var lang_seg = '" . $lang_seg . "';\n";
		$content .= "var site_uri = '" . $url . $lang_seg . DIRECTORY_SEPARATOR . "';\n";
		$content .= "var referer = '" . $this->REFERER . "';\n";
		$content .= "var lang_array = new Array();\n";
		foreach($lang as $key => $value){
			$content .= "lang_array['$key'] = '$value';\n";
		}
		exit ( $content );
	}

	// log out when user name press logout
	public function logout() {
		$this->session->sess_destroy ();
		redirect ( base_url () . $this->_seg );
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

	// email subscribe from email group block
	public function subscribe() {
		if ($_GET ["email"] != "") {
			$this->load->helper ( 'email' );
			if (valid_email ( trim ( urldecode ( $_GET ["email"] ) ) )) {
				$req = $this->msite->subscribe ( trim ( $_GET ["email"] ) );
				exit ( $req );
			} else
				exit ( 2 );
		}
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
	// test
	public function test() {
		$this->load->model("whats/mwhats");
		$array = array();
		for($i=2; $i<10; $i++){
			//array_push($array,$this->mchannels->getChannelById($i)->phone);
		}
		$channel = $this->mwhats->getChannelById(3);
		$this->mwhats->connect($channel->phone, $channel->identity);
		$this->mwhats->login($channel->hash);
		$this->mwhats->sendMessage("201067676608", "test");
		//$channel = $this->mwhats->getChannelById(2);
		//$w = new WhatsProt ( trim ( $channel->phone ), $channel->identity, "sdf", true );
		//$w->Connect ();
		//$w->LoginWithPassword ( trim ( $channel->hash ) );
		//echo $this->mwhats->createIdentity("201289261282", $this->config->item("whats_pw"));
		//echo $w->sendGetRequestLastSeen("201067676608");
		//$w->disconnect();
		//$this->mwhats->channelLogin(2);
		//$this->msend->sendMessage(1, $array, "test", "test",123);
		//echo "<pre>";
		//var_dump($array);
	}

	public function importNumbers()
	{
	    $this->load->model("whats/mwhats");
	        $checks = $this->mwhats->checkNumber("966556485881");
	        print_r($checks);
	}

	public function testApi(){
	    exit(var_dump(file_get_contents("http://marwanapi.apiary.io/test")));
	}


}
