<?php
class MServices extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	const TABLE = "services";
	// insert new service
	public function insertService($atts = array()) {
		return $this->db->insert ( self::TABLE, $atts );
	}
	
	// modify an existed service
	public function modifyService($id, $lang, $atts = array()) {
		$this->db->where(array("common_id" => $id, "lang" => $lang));
		return $this->db->update ( self::TABLE, $atts );
	}
	
	// delete an existed service
	public function deleteService($id) {
		$this->db->where ( "common_id", $id );
		return $this->db->delete ( self::TABLE );
	}
	
	// get all services
	public function getAllServices() {
		$this->db->where("lang", $this->mfunctions->getDefCode());		
		$query = $this->db->get ( self::TABLE );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get service by id
	public function getServiceById($id) {
		$query = $this->db->get_where ( self::TABLE, array (
				"common_id" => $id 
		) );
		if ($query->num_rows > 0)
			return $query->result ();
		return false;
	}
	
	// set services order
	public function setServicesOrder($orders = array()) {
		foreach ( $orders as $id => $order ) {
			$this->db->where ( "common_id", $id );
			$this->db->update ( self::TABLE, array (
					"order" => $order 
			) );
		}
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