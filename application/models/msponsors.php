<?php
class MSponsors extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	const TABLE = "sponsors";
	
	//insert new sponser
	public function insertSponsor($atts=array()){
		return $this->db->insert(self::TABLE, $atts);
	}
	
	//modify an existed sponsor
	public function modifySponsor($id, $lang, $atts=array()){
		$this->db->where(array("common_id" => $id, "lang" => $lang));
		return $this->db->update(self::TABLE, $atts);
	}
	
	//delete an existed sponsor
	public function deleteSponsor($id){
		$this->db->where("common_id", $id);
		return $this->db->delete(self::TABLE);
	}
	
	//get all sponsors
	public function getAllSponsors(){
		$this->db->where("lang", $this->mfunctions->getDefCode());
		$query = $this->db->get(self::TABLE);
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get sponsor by id
	public function getSponsorById($id){
		$query = $this->db->get_where(self::TABLE, array("common_id"=>$id));
		if($query->num_rows>0)
			return $query->result();
		return false;
	}
	
	//set sponsors order
	public function setSponsorsOrder($orders=array()){
		foreach($orders as $id=>$order){
			$this->db->where("common_id", $id);
			$this->db->update(self::TABLE, array("order" => $order));
		}
	}
	
	// check page title exist for modify sponsor
	public function checkTitleExist($id, $title) {
		$query = $this->db->get_where ( self::TABLE, array (
				"title" => $title,
				"common_id != " => $id
		) );
		if($query->num_rows() > 0)
			return false;
		return true;
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