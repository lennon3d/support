<?php
class MVideos extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}

	const TABLE = "videos";
	
	//insert new video
	public function insertVideo($atts=array()){
		return $this->db->insert(self::TABLE, $atts);
	}
	
	//modify an existed video
	public function modifyVideo($id, $lang, $atts=array()){
		$this->db->where(array("common_id" => $id, "lang" => $lang));
		return $this->db->update(self::TABLE, $atts);
	}
	
	//delete an existed video
	public function deleteVideo($id){
		$this->db->where("common_id", $id);
		return $this->db->delete(self::TABLE);
	}
	
	//get all videos
	public function getAllVideos(){
		$this->db->where("lang", $this->mfunctions->getDefCode());
		$query = $this->db->get(self::TABLE);
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get video by id
	public function getVideoById($id){
		$query = $this->db->get_where(self::TABLE, array("common_id"=>$id));
		if($query->num_rows > 0)
			return $query->result();
		return false;
	}
	
	//set videos order
	public function setVideosOrder($orders=array()){
		foreach($orders as $id=>$order){
			$this->db->where("common_id", $id);
			$this->db->update(self::TABLE, array("order" => $order));
		}
	}
	
	// check video title exist for modify video
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