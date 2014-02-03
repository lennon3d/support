<?php

class MNumbers extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("whats/mwhats");
    }

    const GROUPS_TABLE = "numbers_groups";

    const NUMBERS_TABLE = "users_numbers";

    // create new main group
    public function addMainGroup($atts = array())
    {
        $query = $this->db->get_where(self::GROUPS_TABLE, array(
            "title" => $atts["title"],
            "user_id" => $atts["user_id"],
            "is_main" => 1
        ));
        if ($query->num_rows() > 0)
            return "-2"; // group existed
        return $this->db->insert(self::GROUPS_TABLE, array(
            "title" => $atts["title"],
            "user_id" => $atts["user_id"],
            "create_time" => time(),
            "is_main" => 1,
            "main_group_id" => 0
        ));
    }

    // create new sub group
    public function addSubGroup($atts = array())
    {
        $query = $this->db->get_where(self::GROUPS_TABLE, array(
            "title" => $atts["title"],
            "user_id" => $atts["user_id"],
            "is_main" => 0,
            "main_group_id" => $atts["main_group_id"]
        ));
        if ($query->num_rows() > 0)
            return "-2"; // group existed
        return $this->db->insert(self::GROUPS_TABLE, array(
            "title" => $atts["title"],
            "user_id" => $atts["user_id"],
            "create_time" => time(),
            "is_main" => 0,
            "main_group_id" => $atts["main_group_id"]
        ));
    }

    // get group by id
    public function getGroupById($group_id, $user_id = "")
    {
        $this->db->where("id", $group_id);
        if ($user_id != "")
            $this->db->where("user_id", $user_id);
        $query = $this->db->get(self::GROUPS_TABLE);
        if ($query->num_rows() > 0)
            return $query->row();
        return false;
    }

    // get all numbers groups
    public function getAllMainGroups($limit = 25, $offset = 0, $search = array())
    {
        $this->db->limit($limit, $offset);
        $this->db->where("is_main", 1);
        $this->db->order_by("create_time", "desc");
        $this->db->where($search);
        $query = $this->db->get(self::GROUPS_TABLE);
        if ($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    // get user main groups
    public function getUserMainGroups($user_id, $limit = 25, $offset = 0, $search = "")
    {
        if ($limit != "all")
            $this->db->limit($limit, $offset);
        $this->db->select("create_time, id, title");
        $this->db->where("user_id", $user_id);
        $this->db->where("is_main", 1);
        if ($search != "")
            $this->db->like("title", $search);
        $this->db->order_by("create_time", "desc");
        $query = $this->db->get(self::GROUPS_TABLE);
        if ($query->num_rows() > 0) {
            $res = $query->result();
            for ($i = 0; $i < count($res); $i ++) {
                $this->db->select("id");
                $this->db->where("main_group_id", $res[$i]->id);
                $this->db->where("user_id", $user_id);
                $query = $this->db->get(self::GROUPS_TABLE);
                $res[$i]->count = $query->num_rows();
            }
            $this->db->where("user_id", $user_id);
            $this->db->where("is_main", 1);
            $query1 = $this->db->get(self::GROUPS_TABLE);
            return array(
                "results" => $res,
                "count" => $query1->num_rows()
            );
        }
        return false;
    }

    // get user sub groups of main group
    public function getUserSubGroups($user_id, $group_id, $limit = 25, $offset = 0, $search = "")
    {
        if ($limit != "all")
            $this->db->limit($limit, $offset);
        $this->db->select("create_time, id, title");
        $this->db->where("user_id", $user_id);
        $this->db->where("is_main", 0);
        $this->db->where("main_group_id", $group_id);
        if ($search != "")
            $this->db->like("title", $search);
        $this->db->order_by("create_time", "desc");
        $query = $this->db->get(self::GROUPS_TABLE);
        if ($query->num_rows() > 0) {
            $res = $query->result();
            for ($i = 0; $i < count($res); $i ++) {
                $this->db->where("group_id", $res[$i]->id);
                $this->db->where("user_id", $user_id);
                $query = $this->db->get(self::NUMBERS_TABLE);
                $res[$i]->count = $query->num_rows();
            }
            $this->db->where("user_id", $user_id);
            $this->db->where("main_group_id", $group_id);
            $this->db->where("is_main", 0);
            $query1 = $this->db->get(self::GROUPS_TABLE);
            return array(
                "results" => $res,
                "count" => $query1->num_rows()
            );
        }
        return false;
    }

    // get group numbers
    public function getGroupNumbers($group_id)
    {
        $this->db->where("id", $group_id);
        $this->db->where("user_id", $this->USER_ID);
        $query = $this->db->get(self::GROUPS_TABLE);
        if ($query->num_rows() < 1)
            return false;
        $this->db->where("group_id", $group_id);
        $query = $this->db->get(self::NUMBERS_TABLE);
        if ($query->num_rows() > 0)
            return $query->result();
        return false;
    }

    // get user group numbers
    public function getUserGroupNumbers($user_id, $group_id, $limit = "all", $offset = 0, $search = "")
    {
        if ($limit != "all")
            $this->db->limit($limit, $offset);
        $this->db->where("group_id", intval($group_id));
        $this->db->where("user_id", intval($user_id));
        if ($search != "") {
            $this->db->like("(number", $search);
            $this->db->or_like("name", $search);
            $this->db->bracket("close", "like");
        }
        $this->db->order_by("create_time", "desc");
        $query = $this->db->get(self::NUMBERS_TABLE);
        if ($query->num_rows() > 0) {
            $res = $query->result();
            $this->db->where("group_id", $group_id);
            $this->db->where("user_id", $user_id);
            $query1 = $this->db->get(self::NUMBERS_TABLE);
            return array(
                "results" => $res,
                "count" => $query1->num_rows()
            );
        }
        return false;
    }

    // check if group empty or not
    public function checkGroupEmpty($user_id, $group_id)
    {
        $this->db->where("group_id", intval($group_id));
        $this->db->where("user_id", intval($user_id));
        $this->db->from(self::NUMBERS_TABLE);
        return $this->db->count_all_results();
    }

    // edit user main numbers group
    public function editUserGroup($user_id, $group_id, $title)
    {
        $this->db->where("title", $title);
        $this->db->where("user_id", $user_id);
        $this->db->where("id != ", $group_id);
        $query = $this->db->get_where(self::GROUPS_TABLE);
        if ($query->num_rows() > 0)
            return "-2"; // group existed
        $this->db->where(array(
            "user_id" => $user_id,
            "id" => $group_id
        ));
        return $this->db->update(self::GROUPS_TABLE, array(
            "title" => $title
        ));
    }

    // empty user numbers group
    public function emptyUserGroup($user_id, $group_id)
    {
        $group = $this->getGroupById($group_id, $user_id);
        $return = false;
        if ($group->is_main == 1) {
            $groups = $this->getUserSubGroups($user_id, $group_id);
            if ($groups) {
                foreach ($groups["results"] as $sub_group) {
                    $this->db->where("group_id", $sub_group->id);
                    $this->db->where("user_id", $user_id);
                    $return = $this->db->delete(self::NUMBERS_TABLE);
                }
                return $return;
            }
        }
        $this->db->where("group_id", $group_id);
        $this->db->where("user_id", $user_id);
        return $this->db->delete(self::NUMBERS_TABLE);
    }

    // delete user numbers group
    public function deleteUserGroup($user_id, $group_id, $sub = 0)
    {
        $group = $this->getGroupById($group_id, $user_id);
        $return = false;
        if ($group) {
            if ($group->is_main == 1) {
                $groups = $this->getUserSubGroups($user_id, $group_id);
                if ($groups)
                    foreach ($groups["results"] as $sub_group) {
                        $this->db->where("id", $sub_group->id);
                        $this->db->where("user_id", $user_id);
                        $return = $this->db->delete(self::GROUPS_TABLE);
                    }
                if ($sub != 0)
                    return $return;
            }

            $this->db->where("id", $group_id);
            $this->db->where("user_id", $user_id);
            $return = $this->db->delete(self::GROUPS_TABLE);
            return $return;
        }
        return false;
    }
    /*
     * // update group public function editGroup($group_id, $atts = array()) { $this->db->where ( "id", $group_id ); return $this->db->update ( self::GROUPS_TABLE, $atts ); }
     */
    // delete an existed group with its numbers
    public function deleteGroup($group_id)
    {
        $this->db->where("group_id", $group_id);
        $query = $this->db->delete(self::GROUPS_TABLE);
        if ($query > 0) {
            $this->db->where("group_id", $group_id);
            $numbers_query = $this->db->delete(self::NUMBERS_TABLE);
            if ($numbers_query > 0) {
                return true;
            } else
                return false;
        } else
            return false;
    }

    // delete an existed number
    public function deleteNumber($user_id, $number_id)
    {
        $this->db->where("id", $number_id);
        $this->db->where("user_id", $user_id);
        return $this->db->delete(self::NUMBERS_TABLE);
    }

    // edit user number
    public function editNumber($atts = array())
    {
        $this->db->where("number", $atts["number"]);
        $this->db->where("user_id", $atts["user_id"]);
        $this->db->where("id != ", $atts["number_id"]);
        $this->db->where("group_id", $atts["group_id"]);
        $query = $this->db->get_where(self::NUMBERS_TABLE);
        if ($query->num_rows() > 0)
            return "-2"; // number existed
        if (count($this->mchannels->checkNumber($atts["number"])) < 1)
            return "-3"; // number doesn't has whatsapp registered
        $this->db->where("id", $atts["number_id"]);
        $this->db->where("user_id", $atts["user_id"]);
        return $this->db->update(self::NUMBERS_TABLE, array(
            "name" => $atts["name"],
            "number" => $atts["number"]
        ));
    }

    // add new number to sub group
    public function addNumber($atts = array())
    {
        $this->db->where("number", $atts["number"]);
        $this->db->where("user_id", $atts["user_id"]);
        $this->db->where("group_id", $atts["group_id"]);
        $query = $this->db->get_where(self::NUMBERS_TABLE);
        if ($query->num_rows() > 0)
            return "-2"; // number existed
        if (count($this->mchannels->checkNumber($atts["number"])) < 1)
            return "-3"; // number doesn't has whatsapp registered
        return $this->db->insert(self::NUMBERS_TABLE, array(
            "name" => $atts["name"],
            "number" => $atts["number"],
            "create_time" => time(),
            "user_id" => $atts["user_id"],
            "group_id" => $atts["group_id"]
        ));
    }

    // get numbers from excel file
    public function importFromExcel()
    {
        $this->load->library('excel');
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load("./assets/uploads/numbers.xlsx");
        $objWorksheet = $objPHPExcel->getActiveSheet();
        static $array = array();
        static $out_array = array();
        $rows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        foreach ($objWorksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach ($cellIterator as $cell) {
                if ($cell->getValue() != "")
                    array_push($out_array, $cell->getValue());
            }
        }
        return $out_array;
    }
}