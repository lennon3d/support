<?php
class MFooter extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	const TABLE = "footer";
	// insert new footer
	public function insertFooter($atts = array()) {
		return $this->db->insert ( self::TABLE, $atts );
	}
	
	// modify an existed footer
	public function modifyFooter($id, $lang, $atts = array()) {
		$this->db->where(array("common_id" => $id, "lang" => $lang));
		return $this->db->update ( self::TABLE, $atts );
	}
	
	// delete an existed footer
	public function deleteFooter($id) {
		$this->db->where ( "common_id", $id );
		return $this->db->delete ( self::TABLE );
	}
	
	// get all footers
	public function getAllFooters() {
		$this->db->where("lang", $this->mfunctions->getDefCode());
		$query = $this->db->get ( self::TABLE );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get footer by id
	public function getFooterById($id) {
		$query = $this->db->get_where ( self::TABLE, array (
				"common_id" => $id 
		) );
		if ($query->num_rows > 0)
			return $query->result();
		return false;
	}
	
	// set footers order
	public function setFootersOrder($orders = array()) {
		foreach ( $orders as $id => $order ) {
			$this->db->where ( "common_id", $id );
			$this->db->update ( self::TABLE, array (
					"order" => $order 
			) );
		}
	}
	
	// check footer title exist for modify footer
	public function checkTitleExist($id, $title) {
		$query = $this->db->get_where ( self::TABLE, array (
				"title" => $title ,
				"common_id != " => $id
		) );
		if ($query->num_rows () > 0) {
			return false;
		}
		return true;
	}
	
	/*
	 * get footers position array containg keys 1, 2, 3 refer to title left, center, and right
	 */
	public function getPositionArray() {
		return array (
				"0" => lang ( "no_position" ),
				"1" => lang ( "left" ),
				"2" => lang ( "center" ),
				"3" => lang ( "right" ) 
		);
	}
	
	// get title of footer position order key
	public function getPositionByArrayKey($position_key) {
		$footers = $this->getPositionArray ();
		return $footers [$position_key];
	}
	
	//get footer titles from database and return array with them
	public function getFooterTitles(){
		$this->db->like("title", self::TABLE);
		$query = $this->db->get("langs_titles");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//update footer titles
	public function updateTitles($lang, $title, $text){
		$this->db->where(array("lang" => $lang, "title" => $title));
		return $this->db->update("langs_titles", array("text" => $text));
	}
	
	//get new common id
	public function getCommonId(){
		$this->db->select("common_id");
		$this->db->order_by("common_id", "desc");
		$query = $this->db->get(self::TABLE);
		if($query->num_rows()>0){
			$row = $query->row();
			return $row->common_id+1;
		}
		return false;
	}
}