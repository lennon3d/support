<?php
class MSlider extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}

	//insert new slide
	public function insertSlide($atts=array()){
		return $this->db->insert("slider", $atts);
	}
	
	//modify an existed slide
	public function modifySlide($id, $atts=array()){
		$this->db->where("id", $id);
		return $this->db->update("slider", $atts);
	}
	
	//delete an existed slide
	public function deleteSlide($id){
		$this->db->where("id", $id);
		return $this->db->delete("slider");
	}
	
	//get all products
	public function getAllSlides(){
		$query = $this->db->get("slider");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get product by id
	public function getSlideById($id){
		$query = $this->db->get_where("slider", array("id"=>$id));
		if($query->num_rows==1)
			return $query->row();
		return false;
	}
	
	//set slider order
	public function setSlidesOrder($orders=array()){
		foreach($orders as $id=>$order){
			$this->db->where("id", $id);
			$this->db->update("slider", array("order" => $order));
		}
	}
	
	// check slide photo url exist for modify page
	public function checkPhotoUrlExist($id, $url) {
		$query = $this->db->get_where ( "slider", array (
				"photo_url" => $url
		) );
		$slide1 = $this->getSlideById ( $id );
		if ($query->num_rows () > 0) {
			$slide = $query->row ();
			if ($slide->photo_url == $slide1->photo_url)
				return true;
			return false;
		}
		return true;
	}
	

}