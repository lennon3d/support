<?php

class MFunctions extends CI_Model
{
    function onGetRequestLastSeen($mynumber, $from, $id, $sec)
    {
        // echo $from." : ".date("Y-m-d h:i a",time()-$sec)."<br/>";
    }

    function onConnect()
    {
        $this->connected = true;
    }
    function onLoginFailed($mynumber, $reason)
    {
        return ("error_log");
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
        $this->db->update(self::ARCHIVE_TABLE, array(
            "status" => "client"
        ));
    }

    public function onSendMessage($mynumber, $target, $messageId, $innerNode, $user_id, $nickname, $fake)
    {
        $number = explode('@', $target);
        $this->mwhats->disCountCredits($user_id);
        $this->db->insert(self::ARCHIVE_TABLE, array(
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

    public function onGetImage($mynumber, $from, $id, $type, $t, $name, $size, $url, $file, $mimetype, $filehash, $width, $height, $preview)
    {
        $from1 = explode('@', $from);
        $this->db->insert("whats_archive", array(
            "channel_id" => $this->getChannelByPhone($mynumber)->id,
            "number" => $from1[0],
            "time" => $t,
            "status" => 1,
            "message" => $url,
            "msg_id" => $id,
            "user_id" => 0,
            "nickname" => $name,
            "seen" => 0,
            "goten" => 0,
            "type" => "image"
        ));
    }

    function onGetMessage($mynumber, $from, $id, $type, $time, $name, $body)
    {
        $from1 = explode('@', $from);
        $this->db->insert(self::ARCHIVE_TABLE, array(
            "channel_id" => $this->getChannelByPhone($mynumber)->id,
            "number" => $from1[0],
            "time" => $time,
            "status" => 1,
            "message" => $body,
            "msg_id" => $id,
            "user_id" => 0,
            "nickname" => $name,
            "seen" => 0,
            "goten" => 0,
            "type" => "text"
        ));
    }

    function onGetProfilePicture($from, $target, $type, $data)
    {
        if ($type == "preview") {
            $filename = base_url() . "assets/uploads/whatsapp/profile/preview_" . $target . ".jpg";
        } else {
            $filename = base_url() . "assets/uploads/whatsapp/profile/" . $target . ".jpg";
        }
        $fp = @fopen($filename, "w");
        if ($fp) {
            fwrite($fp, $data);
            fclose($fp);
        }
        $this->session->set_userdata(array(
            $target . "_profile" => true
        ));
    }

    function onGetAudio($mynumber, $from, $id, $type, $time, $name, $size, $url, $file, $mimetype, $filehash, $duration, $acodec)
    {
        $from1 = explode('@', $from);
        $this->db->insert(self::ARCHIVE_TABLE, array(
            "channel_id" => $this->getChannelByPhone($mynumber)->id,
            "number" => $from1[0],
            "time" => $time,
            "status" => 1,
            "message" => $url,
            "msg_id" => $id,
            "user_id" => 0,
            "nickname" => $name,
            "seen" => 0,
            "goten" => 0,
            "type" => "audio"
        ));
    }

    function onGetVideo($mynumber, $from, $id, $type, $time, $name, $url, $file, $size, $mimetype, $filehash, $duration, $vcodec, $acodec, $data)
    {
        $from1 = explode('@', $from);
        $this->db->insert(self::ARCHIVE_TABLE, array(
            "channel_id" => $this->getChannelByPhone($mynumber)->id,
            "number" => $from1[0],
            "time" => $time,
            "status" => 1,
            "message" => $url,
            "msg_id" => $id,
            "user_id" => 0,
            "nickname" => $name,
            "seen" => 0,
            "goten" => 0,
            "type" => "video"
        ));
    }

    function onGetvCard($mynumber, $from, $id, $type, $time, $name, $vCardName, $vCard)
    {
        $from1 = explode('@', $from);
        $this->db->insert(self::ARCHIVE_TABLE, array(
            "channel_id" => $this->getChannelByPhone($mynumber)->id,
            "number" => $from1[0],
            "time" => $time,
            "status" => 1,
            "message" => $vCardName . "-" . $vCard,
            "msg_id" => $id,
            "user_id" => 0,
            "nickname" => $name,
            "seen" => 0,
            "goten" => 0,
            "type" => "card"
        ));
    }

    function onGetLocation($mynumber, $from, $id, $type, $time, $name, $longtitude, $latitude, $data)
    {
        $from1 = explode('@', $from);
        $this->db->insert(self::ARCHIVE_TABLE, array(
            "channel_id" => $this->getChannelByPhone($mynumber)->id,
            "number" => $from1[0],
            "time" => $time,
            "status" => 1,
            "message" => $latitude . "-" . $longtitude . "-" . $data,
            "msg_id" => $id,
            "user_id" => 0,
            "nickname" => $name,
            "seen" => 0,
            "goten" => 0,
            "type" => "location"
        ));
    }

    function onGetPlace($mynumber, $from, $id, $type, $time, $name, $placeName, $longtitude, $latitude, $url)
    {
        $from1 = explode('@', $from);
        $this->db->insert(self::ARCHIVE_TABLE, array(
            "channel_id" => $this->getChannelByPhone($mynumber)->id,
            "number" => $from1[0],
            "time" => $time,
            "status" => 1,
            "message" => $latitude . "-" . $longtitude . "-" . $url . "-" . $placeName,
            "msg_id" => $id,
            "user_id" => 0,
            "nickname" => $name,
            "seen" => 0,
            "goten" => 0,
            "type" => "place"
        ));
    }

}
