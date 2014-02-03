<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin Footer controller
class Footer extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mfooter" );
	}
	
	public function index() {
		if ($this->permissions->footer["see"] != "1")
			$this->mfunctions->noPermission();
		$footers = $this->mfooter->getAllFooters();
		$data ["footers"] = $footers;
		$data ["target"] = "footer";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new footer 
	public function insertFooter() {
		if ($this->permissions->footer["create"] != "1")
			$this->mfunctions->noPermission();
		foreach($this->_LANGS as $lang){
			$data["post"]["title_$lang->code"] = "";
			$data["post"]["url_$lang->code"] = "";
			$data["post"]["position_$lang->code"] = "";
			$data["post"]["status_$lang->code"] = "";
		}
		$data["pages"] = $this->mfunctions->getALlPages();
		$data["positions"] = $this->mfooter->getPositionArray();
		if ($_POST) {
			$common_id = $this->mfooter->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_footer_title' )." - " . $lang->language, 'trim|required|is_unique[footer.title]' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_footer";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
				$query = $this->mfooter->insertFooter( array (
						"title" => trim($_POST ["title_$lang->code"]),
						"url" => trim($_POST ["url_$lang->code"]),
						"lang" => $lang->code,
						"position" => $_POST ["position_$lang->code"],
						"order" => 0,
						"common_id" => $common_id,
						"status" => (isset($_POST["status_$lang->code"])?1:0)
				) );
				}
				if($query>0)
					$this->mfunctions->actionReport("footer", "insert");
				$this->session->set_userdata ( array (
						"msg" => "1"
				) );
				redirect ( base_url () . "admin/footer", "refresh" );
			}
		} else {
			$data ["target"] = "insert_footer";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed footer 
	public function modifyFooter($footer_id, $atts = array()) {
		if ($this->permissions->footer["modify"] != "1")
			$this->mfunctions->noPermission();
		$data["pages"] = $this->mfunctions->getALlPages();
		$data["positions"] = $this->mfooter->getPositionArray();
		if ($footer_id != "") {
			$footer = $this->mfooter->getFooterById ( $footer_id );
			if ($footer) {
				$data ["footer"] = $footer;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					foreach($this->_LANGS as $lang){
						$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_footer_title' )." - " . $lang->language, "trim|required|callback_checkTitleExist[$footer_id]" );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_footer";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
						$query = $this->mfooter->modifyFooter( $footer_id, $lang->code, array (
							"title" => trim($_POST ["title_$lang->code"]),
							"url" => trim($_POST ["url_$lang->code"]),
							"position" => $_POST ["position_$lang->code"],
							"status" => (isset($_POST["status_$lang->code"])?1:0)
						) );
						}
						if($query>0)
							$this->mfunctions->actionReport("footer", "modify");
						$this->session->set_userdata ( array (
								"msg" => "1"
						) );
						redirect ( base_url () . "admin/footer", "refresh" );
					}
				} else {
					$data ["target"] = "modify_footer";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed footer 
	public function deleteFooter($footer_id) {
		if ($this->permissions->footer["delete"] != "1")
			$this->mfunctions->noPermission();
		if ($footer_id != "") {
			$query = $this->mfooter->deleteFooter( $footer_id );
			$this->session->set_userdata ( array (
					"msg" => 1
			) );
			if($query>0)
				$this->mfunctions->actionReport("footer", "delete");
			redirect ( base_url () . "admin/footer", "refresh" );
		}
	}
	
	// check footer title exist for modify
	public function checkTitleExist($title, $footer_id) {
		$request = $this->mfooter->checkTitleExist ( $footer_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set footer  order
	public function setOrder() {
		if ($_POST) {
			$this->mfooter->setFootersOrder ( $_POST ["footer"] );
			$this->session->set_userdata ( array (
					"msg" => "1"
			) );
				$this->mfunctions->actionReport("footer", "set_order");
			redirect ( base_url () . "admin/footer", "refresh" );
		}
	}
	/*
	//update footer titles
	public function updateTitles(){
		if($_POST){
			if ($this->permissions->langs_titles["modify"] != "1")
				$this->mfunctions->noPermission();
			$count = 0;
			$data["message"] = "";
			foreach($_POST as $key => $value){
				$name_array = explode("_", $key);
				$name = $name_array[0]."_".$name_array[1];
				$lang_code = $name_array[2];
				if($value==""){
					$count++;
					$lang = $this->mfunctions->getLangByCode($lang_code);
					$data ["msg"] = "-1";
					$data ["message"] .= lang("enter")." ".lang($name)." ....". lang("language"). ": ".$lang->language."<br/>";
				}else{
					$query = $this->mfooter->updateTitles($lang_code, $name, $value);
					if($query>0)
						$this->mfunctions->actionReport("footer", "update_titles");
				}
			}
			if($count==0){
				$this->session->set_userdata ( array (
						"msg" => "1"
				) );
				redirect ( base_url () . "admin/footer", "refresh" );
			}
		}
		$data["footer_titles"] = $this->mfooter->getFooterTitles();
		$data["target"] = "footer_titles";
		$data["langs"] = $this->mfunctions->getAllLangs();
		$this->load->view("admin/index", $data);
	}
*/
	
}