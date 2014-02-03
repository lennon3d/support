<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    // common admin controller
class AdminController extends CI_Controller
{

    var $permissions;

    var $_SEG;

    var $_LANGS;

    var $SET;

    var $USER_ID;

    var $TITLE;

    var $USERNAME;

    var $URI;

    var $REFERER;

    var $USER;

    public function __construct()
    {
        parent::__construct();
        $this->USER = $this->musers->getUserById($this->session->userdata("id"));
        $this->check_isvalidated();
        $this->lang->load("arabic", "arabic");
        $this->_SEG = $this->uri->segment(1);
        $this->_LANGS = $this->mfunctions->getAllLangs();
        $permissions = $this->musers->getGroupPermissions($this->USER->group);
        $this->permissions = (object) $permissions["permissions"];
        $this->SET = $this->mfunctions->getSiteSettings();
        $this->USER_ID = $this->session->userdata("id");
        $this->USERNAME = $this->session->userdata("username");
        $this->TITLE = $this->mfunctions->getSiteTitle();
        $this->REFERER = $this->getReferer();
        $this->URI = $this->getUri();
        if ($this->permissions->admin_login["see"] != "1")
            $this->mfunctions->noPermission();
    }

    // check login validation username and password
    private function check_isvalidated()
    {
        if (! $this->session->userdata('validated')) {
            redirect(base_url() . 'admin/login');
        } else {
            $user = $this->musers->getUserById($this->session->userdata("id"));
            if ($user->active == 0) {
                $this->session->unset_userdata(array(
                    'id' => "",
                    'name' => "",
                    'username' => "",
                    'validated' => "",
                    "group" => ""
                ));
                redirect(site_url("admin/login"));
            }
        }
    }

    private function getReferer()
    {
        $url = "http";
        if (! empty($_SERVER["HTTPS"]))
            $url .= "s";
        $url .= "://";
        $url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        return $url;
    }

    private function getUri()
    {
        $uri = explode('?', $this->REFERER);
        return $uri[0];
    }
}

class SiteController extends CI_Controller
{

    var $_set;

    var $_langs;

    var $_seg;

    var $_titles;

    var $USER_ID;

    var $SITE_URL;

    var $REFERER;

    var $URI;

    var $GETS;

    var $valid;

    var $js;

    var $css;

    function __construct()
    {
        parent::__construct();
        $this->load->model("msite");
        if ($this->checkBlocked())
            exit("you are blocked!");
        $this->_langs = $this->msite->getLangsTitles();
        $this->_seg = $this->uri->segment(1);
        $this->_titles = $this->msite->getLangsTitles();
        $this->USER_ID = $this->session->userdata("id");
        $this->SITE_URL = base_url() . $this->_seg . DIRECTORY_SEPARATOR;
        $this->REFERER = $this->getReferer();
        $this->GETS = $this->getGets();
        $this->URI = $this->getUri();
        $this->check_isvalidated();
        $this->_set = $this->mfunctions->getSiteSettings();
        if ($this->_set->site_open != 1)
            exit();
        $user = $this->musers->getUserById($this->session->userdata("id"));
        $this->updateGuest();
        $this->mappingSite();
        $this->lang->load("site_$this->_seg", "site_$this->_seg");
        if (! $this->session->userdata("captcha")) {
            $this->session->set_userdata(array(
                "captcha" => rand(10000, 99999)
            ));
        }
        if($this->uri->segment(2) == "cp" && !$this->session->userdata("validated"))
            redirect($this->SITE_URL."user/login");
        $this->js = array();
        $this->css = array();
    }

    private function getGets()
    {
        $uri = explode('?', $this->REFERER);
        if (count($uri) == 2)
            return $uri[1];
        return false;
    }

    private function getReferer()
    {
        $url = "http";
        if (! empty($_SERVER["HTTPS"]))
            $url .= "s";
        $url .= "://";
        $url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        return $url;
    }

    private function getUri()
    {
        $uri = explode('?', $this->REFERER);
        return $uri[0];
    }

    // check login validation username and password
    private function check_isvalidated()
    {
        if (! $this->session->userdata('validated')) {

            // redirect ( base_url () . 'admin/login' );
        } else {
            $user = $this->musers->getUserById($this->session->userdata("id"));
            if ($user->active == 0) {
                $this->session->unset_userdata(array(
                    'id' => "",
                    'name' => "",
                    'username' => "",
                    'validated' => "",
                    "group" => ""
                ));
                // redirect ( site_url ( "admin/login" ) );
            }
            if ($this->msite->getUserStatus($this->USER_ID) != MFunctions::REGISTER_STATUS_ACTIVE) {
                if ($this->uri->segment(3) != "enterCode" && $this->uri->segment(2) != "logout") {
                    redirect($this->SITE_URL . "user/enterCode", "refresh");
                }
            }
        }
    }

    // check if guest blocked
    private function checkBlocked()
    {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $guest = $this->msite->getBlockedIp($ipaddress);
        if ($guest)
            return true;
        return false;
    }

    // mapping site segments
    private function mappingSite()
    {
        $lang_seg = $this->uri->segment(1);
        $lang = $this->msite->getLangByCode($lang_seg);
        $def_lang = $this->msite->getDefaultLang();
        $new_lang_seg = $def_lang->code;
        if (! $lang) {
            redirect(base_url() . $new_lang_seg);
        }
        if ($this->uri->total_segments() == 0) {
            redirect(base_url() . $new_lang_seg);
        }
    }

    // update guests actions
    private function updateGuest()
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $db_guest = $this->msite->getGuestByIp($ip);
        $guest_id = $this->session->userdata("guest_id");
        if (! $guest_id)
            $this->msite->updateVisits();
        if (! $guest_id || ! $db_guest) {
            if (! $db_guest) {
                $guest = $this->msite->insertGuest(array(
                    "enter_time" => time(),
                    "ipaddress" => $_SERVER['REMOTE_ADDR'],
                    "useragent" => $_SERVER['HTTP_USER_AGENT'],
                    "current_page" => $this->REFERER,
                    "exit_time" => time() + 3600
                ));
                $this->session->set_userdata(array(
                    "guest_id" => $guest
                ));
            } else {
                $this->session->set_userdata(array(
                    "guest_id" => $db_guest->id
                ));
            }
        } else {
            $guest_id = $this->session->userdata("guest_id");
            $this->msite->updateGuest($guest_id, array(
                "current_page" => $this->REFERER
            ));
        }
    }
}