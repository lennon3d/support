<?php
require_once './application/libraries/whats/whatsprot.class.php';
class MWhats extends CI_Model {

	const ARCHIVE_TABLE = "whats_archive";
	const CHANNELS_TABLE = "whats_channels";
	const CHARGE_REQUESTS_TABLE = "whats_charge_requests";
	const CREDITS_TABLE = "whats_credits";
	const MSG_LIMIT_TABLE = "whats_msg_limit";
	const USERS_CHANNELS_TABLE = "whats_users_channels";
	const SETTINGS_TABLE = "whats_settings";
	const INBOX_TABLE = "whats_inbox";
	//const TOKEN = "011235813MarwanZak!!";

	var $whats;
	protected $connected;
	protected $login;

	public function __construct() {
		parent::__construct ();

	}

	//public function __destruct(){
	//	if(isset($this->whats) && $this->connected)
	//		$this->whats->disconnect();
	//}


	//get channel by id
	public function getChannelById($channel_id){
		$this->db->where("id", $channel_id);
		$query = $this->db->get(MWhats::CHANNELS_TABLE);
		if($query->num_rows()>0)
			return $query->row();
		return false;
	}

	//get channel by phone
	public function getChannelByPhone($phone){
		$this->db->where("phone", $phone);
		$query = $this->db->get ( MWhats::CHANNELS_TABLE);
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}

	public function connect($phone, $identity, $nickname=""){
		if($nickname == "")
			$nickname = $phone;
		try{
		$this->whats = new WhatsProt ( $phone, $identity, $nickname, false );
		$this->whats->eventManager()->bind('onConnect', array($this, 'onConnect'));
		$this->whats->eventManager()->bind("onSendStatusUpdate", array($this, "onSendStatusUpdate"));
		$this->whats->eventManager()->bind("onGetImage", array($this, "onGetImage"));
		$this->whats->eventManager()->bind("onGetMessage", array($this, "onGetMessage"));
		$this->whats->eventManager()->bind("onGetPlace", array($this, "onGetPlace"));
		$this->whats->eventManager()->bind("onGetvCard", array($this, "onGetvCard"));
		$this->whats->eventManager()->bind("onGetLocation", array($this, "onGetLocation"));
		$this->whats->eventManager()->bind("onGetVideo", array($this, "onGetVideo"));
		$this->whats->eventManager()->bind("onGetAudio", array($this, "onGetAudio"));
		$this->whats->eventManager()->bind("onGetProfilePicture", array($this, "onGetProfilePicture"));
		$this->whats->eventManager ()->bind ( "onSendMessage", array ($this,"onSendMessage") );
		$this->whats->eventManager ()->bind ( "onMessageReceivedServer", array ($this,"onMessageReceivedServer") );
		$this->whats->eventManager ()->bind ( "onMessageReceivedClient", array ($this,"onMessageReceivedClient") );

		}catch(Exception $e){
			return array("status" => "failed", "message" => $e->getMessage());
		}
	}

	public function login($pw){
		if (isset($this->whats)) {
			$this->whats->connect();
			$this->whats->loginWithPassword($pw);
			return true;
		}
		return false;
	}

	public function sendMessage($number, $message, $user_id=1){
	    $this->whats->sendMessageComposing(trim($number));
	    $this->whats->sendMessage(trim($number), trim($message), array(
	        "user_id" => $user_id,
	        "nickname" => $number,
	        "fake" => $message
	    ));
	}

	public function onConnect()
	{
		$this->connected = true;
	}

	public function codeRequest($method){
		return $this->whats->codeRequest($method);
	}

	public function codeRegister($code){
		return $this->whats->codeRegister($code);
	}

	public function saveMessage($user_id, $message, $number){
	    $this->db->insert(self::ARCHIVE_TABLE, array(
	    	"user_id" => $user_id,
	        "message" => $message,
	        "number" => $number,
	        "time" => time(),
	        "status" => "waiting",
	        "type" => "text"
	    ));
	}

	// discount credit of user
	public function disCountCredits($user_id) {
		$this->db->where ( "user_id", $user_id );
		$query = $this->db->get ( self::CREDITS_TABLE );
		if ($query->num_rows () > 0) {
			$user = $query->row ();
			$this->db->where ( "user_id", $user_id );
			$query = $this->db->update ( "whats_credits", array (
					"credits" => $user->credits - 1
			) );
			if ($query)
				return $user->credits;
			return false;
		}
		return false;
	}


	// get user whats app credit points
	public function getUserCredits($user_id) {
		$this->db->where ( "user_id", $user_id );
		$query = $this->db->get ( self::CREDITS_TABLE);
		if ($query->num_rows () > 0) {
			$user = $query->row ();
			return $user->credits;
		}
		return false;
	}


	// get whats settings
	public function getSettings() {
		$this->db->where ( "id", 1 );
		$query = $this->db->get ( self::SETTINGS_TABLE);
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}

	//update whatsapp settings
	public function updateSettings($atts=array()){
		$this->db->where("id", 1);
		return $this->db->update(self::SETTINGS_TABLE, $atts);
	}
	//set test channels user
	public function setTestUser($user_id){
		$this->db->where("id", 1);
		return $this->db->update(self::SETTINGS_TABLE, array("test_user" => $user_id));
	}

	//set notify messages user
	public function setNotifyUser($user_id){
		$this->db->where("id", 1);
		return $this->db->update(self::SETTINGS_TABLE, array("notify_user" => $user_id));
	}


