<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    // site main
class WhatsGroups extends SiteController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("mnumbers");
        if (! $this->session->userdata("validated"))
            redirect($this->SITE_URL . "/user/login", "refresh");
    }

    // show user main groups
    public function index()
    {
        $limit = (isset($_GET["limit"]) ? trim($_GET["limit"]) : 25);
        $page = (isset($_GET["page"]) ? trim($_GET["page"]) : 0);
        $search = (isset($_GET["search_word"]) ? trim($_GET["search_word"]) : "");
        $data["search"] = $search;
        $data["page_num"] = $page;
        $data["limit"] = $limit;
        $data["target"] = "numbers_groups";
        $groups = $this->mnumbers->getUserMainGroups($this->USER_ID, $limit, $limit * $page, $search);
        $data["groups"] = $groups;
        $data["all_groups"] = $this->mnumbers->getUserMainGroups($this->USER_ID);
        if (isset($_POST["submit"])) {
            if ($_POST["action"] == "") {
                $this->session->set_flashdata(array(
                    "msg" => - 1,
                    "message" => lang("no_action")
                ));
                redirect($this->REFERER, "refresh");
            }
            $action_groups = null;
            if (isset($_POST["check_all"])) {
                $action_groups = $this->mnumbers->getUserMainGroups($this->USER_ID);
                $action_groups = $action_groups["results"];
            } else {
                $action_groups = (isset($_POST["checks"]) ? $_POST["checks"] : false);
            }
            if ($action_groups != null) {
                foreach ($action_groups as $group) {
                    $group1 = (isset($_POST["check_all"]) ? $group->id : $group);
                    switch ($_POST["action"]) {
                        case "delete":
                            $this->mnumbers->deleteUserGroup($this->USER_ID, $group1);
                            break;
                        case "empty":
                            $this->mnumbers->emptyUserGroup($this->USER_ID, $group1);
                            break;
                        case "delete_sub":
                            $this->mnumbers->deleteUserGroup($this->USER_ID, $group1, 1);
                            break;
                    }
                }
                $this->session->set_flashdata(array(
                    "msg" => 1
                ));
                redirect($this->REFERER, "refresh");
            } else {
                $this->session->set_flashdata(array(
                    "msg" => - 1,
                    "message" => lang("no_checks")
                ));
                redirect($this->REFERER, "refresh");
            }
        } else {
            $this->load->view("site/cp/index", $data);
        }
    }

    // show sub groups of user main group
    public function SubGroups($group_id = "")
    {
        if ($group_id == "")
            redirect(base_url($this->_seg) . "/whatsapp/groups");
        $limit = (isset($_GET["limit"]) ? trim($_GET["limit"]) : 25);
        $page = (isset($_GET["page"]) ? trim($_GET["page"]) : 0);
        $search = (isset($_GET["search_word"]) ? trim($_GET["search_word"]) : "");
        $data["search"] = $search;
        $data["page_num"] = $page;
        $data["limit"] = $limit;
        $groups = $this->mnumbers->getUserSubGroups($this->USER_ID, $group_id, $limit, $limit * $page, $search);
        $data["groups"] = $groups;
        $data["group_id"] = $group_id;
        $data["all_groups"] = $this->mnumbers->getUserMainGroups($this->USER_ID);
        $data["target"] = "sub_groups";
        if (isset($_POST["submit"])) {
            if ($_POST["action"] == "") {
                $this->session->set_flashdata(array(
                    "msg" => - 1,
                    "message" => lang("no_action")
                ));
                redirect($this->REFERER, "refresh");
            }
            $action_groups = null;
            if (isset($_POST["check_all"])) {
                $action_groups = $this->mnumbers->getUserSubGroups($this->USER_ID);
                $action_groups = $action_groups["results"];
            } else {
                $action_groups = (isset($_POST["checks"]) ? $_POST["checks"] : false);
            }
            if ($action_groups != null) {
                foreach ($action_groups as $group) {
                    $group1 = (isset($_POST["check_all"]) ? $group->id : $group);
                    switch ($_POST["action"]) {
                        case "delete":
                            $this->mnumbers->deleteUserGroup($this->USER_ID, $group1);
                            break;
                        case "empty":
                            $this->mnumbers->emptyUserGroup($this->USER_ID, $group1);
                            break;
                    }
                }
                $this->session->set_flashdata(array(
                    "msg" => 1
                ));
                redirect($this->REFERER, "refresh");
            } else {
                $this->session->set_flashdata(array(
                    "msg" => - 1,
                    "message" => lang("no_checks")
                ));
                redirect($this->REFERER, "refresh");
            }
        } else {
            $this->load->view("site/cp/index", $data);
        }
    }

    // show sub group numbers of user
    public function GroupNumbers($group_id = "")
    {
        if ($group_id == "")
            redirect(base_url($this->_seg) . "/whatsapp/groups");
        $group = $this->mnumbers->getGroupById($group_id);
        if (! $group)
            redirect(base_url($this->_seg) . "/whatsapp/groups");
        $data["main_group"] = $group->main_group_id;
        $limit = (isset($_GET["limit"]) ? trim($_GET["limit"]) : 25);
        $page = (isset($_GET["page"]) ? trim($_GET["page"]) : 0);
        $search = (isset($_GET["search_word"]) ? trim($_GET["search_word"]) : "");
        $numbers = $this->mnumbers->getUserGroupNumbers($this->USER_ID, $group_id, $limit, $limit * $page, $search);
        $data["search"] = $search;
        $data["page_num"] = $page;
        $data["limit"] = $limit;
        $data["numbers"] = $numbers;
        $data["group_id"] = $group_id;
        $data["target"] = "numbers";
        if (isset($_POST["submit"])) {
            if ($_POST["action"] == "") {
                $this->session->set_flashdata(array(
                    "msg" => - 1,
                    "message" => lang("no_action")
                ));
                redirect($this->REFERER, "refresh");
            }
            $action_numbers = null;
            if (isset($_POST["check_all"])) {
                $action_numbers = $this->mnumbers->getUserGroupNumbers($this->USER_ID);
                $action_numbers = $action_numbers["results"];
            } else {
                $action_numbers = (isset($_POST["checks"]) ? $_POST["checks"] : false);
            }
            if ($action_numbers != null) {
                foreach ($action_numbers as $number) {
                    $number1 = (isset($_POST["check_all"]) ? $number->id : $number);
                    switch ($_POST["action"]) {
                        case "delete":
                            $this->mnumbers->deleteNumber($this->USER_ID, $number1);
                            break;
                    }
                }
                $this->session->set_flashdata(array(
                    "msg" => 1
                ));
                redirect($this->REFERER, "refresh");
            } else {
                $this->session->set_flashdata(array(
                    "msg" => - 1,
                    "message" => lang("no_checks")
                ));
                redirect($this->REFERER, "refresh");
            }
        } else {
            $this->load->view("site/cp/index", $data);
        }
    }

    //show numbers in tree view
    public function showNumbers(){
        array_push($this->js, base_url()."assets/admin_metro/plugins/fuelux/js/tree.min.js");
        array_push($this->css, base_url()."assets/admin_metro/plugins/fuelux/css/tree-metronic-rtl.css");
        $data["target"] = "show_numbers";
        $this->load->view("site/cp/index", $data);
    }

    public function importNumbers()
    {
        $this->load->model("whats/mchannels");
        //$numbers = $this->mnumbers->importFromExcel();
        //$array = array_chunk($numbers, 1000);
        //echo "<pre>";
        //print_r($array);
        //$channels = $this->mchannels->getOkChannels(1);
        //echo "<pre>";
        //exit(print_r($channels));
        //foreach ($array as $key => $nums) {
            $checks = $this->mwhats->checkNumber("966500005578");
            print_r($checks);
            //foreach ($checks as $check) {
                //$this->db->insert("users_numbers", array(
                 //   "name" => $check["phonenumber"],
                //    "number" => $check["phonenumber"],
                 //   "create_time" => time(),
                 //   "group_id" => 160,
                  //  "user_id" => 1
               // ));
           // }
        //}
    }
}