<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    // site operator ajax operations
class OperatorAjax extends CI_Controller
{

    var $LANG;

    function __construct()
    {
        parent::__construct();
        $this->load->model("support/operatormodel", "op");
        $this->LANG = $this->input->get_post("lang");
        $this->lang->load("cp_$this->LANG", "cp_$this->LANG");
    }

    // login
    public function login()
    {
        $operator = $this->input->get_post("operator");
        $username = $this->input->get_post("username");
        $password = $this->input->get_post("password");
        if (! $operator || empty($operator))
            exit($this->status(lang("no_operator"), "111")); // no operator
        if (! $username || empty($username))
            exit($this->status(lang("no_username"), "112")); // no username
        if (! $password || empty($password))
            exit($this->status(lang("no_password"), "113")); // no password
        $login = $this->op->login($operator, $username, $password);
        if ($login == "-1")
            exit($this->status(lang("no_operator"), $login)); // no operator match
        if ($login == "-2")
            exit($this->status(lang("operator_inactive"), $login)); // operator inactive
        if ($login == "-3")
            exit($this->status(lang("invalid_login"), $login)); // operator user not match
        if ($login == "-4")
            exit($this->status(lang("user_inactive"), $login)); // user inactive
        if ($login == "-5")
            exit($this->status(lang("invalid_login"), $login)); // wrong password
        if ($login == "1") {
            exit($this->status(lang("login_success"), $login)); // login success
        }
    }

    // logout user of operator
    public function logout()
    {
        $operator = $this->input->get_post("operator");
        $username = $this->input->get_post("username");
        if (! $operator || empty($operator))
            exit($this->status(lang("no_operator"), "111")); // no operator
        if (! $username || empty($username))
            exit($this->status(lang("no_username"), "112")); // no username
        $this->op->setStatus($operator, $username, 0);
        exit($this->status("logout", "114"));
    }

    // return json object of status message
    public function status($message, $st = 0)
    {
        $status_a = array();
        $status_a["code"] = $st;
        $status_a["message"] = $message;
        return json_encode($status_a);
    }
}