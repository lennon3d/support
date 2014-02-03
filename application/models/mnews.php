<?php
class MNews extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	const TABLE = "news";
	// insert new new
	public function insertNew($atts = array()) {
		return $this->db->insert ( self::TABLE, $atts );
	}
	
	// modify an existed new
	public function modifyNew($id, $lang, $atts = array()) {
		$this->db->where(array("common_id" => $id, "lang" => $lang));
		return $this->db->update ( self::TABLE, $atts );
	}
	
	// delete an existed new
	public function deleteNew($id) {
		$this->db->where ( "common_id", $id );
		return $this->db->delete ( self::TABLE );
	}
	
	// get all news
	public function getAllNews() {
		$this->db->where("lang", $this->mfunctions->getDefCode());
		$query = $this->db->get ( self::TABLE );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get new by id
	public function getNewById($id) {
		$query = $this->db->get_where ( self::TABLE, array (
				"common_id" => $id 
		) );
		if ($query->num_rows > 0)
			return $query->result ();
		return false;
	}
	
	// set news order
	public function setNewsOrder($orders = array()) {
		foreach ( $orders as $id => $order ) {
			$this->db->where ( "common_id", $id );
			$this->db->update ( self::TABLE, array (
					"order" => $order 
			) );
		}
	}
	
	// check new title exist for modify new
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
	
	// get position from array
	public function getPosition($pos) {
		$array = array (
				"1" => "سلايدر",
				"2" => "يمين أسفل",
				"3" => "قائمة يسرى" 
		);
		return $array[$pos];
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