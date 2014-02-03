<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
	// site main
class WhatsAjax extends CI_Controller {
	var $SESS;
	var $USER_ID;
	function __construct() {
		parent::__construct ();
		$this->load->model ( "whats/msend" );
		$this->load->model ( "whats/mchannels" );
		$this->load->model ( "mnumbers" );
		$this->USER_ID = $this->session->userdata("id");
	}
	

	///////////////////////begin messaging section for send and receive messages/////////////////////////////////////
	
	// get new messages of channel and put them in database
	public function channelInbound() {
		set_time_limit(60);
		$channel_id = (isset($_GET["channel_id"])?trim($_GET["channel_id"]):"");
		//$channel_id = $this->session->userdata ( "channel_id" );
		$channel = $this->mchannels->getChannelById ( $channel_id );
		if (! $channel)
			exit ( 4 ); // invalid channel
		$number = (isset($_GET["number"])?$_GET["number"]:"");
		$w = new WhatsProt ( $channel->phone, $channel->identity, "marwan", false );
		$w->eventManager()->bind("onGetImage", array($this, "onGetImage"));
		$w->eventManager()->bind("onGetMessage", array($this, "onGetMessage"));
		$w->eventManager()->bind("onGetPlace", array($this, "onGetPlace"));
		$w->eventManager()->bind("onGetvCard", array($this, "onGetvCard"));
		$w->eventManager()->bind("onGetLocation", array($this, "onGetLocation"));
		$w->eventManager()->bind("onGetVideo", array($this, "onGetVideo"));
		$w->eventManager()->bind("onGetAudio", array($this, "onGetAudio"));
		$w->eventManager()->bind("onGetProfilePicture", array($this, "onGetProfilePicture"));
		$w->connect ();
		if ($w->getSocket () == NULL)
			exit ( 3 ); // number is unavailable
		set_time_limit(10);
		$w->loginWithPassword ( $channel->hash );
		$messages = $this->mchannels->getUngotenMessages ( $channel_id, "id", $number );
		while ( ! $messages ) {
			$w->pollMessages (array("channel_id" => $channel->id));
			$w->getMessages ();
			$messages = $this->mchannels->getUngotenMessages( $channel_id, "id", $number );
			sleep ( 1 );
		}
		$this->mchannels->getChannelMessages($channel_id);
		echo json_encode ( $messages);
	}
	
	
	//get channel inboud for a determined number
	public function numberInbound(){
		set_time_limit(60);
		$channel_id = (isset($_GET["channel_id"])?trim($_GET["channel_id"]):"");
		//$channel_id = $this->session->userdata ( "channel_id" );
		$channel = $this->mchannels->getChannelById ( $channel_id );
		if (! $channel)
			exit ( "4" ); // invalid channel
		if(!isset($_GET["number"]))
			exit ("5"); //no number
		$number = trim($_GET["number"]);
		$w = new WhatsProt ( $channel->phone, $channel->identity, "marwan", false );
		$w->eventManager()->bind("onGetImage", array($this, "onGetImage"));
		$w->eventManager()->bind("onGetMessage", array($this, "onGetMessage"));
		$w->eventManager()->bind("onGetPlace", array($this, "onGetPlace"));
		$w->eventManager()->bind("onGetvCard", array($this, "onGetvCard"));
		$w->eventManager()->bind("onGetLocation", array($this, "onGetLocation"));
		$w->eventManager()->bind("onGetVideo", array($this, "onGetVideo"));
		$w->eventManager()->bind("onGetAudio", array($this, "onGetAudio"));
		$w->eventManager()->bind("onGetProfilePicture", array($this, "onGetProfilePicture"));
		$w->connect ();
		if ($w->getSocket () == NULL)
			exit ( 3 ); // number is unavailable
		set_time_limit(10);
		$w->loginWithPassword ( $channel->hash );
		$messages = $this->mchannels->getUngotenNumberMessages ( $channel_id, $number );
		while ( ! $messages ) {
			$w->pollMessages (array("channel_id" => $channel->id));
			$w->getMessages ();
			$messages = $this->mchannels->getUngotenNumberMessages( $channel_id, $number );
			sleep ( 1 );
		}
		$this->mchannels->getChannelMessages($channel_id);
		$out_array = array();
		if($number != ""){
			foreach($messages as $message){
				array_push ( $out_array, array (
				"message_container" => $this->messageContainer ( $message->user_id, trim ( $message->message ), time () - 10, $message->number, $message->type )
				) );
			}
		}else{
			foreach($messages as $message){
				array_push ( $out_array, array (
				"number" => $message->$number,
				
				) );
			}
		}
		echo json_encode ( $out_array);
	}

