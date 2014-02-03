<?php
class MSite extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	// javascript output to put in site
	public function js() {
		$lang = $this->lang->language;
		//header ( 'Content-Type: application/javascript' );
		$query = $this->db->get ( "sitesettings" );
		$settings = $query->row ();
		$url = $settings->site_url;
		$lang_seg = $this->uri->segment ( 1 );
		$content = "var site_url = '" . $url . "';\n";
		$content .= "var lang_seg = '" . $lang_seg . "';\n";
		$content .= "var site_uri = '" . $url . $lang_seg . DIRECTORY_SEPARATOR . "';\n";
		$content .= "var referer = '" . $this->REFERER . "';\n";
		$content .= "var gets = '" . $this->GETS ."';\n";
		$content .= "var uri = '" . $this->URI ."';\n";
		$content .= "var lang_array = new Array();\n";
		foreach($lang as $key => $value){
			$content .= "lang_array['$key'] = '$value';\n";
		}
		return $content;
	}
	
	// get languages titles
	public function getLangsTitles() {
		$query = $this->db->get ( "langs_titles" );
		static $array = array ();
		if ($query->num_rows () > 0) {
			foreach ( $query->result () as $title ) {
				if (! isset ( $array [$title->lang] ))
					$array [$title->lang] = array ();
				$array [$title->lang] += array (
						$title->title => $title->text 
				);
			}
			return $array;
		}
		return false;
	}
	// insert new online guest to database
	public function insertGuest($atts = array()) {
		$this->db->insert ( "online_guests", $atts );
		return $this->db->insert_id ();
	}
	
	// update guest actions
	public function updateGuest($guest_id, $atts = array()) {
		$this->db->where ( "id", $guest_id );
		return $this->db->update ( "online_guests", $atts );
	}
	
	// get all online guests
	public function getAllOnlineGuests() {
		$query = $this->db->get ( "online_guests" );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get guest by ipaddress from database
	public function getGuestByIp($ipaddress) {
		$query = $this->db->get_where ( "online_guests", array (
				"ipaddress" => $ipaddress 
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}
	
	// get guest by id from database
	public function getGuestById($guest_id) {
		$query = $this->db->get_where ( "online_guests", array (
				"id" => $guest_id 
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}
	
	// block ip from show website
	public function blockIp($ip) {
		$this->db->insert ( "blocked_ip", array (
				"ipaddress" => $ip,
				"datetime" => time () 
		) );
		return $this->db->insert_id ();
	}
	
	// get all blocked ips
	public function getAllBlockedIps() {
		$query = $this->db->get ( "blocked_ip" );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get block ip by ip
	public function getBlockedIp($ip) {
		$query = $this->db->get_where ( "blocked_ip", array (
				"ipaddress" => $ip 
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}
	
	// unblock ip in database
	public function unBlockGuest($id) {
		$this->db->where ( "id", $id );
		return $this->db->delete ( "blocked_ip" );
	}
	
	// get language by language code
	public function getLangByCode($code) {
		$query = $this->db->get_where ( "languages", array (
				"code" => $code 
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}
	
	// get default language
	public function getDefaultLang() {
		$query = $this->db->get_where ( "languages", array (
				"default" => 1 
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}
	
	// get navigation bar
	public function getNav($lang) {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "nav", array (
				"lang" => $lang,
				"order < " => "10",
				"order > " => "0" 
		) );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get footer
	public function getFooter($lang) {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "footer", array (
				"order != " => "0",
				"lang" => $lang 
		) );
		if ($query->num_rows () > 0) {
			return $query->result ();
		}
		return false;
	}
	
	// get slider
	public function getSlider() {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "slider", array (
				"order != " => 0 
		) );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get slider
	public function getGallery($lang) {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "gallery", array (
				"order != " => 0,
				"lang" => $lang 
		) );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get social network links
	public function getSocial() {
		$query = $this->db->get_where ( "sitesettings", array (
				"id" => "1" 
		) );
		return $query->row ();
	}
	
	// get pages
	public function getPage($id, $lang) {
		$query = $this->db->get_where ( "pages", array (
				"common_id" => $id,
				"lang" => $lang 
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}
	
	// get product
	public function getProduct($product_id) {
		$query = $this->db->get_where ( "products", array (
				"id" => $product_id 
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}
	
	// get product slides
	public function getProductSlides($product_id) {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "productslides", array (
				"product" => $product_id,
				"order > " => "0" 
		) );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get all news
	public function getNews($lang) {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "news", array (
				"order > " => "0",
				"lang" => $lang 
		) );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get links
	public function getLinks($lang) {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "links", array (
				"order > " => "0",
				"lang" => $lang 
		) );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// update site visits
	public function updateVisits() {
		$query = $this->db->get_where ( "visits", array (
				"date < " => time (),
				"date > " => time () - 3600 * 24 
		) );
		if ($query->num_rows != 1)
			$this->db->insert ( "visits", array (
					"date" => time (),
					"count" => 1 
			) );
		else {
			$row = $query->row ();
			$this->db->where ( "id", $row->id );
			$this->db->update ( "visits", array (
					"count" => ++ $row->count 
			) );
		}
	}
	
	// submit new contact us form
	public function submitContactus($atts = array()) {
		$this->db->insert ( "contactus_forms", $atts );
		return $this->db->insert_id ();
	}
	
	// get sencond slider slides from products
	public function getSecSlider($lang) {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "products", array (
				"order > " => "0",
				"lang" => $lang,
				"in_slider" => "1",
				"active" => "1" 
		) );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get blocks
	public function getBlocks($lang) {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "banners", array (
				"order > " => "0",
				"lang" => $lang 
		) );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get cat by id
	public function getCatById($id) {
		$query = $this->db->get_where ( "products_categories", array (
				"id" => $id 
		) );
		if ($query->num_rows == 1)
			return $query->row ();
		return false;
	}
	
	// get array of activated products categories with products
	public function getProducts($lang) {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "products_categories", array (
				"lang" => $lang,
				"active" => 1,
				"order > " => 0 
		) );
		static $array = array ();
		if ($query->num_rows > 0) {
			foreach ( $query->result () as $cat ) {
				$array [$cat->title] = array ();
				$this->db->order_by ( "order", "asc" );
				$query = $this->db->get_where ( "products", array (
						"category" => $cat->id,
						"active" => "1",
						"order > " => 0,
						"lang" => $lang 
				) );
				if ($query->num_rows () > 0)
					foreach ( $query->result () as $product ) {
						$url = base_url () . $lang . DIRECTORY_SEPARATOR . "products?product=" . $product->id;
						$cat = $this->getCatById ( $product->category )->title;
						$array [$this->getCatById ( $product->category )->title] += array (
								$product->title => $url 
						);
					}
			}
			return $array;
		}
		return false;
	}
	
	// insert new user in members group from registeration form in website
	public function register($atts = array()) {
		$salt = rand ();
		$password = crypt ( $atts ["password"], $salt );
		$atts["password"] = $password;
		$atts["salt"] = $salt;
		$query = $this->db->insert ( "users", $atts);
		if($query){
			$this->load->model("whats/mwhats");
			$set = $this->mwhats->getSettings();
			$user_id = $this->db->insert_id();
			$this->db->insert("whats_credits", array("user_id" => $user_id, "credits" => $set->register_points));
			if($atts["group"] == MFunctions::GROUP_WHATSAPP){
				$this->load->model("whats/mwhats");
				$this->mwhats->assignChannel($this->mwhats->getUnassignedChannel(), $user_id);
			}
		}
		return $user_id;
	}
	
	//get user mobile code
	public function getMobileCode($user_id){
		$this->db->select("mobile_code");
		$this->db->where("id", $user_id);
		$query = $this->db->get("users");
		if($query)
			return $query->row()->mobile_code;
		return false;
	}
	
	//get user email code
	public function getEmailCode($user_id){
		$this->db->select("email_code");
		$this->db->where("id", $user_id);
		$query = $this->db->get("users");
		if($query)
			return $query->row()->email_code;
		return false;
	}
	
	// update user status
	public function updateStatus($user_id, $status) {
		$this->db->where ( "id", $user_id );
		return $this->db->update ( "users", array (
				"active" => intval ( $status ) 
		) );
	}
	
	// get user active status
	public function getUserStatus($user_id) {
		$this->db->select ( "active" );
		$this->db->where ( "id", $user_id );
		$query = $this->db->get_where ( "users" );
		if ($query->num_rows () > 0) {
			$user = $query->row ();
			return $user->active;
		}
		return false;
	}
	
	// forget password handling
	public function forgetPassword($type, $input) {
		$this->load->model ( "memail" );
		$salt = rand ();
		$pass = rand ( 111111, 999999 );
		$password = crypt ( $pass, $salt );
		$query;
		if ($type == "mobile") {
			$this->db->select ( "id,email" );
			$this->db->where ( "mobile", $input );
			$query = $this->db->get ( "users" );
			if ($query->num_rows () > 0) {
				$user = $query->row ();
				$this->db->where ( "id", $user->id );
			} else
				return false;
		} else if ($type == "username") {
			$this->db->select ( "id,email" );
			$this->db->where ( "username", $input );
			$query = $this->db->get ( "users" );
			if ($query->num_rows () > 0) {
				$user = $query->row ();
				$this->db->where ( "id", $user->id );
			} else
				return false;
		}
		$query = $this->db->update ( "users", array (
				"password" => $password,
				"salt" => $salt 
		) );
		if ($this->db->affected_rows () > 0) {
			$emails = array (
					$user->email 
			);
			$this->memail->sendEmail ( array (
					"message" => "Your password is: $pass",
					"address" => $emails,
					"subject" => $this->_titles [$this->_seg] ["set_companyname"] 
			) );
			return true;
		} else
			return false;
	}
	
	// subscribe email to email groups
	public function subscribe($email) {
		return $this->db->insert ( "subscribers", array (
				"email" => $email,
				"datetime" => time () 
		) );
	}
	
	// get user whats app credit points
	public function getWhatsCredits($user_id) {
		$this->db->where ( "user_id", $user_id );
		$query = $this->db->get ( "whats_credits");
		if ($query->num_rows () > 0) {
			$user = $query->row ();
			return $user->credits;
		}
		return false;
	}
	
}