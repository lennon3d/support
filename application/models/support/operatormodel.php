<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class OperatorModel extends CI_Model
{

    const TABLE = "operators";

    const USERS_TABLE = "operators_users";

    const GROUPS_TABLE = "operators_groups";

    public function __construct()
    {
        parent::__construct();
    }
    /*
     * // login to operator public function login($operator, $username, $password) { $ope = $this->getOperator($operator, "operator"); if (! $ope) return "-1"; if ($ope->active != "1") return "-2"; $user = $this->getOperatorUser($operator, $username); if (! $user) return "-3"; if ($user->active != "1") return "-4"; $pass = crypt($password, $user->salt); if ($pass != $user->password) return "-5"; $this->setStatus($operator, $username, 1); $this->session->set_userdata(array( "username" => $user->username, "email" => $user->email, "operator" => $user->operator, "user_id" => $user->id, "operator_id" => $ope->id )); return "1"; }
     */
    public function login($email, $password)
    {
        $check = $this->checkUser($email, $password);
        if ($check == "1")
            $this->setStatus($email, 1);
        return $check;
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
    public function setStatus($email, $status)
    {
        $user = $this->getUser($email);
        $this->db->where("email", $email);
        $this->db->update(self::USERS_TABLE, array(
            "status" => $status
        ));
        $users = $this->getGroupOnlineUsers($user->group);
        // no online users in group
        if (! $users) {
            // set users group to be offline
            $this->db->where("id", $user->group);
            $this->db->update(self::GROUPS_TABLE, array(
                "status" => 0
            ));
            $groups = $this->getOperatorOnlineGroups($user->operator);
            // if operator groups all offline set operator to be offline
            if (! $groups) {
                $this->db->where("operator", $user->operator);
                $this->db->update(self::TABLE, array(
                    "status" => 0
                ));
            }
        } else {
            // set user group to be online
            $this->db->where("id", $user->group);
            $this->db->update(self::GROUPS_TABLE, array(
                "status" => 1
            ));
            // set online operator to be online
            $this->db->where("operator", $user->operator);
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
    public function getOperatorUser($operator, $email = "all")
    {
        $this->db->where("operator", $operator);
        if ($user != "all")
            $this->db->where("email", $email);
        $query = $this->db->get(self::USERS_TABLE);
        if ($query->num_rows() > 0) {
            if ($user != "all")
                return $query->row();
            return $query->result();
        }
        return false;
    }

    // get user by email
    public function getUser($email)
    {
        $this->db->where("email", $email);
        $query = $this->db->get(self::USERS_TABLE);
        if ($query->num_rows() > 0) {
            return $query->row();
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

    // get operator group online users
    public function getGroupOnlineUsers($group)
    {
        $this->db->where("group", $group);
        $this->db->where("status", "1");
        $query = $this->db->get(self::USERS_TABLE);
        if ($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    // get operator group users
    public function getGroupUsers($group)
    {
        $this->db->where("group", $group);
        $query = $this->db->get(self::USERS_TABLE);
        if ($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    // get operator groups
    public function getOperatorGroups($operator)
    {
        $this->db->where("operator", $operator);
        $query = $this->db->get(self::GROUPS_TABLE);
        if ($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    // get online operator groups
    public function getOperatorOnlineGroups($operator)
    {
        $this->db->where("operator", $operator);
        $this->db->where("status", "1");
        $query = $this->db->get(self::GROUPS_TABLE);
        if ($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    // get operator users group
    public function getGroup($id)
    {
        $this->db->where("id", $id);
        $query = $this->db->get(self::GROUPS_TABLE);
        if ($query->num_rows() > 0)
            return $query->row();
        return false;
    }

    // check if user and operator valid
    public function checkUser($email, $password)
    {
        $user = $this->getUser($email);
        if (! $user)
            return "-3"; // no such user
        if ($user->active != "1")
            return "-4"; // user inactive
        $pass = crypt($password, $user->salt);
        if ($pass != $user->password)
            return "-5"; // invalid password
        $group = $this->getGroup($user->group);
        if (! $group)
            return "-6"; // no such group
        if ($group->active != "1")
            return "-7"; // group inactive
        $ope = $this->getOperator($user->operator);
        if (! $ope)
            return "-1"; // no such operator
        if ($ope->active != "1")
            return "-2"; // operator inactive
        return "1"; // every thing is okay.
    }

    // logout from operator
    public function logout($email, $password)
    {
        $check = $this->checkUser($email, $password);
        if ($check == "1")
            $this->setStatus($email, 0);
        return $check;
    }
}