	//check if number have whatsapp registered or not
	public function checkNumber($number, $user_id="", $channel_id = ""){
		$this->load->model("whats/mchannels");
		$channel = $this->mchannels->getUserChannel($this->getSettings()->notify_user);
		if($user_id != "")
			$channel = $this->mchannels->getUserChannel($user_id);
		if($channel_id !=""){
		    $channel = $this->mchannels->getChannelById($channel_id);
		}
		$w = new WhatsProt ( $channel->phone, $channel->identity, "Marwan", false );
		$w->eventManager()->bind("onLoginFailed", array($this, "onLoginFailed"));
		$w->Connect ();
		$w->LoginWithPassword ( $channel->hash );
		$result = $w->checkNumber($number);
		$w->disconnect();
		return $result;
	}

	//sync contact
	public function syncContact($number){
		return $this->whats->checkNumber(trim($number));
	}

	//get profile picture of number contact
	public function getProfile($channel, $number, $type="id"){
		$this->load->model("whats/mchannels");
		if ($type == "id")
			$channel = $this->mchannels->getChannelById ( $channel );
		elseif ($type == "phone")
		$channel = $this->mchannels->getChannelByPhone ( $channel );
		if (! $channel)
			return 4; // invalid channel
		if($this->session->userdata($number."_profile"))
			return 5; //profile picture had been loaded in this session
		$w = new WhatsProt ( $channel->phone, $channel->identity, "", false );
		$w->eventManager()->bind("onGetProfilePicture", array($this, "onGetProfilePicture"));
		$w->connect ();
		$w->loginWithPassword ( $channel->hash );
		$w->sendGetProfilePicture($number);
		$w->disconnect();
	}

	function onLoginFailed($mynumber, $reason){
		return ("error_log");
	}

	public function onMessageReceivedServer($mynumber, $from, $id, $type, $time) {
		$this->db->where ( "msg_id", $id );
		$this->db->update ( self::ARCHIVE_TABLE, array (
				"status" => "server"
		) );
	}
	public function onMessageReceivedClient($mynumber, $from, $id, $type, $time) {
		$this->db->where ( "msg_id", $id );
		$this->db->update ( self::ARCHIVE_TABLE, array (
				"status" => "client"
		) );
	}
	public function onSendMessage($mynumber, $target, $messageId, $innerNode, $user_id, $nickname, $fake) {
		$number = explode ( '@', $target );
		$this->mwhats->disCountCredits ( $user_id );
		$this->db->insert ( self::ARCHIVE_TABLE, array (
				"msg_id" => $messageId,
				"user_id" => $user_id,
				"number" => $number [0],
				"channel_id" => $this->getChannelByPhone ( $mynumber )->id,
				"message" => $fake,
				"status" => "sent",
				"time" => time (),
				"nickname" => $nickname,
				"type" => "text"
		) );
	}

	public function onGetImage($mynumber, $from, $id, $type, $t, $name, $size, $url, $file, $mimetype, $filehash, $width, $height, $preview){
		$from1 = explode('@',$from);
		$this->db->insert ( "whats_archive", array (
				"channel_id" => $this->getChannelByPhone($mynumber)->id,
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
		$this->db->insert ( self::ARCHIVE_TABLE, array (
				"channel_id" => $this->getChannelByPhone($mynumber)->id,
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
		$this->db->insert ( self::ARCHIVE_TABLE, array (
				"channel_id" => $this->getChannelByPhone($mynumber)->id,
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
		$this->db->insert ( self::ARCHIVE_TABLE, array (
				"channel_id" => $this->getChannelByPhone($mynumber)->id,
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
		$this->db->insert ( self::ARCHIVE_TABLE, array (
				"channel_id" => $this->getChannelByPhone($mynumber)->id,
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
		$this->db->insert ( self::ARCHIVE_TABLE, array (
				"channel_id" => $this->getChannelByPhone($mynumber)->id,
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
		$this->db->insert ( self::ARCHIVE_TABLE, array (
				"channel_id" => $this->getChannelByPhone($mynumber)->id,
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


	//get time deferent between two times given
	public function getTimeDef($time1, $time2){
		$string_def = array(
				array(60, lang("just_now")),
				array(90, '1 '.lang("minute")),                  // 60*1.5
				array(3600, lang("minutes"), 60),             // 60*60, 60
				array(5400, '1 '.lang("hour")),                  // 60*60*1.5
				array(86400, lang("hours"), 3600),            // 60*60*24, 60*60
				array(129600, '1 '.lang("day")),                 // 60*60*24*1.5
				array(604800, lang("days"), 86400),           // 60*60*24*7, 60*60*24
				array(907200, '1 '.lang("week")),                // 60*60*24*7*1.5
				array(2628000, lang("weeks"), 604800),        // 60*60*24*(365/12), 60*60*24*7
				array(3942000, '1 '.lang("month")),              // 60*60*24*(365/12)*1.5
				array(31536000, lang("monthes"), 2628000),     // 60*60*24*365, 60*60*24*(365/12)
				array(47304000, '1 '.lang("year")),              // 60*60*24*365*1.5
				array(3153600000, lang("years"), 31536000),   // 60*60*24*365*100, 60*60*24*365
		);
		$difference = $time1-$time2;
		$message = "";
		foreach($string_def as $format){
			if ($difference < $format[0]) {
				if (count($format) == 2) {
					$message = lang("time_from")." ".$format[1];
					break;
				} else {
					$message = lang("time_from")." ".ceil($difference / $format[2]) . ' ' . $format[1];
					break;
				}
			}
		}
		return $message;
	}
}