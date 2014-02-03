<?php
class MReports extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}

	// bring sms reports
	public function getSmsReports() {
		$query = $this->db->get ( "smsreport" );
		if ($query->num_rows > 0)
			return $query->result ();
		return false;
	}

	//get whatsapp acrchive
	public function getWhatsArchive($limit = "all", $offset = 0, $atts = array()){
	    if ($limit != "all")
	        $this->db->limit ( $limit, $offset );
	    if($atts["user"] != ""){
	        $user = $this->musers->getUserByUsername($atts["user"]);
	        $user_id = "";
	        if($user)
	            $user_id = $user->id;
	        $this->db->where("user_id", $user_id);
	    }
	    if($atts["nickname"] != ""){
	        $this->db->like("nickname", $atts["nickname"]);
	    }
	    if($atts["status"] != ""){
	        $this->db->where("status", $atts["status"]);
	    }
	    if($atts["number"] != ""){
	        $this->db->where("number", $atts["number"]);
	    }
	    if($atts["message"] != ""){
	        $this->db->like("message", $atts["message"]);
	    }

	    $query = $this->db->get( "whats_archive");
	    if ($query->num_rows () > 0){
	        if($atts["user"] != ""){
	            $user = $this->musers->getUserByUsername($atts["user"]);
	            $user_id = "";
	            if($user)
	                $user_id = $user->id;
	            $this->db->where("user_id", $user_id);
	        }
	       if($atts["status"] != ""){
	        $this->db->where("status", $atts["status"]);
	    }
	       if($atts["message"] != ""){
	        $this->db->like("message", $atts["message"]);
	    }
	    if($atts["nickname"] != ""){
	        $this->db->like("nickname", $atts["nickname"]);
	    }
	    if($atts["number"] != ""){
	        $this->db->where("number", $atts["number"]);
	    }
	        $query1 = $this->db->get( "whats_archive");
	        return array (
	            "results" => $query->result (),
	            "count" => $query1->num_rows ()
	        );
	    }
	    return false;
	}

	// get sms report by id
	public function getSmsReportById($report_id) {
		$query = $this->db->get_where ( "smsreport", array (
				"id" => $report_id
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}

	// bring email reports
	public function getEmailReports() {
		$query = $this->db->get ( "emailreport" );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}

	// get email report by id
	public function getEmailReportById($report_id) {
		$query = $this->db->get_where ( "emailreport", array (
				"id" => $report_id
		) );
		if ($query->num_rows () > 0)
			return $query->row ();
		return false;
	}

	// bring users action reports
	public function getActionsReports($atts = array()) {
		$query = $this->db->get_where ( "actions", $atts );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}

	// delete sms report
	public function deleteSmsReport($report_id) {
		$this->db->where ( "id", $report_id );
		return $this->db->delete ( "smsreport" );
	}

	// delete email report
	public function deleteEmailReport($report_id) {
		$this->db->where ( "id", $report_id );
		return $this->db->delete ( "emailreport" );
	}

	// delete user action report
	public function deleteActionReport($report_id) {
		$this->db->where ( "id", $report_id );
		return $this->db->delete ( "actions" );
	}

	// get daily visits
	public function getDailyVisits() {
		$query = $this->db->get ( "visits" );
		if ($query->num_rows () > 0)
			return $query->result ();
		return false;
	}

	//delete visit report
	public function deleteVisitReport($report_id){
		$this->db->where("id", $report_id);
		return $this->db->delete("visits");
	}

	// get arabic days array
	public function dayReplace($date) {
		$en_days = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
		$ar_days = array("الاثنين","الثلاثاء","الأربعاء","الخميس","الجمعة","السبت","الأحد");
		$en_monthes = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		$ar_monthes = array("يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر");
		$new_date = str_replace($en_days, $ar_days, $date);
		return str_replace($en_monthes, $ar_monthes, $new_date);
	}

}