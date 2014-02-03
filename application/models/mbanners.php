<?php
class MBanners extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	const TABLE = "banners";
	// insert new banner
	public function insertBanner($atts = array()) {
		return $this->db->insert ( self::TABLE, $atts );
	}
	
	// modify an existed banner
	public function modifyBanner($id, $lang, $atts = array()) {
		$this->db->where(array("common_id" => $id, "lang" => $lang));
		return $this->db->update ( self::TABLE, $atts );
	}
	
	// delete an existed banner
	public function deleteBanner($id) {
		$this->db->where ( "common_id", $id );
		return $this->db->delete ( self::TABLE );
	}
	
	// get all banners
	public function getAllBanners() {
		$this->db->where("lang", $this->mfunctions->getDefCode());		
		$query = $this->db->get ( self::TABLE );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}
	
	// get banner by id
	public function getBannerById($id) {
		$query = $this->db->get_where ( self::TABLE, array (
				"common_id" => $id 
		) );
		if ($query->num_rows > 0)
			return $query->result ();
		return false;
	}
	
	// set banners order
	public function setBannersOrder($orders = array()) {
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