	// get ungoten message of channel
	public function getUngotenMessages($number="all") {
		set_time_limit(10);
		$channel_id = (isset($_GET["channel_id"])?trim($_GET["channel_id"]):"");
		//$channel_id = $this->session->userdata("channel_id");
		$messages = $this->mchannels->getUngotenMessages ( $channel_id, "id", $number );
		while ( ! $messages ) {
			sleep ( 1 );
			clearstatcache ();
			$messages = $this->mchannels->getUngotenMessages( $channel_id, "id", $number );
		}
		$this->mchannels->getChannelMessages($channel_id);
		$out_array = array();
		foreach($messages as $message){
			array_push ( $out_array, array (
					"message_container" => $this->messageContainer ( $message->user_id, trim ( $message->message ), time () - 10, $message->number ) 
			) );
		}
		echo json_encode ( $out_array);
	}
	
	//get message container html
	public function messageContainer($user="", $message="", $time="", $number="", $type="text"){
		$this->lang->load ( "arabic", "arabic" );
		$data["message"] = $message;
		$data["user"] = $user;
		$data["time"] = $time;
		$data["number"] = $number;
		$data["type"] = $type;
		$message = $this->load->view("site/blocks/message-container", $data, true);
		return $message;
	}
	// send free message
	public function freeMessage() {
		if (trim ( $_POST ["number"] ) == "")
			exit ( "3" ); // user didn't enter number
		if (strlen ( trim ( $_POST ["number"] ) ) !== 12)
			exit ( "4" ); // number must be 12 number length.
		if (trim ( $_POST ["message"] ) == "")
			exit ( "5" ); // empty message
		if (! is_numeric ( trim ( $_POST ["number"] ) ))
			exit ( "6" ); // number isn't numeric.
		$this->load->model ( "whats/msend" );
		$sets = $this->mwhats->getSettings ();
		$request = $this->msend->sendMessage ( $sets->notify_user, trim ( $_POST ["number"] ), trim ( $_POST ["message"] ), trim ( $_POST ["message"] ));
		exit( $request );
	}	
	
	//send message
	public function sendSingleMessage(){
		if(!$this->session->userdata("validated"))
			exit(json_encode(array("status" => "7"))); // not validated
		$credits = $this->mwhats->getUserCredits($this->USER_ID);
		if($credits < 1)
			exit(json_encode(array("status" => "2"))); // no credits in user account
		if (trim ( $_POST ["number"] ) == "")
			exit ( json_encode(array("status" => "3"))); // user didn't enter number
		if (strlen ( trim ( $_POST ["number"] ) ) !== 12)
			exit ( json_encode(array("status" => "4")) ); // number must be 12 number length.
		if (trim ( $_POST ["message"] ) == "")
			exit ( json_encode(array("status" => "5")) ); // empty message
		if (! is_numeric ( trim ( $_POST ["number"] ) ))
			exit ( json_encode(array("status" => "6")) ); // number isn't numeric.
		$this->load->model ( "whats/msend" );
		$sets = $this->mwhats->getSettings ();
		//$channel_id = $this->session->userdata("channel_id");
		$channel_id = (isset($_POST["channel_id"])?trim($_POST["channel_id"]):"");
		$fake_message = (isset($_POST["fake_message"])?trim($_POST["fake_message"]):trim($_POST["message"]));
		$request = $this->msend->sendMessage ( $this->USER_ID, trim ( $_POST ["number"] ), trim ( $_POST ["message"] ), $fake_message, $channel_id);
		$out = array (
				"status" => $request,
				"credits" => $this->mwhats->getUserCredits ( $this->USER_ID ),
				//"message_container" => $this->messageContainer ($this->USER_ID, trim($_POST["fake_message"]), time()-10, trim($_POST["number"])) 
		);
		exit( json_encode($out));
	}
	
