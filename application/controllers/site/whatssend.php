<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    // site main
class WhatsSend extends SiteController
{

    function __construct()
    {
        parent::__construct();
        if (! $this->session->userdata("validated"))
            redirect($this->SITE_URL."user/login", "refresh");
        $this->load->model("whats/msend");
        $this->load->model("mnumbers");
    }

    function getStatus()
    {
        $country = substr($_GET["number"], 0, 2);
        $number = substr($_GET["number"], 2);

        $status_url = "https://sro.whatsapp.net/client/iphone/iq.php?cd=1&cc=" . $country . "&me=12345&u[]=" . $number;
        $status_content = file_get_contents($status_url);
        $status_xml = simplexml_load_string($status_content);

        if (! $status_xml->array->dict)
            return null;

        $status = array();
        $status['text'] = strip_tags($status_xml->array->dict->string[1]->asXML());
        $status['time'] = intval(strip_tags($status_xml->array->dict->integer->asXML()));

        return $status;
    }

    public function status()
    {
        $country = substr($_GET["number"], 0, 2);
        $number = substr($_GET["number"], 2);

        $url = "https://v.whatsapp.net/v2/exist?";
        $url .= "cc=$country";
        $url .= "&in=$number";
        $url .= "&id=" . md5($_GET["number"]);
        $url .= "&c=cookie";
        echo $url . "<br/>";
        echo file_get_contents($url);
    }

    public function testAllChannels()
    {
        $this->load->model("whats/mwhats");
        foreach ($this->mwhats->getAllChannels() as $channel) {
            // echo $this->mwhats->sendChannelMessage("201067676608", $channel->id)."<br/>";
        }
    }

    // callback function to check if group is empty
    public function checkGroup($str)
    {
        $request = $this->mnumbers->checkGroupEmpty($this->USER_ID, intval($str));
        if ($request < 1) {
            $this->form_validation->set_message('checkGroup', lang("group_empty"));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // send text message
    public function sendMessage()
    {
        // $user_id = $this->session->userdata ( "id" );
        // $data ["user"] = $this->musers->getUserById ( $user_id );
        // $data ["countries"] = $this->mfunctions->getCountries ();
        $data["main_groups"] = $this->mnumbers->getUserMainGroups($this->USER_ID);
        $data["main_group"] = (isset($_POST["main_group"]) ? $_POST["main_group"] : "");
        $data["sub_group"] = (isset($_POST["sub_group"]) ? $_POST["sub_group"] : "");
        $data["nickname"] = (isset($_POST["nickname"]) ? $_POST["nickname"] : "");
        // echo "<pre>";
        // var_dump($_POST);
        // exit();
        if (isset($_POST["main_group"])) {
            $data["sub_groups"] = $this->mnumbers->getUserSubGroups($this->USER_ID, $_POST["main_group"]);
        }
        if ($_POST) {
            $this->form_validation->set_message('required', "%s");
            // $this->form_validation->set_rules ( 'numbers', lang ( 'enter_numbers' ), 'required' );
            $this->form_validation->set_rules('nickname', lang('enter_nickname'), "required|callback_checkNickname");
            $this->form_validation->set_rules('sub_group', lang('choose_sub_group'), "required|callback_checkGroup");
            $this->form_validation->set_rules('message', lang('enter_message'), "required");
            if ($this->form_validation->run() == FALSE) {
                $data["message"] = validation_errors();
                $data["status"] = "-1";
                $data["target"] = "send_message";
                $this->load->view("site/index", $data);
            } else {
                $numbers = $this->mnumbers->getUserGroupNumbers($this->USER_ID, $this->input->post("sub_group"));
                $this->load->model("whats/mchannels");
                 foreach($numbers["results"] as $number){
                 $this->mwhats->saveMessage($this->USER_ID, $this->input->post("message"), $number->number);
                 }
                //$channels = $this->mchannels->getOkChannels();
                //foreach ($channels as $channel) {
                //    $this->mwhats->saveMessage($this->USER_ID, $this->input->post("message"), $channel->phone);
               // }
                // success
                // if ($request) {
                $data["message"] = lang("send_success");
                $data["status"] = "1";
                $data["target"] = "send_message";
                $this->load->view("site/cp/index", $data);
                // } else {
                // $data ["message"] = lang ( "operation_error" );
                // $data ["status"] = "-1";
                // $data ["target"] = "send_message";
                // $this->load->view ( "site/index", $data );
                // }
            }
        } else {
            $data["target"] = "send_message";
            $this->load->view("site/cp/index", $data);
        }
    }

    // check nickname validation
    function checkNickname($nickname)
    {
        if (is_numeric($nickname)) {
            if (strlen($nickname) < 9) {
                $this->form_validation->set_message('checkNickname', lang("mobilemore9"));
                return FALSE;
            } elseif (strlen($nickname) > 15) {
                $this->form_validation->set_message('checkNickname', lang("mobileless15"));
                return false;
            } else {
                return TRUE;
            }
        }
    }
    public function test(){
        $this->load->view("site/cp/whatsapp/test");
    }
}