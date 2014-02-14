<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    // site operator ajax operations
class OperatorAjax extends OperatorController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("support/operatormodel", "op");
    }

    // login
    public function login()
    {
        //header('Content-type: text/json');
        // $operator = $this->input->get_post("operator");
        $email = $this->input->get_post("email");
        $password = $this->input->get_post("password");
        // if (! $operator || empty($operator))
        // exit($this->status(lang("no_operator"), 111)); // no operator
        if (! $email || empty($email))
            exit($this->status(lang("no_username"), "112")); // no username
        if (! $password || empty($password))
            exit($this->status(lang("no_password"), "113")); // no password
                                                                 // $login = $this->op->login($operator, $username, $password);
        $login = $this->op->login($email, $password);
        if ($login == "-1")
            exit($this->status(lang("no_operator"), "105")); // no operator match
        if ($login == "-2")
            exit($this->status(lang("operator_inactive"), "104")); // operator inactive
        if ($login == "-6")
            exit($this->status("no such group", "123")); // no group match
        if ($login == "-7")
            exit($this->status("group inactive", "124")); // group inactive
        if ($login == "-3")
            exit($this->status(lang("invalid_login"), "103")); // operator user not match
        if ($login == "-4")
            exit($this->status(lang("user_inactive"), "102")); // user inactive
        if ($login == "-5")
            exit($this->status(lang("invalid_login"), "101")); // wrong password
        if ($login == "1") {
            exit($this->status(lang("login_success"), "100")); // login success
        }
    }

    // logout user of operator
    public function logout()
    {
        $email = $this->input->get_post("email");
        $password = $this->input->get_post("password");
        if (! $email || empty($email))
            exit($this->status(lang("no_username"), "112")); // no username
        if (! $password || empty($password))
            exit($this->status(lang("no_password"), "113")); // no password
        $logout = $this->op->logout($email, $password);
        exit($this->status("logout", $logout));
    }
}