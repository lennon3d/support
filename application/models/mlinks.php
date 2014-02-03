<?php
class MLinks extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	const TABLE = "links";
	//insert new link
	public function insertLink($atts=array()){
		return $this->db->insert(self::TABLE, $atts);
	}
	
	//modify an existed link
	public function modifyLink($id, $lang, $atts=array()){
		$this->db->where(array("common_id" => $id, "lang" => $lang));
		$this->db->update(self::TABLE, $atts);
	}
	
	//delete an existed link
	public function deleteLink($id){
		$this->db->where("common_id", $id);
		return $this->db->delete(self::TABLE);
	}
	
	//get all links
	public function getAllLinks(){
		$this->db->where("lang", $this->mfunctions->getDefCode());
		$query = $this->db->get(self::TABLE);
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get link by id
	public function getLinkById($id){
		$query = $this->db->get_where(self::TABLE, array("common_id"=>$id));
		if($query->num_rows > 0)
			return $query->result();
		return false;
	}
	
	//set links order
	public function setLinksOrder($orders=array()){
		foreach($orders as $id=>$order){
			$this->db->where("common_id", $id);
			$this->db->update(self::TABLE, array("order" => $order));
		}
	}
	
	// check link title exist for modify link
	public function checkTitleExist($id, $title) {
		$query = $this->db->get_where ( self::TABLE, array (
				"title" => $title,
				"common_id != " => $id
		) );
		if ($query->num_rows () > 0) {
			return false;
		}
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