<?php
class MContactus extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	// create new contact us form
	public function insertContact($atts = array()) {
		return $this->db->insert ( "contactus_forms", $atts );
	}
	
	// get contact us form by id
	public function getContactById($contact_id) {
		$this->db->where ( "id", $contact_id );
		$query = $this->db->get ( "contactus_forms" );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}
	
	// get all contact us forms
	public function getAllContacts() {
		$query = $this->db->get ( "contactus_forms" );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// reply to existed contact us form
	public function replyContact($id, $atts = array()) {
		return $this->db->insert ( "contactus_replies", $atts );
	}
	
	//get contact us replies
	public function getContactReplies($contact_id){
		$this->db->where("contact", $contact_id);
		$query = $this->db->get("contactus_replies");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	// delete an existed contact us form "this will delete replies to"
	public function deleteContact($contact_id) {
		$this->db->where ( "contact", $contact_id );
		$this->db->delete ( "contactus_replies" );
		$this->db->where ( "id", $contact_id );
		return $this->db->delete ( "contactus_forms" );
	}
	

	//update contact us titles
	public function updateTitles($lang, $title, $text){
		$this->db->where(array("lang" => $lang, "title" => $title));
		return $this->db->update("langs_titles", array("text" => $text));
	}
	
	//get contact us titles from database and return array with them
	public function getContactusTitles(){
		$this->db->like("title", "contact");
		$query = $this->db->get("langs_titles");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
}
	