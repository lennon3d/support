<?php

class MSend extends CI_Model
{

    protected $connected;

    protected $reason;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("whats/mwhats");
    }

    public function onLoginFailed($mynumber, $reason)
    {
        $this->connected = false;
        $this->reason = $reason;
    }

    public function onMessageReceivedServer($mynumber, $from, $id, $type, $time)
    {
        $this->db->where("msg_id", $id);
        $this->db->update(MWhats::ARCHIVE_TABLE, array(
            "status" => "server"
        ));
    }

    public function onMessageReceivedClient($mynumber, $from, $id, $type, $time)
    {
        $this->db->where("msg_id", $id);
        $this->db->update(MWhats::ARCHIVE_TABLE, array(
            "status" => "client"
        ));
    }

    public function onSendMessage($mynumber, $target, $messageId, $innerNode, $user_id, $nickname, $fake)
    {
        $number = explode('@', $target);
        $this->mwhats->disCountCredits($user_id);
        $this->db->insert(MWhats::ARCHIVE_TABLE, array(
            "msg_id" => $messageId,
            "user_id" => $user_id,
            "number" => $number[0],
            "channel_id" => $this->mchannels->getChannelByPhone($mynumber)->id,
            "message" => $fake,
            "status" => "sent",
            "time" => time(),
            "nickname" => $nickname,
            "type" => "text"
        ));
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function getConnected()
    {
        return $this->connected;
    }
    // send whatsapp message from user channel
    public function sendMessage($user_id, $number, $message, $fake, $channel_id = "", $nickname = "")
    {
        set_time_limit(0);
        $credits = $this->mwhats->getUserCredits($user_id);
        if ($credits < 1)
            return 2; // credit points is zerooooo!!!!
        $channel = $this->mchannels->getUserChannel($user_id);
        if ($channel_id != "")
            $channel = $this->mchannels->getChannelById($channel_id);
            // $msgid = time () . "_" . substr ( trim ( $number ), 9 );
        if ($nickname == "")
            $nickname = $channel->phone;
        try {
            $w = new WhatsProt(trim($channel->phone), $channel->identity, $nickname, false);
            $w->eventManager()->bind("onSendMessage", array(
                $this,
                "onSendMessage"
            ));
            $w->eventManager()->bind("onMessageReceivedServer", array(
                $this,
                "onMessageReceivedServer"
            ));
            $w->eventManager()->bind("onMessageReceivedClient", array(
                $this,
                "onMessageReceivedClient"
            ));
            $w->eventManager()->bind("onLoginFailed", array(
                $this,
                "onLoginFailed"
            ));
        } catch (Exception $e) {
            return "0";
        }
        $w->Connect();
        $w->LoginWithPassword(trim($channel->hash));
        if ($this->connected !== false) {

            // $this->mwhats->disChannel($channel->channel_id);
            // $w->sendMessageComposing ( trim ( $number ) );
            // $this->mwhats->activeChannel($channel->channel_id);
            if (! is_array($number))
                $number = array(
                    $number
                );
            foreach ($number as $num) {
                // $w->sendPresenceSubscription ( trim ( $num ) );
                $w->sendMessageComposing(trim($num));
                $w->sendMessage(trim($num), trim($message), array(
                    "user_id" => $user_id,
                    "nickname" => $nickname,
                    "fake" => $fake
                ));
                // $w->sendMessagePaused ( trim ( $num ) );
                // sleep ( 1 );
            }
            $w->disconnect();
            return true;
        }
    }
    // send message from a determined channel to check channel
    public function sendChannelMessage($number, $channel_id, $message, $type = "id", $nickname = "Marwan")
    {
        $user_id = $this->USER_ID;
        if ($type == "id")
            $channel = $this->mchannels->getChannelById($channel_id);
        elseif ($type == "number")
            $channel = $this->mchannels->getChannelByPhone($channel_id);
        if (! $channel)
            return 4; // invalid channel
        $credits = $this->mwhats->getUserCredits($user_id);
        if ($credits < 1)
            return 2; // credit points is zerooooo!!!!
        $sender = $channel->phone;
        $imei = $channel->hash;
        $msgid = time() . "_" . substr(trim($number), 9);
        $w = new WhatsProt(trim($channel->phone), $channel->identity, $nickname, false);
        $w->eventManager()->bind("onSendMessage", array(
            $this,
            "onSendMessage"
        ));
        $w->Connect();
        $w->LoginWithPassword(trim($imei));
        try {
            // $this->mchannels->disChannel ( $channel->id );
            $w->sendMessageComposing(trim(trim($number)));
            // $this->mchannels->activeChannel ( $channel->id );
            $w->sendMessage(trim($number), trim($message));
            $this->mwhats->disCountCredits($user_id);
            $this->db->insert(MWhats::ARCHIVE_TABLE, array(
                "msg_id" => $msgid,
                "user_id" => $user_id,
                "number" => $number,
                "channel_id" => $channel->id,
                "message" => $message,
                "status" => 1,
                "time" => time(),
                "nickname" => $nickname,
                "goten" => 1,
                "type" => "text"
            ));
            return 1;
        } catch (Exception $e) {
            $this->db->insert(MWhats::ARCHIVE_TABLE, array(
                "msg_id" => $msgid,
                "user_id" => $user_id,
                "number" => $number,
                "channel_id" => $channel->id,
                "message" => $message,
                "status" => 0,
                "time" => time(),
                "nickname" => $nickname,
                "goten" => 1
            ));
            return 0;
        }
    }

    // send multi threed messages with curl_multi
    public function sendMulti($sender, $message)
    {
        $w = new WhatsProt(trim($sender), MWhats::TOKEN, $nickname, false);
        $w->Connect();
        $w->LoginWithPassword(trim($imei));
        $numbers = array();
        for ($i = 0; $i < 10; $i ++)
            array_push($numbers, "201067676608");
        $w->sendBroadcastMessage($numbers, trim($message));
    }
}