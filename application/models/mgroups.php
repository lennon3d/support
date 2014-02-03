<?php
class MGroups extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}

	//get all email subscribers
	public function getEmailSub(){
		$query = $this->db->get_where("subscribers", array("email != " => ""));
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}

	//get all mobile subscribers
	public function getMobileSub(){
		$query = $this->db->get_where("subscribers", array("mobile != " => ""));
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}

	//insert new subscriber
	public function insertSub($atts = array()){
		$atts += array("datetime" => time());
		return $this->db->insert("subscribers", $atts);
	}

	//get subscriber from excel file
	public function importFromExcel(){
		$this->load->library('excel');
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load("./assets/uploads/sub.xlsx");
		$objWorksheet = $objPHPExcel->getActiveSheet();
		static $array=array();
		static $out_array = array();
		$rows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
		foreach ($objWorksheet->getRowIterator() as $row) {
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false);
			foreach ($cellIterator as $cell) {
				if($cell->getValue()!="")
					array_push($array,$cell->getValue());
			}
			array_push($out_array, $array);
			$array = array();
		}
		return $out_array;
	}

	//get subscribers form text file
	public function importFromText($sep){
		static $out_array = array();
		$file = file_get_contents("./assets/uploads/sub.txt");
		$file_array = explode("\n", $file);
		foreach($file_array as $key=>$value){
			$line = explode($sep, $value);
			if(count($line)==2)
			array_push($out_array, array($line[0],$line[1]));
		}

		return $out_array;
	}

	//delete an existed  subscriber
	public function deleteSub($id){
		$this->db->where("id", $id);
		return $this->db->delete("subscribers");
	}

	//check if email existed in database
	public function checkEmail($email){
		$query = $this->db->get_where("subscribers", array("email" => $email));
		if($query->num_rows()>0)
			return false;
		return true;
	}

	//check if mobile number existed in database
	public function checkMobile($mobile){
		$query = $this->db->get_where("subscribers", array("mobile" => $mobile));
		if($query->num_rows()>0)
			return false;
		return true;
	}

	//get subscribers emails
	public function getSubEmails($sub){
		$subs = $this->db->get_where("subscribers", array());
	}

	//get subscriber by id
	public function getSubById($sub_id){
		$query = $this->db->get_where("subscribers", array("id" => $sub_id));
		if($query->num_rows()>0)
			return $query->row();
		return false;
	}


}