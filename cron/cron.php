<?php
 $dir_path =dirname(dirname(__file__)) . "/";

require ("class.MySQL.php");
require ("database.php");
require $dir_path.'application/libraries/whats/whatsprot.class.php';
require $dir_path."application/libraries/SMTP/phpmailer.php";
function getSiteSets()
{
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $query = $sql->executeSql("SELECT `site_url`, `admin_mobiles`, `admin_emails`
                            FROM `sitesettings`
                            WHERE `id`='1';");
    return $query[0];
}
$site_sets = getSiteSets();
$site_url = $site_sets["site_url"];
$mobiles = $site_sets["admin_mobiles"];

function onMessageReceivedServer($mynumber, $from, $id, $type, $time)
{
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $query = "UPDATE `whats_archive` SET `status`='server', `time`='" . time() . "'  WHERE `msg_id`='" . $id . "';";
    $req = $sql->executeSql($query);
}

function onMessageReceivedClient($mynumber, $from, $id, $type, $time)
{
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $query = "UPDATE `whats_archive` SET `status`='client', `time`='" . time() . "'  WHERE `msg_id`='" . $id . "';";
    $req = $sql->executeSql($query);
}

function getChannel($phone)
{
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $query = "SELECT `id` FROM `whats_channels` WHERE `phone` = '" . $phone . "';";
    $req = $sql->executeSql($query);
    return $req[0];
}

function onSendMessage($mynumber, $target, $messageId, $innerNode, $nickname, $id)
{
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $number = explode('@', $target);
    $channel = getChannel($mynumber);
    $query = "UPDATE `whats_archive` SET `msg_id` = '" . $messageId . "', `channel_id` = '" . $channel["id"] . "', `status`='sent', `nickname`='" . $nickname . "', `time`='" . time() . "' WHERE `id`='" . $id . "';";
    $req = $sql->executeSql($query);
    $query = "UPDATE `whats_channels` SET `last_send`='" . time() . "' WHERE `id`='" . $channel["id"] . "';";
    $req = $sql->executeSql($query);
    echo $target." sent!<br/>";
}

function setSending($channel_id, $status)
{
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $query = "UPDATE `whats_channels` SET `sending`='" . $status . "' WHERE `id`='" . $channel_id . "';";
    $req = $sql->executeSql($query);
}

function updateChannel($channel_id, $atts = array()){
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $query = "UPDATE `whats_channels` SET
                `status`='" . $atts["status"] . "',".
                (isset($atts["hash"])?"`hash`='{$atts["hash"]}',":"")."
                `reason`='" . $atts["reason"] . "',
                `last_update`='" . time() . "'
                WHERE `id`='" . $channel_id . "';";
    $sql->executeSql($query);
}

function disSend(){
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $query = "UPDATE `whats_settings` SET `active_send`='0' WHERE `id`='1';";
    $req = $sql->executeSql($query);
}

function getSets()
{
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $query = $sql->executeSql("SELECT `send_hours`, `active_send`, `channels_loop`, `msg_per_channel`
                            FROM `whats_settings`
                            WHERE `id`='1';");
    return $query[0];
}

function getChannels()
{
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $sets = getSets();
    $time = time() - $sets["send_hours"] * 3600;
    $query = "SELECT `id`, `phone`, `hash`, `identity` FROM `whats_channels`
                            WHERE `last_send` < '" . $time . "'
                            AND `sending` = 0
                            AND `status` = 'ok'
                            AND `user` = 0
                            LIMIT " . $sets["channels_loop"] . ";";
    return $sql->executeSql($query);
}

function getMessages()
{
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $sets = getSets();
    $query = "SELECT `id`, `message`, `number`, `nickname` FROM `whats_archive`
          WHERE `status` = 'waiting' LIMIT " . $sets["msg_per_channel"] . ";";
    return $sql->executeSql($query);
}

function getEmailSets(){
    $sql = new MySQL(DBName, DBUser, DBPassword, DBPrefix, HostName);
    $query = $sql->executeSql("SELECT *
                            FROM `email_settings`
                            WHERE `id`='1';");
    return $query[0];
}
function sendEmail($subject, $message){
    $mail = new PHPMailer;
    $sets = getEmailSets();
    $site_sets = getSiteSets();
    $emails = $site_sets["admin_emails"];
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $sets["server"];  // Specify main and backup server
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $sets["username"];                            // SMTP username
    $mail->Password = $sets["password"];                           // SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->charset = "UTF-8";
    $mail->SMTPAuth = true;
    $mail->From = $sets["username"];
    $mail->FromName = $sets["sendername"];
    $mail->IsHTML ( true );
    $emails = explode(",", $emails);
    foreach ( $emails as $address )
        $mail->AddAddress ( $address );
    $mail->Subject = $subject;
    $mail->MsgHTML ( $message );
    if (! $mail->Send ()) {
        return $mail->ErrorInfo;
    } else {
        return 1;
    }
}
header('Content-Type: text/html; charset=utf-8');
$sets = getSets();
if($sets["active_send"] == 0)
    exit("الارسال متوقف يرجى المراجعة");
$channels = getChannels();
if ($channels === true)
    exit("no ready channels!");
$messages = getMessages();
if ($messages === true)
    exit("no waiting messages!");
$blocked = 0;
$msg = "";
foreach ($channels as $channel) {
    $messages = getMessages();
    if ($messages === true)
        exit("no waiting messages!");
    //$nickname = ($message["nickname"] == ""?$channel["phone"]:$message["nickname"]);


    $w = new WhatsProt(trim($channel["phone"]), $channel["identity"], $channel["phone"], false);
    $w->eventManager()->bind("onSendMessage", "onSendMessage");
    $w->eventManager()->bind("onMessageReceivedServer", "onMessageReceivedServer");
    $w->eventManager()->bind("onMessageReceivedClient", "onMessageReceivedClient");
    $w->Connect();
    $w->LoginWithPassword(trim($channel["hash"]));
    setSending($channel["id"], 1);
    echo "<pre>";
    exit(print_r($messages));
    foreach ($messages as $message) {
    try{
        // $w->sendPresenceSubscription ( trim ( $num ) );
        $w->sendMessageComposing ( trim($message["number"]) );
        $w->sendMessage(trim($message["number"]), trim($message["message"]), array(
            "nickname" => $message["nickname"],
            "id" => $message["id"]
        ));
        //sleep ( 1 );
        }catch (Exception $e){
            echo "error sending Number {$message['number']}<br/>";
        }
        // $w->sendMessagePaused ( trim ( $num ) );

    }
    $cred = $w->checkCredentials ( $channel["phone"]);
    if ($cred->status == "ok"){
        updateChannel($channel["id"], array(
            "status" => $cred->status,
            "hash" => $cred->pw,
            "last_update" => time (),
            "reason" => ""
        ));
        echo "channel: {$channel['phone']} is Ok!<br/>";
    }
    elseif($cred->reason == "blocked"){
        updateChannel($channel["id"], array(
            "status" => $cred->status,
            "last_update" => time (),
            "reason" => $cred->reason
        ));
        $blocked += 1;
        echo "channel: {$channel['phone']} is fail for reason: BLOCKED!<br/>";
        $msg .= " blocked channel id: {$channel['id']}<br/>";
        if($blocked == 1){
            disSend();
            sendEmail("تم إيقاف الارسال في سكربت الواتس آب", $msg);
            exit("تم إيقاف الارسال");
        }
    }
    else{
        updateChannel($channel["id"], array(
            "status" => $cred->status,
            "last_update" => time (),
            "reason" => $cred->reason
        ));
        echo "channel: {$channel['phone']} is fail for reason: {$cred->reason}!<br/>";
    }
    //$w->disconnect();
    setSending($channel["id"], 0);
}
