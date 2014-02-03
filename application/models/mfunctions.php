<?php
class MFunctions extends CI_Model {

	const REGISTER_STATUS_INACTIVE = 0;
	const REGISTER_STATUS_ACTIVE = 1;
	const REGISTER_STATUS_MOBILE = 2;
	const REGISTER_STATUS_EMAIL = 3;
	const REGISTER_STATUS_BOTH = 4;

	const GROUP_WHATSAPP = 3;
	const GROUP_MEMBERS = 2;
	const GROUP_FACEBOOK = 4;

	public function __construct() {
		parent::__construct ();
	}

	public function validate() {
		// grab user input
		$username = $this->security->xss_clean ( $this->input->post ( 'username' ) );
		$pass = $this->security->xss_clean ( $this->input->post ( 'password' ) );
		// Prep the query
		$this->db->where ( 'username', $username );

		// Run the query
		$query = $this->db->get ( 'users' );
		// Let's check if there are any results
		if ($query->num_rows == 1) {
			// If there is a user, then create session data
			$row = $query->row ();
				$new_pass = crypt ( $pass, $row->salt );
				$group = $this->musers->getGroupById($row->group);
				$permissions = $this->musers->getGroupPermissions($row->group);
				if ($new_pass == $row->password && $row->active != 0 && $group->active != 0) {
					$data = array (
							'id' => $row->id,
							'name' => $row->name,
							'username' => $row->username,
							'group' => $row->group,
							'validated' => true,
							'email' => $row->email,
							'mobile' => $row->mobile
					);
					$this->session->set_userdata ( $data );
					return true;
				} else {
					return false;
				}
		}

		// If the previous process did not validate
		// then return false.
		return false;
	}

	//get default language code
	public function getDefCode(){
		$this->db->select("code");
		$this->db->where("default", 1);
		$query = $this->db->get("languages");
		if($query->num_rows()>0)
			return $query->row()->code;
		return false;

	}

	// get set titles from database and return object with them
	public function getSetTitles() {
		$lang = $this->getDefCode();
		$this->db->where("lang", $lang);
		$this->db->like ( "title", "set" );
		$query = $this->db->get ( "langs_titles" );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}

	//get site name by default language
	public function getSiteTitle() {
		$lang = $this->getDefCode();
		$this->db->where("lang", $lang);
		$this->db->like ( "title", "set_companyname" );
		$this->db->select("text");
		$query = $this->db->get ( "langs_titles" );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}

	// get site settings
	public function getSiteSettings() {
		$query = $this->db->get_where ( "sitesettings", array (
				"id" => 1
		) );
		if ($query->num_rows == 1) {
			return $query->row ();
		}
		return false;
	}

	// set site settings
	public function setSiteSettings($atts = array()) {
		$this->db->where ( "id", "1" );
		return $this->db->update ( "sitesettings", $atts );
	}

	// get all languages
	public function getAllLangs() {
		$query = $this->db->get ( "languages" );
		if ($query->num_rows > 0)
			return $query->result ();
		return false;
	}

	// get language by id
	public function getLangById($id) {
		$query = $this->db->get_where ( "languages", array (
				"id" => $id
		) );
		if ($query->num_rows () == 1)
			return $query->row ();
		return false;
	}
	public function getPageUrl($lang) {
		return "pages?page=";
	}