	//get channel number messages
	public function getNumberMessages(){
		if(!$this->session->userdata("validated"))
			exit(json_encode(array("status" => "7"))); // not validated
		
	}
	
	public function onGetImage($mynumber, $from, $id, $type, $t, $name, $size, $url, $file, $mimetype, $filehash, $width, $height, $preview){
		$from1 = explode('@',$from);
		$this->db->insert ( "whats_archive", array (
				"channel_id" => $this->mchannels->getChannelByPhone($mynumber)->id,
				"number" => $from1[0],
				"time" => $t,
				"status" => 1,
				"message" => $url,
				"msg_id" => $id,
				"user_id" => 0,
				"nickname" => $name,
				"seen" => 0 ,
				"goten" => 0,
				"type" => "image"
		) );
	}
	function onGetMessage($mynumber, $from, $id, $type, $time, $name, $body){
		$from1 = explode('@',$from);
		$this->db->insert ( "whats_archive", array (
				"channel_id" => $this->mchannels->getChannelByPhone($mynumber)->id,
				"number" => $from1[0],
				"time" => $time,
				"status" => 1,
				"message" => $body,
				"msg_id" => $id,
				"user_id" => 0,
				"nickname" => $name,
				"seen" => 0 ,
				"goten" => 0,
				"type" => "text"
		) );
	}
	
	function onGetProfilePicture($from, $target, $type, $data)
	{
		if ($type == "preview") {
			$filename = base_url()."assets/uploads/whatsapp/profile/preview_" . $target . ".jpg";
		} else {
			$filename = base_url()."assets/uploads/whatsapp/profile/" . $target . ".jpg";
		}
		$fp = @fopen($filename, "w");
		if ($fp) {
			fwrite($fp, $data);
			fclose($fp);
		}
		$this->session->set_userdata(array($target."_profile" => true));
	}
	
	function onGetAudio($mynumber, $from, $id, $type, $time, $name, $size, $url, $file, $mimetype, $filehash, $duration, $acodec){
		$from1 = explode('@',$from);
		$this->db->insert ( "whats_archive", array (
				"channel_id" => $this->mchannels->getChannelByPhone($mynumber)->id,
				"number" => $from1[0],
				"time" => $time,
				"status" => 1,
				"message" => $url,
				"msg_id" => $id,
				"user_id" => 0,
				"nickname" => $name,
				"seen" => 0 ,
				"goten" => 0,
				"type" => "audio"
		) );
	}
	
	function onGetVideo($mynumber, $from, $id, $type, $time, $name, $url, $file, $size, $mimetype, $filehash, $duration, $vcodec, $acodec, $data){
		$from1 = explode('@',$from);
		$this->db->insert ( "whats_archive", array (
				"channel_id" => $this->mchannels->getChannelByPhone($mynumber)->id,
				"number" => $from1[0],
				"time" => $time,
				"status" => 1,
				"message" => $url,
				"msg_id" => $id,
				"user_id" => 0,
				"nickname" => $name,
				"seen" => 0 ,
				"goten" => 0,
				"type" => "video"
		) );
	}
	
