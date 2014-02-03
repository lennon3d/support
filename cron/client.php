<?php
require ("class.MySQL.php");
require ("database.php");
$sql = new MySQL ( DBName, DBUser, DBPassword, DBPrefix, HostName );
$prefix = DBPrefix;
if ($_GET) {
	switch ($_GET ["action"]) {
		//request new chat by guests
		case "request_chat" :
			$time = time ();
			$query = $sql->executeSql ( "INSERT INTO `{$prefix}chats` (`name`,`email`,`mobile`,`datetime`,`active`,`accepted`)
			VALUES ('{$_GET['name']}','{$_GET['email']}','{$_GET['mobile']}','{$time}','1','0')" );
			$id = mysql_insert_id ();
			echo ($id);
			break;
		case "status" :
			$last_chat = $sql->executeSql ( "SELECT `datetime` FROM `{$prefix}chats` WHERE `active`= '1' ORDER BY `datetime` DESC LIMIT 1" );
			echo $last_chat[0]["datetime"];
			break;
			//send new message by either guest or users
		case "sendmessage" :
			$time = time ();
			$user = $_GET["username"];
			$query = $sql->executeSql ( "INSERT INTO `{$prefix}messages` (`message`,`datetime`,`username`,`chat`)
			VALUES ('{$_GET['message']}','{$time}','{$user}','{$_GET['chat']}')" );
			echo ($query);
			break;
			//get operator review new chats and messages
		case "operator_review" :
			$return = array ();
			$last_chat_ajax = $_GET ["chat_ajax"];
			$last_message_ajax = $_GET["message_ajax"];
			//$last_message = $sql->Select ( "{$prefix}messages", '', 'datetime desc', '1' );
			$last_message = $sql->executeSql ( "SELECT `datetime` FROM `{$prefix}messages` ORDER BY `datetime` DESC LIMIT 1" );
			$last_chat = $sql->executeSql ( "SELECT `datetime` FROM `{$prefix}chats` WHERE `active`= '1' ORDER BY `datetime` DESC LIMIT 1" );
			if(!is_array($last_chat)){
				$last_chat = array(array("datetime"=>1));
			}
			if(!is_array($last_message)){
				$last_message = array(array("datetime"=>1));
			}
			$chat_ajax = ($last_chat_ajax != null ? $last_chat_ajax : $last_chat[0]["datetime"]);
			$message_ajax = ($_GET ["message_ajax"] != null ? $_GET ["message_ajax"] : $last_message[0]["datetime"]);
			while ( $chat_ajax >= $last_chat [0] ["datetime"] && $message_ajax >= $last_message[0]["datetime"]) {
				usleep ( 10000 );
				clearstatcache ();
				$last_chat = $sql->executeSql ( "SELECT `datetime` FROM `{$prefix}chats` WHERE `active`= '1' ORDER BY `datetime` DESC LIMIT 1" );
				$last_message = $sql->executeSql ( "SELECT `datetime` FROM `{$prefix}messages` ORDER BY `datetime` DESC LIMIT 1" );
			}
			
			$chats = $sql->executeSql ( "SELECT * FROM `{$prefix}chats` WHERE `active`='1' AND `datetime`>{$chat_ajax}" );
			$messages = $sql->executeSql("SELECT * FROM `{$prefix}messages` WHERE `datetime`>{$message_ajax}");
			$return ["chats"] = array ();
			$return ["chats"] ["chats"] = $chats;
			$return ["chats"] ["last"] = $last_chat [0] ["datetime"];
			$return ["messages"] = array();
			$return ["messages"] ["messages"] = $messages;
			$return ["messages"]["last"] = $last_message[0]["datetime"];
			echo json_encode ( $return );
			break;
			//close chat from either guest or users
		case "closechat":
			$chat_id = $_GET["chat"];
			$query = "UPDATE `{$prefix}chats` SET `active`='0' WHERE `id`='{$chat_id}'";
			echo $sql->executeSql($query);
			break;
			//get active chats
		case "activechats":
			$query = "SELECT * FROM `{$prefix}chats` WHERE `active`='1'";
			$chats = $sql->executeSql($query);
			echo json_encode($chats);
			break;
			//get messages of active chats
		case "activechatsmessages":
			$messages["messages"] = array();
			$active_chats = $sql->executeSql("SELECT * FROM `{$prefix}chats` WHERE `active`='1'");
			foreach($active_chats as $chat){
				$query = "SELECT * FROM `{$prefix}messages` WHERE `chat`='{$chat["id"]}'";
				$messages_array = $sql->executeSql($query);
				if(count($messages_array)>1)
				array_push($messages["messages"], $messages_array);
			}
			$request = json_encode($messages);
			//$request = str_replace(array("[","]"), "", $request)
			//$json = json_decode($request);
			//echo "<pre>";
			//print_r($json->messages[0][0]->id);
			//echo "</pre>";
			echo $request;
			break;
			//get messages of a chat
		case "chatmessages":
			$chat = $_GET["chat"];
			$query = "SELECT * FROM `{$prefix}messages` WHERE `chat`='{$chat}'";
			$messages = $sql->executeSql($query);
			echo json_encode($messages);
			break;
			//accept chat by user
		case "acceptchat":
			$chat = $_GET["chat"];
			$query = "UPDATE `{$prefix}chats` SET `accepted`='1' WHERE `id`='{$chat}'";
			$request = $sql->executeSql($query);
			echo $request;
			break;
		case "clientreview":
			$return = array ();
			$last_message_ajax = $_GET["message_ajax"];
			$chat = $_GET["chat"];
			//$last_message = $sql->Select ( "{$prefix}messages", '', 'datetime desc', '1' );
			$last_message = $sql->executeSql ( "SELECT `datetime` FROM `{$prefix}messages` WHERE `chat`='{$chat}' ORDER BY `datetime` DESC LIMIT 1" );
			if(!is_array($last_message)){
				$last_message = array(array("datetime"=>1));
			}
			$message_ajax = ($_GET ["message_ajax"] != null ? $_GET ["message_ajax"] : $last_message[0]["datetime"]);
			while ($message_ajax >= $last_message[0]["datetime"]) {
				usleep ( 10000 );
				clearstatcache ();
				$last_message = $sql->executeSql ( "SELECT `datetime` FROM `{$prefix}messages` WHERE `chat`='{$chat}' ORDER BY `datetime` DESC LIMIT 1" );
			}
				
			$messages = $sql->executeSql("SELECT * FROM `{$prefix}messages` WHERE `chat`='{$chat}' AND `datetime`>{$message_ajax}");
			$return ["messages"] = array();
			$return ["messages"] ["messages"] = $messages;
			$return ["messages"]["last"] = $last_message[0]["datetime"];
			echo json_encode ( $return );
			break;
			
	}
}