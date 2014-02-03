<?php
class MLangs extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}

	//insert new language
	public function insertLang($atts=array()){
		$this->db->insert("langs_titles", array("title" => "set_copyrights", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "set_companyname", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "set_logo", "lang" => $atts["code"], "text" => ""));
		/*
		$this->db->insert("langs_titles", array("title" => "footer_left", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "footer_right", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "footer_center", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_name", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_email", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_mobile", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_company", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_body", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_country", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_success", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_entername", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_enteremail", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_entermobile", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_entermessage", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_numeric", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_validemail", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_minlengthmobile", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_maxlengthmobile", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "contact_send", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "product_year", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "product_director", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "product_editor", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "product_actors", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "product_country", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "product_copyrights", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "set_links", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "set_news", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "set_more", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "set_videos", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "set_gallery", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "users_username", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "users_name", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "users_password", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "users_repassword", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "users_country", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "users_birthdate", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "users_email", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "users_mobile", "lang" => $atts["code"], "text" => ""));
		$this->db->insert("langs_titles", array("title" => "users_phone", "lang" => $atts["code"], "text" => ""));
		*/
		$dir = "./application/language/site_".$atts["code"];
		$mk = mkdir("./application/language/site_".$atts["code"], 0777);
		static $rm = true;
		static $return;
		if($mk){
			$content = file_get_contents("./assets/site/locale.php");
			if($content){
				$put = file_put_contents("./application/language/site_{$atts['code']}/site_".$atts["code"]."_lang.php", $content);
				if($put){
					return $this->db->insert("languages", $atts);
				}else $return = 3;
			} else $return = 4;
		}else $return = 5;
		if($return > 2){
			if(is_dir($dir));
			$rm = rmdir("./application/language/site_".$atts["code"]);
		}
		if($rm){
		return $return;
		}else return 6;
	}
	
	//modify an existed language
	public function modifyLang($id, $atts=array()){
		static $rename;
		$dir = $dir = "./application/language/";
		$query = $this->db->get_where("languages", array("id" => $id));
		$lang = $query->row();
		$rename = rename($dir."site_$lang->code", $dir."site_{$atts["code"]}");
		if($rename){
			$rename = rename($dir."site_{$atts["code"]}/site_{$lang->code}_lang.php", $dir."site_{$atts["code"]}/site_{$atts["code"]}_lang.php");
			if($rename)	{
				$this->db->where("lang", $lang->code);
				$req = $this->db->update("langs_titles", array(
					"lang" => $atts["code"]
				));
				if($req){
				$this->db->where("id", $id);
				return $this->db->update("languages", $atts);		
				}else return false;		
			}else return false;
		}else return false;
	}
	
	//delete an existed language
	public function deleteLang($id){
		$lang = $this->getLangById($id);
		$this->db->where("lang", $lang->code);
		$query = $this->db->get("langs_titles");
		static $rm;
		static $dir;
		$dir = "./application/language/site_$lang->code";
		if($query->num_rows()>0){
			$this->db->where("lang", $lang->code);
			$this->db->delete("langs_titles");
		}
		foreach(glob($dir . '/*') as $file) {
			unlink($file);
		}
		$rm = rmdir($dir);
		if($rm){
		$this->db->where("id", $id);
		return $this->db->delete("languages");
		}else return 6;
	}
	
	//get language by id
	public function getLangById($id){
		$query = $this->db->get_where("languages", array("id" => $id));
		if($query->num_rows()==1)
			return $query->row();
		return false;
	}
	
	//get language by language code
	public function getLangByCode($code){
		$query = $this->db->get_where("languages", array("code" => $code));
		if($query->num_rows()>0)
			return $query->row();
		return false;
	}
	
	//get all languages
	public function getAllLangs(){
		$query = $this->db->get("languages");
		if($query->num_rows>0)
			return $query->result();
		return false;
	}
	
	//set default language
	public function setDefaultLang($lang_id){
		$langs = $this->getAllLangs ();
		if ($langs)
			foreach ( $langs as $lang) {
				$this->db->where ( "id", $lang->id );
				$this->db->update ( "languages", array (
						"default" => "0" 
				) );
			}
		$this->db->where ( "id", $lang_id );
		return $this->db->update ( "languages", array (
				"default" => "1" 
		) );
	}
	
	// check language language exist for modify language
	public function checkLanguageExist($id, $language) {
		$query = $this->db->get_where ( "languages", array (
				"language" => $language
		) );
		$lang1 = $this->getLangById ( $id );
		if ($query->num_rows () > 0) {
			$lang= $query->row ();
			if ($lang->language == $lang1->language)
				return true;
			return false;
		}
		return true;
	}
	
	// check language code exist for modify language
	public function checkCodeExist($id, $code) {
		$query = $this->db->get_where ( "languages", array (
				"code" => $code
		) );
		$lang1 = $this->getLangById ( $id );
		if ($query->num_rows () > 0) {
			$lang = $query->row ();
			if ($lang->code == $lang1->code)
				return true;
			return false;
		}
		return true;
	}
	
}