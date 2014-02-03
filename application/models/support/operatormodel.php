<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class OperatorModel extends CI_Model
{

    const TABLE = "operators";

    const USERS_TABLE = "operators_users";

    public function __construct()
    {
        parent::__construct();
    }

    // login to operator
    public function login($operator, $username, $password)
    {
        $ope = $this->getOperator($operator, "operator");
        if (! $ope)
            return "-1";
        if ($ope->active != "1")
            return "-2";
        $user = $this->getOperatorUser($operator, $username);
        if (! $user)
            return "-3";
        if ($user->active != "1")
            return "-4";
        $pass = crypt($password, $user->salt);
        if ($pass != $user->password)
            return "-5";
        $this->setStatus($operator, $username, 1);
        $this->session->set_userdata(array(
            "username" => $user->username,
            "email" => $user->email,
            "operator" => $user->operator,
            "user_id" => $user->id,
            "operator_id" => $ope->id
        ));
        return "1";
    }

    // get operator status (online, offline)
    public function getOperatorStatus($operator)
    {
        $this->db->where("operator", $operator);
        $query = $this->db->get(self::TABLE);
        if ($query->num_rows() > 0) {
            $operator = $query->row();
            return $operator->status;
        }
        return false;
    }

    // set operator and user status
    public function setStatus($operator, $user, $status)
    {
        $this->db->where("username", $user);
        $this->db->where("operator", $operator);
        $this->db->update(self::USERS_TABLE, array(
            "status" => $status
        ));
        $users = $this->getOperatorOnlineUsers($operator);
        if (! $users) {
            //if there are no online users set operator to be offline
            $this->db->where("operator", $operator);
            $this->db->update(self::TABLE, array(
                "status" => 0
            ));
        } else {
            // set online
            $this->db->where("operator", $operator);
            $this->db->update(self::TABLE, array(
                "status" => 1
            ));
        }
    }

    // get operator by field
    public function getOperator($field, $type = "operator")
    {
        $this->db->where($type, $field);
        $query = $this->db->get(self::TABLE);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    // get operator users
    public function getOperatorUser($operator, $user = "all")
    {
        $this->db->where("operator", $operator);
        if ($user != "all")
            $this->db->where("username", $user);
        $query = $this->db->get(self::USERS_TABLE);
        if ($query->num_rows() > 0) {
            if ($user != "all")
                return $query->row();
            return $query->result();
        }
        return false;
    }

    // get operator online users
    public function getOperatorOnlineUsers($operator)
    {
        $this->db->where("operator", $operator);
        $this->db->where("status", "1");
        $query = $this->db->get(self::USERS_TABLE);
        if ($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    // check if user and operator valid
    public function checkUser($operator, $username, $password)
    {
        $ope = $this->getOperator($operator, "operator");
        if (! $ope)
            return "-1";
        if ($ope->active != "1")
            return "-2";
        $user = $this->getOperatorUser($operator, $username);
        if (! $user)
            return "-3";
        if ($user->active != "1")
            return "-4";
        $pass = crypt($password, $user->salt);
        if ($pass != $user->password)
            return "-5";
        return "1";
    }


    //get languages array code
    public function langCode($code)
    {
        $array = array("ar", "en", "fr", "ch", "sp");
        return in_array($code, $array);
    }
}