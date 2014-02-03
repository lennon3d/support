<?php
class MUsers extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	const TABLE = "users";
	const GROUPS_TABLE = "users_groups";

	// insert user in database
	public function insertUser($atts = array()) {
		$salt = rand ();
		$password = crypt ( $atts ["password"], $salt );
		$query = $this->db->insert ( self::TABLE, array (
				"username" => $atts ["username"],
				"password" => $password,
				"salt" => $salt,
				"email" => $atts ["email"],
				"mobile" => $atts ["mobile"],
				"active" => $atts ["active"],
				"name" => $atts ["name"],
				"group" => $atts ["group"]
		) );
		$user_id = $this->db->insert_id ();
		if ($user_id > 0) {
			if ($atts ["group"] == MFunctions::GROUP_WHATSAPP) {
				$this->load->model ( "whats/mwhats" );
				$set = $this->mwhats->getSettings();
				$this->db->insert("whats_credits", array("user_id" => $user_id, "credits" => $set->register_points));
				$this->mwhats->assignChannel ($this->mwhats->getUnassignedChannel (), $user_id );
			}
		}
		return $user_id;
	}

	// get all users in database
	public function getAllUsers($group="all") {
		if($group != "all")
			$this->db->where("group", $group);
		$query = $this->db->get ( self::TABLE );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}

	// get user by id
	public function getUserById($id) {
		$query = $this->db->get_where ( self::TABLE, array (
				"id" => $id
		) );
		if ($query->num_rows () > 0) {
			return $query->row ();
		}
		return false;
	}

	// modify a user in database
	public function modifyUser($id, $atts = array()) {
		$this->db->where ( "id", $id );
		return $this->db->update ( self::TABLE, $atts );
	}

	// change password for a user
	public function changePassword($id, $pass) {
		$this->db->where ( "id", $id );
		$salt = rand ();
		$password = crypt ( $pass, $salt );
		return $this->db->update ( self::TABLE, array (
				"password" => $password,
				"salt" => $salt
		) );
	}

	// change permissions for user
	public function changePermissions($id, $atts = array()) {
		$this->db->where ( "id", $id );
		return $this->db->update ( self::GROUPS_TABLE, array (
				"permissions" => $atts ["permissions"]
		) );
	}

	// get group permissions
	// return detailed array of group permissions
	public function getGroupPermissions($id) {
		$query = $this->db->get_where ( self::GROUPS_TABLE, array (
				"id" => $id
		) );
		if ($query->num_rows () > 0) {
			$user = $query->row ();
			$permissions = $user->permissions;
			$permissions = explode ( ",", $permissions );
			$permissions_array = array (
					"users" => array (
							"users_see" => $permissions [0],
							"users_create" => $permissions [1],
							"users_modify" => $permissions [2],
							"users_delete" => $permissions [3]
					),
					"smsgates" => array (
							"smsgates_see" => $permissions [4],
							"smsgates_create" => $permissions [5],
							"smsgates_modify" => $permissions [6],
							"smsgates_delete" => $permissions [7]
					),
					"products" => array (
							"products_see" => $permissions [8],
							"products_create" => $permissions [9],
							"products_modify" => $permissions [10],
							"products_delete" => $permissions [11]
					),
					"news" => array (
							"news_see" => $permissions [12],
							"news_create" => $permissions [13],
							"news_modify" => $permissions [14],
							"news_delete" => $permissions [15]
					),
					"pages" => array (
							"pages_see" => $permissions [16],
							"pages_create" => $permissions [17],
							"pages_modify" => $permissions [18],
							"pages_delete" => $permissions [19]
					),
					"gallery" => array (
							"see" => $permissions [20],
							"create" => $permissions [21],
							"modify" => $permissions [22],
							"delete" => $permissions [23]
					),
					"videos" => array (
							"see" => $permissions [24],
							"create" => $permissions [25],
							"modify" => $permissions [26],
							"delete" => $permissions [27]
					),
					"slider" => array (
							"see" => $permissions [28],
							"create" => $permissions [29],
							"modify" => $permissions [30],
							"delete" => $permissions [31]
					),
					"nav" => array (
							"nav_see" => $permissions [32],
							"nav_create" => $permissions [33],
							"nav_modify" => $permissions [34],
							"nav_delete" => $permissions [35]
					),
					"links" => array (
							"links_see" => $permissions [36],
							"links_create" => $permissions [37],
							"links_modify" => $permissions [38],
							"links_delete" => $permissions [39]
					),
					"notify" => array (
							"see" => $permissions [40],
							"",
							"modify" => $permissions [41],
							""
					),
					"subscripers_sendsms" => array (
							"subscripers_sendsms" => $permissions [42],
							"",
							"",
							""
					),
					"subscriper_sendemail" => array (
							"subscriper_sendemail" => $permissions [43],
							"",
							"",
							""
					),
					"languages" => array (
							"lang_see" => $permissions [44],
							"lang_create" => $permissions [45],
							"lang_modify" => $permissions [46],
							"lang_delete" => $permissions [47]
					),
					"blockip" => array (
							"see" => $permissions [48],
							"create" => $permissions [49],
							"",
							"delete" => $permissions [50]
					),
					"sms_send" => array (
							"send" => $permissions [51],
							"",
							"",
							""
					),
					"actions" => array (
							"see" => $permissions [52],
							"",
							"",
							"delete" => $permissions [53]
					),
					"comments" => array (
							"see" => $permissions [54],
							"create" => $permissions [55],
							"modify" => $permissions [56],
							"delete" => $permissions [57]
					),
					"contacts" => array (
							"see" => $permissions [58],
							"",
							"",
							"delete" => $permissions [59]
					),
					"contacts_reply" => array (
							"see" => $permissions [60],
							"create" => $permissions [61],
							"",
							""
					),
					"sitesettings" => array (
							"see" => $permissions [62],
							"",
							"modify" => $permissions [63],
							""
					),
					"emailsettings" => array (
							"see" => $permissions [64],
							"",
							"modify" => $permissions [65],
							""
					),
					"browser" => array (
							"see" => $permissions [66],
							"",
							"",
							""
					),
					"footer" => array (
							"see" => $permissions [67],
							"create" => $permissions [68],
							"modify" => $permissions [69],
							"delete" => $permissions [70]
					),
					"langs_titles" => array (
							"see" => $permissions [71],
							"",
							"modify" => $permissions [72],
							""
					),
					"groups" => array (
							"see" => $permissions [73],
							"create" => $permissions [74],
							"",
							"delete" => $permissions [75]
					),
					"sms_reports" => array (
							"see" => $permissions [76],
							"",
							"",
							"delete" => $permissions [77]
					),
					"email_reports" => array (
							"see" => $permissions [78],
							"",
							"",
							"delete" => $permissions [79]
					),
					"email_send" => array (
							"send" => $permissions [80],
							"",
							"",
							""
					),
					"banners" => array (
							"see" => $permissions [81],
							"create" => $permissions [82],
							"modify" => $permissions [83],
							"delete" => $permissions [84]
					),
					"talent" => array (
							"see" => $permissions [85],
							"create" => "",
							"modify" => "",
							"delete" => $permissions [86]
					),
					"admin_login" => array (
							"see" => $permissions [87],
							"create" => "",
							"modify" => "",
							"delete" => ""
					),
					"users_groups" => array (
							"see" => $permissions [88],
							"create" => $permissions [89],
							"modify" => $permissions [90],
							"delete" => $permissions [91]
					),
					"sponsors" => array (
							"see" => $permissions [92],
							"create" => $permissions [93],
							"modify" => $permissions [94],
							"delete" => $permissions [95]
					),
					"offers" => array (
							"see" => $permissions [96],
							"create" => $permissions [97],
							"modify" => $permissions [98],
							"delete" => $permissions [99]
					),
					"whats" => array (
							"see" => $permissions [100],
							"create" => $permissions [101],
							"modify" => $permissions [102],
							"delete" => $permissions [103]
					),
					"whats_channels" => array (
							"see" => $permissions [104],
							"create" => $permissions [105],
							"modify" => $permissions [106],
							"delete" => $permissions [107]
					)
			);
			return array (
					"permissions" => $permissions_array
			);
		}
		return false;
	}

	//get user by username
	public function getUserByUsername($username){
		$this->db->like("username", $username);
		$query = $this->db->get("users");
		if($query->num_rows() == 1)
			return $query->row();
		return false;
	}

	// check username exist for modify user
	public function checkUserExist($id, $username) {
		$query = $this->db->get_where ( self::TABLE, array (
				"username" => $username
		) );
		$user1 = $this->getUserById ( $id );
		if ($query->num_rows () > 0) {
			$user = $query->row ();
			if ($user->username == $user1->username)
				return true;
			return false;
		}
		return true;
	}

	// check email exist for modify user
	public function checkEmailExist($id, $email) {
		$query = $this->db->get_where ( self::TABLE, array (
				"email" => $email
		) );
		$user1 = $this->getUserById ( $id );
		if ($query->num_rows () > 0) {
			$user = $query->row ();
			if ($user->email == $user1->email)
				return true;
			return false;
		}
		return true;
	}

	// check mobile number exist for modify user
	public function checkMobileExist($id, $mobile) {
		$query = $this->db->get_where ( self::TABLE, array (
				"mobile" => $mobile
		) );
		$user1 = $this->getUserById ( $id );
		if ($query->num_rows () > 0) {
			$user = $query->row ();
			if ($user->mobile == $user1->mobile)
				return true;
			return false;
		}
		return true;
	}

	// check group title exist for modify group
	public function checkGroupExist($id, $title) {
		$query = $this->db->get_where ( self::GROUPS_TABLE, array (
				"title" => $title
		) );
		$group1 = $this->getGroupById ( $id );
		if ($query->num_rows () > 0) {
			$group = $query->row ();
			if ($group->title == $group1->title)
				return true;
			return false;
		}
		return true;
	}

	// delete user from database
	public function deleteUser($id) {
		$this->db->where ( "id", $id );
		$query = $this->db->delete ( self::TABLE );
		if($query){
			$this->load->model("whats/mwhats");
			$this->mwhats->assignChannel($this->mwhats->getUserChannel($id, "id"), 0);
		}

	}

	// insert new users group
	public function insertGroup($atts = array()) {
		$atts += array (
				"permissions" => 1
		);
		return $this->db->insert ( self::GROUPS_TABLE, $atts );
	}

	// modify user group
	public function modifyGroup($id, $atts = array()) {
		$this->db->where ( "id", $id );
		return $this->db->update ( self::GROUPS_TABLE, $atts );
	}

	// get all users groups from database
	public function getAllGroups() {
		$query = $this->db->get ( self::GROUPS_TABLE );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}

	// get users group by id
	public function getGroupById($id) {
		$query = $this->db->get_where ( self::GROUPS_TABLE, array (
				"id" => $id
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}

	// delete group
	public function deleteGroup($id) {
		$this->db->where ( "group", $id );
		$query = $this->db->delete ( self::TABLE );
		if ($query) {
			$this->db->where ( "id", $id );
			return $this->db->delete ( self::GROUPS_TABLE );
		}
		return false;
	}

	// get group users count
	public function getUsersCount($group_id) {
		$query = $this->db->get_where ( self::TABLE, array (
				"group" => $group_id
		) );
		return $query->num_rows ();
	}

	// get register titles from database and return array with them
	public function getRegisterTitles() {
		$this->db->like ( "title", "users" );
		$query = $this->db->get ( "langs_titles" );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}

	// get users settings
	public function getUsersSettings() {
		$this->db->select ( "register_active,register_mobile,register_email,register_admin" );
		$query = $this->db->get_where ( "sitesettings", array (
				"id" => 1
		) );
		if ($query->num_rows == 1) {
			return $query->row ();
		}
		return false;
	}

	// update user settings
	public function setUserSettings($atts = array()) {
		$this->db->where ( "id", 1 );
		return $this->db->update ( "sitesettings", $atts );
	}

	// update register titles
	public function updateTitles($lang, $title, $text) {
		$this->db->where ( array (
				"lang" => $lang,
				"title" => $title
		) );
		return $this->db->update ( "langs_titles", array (
				"text" => $text
		) );
	}
}