	function onGetvCard($mynumber, $from, $id, $type, $time, $name, $vCardName, $vCard){
		$from1 = explode('@',$from);
		$this->db->insert ( "whats_archive", array (
				"channel_id" => $this->mchannels->getChannelByPhone($mynumber)->id,
				"number" => $from1[0],
				"time" => $time,
				"status" => 1,
				"message" => $vCardName ."-". $vCard,
				"msg_id" => $id,
				"user_id" => 0,
				"nickname" => $name,
				"seen" => 0 ,
				"goten" => 0,
				"type" => "card"
		) );
	}
	
	function onGetLocation($mynumber, $from, $id, $type, $time, $name, $longtitude, $latitude, $data){
		$from1 = explode('@',$from);
		$this->db->insert ( "whats_archive", array (
				"channel_id" => $this->mchannels->getChannelByPhone($mynumber)->id,
				"number" => $from1[0],
				"time" => $time,
				"status" => 1,
				"message" => $latitude."-".$longtitude."-".$data,
				"msg_id" => $id,
				"user_id" => 0,
				"nickname" => $name,
				"seen" => 0 ,
				"goten" => 0,
				"type" => "location"
		) );
	}
	
	function onGetPlace($mynumber, $from, $id, $type, $time, $name, $placeName, $longtitude, $latitude, $url){
		$from1 = explode('@',$from);
		$this->db->insert ( "whats_archive", array (
				"channel_id" => $this->mchannels->getChannelByPhone($mynumber)->id,
				"number" => $from1[0],
				"time" => $time,
				"status" => 1,
				"message" => $latitude."-".$longtitude."-".$url."-".$placeName,
				"msg_id" => $id,
				"user_id" => 0,
				"nickname" => $name,
				"seen" => 0 ,
				"goten" => 0,
				"type" => "place"
		) );
	}
///////////////////////////end of messaging section////////////////////////////////

	
	
	
	////////////////////////begin of numbers and numbers groups section//////////////////////////////////////////
	
	// create new main group
	public function addMainGroup() {
		if (isset ( $_POST ["group_title"] )) {
			if(trim($_POST["group_title"]) == "")
				exit("3"); //empty group title
			$query = $this->mnumbers->addMainGroup ( array (
					"title" => trim($this->security->xss_clean(trim($_POST ["group_title"]))),
					"user_id" => $this->USER_ID
			) );//return -1 if group existed
			exit($query);
		}else exit("2");//no group_title post input
	}
	
	//get user main numbers groups
	public function getUserMainGroups(){
		$groups = $this->mnumbers->getUserMainGroups($this->USER_ID);
		if($groups)
			exit(json_encode($groups));
		else exit("0");//no groups
	}
	
	//get user sub groups of a main group
	public function getUserSubGroups(){
		if(!isset($_POST["group_id"]))
			exit("2");//no group id post.
		$groups = $this->mnumbers->getUserSubGroups($this->USER_ID, $_POST["group_id"]);
		if($groups)
			exit(json_encode($groups));
		exit("0");//no sub groups
	}
	
	//edit user main numbers group
	public function editUserGroup(){
		if(!isset($_POST["group_id"]))
			exit("2");//no group id post.
		if(!isset($_POST["title"]))
			exit("3");//no group title post.
		if(trim($_POST["title"]) == "") 
			exit("4");//group title is empty.
		$title = $this->security->xss_clean(trim($_POST["title"]));
		$request = $this->mnumbers->editUserGroup($this->USER_ID, $_POST["group_id"], $title);
		exit($request);
	}
	
	//empty user group
	public function emptyUserGroup(){
		if(!isset($_POST["group_id"]))
			exit("2");//no group id post.
		$request = $this->mnumbers->emptyUserGroup($this->USER_ID, $_POST["group_id"]);
		exit($request);
	}
	
	//delete user group
	public function deleteUserGroup(){
		if(!isset($_POST["group_id"]))
			exit("2");//no group id post.
		$request = $this->mnumbers->deleteUserGroup($this->USER_ID, $_POST["group_id"]);
		exit($request);
	}
	
