<?php
class MNotify extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	//get all notification messages
	public function getNotifyMessages(){
		$query = $this->db->get("notifymessages");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//set notification messages
	public function setNotifyMessages($atts = array()){
		foreach($atts as $key => $values){
			$this->db->where("type", $key);
			$this->db->update("notifymessages", array("message" => $values["message"], "active" => $values["active"]));
		}
	}
	
	//get notify messages types with active status
	public function getNotifyStatus(){
		$query = $this->db->get('notifymessages');
		static $array = array();
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$array+=array($row->type => array($row->active,$row->message));
			}
			return $array;
		}
		return false;
						
	}
	
	
	
}