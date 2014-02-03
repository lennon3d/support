<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin users controller
class Users extends AdminController {
	function __construct() {
		parent::__construct ();
	}
	public function index() {
		if ($this->permissions->users ["users_see"] != "1")
			$this->mfunctions->noPermission ();
		$users = $this->musers->getAllUsers ();
		$data ["users"] = $users;
		$data ["target"] = "users";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new user
	public function insertUser() {
		if ($this->permissions->users ["users_create"] != "1")
			$this->mfunctions->noPermission ();
		$data ['groups'] = $this->musers->getAllGroups ();
		$data ["group_select"] = "";
		if ($_POST) {
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			$this->form_validation->set_message ( 'matches', lang ( "password_no_match" ) );
			$this->form_validation->set_message ( 'valid_email', lang ( "valid_email" ) );
			$this->form_validation->set_message ( 'numeric', lang ( "numeric" ) );
			$this->form_validation->set_rules ( 'name', lang ( 'enter_name' ), 'required' );
			$this->form_validation->set_rules ( 'username', lang ( 'enter_username' ), 'required|is_unique[users.username]' );
			$this->form_validation->set_rules ( 'password', lang ( 'enter_password' ), 'required|matches[repassword]' );
			$this->form_validation->set_rules ( 'email', lang ( 'enter_email' ), 'required|valid_email|is_unique[users.email]' );
			$this->form_validation->set_rules ( 'mobile', lang ( 'enter_mobile' ), 'required|is_unique[users.mobile]|numeric' );
			$this->form_validation->set_rules ( 'repassword', lang ( "enter_repassword" ), 'required' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_user";
				$data ["group_select"] = $_POST ["group"];
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->musers->insertUser ( array (
						"username" => $_POST ["username"],
						"password" => $_POST ["password"],
						"name" => $_POST ["name"],
						"email" => $_POST ["email"],
						"mobile" => $_POST ["mobile"],
						"active" => $_POST ["active"],
						"group" => $_POST ["group"] 
				) );
				if ($query > 0)
					$this->mfunctions->actionReport ( "users", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/users", "refresh" );
			}
		} else {
			$data ["target"] = "insert_user";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify user
	public function modifyUser($user_id = "") {
		if ($this->permissions->users ["users_modify"] != "1")
			if ($user_id != $this->session->userdata ( "id" ))
				$this->mfunctions->noPermission ();
		if ($user_id != "") {
			$user = $this->musers->getUserById ( $user_id );
			if ($user) {
				$data ["user"] = $user;
				$data ['groups'] = $this->musers->getAllGroups ();
				if ($_POST) {
					$active = (isset ( $_POST ["active"] ) ? $_POST ["active"] : 1);
					if ($user_id == 1)
						$active = 1;
					$group = (isset ( $_POST ["group"] ) ? $_POST ["group"] : 1);
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
					$this->form_validation->set_message ( 'matches', lang ( "password_no_match" ) );
					$this->form_validation->set_message ( 'valid_email', lang ( "valid_email" ) );
					$this->form_validation->set_message ( 'numeric', lang ( "numeric" ) );
					$this->form_validation->set_rules ( 'name', lang ( 'enter_name' ), 'required' );
					$this->form_validation->set_rules ( 'username', lang ( 'enter_username' ), "required|callback_checkUserExist[$user_id]" );
					$this->form_validation->set_rules ( 'email', lang ( 'enter_email' ), "required|valid_email|callback_checkEmailExist[$user_id]" );
					$this->form_validation->set_rules ( 'mobile', lang ( 'enter_mobile' ), "required|callback_checkMobileExist[$user_id]|numeric" );
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_user";
						$this->load->view ( "admin/index", $data );
					} else {
						$query = $this->musers->modifyUser ( $user_id, array (
								"username" => $_POST ["username"],
								"name" => $_POST ["name"],
								"email" => $_POST ["email"],
								"mobile" => $_POST ["mobile"],
								"active" => $active,
								"group" => $group 
						) );
						if ($query > 0)
							$this->mfunctions->actionReport ( "users", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/users", "refresh" );
					}
				} else {
					$data ["target"] = "modify_user";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// check user exist for modify
	public function checkUserExist($user, $user_id) {
		$request = $this->musers->checkUserExist ( $user_id, $user );
		if (! $request) {
			$this->form_validation->set_message ( 'checkUserExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// check email exist for modify
	public function checkEmailExist($email, $user_id) {
		$request = $this->musers->checkEmailExist ( $user_id, $email );
		if (! $request) {
			$this->form_validation->set_message ( 'checkEmailExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// check mobile number exist for modify
	public function checkMobileExist($mobile, $user_id) {
		$request = $this->musers->checkMobileExist ( $user_id, $mobile );
		if (! $request) {
			$this->form_validation->set_message ( 'checkMobileExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// check group title exist for modify group
	public function checkGroupExist($title, $group_id) {
		$request = $this->musers->checkGroupExist ( $group_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkGroupExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// change password for an existed user
	public function changePassword($user_id = "") {
		if ($this->permissions->users ["users_modify"] != "1")
			$this->mfunctions->noPermission ();
		if ($user_id != "") {
			$user = $this->musers->getUserById ( $user_id );
			if ($user) {
				$data ["user"] = $user;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_message ( 'matches', lang ( "password_no_match" ) );
					$this->form_validation->set_rules ( 'password', lang ( 'enter_password' ), 'required|matches[repassword]' );
					$this->form_validation->set_rules ( 'repassword', lang ( "enter_repassword" ), 'required' );
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_user";
						$this->load->view ( "admin/index", $data );
					} else {
						$query = $this->musers->changePassword ( $user_id, $_POST ["password"] );
						if ($query > 0)
							$this->mfunctions->actionReport ( "users", "change_password" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/users", "refresh" );
					}
				} else {
					$data ["target"] = "modify_user";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// change permissions of an existed user
	public function changePermissions($group_id = "") {
		if ($this->permissions->users ["users_modify"] != "1")
			$this->mfunctions->noPermission ();
		if ($group_id == 1)
			exit ( "You can't change admin user!!" );
		if ($group_id != "") {
			if (isset ( $_POST ["permissions"] )) {
				$permissions_array = $_POST ["permissions"];
				$permissions_string = implode ( $permissions_array, "," );
				$query = $this->musers->changePermissions ( $group_id, array (
						"permissions" => $permissions_string 
				) );
				if ($query > 0)
					$this->mfunctions->actionReport ( "users", "change_permissions" );
				if ($query > 0)
					$data ["msg"] = 1;
			}
			$permissions1 = $this->musers->getGroupPermissions ( $group_id );
			if ($permissions1) {
				$data ["permissions1"] = ( object ) $permissions1 ["permissions"];
				$data ["target"] = "change_permissions";
				$data ["group_id"] = $group_id;
				$this->load->view ( "admin/index", $data );
			}
		}
	}
	
	// delete existed users
	public function deleteUser() {
		if ($this->permissions->users ["users_delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($_POST) {
			foreach ( $_POST ["user_id"] as $id ) {
				if ($id == 1)
					exit ( "You can't delete super admin user!!" );
				$query = $this->musers->deleteUser ( $id );
				if ($query > 0)
					$this->mfunctions->actionReport ( "users", "delete" );
			}
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			redirect ( base_url () . "admin/users", "refresh" );
		}
	}
	
	// show users groups table
	public function groups() {
		if ($this->permissions->users_groups ["see"] != "1")
			$this->mfunctions->noPermission ();
		$groups = $this->musers->getAllGroups ();
		$data ["groups"] = $groups;
		$data ["target"] = "users_groups";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new group
	public function insertGroup() {
		if ($this->permissions->users_groups ["create"] != "1")
			$this->mfunctions->noPermission ();
		if ($_POST) {
			$color = trim ( $_POST ["color"] );
			$desc = trim ( $_POST ["description"] );
			$active = (isset ( $_POST ["active"] ) ? "1" : "0");
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			$this->form_validation->set_rules ( 'title', lang ( 'enter_group_title' ), 'trim|required|is_unique[users_groups.title]' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["description"] = $desc;
				$data ["color"] = $color;
				$data ["target"] = "insert_users_group";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->musers->insertGroup ( array (
						"title" => trim ( $_POST ["title"] ),
						"color" => trim ( $_POST ["color"] ),
						"active" => $active,
						"description" => trim ( $_POST ["description"] ) 
				) );
				if ($query > 0)
					$this->mfunctions->actionReport ( "users_goups", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/users/groups", "refresh" );
			}
		} else {
			$data ["target"] = "insert_users_group";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed users group
	public function modifyGroup($group_id = "") {
		if ($this->permissions->users_groups ["modify"] != "1")
			$this->mfunctions->noPermission ();
		if ($group_id != "") {
			$group = $this->musers->getGroupById ( $group_id );
			if ($group) {
				$data ["group"] = $group;
				if ($_POST) {
					$active = (isset ( $_POST ["active"] ) ? "1" : "0");
					if ($group_id == 1)
						$active = 1;
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
					$this->form_validation->set_rules ( 'title', lang ( 'enter_group_title' ), "trim|required|callback_checkGroupExist[$group_id]" );
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_users_group";
						$this->load->view ( "admin/index", $data );
					} else {
						$query = $this->musers->modifyGroup ( $group_id, array (
								"title" => trim ( $_POST ["title"] ),
								"color" => trim ( $_POST ["color"] ),
								"active" => $active,
								"description" => trim ( $_POST ["description"] ) 
						) );
						if ($query > 0)
							$this->mfunctions->actionReport ( "groups", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/users/groups", "refresh" );
					}
				} else {
					$data ["target"] = "modify_users_group";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete users group
	public function deleteGroup($group_id) {
		if ($this->permissions->users_group ["delete"] != "1")
			$this->mfunctions->noPermission ();
		if ($group_id != "") {
			if ($group_id == 1 || $group_id == 2)
				exit ( "You can't delete primary users groups!!" );
			$query = $this->musers->deleteGroup ( $group_id );
			if ($query > 0) {
				$this->session->set_userdata ( array (
						"msg" => 1 
				) );
				$this->mfunctions->actionReport ( "banners", "delete" );
			} else {
				$this->session->set_userdata ( array (
						"msg" => - 1 ,
						"message" => lang ( "database_error" ) 
				) );
			}
		}
		redirect ( base_url () . "admin/banners", "refresh" );
	}
	
	// update users settings
	public function updateSettings() {
		if ($this->permissions->sitesettings ["see"] != "1")
			$this->mfunctions->noPermission ();
		if ($_POST) {
			if ($this->permissions->sitesettings ["modify"] != "1")
				$this->mfunctions->noPermission ();
			$update = $this->musers->setUserSettings ( array (
					"register_active" => (isset ( $_POST ["register_active"] ) ? 1 : 0),
					"register_admin" => (isset ( $_POST ["register_admin"] ) ? 1 : 0),
					"register_mobile" => (isset ( $_POST ["register_mobile"] ) ? 1 : 0),
					"register_email" => (isset ( $_POST ["register_email"] ) ? 1 : 0) 
			)
			 );
			if ($update > 0) {
				/*
				 * foreach ( $_POST as $key => $value ) { $name_array = explode ( "_", $key ); $name = $name_array [0] . "_" . $name_array [1]; $lang_code = $name_array [2]; if ($value == "") { $count ++; $lang = $this->mfunctions->getLangByCode ( $lang_code ); $data ["msg"] = "-1"; $data ["message"] .= lang ( "enter" ) . " " . lang ( $name ) . " ...." . lang ( "language" ) . ": " . $lang->language . "<br/>"; } else { $query = $this->musers->updateTitles ( $lang_code, $name, $value ); if($query>0) $this->mfunctions->actionReport("users", "update_titles"); } }
				 */
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				 redirect ( base_url () . "admin/users/updateSettings", "refresh" );
			} else {
				$this->session->set_userdata ( array (
						"msg" => "-1",
						"message" => lang ( "database_error" ) 
				) );
				redirect ( base_url () . "admin/users/updateSettings", "refresh" );
			}
		}
		$data ["settings"] = $this->musers->getUsersSettings ();
		$data ["target"] = "users_settings";
		$this->load->view ( "admin/index", $data );
	}
}