	// create new sub group
	public function addSubGroup() {
		if (isset ( $_POST ["group_title"] )) {
			if(trim($_POST["group_title"]) == "")
				exit("3"); //empty group title
			if(trim($_POST["group_id"]) == "")
				exit("4"); //empty group title
			echo $query = $this->mnumbers->addSubGroup ( array (
					"title" => trim($this->security->xss_clean(trim($_POST ["group_title"]))),
					"main_group_id" => $_POST["group_id"],
					"user_id" => $this->USER_ID
			) );
			exit();
		}else exit("2");//no group_title post input
	}
	
	// add new number to sub group
	public function addUserNumber() {
		if (isset ( $_POST ["mobile"] )) {
			if(trim($_POST["mobile"]) == "")
				exit("3"); //empty mobile number
			if(!is_numeric(trim($_POST["mobile"])))
				exit("4"); //mobile number must be numeric
			if(strlen(trim($_POST["mobile"])) != 12)
				exit("5"); //mobile number length must be 12 digits
			echo $query = $this->mnumbers->addNumber ( array (
					"name" => trim($this->security->xss_clean($_POST ["name"])),
					"group_id" => $_POST["group_id"],
					"number" => trim($this->security->xss_clean($_POST["mobile"])),
					"user_id" => $this->USER_ID
			));
			exit();
		}else exit("2");//no mobile number post input
	}
	
	//delete user number
	public function deleteUserNumber(){
		if(!isset($_POST["number_id"]))
			exit("2");//no number id post.
		if(trim($_POST["number_id"]) == "")
			exit("3");//number id is empty.
		$request = $this->mnumbers->deleteNumber($this->USER_ID, $_POST["number_id"]);
		exit($request);
	}
	
	//edit user number
	public function editUserNumber(){
		if(!isset($_POST["number_id"]))
			exit("2"); //no number id post.
		if(trim($_POST["number_id"]) == "")
			exit("3"); //number id is empty.
		if(trim($_POST["number"]) == "")
			exit("4"); //number is empty.
		if(!is_numeric(trim($_POST["number"])))
			exit("5"); //number is not numeric.
		if(strlen(trim($_POST["number"])) !== 12)
			exit("6"); //number must be 12 numbers.
		$request = $this->mnumbers->editNumber(array(
				"user_id" => $this->USER_ID,
				"number_id" => trim($_POST["number_id"]),
				"name" => $this->security->xss_clean(trim($_POST["name"])),
				"number" => $this->security->xss_clean(trim($_POST["number"])),
				"group_id" => $_POST["group_id"]
		));
		exit($request);
	}
	
	public function checkGroupEmpty(){
		if($_GET["group_id"] == "")
			exit("2"); //no group_id
		$request = $this->mnumbers->checkGroupEmpty($this->USER_ID, $_GET["group_id"]);
		if($request>0)
			exit("1");//group isn't empty.
		exit("0");//group is empty.
	}
	
	
	
}



/*
// class to process inboud of channels
class ProcessNode extends CI_Controller {
	protected $wp = false;
	protected $target = false;
	protected $channel_id = false;
	public function __construct($wp, $target, $channel_id) {
		parent::__construct ();
		$this->wp = $wp;
		$this->target = $target;
	}

	public function process($node) {
		$text = $node->getChild ( 'body' );
		$text = $text->getData ();
		$from = explode ( "@", $node->getAttribute ( "from" ) );
		$msg_id = $node->getAttribute ( "id" );
		$this->db->insert ( "whats_archive", array (
				"channel_id" => $this->session->userdata ( "channel_id" ),
				"number" => $from [0],
				"time" => time (),
				"status" => 1,
				"message" => $text,
				"msg_id" => $msg_id,
				"user_id" => 0,
				"nickname" => $from [0],
				"seen" => 0 ,
				"goten" => 0
		) );
	}
	
	
	
}
*/