	// get all pages
	public function getAllPages() {
		$pages = array ();
		$this->db->select("title, common_id");
		$this->db->distinct();
		$query = $this->db->get ( "pages" );
		if ($query->num_rows () > 0)
			foreach ( $query->result () as $page ) {
				array_push ( $pages, array (
						"title" => $page->title,
						"url" => "pages?page=" . $page->common_id
				) );
			}
				array_push ( $pages, array (
						"title" => lang ( "home" ),
						"url" => ""
				) );
				array_push ( $pages, array (
						"title" => lang ( "news" ),
						"url" => "news"
				) );
				array_push ( $pages, array (
						"title" => lang ( "products" ),
						"url" => "products"
				) );
				array_push ( $pages, array (
						"title" => lang ( "gallery" ),
						"url" => "gallery"
				) );
				array_push ( $pages, array (
						"title" => lang ( "videos" ),
						"url" => "videos"
				) );
				//array_push ( $pages, array (
					//	"title" => lang ( "equips" ),
				//		"url" => "equipments"
				//) );
	//	array_push ( $pages, array (
		//		"title" => lang ( "talents" ),
	//			"url" => base_url () . "talent/step1"
	//	) );

		if (count ( $pages ) > 0)
			return $pages;
		return false;
	}

	// get rss of news
	public function getRss($lang_code = "") {
		$this->load->model ( "mlangs" );
		$items = "";
		$details = '<?xml version="1.0" encoding="utf-8" ?>
					<rss version="2.0">
						<channel>
							<title>' . 'صدف للانتاج الصوتي والمرئي | الأخبار' . '</title>
							<description>' . 'الأخبار' . '</description>
							<image>
								<url>' . base_url () . 'assets/site/images/core_of_site_02.png' . '</url>
							</image>';
		if ($lang_code != "") {
			$query = $this->db->get_where ( "news", array (
					"lang" => $lang_code,
					"order !=" => "0"
			) );
			if ($query->num_rows () > 0) {
				$news = $query->result_array ();
				foreach ( $news as $new )
					$items .= '<item>
						 <title>' . $new ["title"] . '</title>
						 <link>' . $new ["url"] . '</link>
						 <description>' . $new ["short_description"] . '</description>
					 </item>';
			}
			$items .= '</channel>
				 </rss>';
		} else
			$items = "<item>
							<title>No News</title>
					</item>
				</channel>
			</rss>";
		return $details . $items;
	}

