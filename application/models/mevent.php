<?php
class MEvent extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}

	const TABLE = "event";
	
	//insert new event
	public function insertEvent($atts=array()){
		return $this->db->insert(self::TABLE, $atts);
	}
	
	//modify an existed event
	public function modifyEvent($id, $lang, $atts=array()){
		$this->db->where(array("common_id" => $id, "lang" => $lang));
		return $this->db->update(self::TABLE, $atts);
	}
	
	//delete an existed event
	public function deleteEvent($id){
		$this->db->where("common_id", $id);
		return $this->db->delete(self::TABLE);
	}
	
	//get all Events
	public function getAllEvents(){
		$this->db->where("lang", $this->mfunctions->getDefCode());
		$query = $this->db->get(self::TABLE);
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get event by id
	public function getEventById($id){
		$query = $this->db->get_where(self::TABLE, array("common_id"=>$id));
		if($query->num_rows > 0)
			return $query->result();
		return false;
	}
	
	//get default lang event by id
	public function getDefEventById($id){
		$this->db->where("lang", $this->mfunctions->getDefCode());
		$this->db->where("common_id", $id);
		$query = $this->db->get(self::TABLE);
		if($query->num_rows()>0)
			return $query->row();
		return false;
	}
	
	//set event order
	public function setEventsOrder($orders=array()){
		foreach($orders as $id=>$order){
			$this->db->where("common_id", $id);
			$this->db->update(self::TABLE, array("order" => $order));
		}
	}
	
	// check event title exist for modify event
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