<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    // site chat ajax operations
class ChatAjax extends CI_Controller
{

    var $LANG;

    var $OPERATOR;

    function __construct()
    {
        parent::__construct();
        $this->load->model("support/operatormodel", "op");
        $this->load->model("support/chatmodel", "chat");
        $this->LANG = ($this->op->langCode($this->input->get_post("lang")) ? $this->input->get_post("lang") : "ar");
        $this->lang->load("cp_$this->LANG", "cp_$this->LANG");
        $this->checkUser();
        header('Content-Type: text/html; charset=utf-8');
    }

    // send chat message
    public function sendMessage()
    {
        $user = $this->input->get_post("username");
        $chat_id = $this->input->get_post("chat");
        $message = $this->input->get_post("message");
        if (! $user || empty($user))
            exit($this->status(lang("no_user"), "117")); // no user
        if (! $chat_id || empty($chat_id))
            exit($this->status(lang("no_chat_id"), "118")); // no chat id
        if (! $message || empty($message))
            exit($this->status(lang("no_message"), "119")); // no message
        $this->chat->sendMessage($user, $chat_id, $message);
        exit($this->status(lang("message_sent"), "120"));
    }

    // get all active chats and message of operator
    public function getActiveChats()
    {
        $chats_array = array();
        $chats = $this->chat->getActiveChats($this->OPERATOR);
        if (! $chats)
            exit($this->status(lang("no_chats"), "115")); // no active chats
        foreach ($chats as $chat) {
            $messages = $this->chat->getChatMessages($chat->id);
            array_push($chats_array, array(
                "chat" => $chat,
                "messages" => $messages
            ));
        }
        exit(json_encode(array(
            "code" => "116",
            "chats" => $chats_array
        )));
    }

    // get oprator chats review
    public function chatsReview()
    {
        $return = array();
        $last_chat_ajax = $_GET["chat_ajax"];
        $last_message_ajax = $_GET["message_ajax"];
        // $last_message = $sql->Select ( "{$prefix}messages", '', 'datetime desc', '1' );
        $last_message = $sql->executeSql("SELECT `datetime` FROM `{$prefix}messages` ORDER BY `datetime` DESC LIMIT 1");
        $last_chat = $sql->executeSql("SELECT `datetime` FROM `{$prefix}chats` WHERE `active`= '1' ORDER BY `datetime` DESC LIMIT 1");
        if (! is_array($last_chat)) {
            $last_chat = array(
                array(
                    "datetime" => 1
                )
            );
        }
        if (! is_array($last_message)) {
            $last_message = array(
                array(
                    "datetime" => 1
                )
            );
        }
        $chat_ajax = ($last_chat_ajax != null ? $last_chat_ajax : $last_chat[0]["datetime"]);
        $message_ajax = ($_GET["message_ajax"] != null ? $_GET["message_ajax"] : $last_message[0]["datetime"]);
        while ($chat_ajax >= $last_chat[0]["datetime"] && $message_ajax >= $last_message[0]["datetime"]) {
            usleep(10000);
            clearstatcache();
            $last_chat = $sql->executeSql("SELECT `datetime` FROM `{$prefix}chats` WHERE `active`= '1' ORDER BY `datetime` DESC LIMIT 1");
            $last_message = $sql->executeSql("SELECT `datetime` FROM `{$prefix}messages` ORDER BY `datetime` DESC LIMIT 1");
        }

        $chats = $sql->executeSql("SELECT * FROM `{$prefix}chats` WHERE `active`='1' AND `datetime`>{$chat_ajax}");
        $messages = $sql->executeSql("SELECT * FROM `{$prefix}messages` WHERE `datetime`>{$message_ajax}");
        $return["chats"] = array();
        $return["chats"]["chats"] = $chats;
        $return["chats"]["last"] = $last_chat[0]["datetime"];
        $return["messages"] = array();
        $return["messages"]["messages"] = $messages;
        $return["messages"]["last"] = $last_message[0]["datetime"];
        echo json_encode($return);
    }

    private function checkUser()
    {
        $username = $this->input->get_post("username");
        $password = $this->input->get_post("password");
        $operator = $this->input->get_post("operator");
        $this->OPERATOR = $operator;
        if (! $operator || empty($operator))
            exit($this->status(lang("no_operator"), "111")); // no operator
        if (! $username || empty($username))
            exit($this->status(lang("no_username"), "112")); // no username
        if (! $password || empty($password))
            exit($this->status(lang("no_password"), "113")); // no password
        $check = $this->op->checkUser($operator, $username, $password);
        if ($check == "-1")
            exit($this->status(lang("no_operator"), $check)); // no operator match
        if ($check == "-2")
            exit($this->status(lang("operator_inactive"), $check)); // operator inactive
        if ($check == "-3")
            exit($this->status(lang("invalid_login"), $check)); // operator user not match
        if ($check == "-4")
            exit($this->status(lang("user_inactive"), $check)); // user inactive
        if ($check == "-5")
            exit($this->status(lang("invalid_login"), $check)); // wrong password
    }

    // return json object of status message
    public function status($message = "", $st = 0)
    {
        $status_a = array();
        $status_a["code"] = $st;
        $status_a["message"] = $message;
        return json_encode($status_a);
    }
}