	// delete all online guests whome times exipered
	public function deleteGuests() {
		$this->db->where ( "exit_time < ", time () );
		$this->db->delete ( "online_guests" );
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

	// get videos for choosen language
	public function getVideos($lang) {
		$this->db->order_by ( "order", "asc" );
		$query = $this->db->get_where ( "videos", array (
				"lang" => $lang,
				"order > " => 0
		) );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}

	// update site titles
	public function updateTitles($lang, $title, $text) {
		$this->db->where ( array (
				"lang" => $lang,
				"title" => $title
		) );
		return $this->db->update ( "langs_titles", array (
				"text" => $text
		) );
	}

	// insert user action report
	public function actionReport($table, $action) {
		$atts = array (
				"user" => $this->session->userdata ( "username" ),
				"ipaddress" => $_SERVER ['REMOTE_ADDR'],
				"datetime" => time (),
				"table" => $table,
				"action" => $action
		);
		$this->db->insert ( "actions", $atts );
		return $this->db->insert_id ();
	}

	// get table head and body to export to file
	public function getTableForFile($tbody1, $thead1) {
		$regex = '/(|\\\\[rntv]{1})/';
		$thead = preg_replace ( $regex, "", $thead1 );
		$tbody = preg_replace ( $regex, "", $tbody1 );
		$thead = str_replace ( array (
				"[",
				"]",
				"\""
		), "", $thead );
		$tbody = str_replace ( array (
				"[",
				"]",
				"\""
		), "", $tbody );
		$thead_array = explode ( ",", $thead );
		$tbody_array = explode ( ",", $tbody );
		$divided = count ( $tbody_array ) / count ( $thead_array );
		$tbody = array ();
		for($i = 0; $i < $divided; $i ++) {
			$tbody [$i] = array ();
			$tbody [$i] += array_slice ( $tbody_array, $i * count ( $thead_array ), count ( $thead_array ) );
		}
		return array (
				"thead" => $thead_array,
				"tbody" => $tbody
		);
	}

	// show no permission page
	public function noPermission() {
		$this->load->model("msite");
		exit ( "
				<meta charset='utf-8'/>
				<link href='" . base_url () . "assets/admin/css/main.css' rel='stylesheet' type='text/css' />
				<link href='" . base_url () . "assets/admin/css/admin.css' rel='stylesheet' type='text/css' />
				<div class='wrapper'>
				<div class='content'>
				<div class='inner'>
				<div class='body'>
				<div style='text-align:center;'>
				<img style='left;0' src='" . base_url () . "assets/admin/images/denied.png'/>
				<label style='display:block;'>" . lang ( "no_permission" ) . "</label>
				<a style='display:block;' href= '".base_url()."'>".lang('home_page')."</a>'
				<a style='display:block;' href = '" . base_url () . "admin'>" . lang ( "go_home" ) . "</a>
				<a style='display:block;' href = '".base_url()."{$this->msite->getDefaultLang()->code}/logout'>".lang("logout")."</a>
				</div>
				</div>
				</div>
				</div>
				</div>
				" );
	}

	// get all unseen contact us forms
	public function getUnseenContactus() {
		$query = $this->db->get_where ( "contactus_forms", array (
				"seen" => 0
		) );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}

	//get all countries
	public function getCountries(){
		$this->db->select("c_id, c_name");
		$query = $this->db->get("countries");
		if($query->num_rows() > 0)
			return $query->result();
		return false;
	}

	//get country by id
	public function getCountryById($id){
		$this->db->where("c_id", $id);
		$query = $this->db->get("countries");
		if($query->num_rows() > 0)
			return $query->row();
		return false;
	}

	//get country cities
	public function getCountryCities($country_id){
		$this->db->where("c_id", $country_id);
		$query = $this->db->get("cities");
		if($query->num_rows()>0)
			return $query->result();
		return false;

	}

	//get city by id
	public function getCityById($city_id){
		$this->db->where("id", $city_id);
		$query = $this->db->get("cities");
		if($query->num_rows()>0)
			return $query->row();
		return false;
	}

        // print array
    public function printA($array, $method = "print_r")
    {
        echo "<pre>";
        if ($method == "print_r")
            print_r($array);
        elseif ($method == "var_dump")
            var_dump($array);
        exit();
    }

	//get time deferent between two times given
	public function getTimeDef($time1, $time2){
	    $string_def = array(
	        array(60, lang("just_now")),
	        array(90, '1 '.lang("minute")),                  // 60*1.5
	        array(3600, lang("minutes"), 60),             // 60*60, 60
	        array(5400, '1 '.lang("hour")),                  // 60*60*1.5
	        array(86400, lang("hours"), 3600),            // 60*60*24, 60*60
	        array(129600, '1 '.lang("day")),                 // 60*60*24*1.5
	        array(604800, lang("days"), 86400),           // 60*60*24*7, 60*60*24
	        array(907200, '1 '.lang("week")),                // 60*60*24*7*1.5
	        array(2628000, lang("weeks"), 604800),        // 60*60*24*(365/12), 60*60*24*7
	        array(3942000, '1 '.lang("month")),              // 60*60*24*(365/12)*1.5
	        array(31536000, lang("monthes"), 2628000),     // 60*60*24*365, 60*60*24*(365/12)
	        array(47304000, '1 '.lang("year")),              // 60*60*24*365*1.5
	        array(3153600000, lang("years"), 31536000),   // 60*60*24*365*100, 60*60*24*365
	    );
	    $difference = $time1-$time2;
	    $message = "";
	    foreach($string_def as $format){
	        if ($difference < $format[0]) {
	            if (count($format) == 2) {
	                $message = lang("time_from")." ".$format[1];
	                break;
	            } else {
	                $message = lang("time_from")." ".ceil($difference / $format[2]) . ' ' . $format[1];
	                break;
	            }
	        }
	    }
	    return $message;
	}

}