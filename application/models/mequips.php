<?php
class MEquips extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	//get equipments pages from database and return array with them
	public function getEquips(){
		$query = $this->db->get("equipments");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//update equipments pages
	public function updateEquips($atts=array()){
		foreach($atts as $lang=>$eq){
			$this->db->where("lang", $lang);
			$this->db->update("equipments", array(
				"title" => $eq["title"],
					"content" => $eq["content"]
			));
		}
		return true;
	}
	
}