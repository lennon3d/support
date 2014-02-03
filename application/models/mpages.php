<?php
class MPages extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	const TABLE = "pages";
	
	//insert new page
	public function insertPage($atts=array()){
		return $this->db->insert(self::TABLE, $atts);
	}
	
	//get all pages
	public function getAllPages(){
		$this->db->where("lang", $this->mfunctions->getDefCode());
		$query = $this->db->get(self::TABLE);
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get an existed page by id
	public function getPageById($id){
		$this->db->where("common_id",$id);
		$query = $this->db->get(self::TABLE);
		if($query->num_rows > 0)
			return $query->result();
		return false;
	}
	
	//modify an existed page
	public function modifyPage($id, $lang, $atts=array()){
		$this->db->where(array("common_id" => $id, "lang" => $lang));
		return $this->db->update(self::TABLE, $atts);
	}
	
	//delete an existed page (this will delete all the comments of the page)
	public function deletePage($id){
		$this->db->where ( "page", $id);
		$this->db->delete ( "comments" );
		$this->db->where ( "common_id", $id );
		return $this->db->delete(self::TABLE);
	}
	
	//get page by title
	public function getPageByTitle($title){
		$query = $this->db->get_where(self::TABLE, array("title" => $title));
		if($query->num_rows()==0){
			return $query->row();
		}return false;
	}
	
	// check page title exist for modify page
	public function checkTitleExist($id, $title) {
		$query = $this->db->get_where ( self::TABLE, array (
				"title" => $title
		) );
		$page1 = $this->getPageById ( $id );
		if ($query->num_rows () > 0) {
			$page = $query->row ();
			if ($page->title == $page1->title)
				return true;
			return false;
		}
		return true;
	}
	
	//insert new comment to an exited page
	public function insertComment($page_id, $atts=array()){
		$atts += array("ipaddress" => $_SERVER['REMOTE_ADDR']);
		return $this->db->insert("comments", $atts);
	}
	
	//modify an existed comment
	public function modifyComment($comment_id, $atts=array()){
		$atts += array("ipaddress" => $_SERVER['REMOTE_ADDR']);
		$this->db->where("id", $comment_id);
		return $this->db->update("comments", $atts);
	}
	
	//delete an existed comment
	public function deleteComment($comment_id){
		$this->db->where("id", $comment_id);
		return $this->db->delete("comments");
	}
	
	//get all comments of an existed page
	public function getAllPageComments($page_id){
		$query = $this->db->get_where("comments", array("page" => $page_id));
		if($query->num_rows()>0)
			return $query->result();
		return false;
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