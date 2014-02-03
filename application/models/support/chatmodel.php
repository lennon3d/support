<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class ChatModel extends CI_Model
{

    const TABLE = "chats";

    const MSG_TABLE = "messages";

    public function __construct()
    {
        parent::__construct();
    }

    // get chat messages
    public function getChatMessages($chat_id)
    {
        $this->db->where("chat_id", $chat_id);
        $query = $this->db->get(self::MSG_TABLE);
        if ($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    // get chat
    public function getChat($field, $type = "id")
    {
        $this->db->where($type, $field);
        $query = $this->db->get(self::TABLE);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    // get active chat of an operator
    public function getActiveChats($operator)
    {
        $this->db->where("operator", $operator);
        $this->db->where("status", 1);
        $query = $this->db->get(self::TABLE);
        if ($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    // accept chat
    public function acceptChat($chat_id)
    {
        $this->db->where("id", $chat_id);
        return $this->db->update(self::TABLE, array(
            "status" => 1,
            "accepted" => 1
        ));
    }

    // close chat
    public function closeChat($chat_id)
    {
        $this->db->where("id", $chat_id);
        return $this->db->update(self::TABLE, array(
            "status" => 0
        ));
    }

    // send chat message
    public function sendMessage($user_id, $chat_id, $message)
    {
        return $this->db->insert(self::MSG_TABLE, array(
            "chat_id" => $chat_id,
            "user" => $user_id,
            "message" => $message,
            "datetime" => time()
        ));
    }
}