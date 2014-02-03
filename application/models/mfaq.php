<?php
class MFaq extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}

	const TABLE = "faq";
	
	//insert new faq question
	public function insertFaq($atts=array()){
		return $this->db->insert(self::TABLE, $atts);
	}
	
	//modify an existed faq
	public function modifyFaq($id, $lang, $atts=array()){
		$this->db->where(array("common_id" => $id, "lang" => $lang));
		return $this->db->update(self::TABLE, $atts);
	}
	
	//delete an existed faq
	public function deleteFaq($id){
		$this->db->where("common_id", $id);
		return $this->db->delete(self::TABLE);
	}
	
	//get all Faqs
	public function getAllFaqs(){
		$this->db->where("lang", $this->mfunctions->getDefCode());
		$query = $this->db->get(self::TABLE);
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get Faq by id
	public function getFaqById($id){
		$query = $this->db->get_where(self::TABLE, array("common_id"=>$id));
		if($query->num_rows > 0)
			return $query->result();
		return false;
	}
	
	//get default lang Faq by id
	public function getDefNavById($id){
		$this->db->where("lang", $this->mfunctions->getDefCode());
		$this->db->where("common_id", $id);
		$query = $this->db->get(self::TABLE);
		if($query->num_rows()>0)
			return $query->row();
		return false;
	}
	
	//set Faq questions order
	public function setFaqsOrder($orders=array()){
		foreach($orders as $id=>$order){
			$this->db->where("common_id", $id);
			$this->db->update(self::TABLE, array("order" => $order));
		}
	}
	
	// check Faq title exist for modify Faq question
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