<?php

class MChannels extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("whats/mwhats");
    }

    // create identity for mobile number
    public function createIdentity($number, $salt = "")
    {
        $in = substr($number, 2);
        return strtolower(urlencode(sha1(strrev($in . $salt), true)));
    }

    // just login to channel debug = true to show errors
    public function channelLogin($channel_id)
    {
        $channel = $this->getChannelById($channel_id);
        $w = new WhatsProt($channel->phone, $channel->identity, "Marwan", true);
        $w->Connect();
        $w->LoginWithPassword($channel->hash);
        $w->disconnect();
    }

    // disactive channel
    public function disChannel($channel_id)
    {
        $this->db->where("id", $channel_id);
        return $this->db->update(MWhats::CHANNELS_TABLE, array(
            "status" => 0
        ));
    }

    // activate channel
    public function activeChannel($channel_id)
    {
        $this->db->where("id", $channel_id);
        return $this->db->update(MWhats::CHANNELS_TABLE, array(
            "status" => 1
        ));
    }

    // get user channels
    public function getUserChannel($user_id, $type = "all")
    {
        $this->db->where("user", $user_id);
        $query = $this->db->get(MWhats::CHANNELS_TABLE);
        if ($query->num_rows() > 0) {
            $channel = $query->row();
            if ($type == "id")
                return $channel->id;
            if ($type == "phone")
                return $channel->phone;
            if ($type == "all")
                return $channel;
        }
        return false;
    }

    // get channel by id
    public function getChannelById($channel_id)
    {
        $this->db->where("id", $channel_id);
        $query = $this->db->get(MWhats::CHANNELS_TABLE);
        if ($query->num_rows() > 0)
            return $query->row();
        return false;
    }

    // get channel by phone
    public function getChannelByPhone($phone)
    {
        $this->db->where("phone", $phone);
        $query = $this->db->get(MWhats::CHANNELS_TABLE);
        if ($query->num_rows() > 0)
            return $query->row();
        return false;
    }

    // request code to number
    public function requestCode($method = "voice", $number, $nickname = "")
    {
        $channel = $this->getChannelByPhone($number);
        if (! $channel)
            return false;
        if ($nickname == "")
            $nickname = $channel->phone;
        $w = new WhatsProt($channel->phone, $channel->identity, $nickname, false);
        return $w->codeRequest($method);
    }

    // register code
    public function registerCode($mobile, $code, $nickname = "")
    {
        $channel = $this->getChannelByPhone($mobile);
        if (! $channel)
            return false;
        if ($nickname == "")
            $nickname = $channel->phone;
        $w = new WhatsProt($channel->phone, $channel->identity, $nickname, false);
        return $w->codeRegister(trim($code));
    }

    // update channel hash password by channel phone
    public function updateHash($phone, $hash)
    {
        $this->db->where("phone", $phone);
        return $this->db->update(MWhats::CHANNELS_TABLE, array(
            "hash" => $hash,
            "last_update" => time()
        ));
    }

    // get all channels
    public function getAllChannels($limit = 25, $offset = 0, $search = array())
    {
        if ($limit != "all")
            $this->db->limit($limit, $offset);
        if (count($search) != 0)
            foreach ($search as $key => $value) {
                $this->db->like($key, $value);
            }
        $query = $this->db->get(MWhats::CHANNELS_TABLE);
        if ($query->num_rows() > 0) {
            $query1 = $this->db->get(MWhats::CHANNELS_TABLE);
            return array(
                "results" => $query->result(),
                "count" => $query1->num_rows()
            );
        }
        return false;
    }

    // add new channel
    public function addChannel($atts = array())
    {
        $query = $this->db->insert(MWhats::CHANNELS_TABLE, $atts);
        if ($query)
            return $this->db->insert_id();
        return false;
    }

    // update channel
    public function updateChannel($id, $atts = array())
    {
        $this->db->where("id", $id);
        return $this->db->update(MWhats::CHANNELS_TABLE, $atts);
    }

    // delete channel
    public function deleteChannel($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete(MWhats::CHANNELS_TABLE);
    }

    // read messages of a channel
    public function readChannelMessages($channel, $type = "id")
    {
        $out_array = array();
        $message = array();
        if ($type == "id")
            $channel = $this->mwhats->getChannelById($channel);
        elseif ($type == "number")
            $channel = $this->mwhats->getChannelByPhone($channel);
        if (! $channel)
            return 4; // invalid channel
        $w = new WhatsProt($channel->phone, $channel->identity, "marwan", false);
        $w->connect();
        if ($w->getSocket() == NULL)
            return 3; // number is unavailable
        $w->loginWithPassword($channel->hash);
        $w->pollMessages();
        $msgs = $w->getMessages();
        foreach ($msgs as $m) {
            $from_att = $m->getAttribute("from");
            $message["time"] = date("Y-m-d h:i a", $m->getAttribute("t"));
            $from = explode("@", $from_att);
            $message["from"] = $from[0];
            // process inbound messages
            // header('Content-type: text/xml;');
            // echo "<pre>";
            foreach ($m->getChildren() as $child) {
                if ($child->getTag() == "body") {
                    $message["message"] = $child->getData();
                }
            }
            array_push($out_array, $message);
        }
        return $out_array;
    }

    // assign channel to user
    public function assignChannel($channel_id, $user_id)
    {
        $this->db->where("user", $user_id);
        $this->db->update(MWhats::CHANNELS_TABLE, array(
            "user" => 0
        ));
        $this->db->where("id", $channel_id);
        return $this->db->update(MWhats::CHANNELS_TABLE, array(
            "user" => $user_id
        ));
    }

    // get active and unassigned channel
    public function getUnassignedChannel()
    {
        $this->db->where("user", 0);
        $this->db->where("status", "ok");
        $query = $this->db->get(MWhats::CHANNELS_TABLE);
        if ($query->num_rows() > 0) {
            $channel = $query->row();
            return $channel->id;
        }
    }

    // check channel credentials to know what is the status of the channel
    public function checkCred($phone)
    {
        $channel = $this->getChannelByPhone($phone);
        $w = new WhatsProt($channel->phone, $channel->identity, $channel->phone, false);
        return $w->checkCredentials();
    }

    // get channel conversations
    public function getChannelConv($channel, $type = "id")
    {
        if ($type == "id")
            $channel = $this->mwhats->getChannelById($channel);
        elseif ($type == "phone")
            $channel = $this->mwhats->getChannelByPhone($channel);
        if (! $channel)
            return 4; // invalid channel
        $out_array = array();
        $this->db->select("number, message, nickname");
        $this->db->where("channel_id", $channel->id);
        $this->db->group_by("number");
        // $this->db->distinct();
        $query = $this->db->get(MWhats::ARCHIVE_TABLE);
        if ($query->num_rows() < 1)
            return false;
        foreach ($query->result() as $row) {
            array_push($out_array, array(
                "number" => $row->number,
                "nickname" => $row->nickname,
                "message" => $row->message,
                "count" => 0
            ));
        }
        $this->db->select("number, count(seen) as count");
        $this->db->where(array(
            "seen" => 0,
            "channel_id" => $channel->id
        ));
        $this->db->group_by("number");
        $query = $this->db->get(MWhats::ARCHIVE_TABLE);
        if ($query->num_rows() > 0) {
            foreach ($out_array as $key => $array) {
                foreach ($query->result() as $row) {
                    if ($row->number == $array["number"]) {
                        $out_array[$key]["count"] = $row->count;
                    }
                }
            }
        }
        return $out_array;
    }

    // get ungoten message of channel
    public function getUngotenMessages($channel, $type = "id")
    {
        if ($type == "id")
            $channel = $this->mwhats->getChannelById($channel);
        elseif ($type == "phone")
            $channel = $this->mwhats->getChannelByPhone($channel);
        if (! $channel)
            return 4; // invalid channel
        $this->db->select("number,count(number) count, message");
        $this->db->group_by("number");
        $this->db->where(array(
            "goten" => 0,
            "channel_id" => $channel->id,
            "user_id" => 0
        ));
        $query = $this->db->get(MWhats::ARCHIVE_TABLE);
        $out_array = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $message) {
                array_push($out_array, array(
                    "number" => $message->number,
                    "count" => $message->count,
                    "message" => $message->message
                ));
            }
            return $out_array;
        }
        return false;
    }

    // get ungoten message of channel for a determined mobile number
    public function getUngotenNumberMessages($channel, $number, $type = "id")
    {
        if ($type == "id")
            $channel = $this->mwhats->getChannelById($channel);
        elseif ($type == "phone")
            $channel = $this->mwhats->getChannelByPhone($channel);
        if (! $channel)
            return "4"; // invalid channel
        if ($number == null)
            return "5"; // no choosen number
        $this->db->select("message, type, number, user_id");
        $this->db->where(array(
            "goten" => 0,
            "channel_id" => $channel->id,
            "number" => $number
        ));
        $query = $this->db->get(MWhats::ARCHIVE_TABLE);
        if ($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    // update goten status of channel messages
    public function getChannelMessages($channel, $type = "id", $number = "all")
    {
        if ($type == "id")
            $channel = $this->mwhats->getChannelById($channel);
        elseif ($type == "phone")
            $channel = $this->mwhats->getChannelByPhone($channel);
        if (! $channel)
            return 4; // invalid channel
        $this->db->where(array(
            "channel_id" => $channel->id,
            "goten" => 0
        ));
        if ($number != "all")
            $this->db->where("number", $number);
        return $this->db->update(MWhats::ARCHIVE_TABLE, array(
            "goten" => 1
        ));
    }

    // handle message inbound
    public function getNumberMessages($channel, $number, $type = "id")
    {
        if ($type == "id")
            $channel = $this->mwhats->getChannelById($channel);
        elseif ($type == "phone")
            $channel = $this->mwhats->getChannelByPhone($channel);
        if (! $channel)
            return 4; // invalid channel
        $this->db->limit(10);
        $this->db->order_by("time", "desc");
        $this->db->select("message, time, user_id, type");
        $this->db->where(array(
            "channel_id" => $channel->id,
            "number" => $number
        ));
        $query = $this->db->get(MWhats::ARCHIVE_TABLE);
        if ($query->num_rows() > 0)
            return array_reverse($query->result());
        return false;
    }

    // get channel settings
    public function getChannelSettings($channel_id)
    {
        $this->db->select("status_text, profile_pic");
        $this->db->where("id", $channel_id);
        $query = $this->db->get(MWhats::CHANNELS_TABLE);
        if ($query->num_rows() > 0)
            return $query->row();
        return false;
    }

    // set channel profile picture
    public function setChannelProfilePic($channel_id, $path)
    {
        $channel = $this->mwhats->getChannelById($channel_id);
        if (! $channel)
            return ("4"); // invalid channel
        $number = (isset($_GET["number"]) ? $_GET["number"] : "");
        $w = new WhatsProt($channel->phone, $channel->identity, "", false);
        $w->connect();
        if ($w->getSocket() == NULL)
            return ("3"); // number is unavailable
        $w->loginWithPassword($channel->hash);
        $w->sendSetProfilePicture("./" . trim($path));
        $w->disconnect();
        $this->db->where("id", $channel_id);
        return $this->db->update(Mwhats::CHANNELS_TABLE, array(
            "profile_pic" => $path
        ));
    }

    // set channel status text
    public function setChannelStatus($channel_id, $status)
    {
        $channel = $this->mwhats->getChannelById($channel_id);
        if (! $channel)
            return 4; // invalid channel
                          // $number = (isset($_GET["number"])?$_GET["number"]:"");
        $w = new WhatsProt($channel->phone, $channel->identity, "", false);
        $w->eventManager()->bind("onSendStatusUpdate", array(
            $this,
            "onSendStatusUpdate"
        ));
        $w->connect();
        if ($w->getSocket() == NULL)
            return 3; // number is unavailable
        $w->loginWithPassword($channel->hash);
        $w->sendStatusUpdate(trim($status), array(
            "channel_id" => $channel_id
        ));
        $w->disconnect();
        return 1;
    }

    function onSendStatusUpdate($mynumber, $status, $channel_id)
    {
        $this->db->where("id", $channel_id);
        $this->db->update(MWhats::CHANNELS_TABLE, array(
            "status_text" => $status
        ));
    }

    // set channel settings
    public function setChannelSettings($channel_id, $atts = array())
    {
        $this->db->where("id", $channel_id);
        return $this->db->update(MWhats::CHANNELS_TABLE, $atts);
    }

    // see the messages of number belong to channel
    public function seeNumberMessages($channel, $number, $type = "id")
    {
        if ($type == "id")
            $channel = $this->mwhats->getChannelById($channel);
        elseif ($type == "phone")
            $channel = $this->mwhats->getChannelByPhone($channel);
        if (! $channel)
            return 4; // invalid channel
        $this->db->where(array(
            "channel_id" => $channel->id,
            "seen" => 0,
            "number" => $number
        ));
        return $this->db->update(MWhats::ARCHIVE_TABLE, array(
            "seen" => 1
        ));
    }

    // check if number have whatsapp registered or not
    public function checkNumber($number, $user_id = "")
    {
        $channel = $this->getUserChannel($this->mwhats->getSettings()->notify_user);
        if ($user_id != "")
            $channel = $this->getUserChannel($user_id);
        $this->mwhats->connect($channel->phone, $channel->identity);
        $this->mwhats->login($channel->hash);
        return $this->mwhats->syncContact(trim($number));
    }

    // get ok channels
    public function getOkChannels($array = "")
    {
        $this->db->where("status", "ok");
        $this->db->select("id, phone");
        $query = $this->db->get("whats_channels");
        if ($query->num_rows() > 0) {
            if ($array != "")
                return $query->result_array();
            return $query->result();
        }
        return false;
    }
    /*
     * public function getMessages($channel, $type = "id") { $out_array = array (); $message = array (); if ($type == "id") $channel = $this->mwhats->getChannelById ( $channel ); elseif ($type == "phone") $channel = $this->mwhats->getChannelByPhone ( $channel ); if (! $channel) return 4; // invalid channel $w = new WhatsProt ( $channel->phone, $channel->identity, "marwan", false ); $w->connect (); if ($w->getSocket () == NULL) return 3; // number is unavailable $w->loginWithPassword ( $channel->hash ); $w->pollMessages (); $msgs = $w->getMessages (); while ( count ( $msgs ) == 0 ) { usleep ( 10000 ); clearstatcache (); $w->pollMessages (); $msgs = $w->getMessages (); } foreach ( $msgs as $m ) { if ($m->getAttribute ( 'retry' ) == null && $m->getChild ( 'received' ) != null) { $from_att = $m->getAttribute ( "from" ); $message ["time"] = date ( "Y-m-d h:i a", $m->getAttribute ( "t" ) ); $from = explode ( "@", $from_att ); $message ["from"] = $from [0]; // process inbound messages // header('Content-type: text/xml;'); // echo "<pre>"; foreach ( $m->getChildren () as $child ) { if ($child->getTag () == "body") { $message ["message"] = $child->getData (); } } array_push ( $out_array, $message ); } } return json_encode ( $out_array ); } // get channel inbox and but them in database public function getChannelMessages1($channel, $type = "id") { if ($type == "id") $channel = $this->mwhats->getChannelById ( $channel ); elseif ($type == "phone") $channel = $this->mwhats->getChannelByPhone ( $channel ); if (! $channel) return 4; // invalid channel $this->db->order_by ( "time", "asc" ); $this->db->limit ( 10 ); $this->db->where ( "channel_id", $channel->id ); $query = $this->db->get ( MWhats::INBOX_TABLE ); if ($query->num_rows () > 0) return $query->result (); return false; }
     */
}
