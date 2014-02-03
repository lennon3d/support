<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin reports controller
class Reports extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mreports" );
	}

	public function index() {
		$data ["target"] = "";
		$this->load->view ( "admin/index", $data );
	}

	//show whatsapp archive
	public function whatsArchive(){
	    //if ($this->permissions->actions ["see"] != "1")
	        //$this->mfunctions->noPermission ();
	    if (isset ( $_POST ["archive"] )) {
	        foreach ( $_POST ["archive"] as $report ) {
	            $this->db->where ( "id", $report );
	            $this->db->delete ( "whats_archive" );
	        }
	        $this->mfunctions->actionReport ( "reports", "delete_whats_archive" );
	        $this->session->set_userdata ( array (
	            "msg" => 1
	        ) );
	        redirect ( base_url () . "admin/reports/whatsArchive", "refresh" );
	    }
	    $page = ($this->input->get_post ( "page_num" ) ? trim ( $this->input->get_post ( "page_num" ) ) : 0);
	    $limit = ($this->input->get_post ( "limit" ) ? trim ( $this->input->get_post ( "limit" ) ) : 25);
	    $status = ($this->input->get("status")? trim($this->input->get("status")): "");
	    $number = ($this->input->get("number")? trim($this->input->get("number")): "");
	    $message = ($this->input->get("message")? trim($this->input->get("message")): "");
	    $nickname = ($this->input->get("nickname")? trim($this->input->get("nickname")): "");
	    $user = ($this->input->get("user")? trim($this->input->get("user")): "");
	    $atts = array("status" => $status, "message" => $message, "user" => $user, "number" => $number, "nickname" => $nickname);
	    $reports = $this->mreports->getWhatsArchive( $limit, $limit * $page, $atts );
	    $data ["archive"] = $reports;
	    $data ["status"] = $status;
	    $data ["number"] = $number;
	    $data ["nickname"] = $nickname;
	    $data ["message"] = $message;
	    $data ["user"] = $user;
	    $data ["limit"] = $limit;
	    $data ["page_num"] = $page;
	    $data ["target"] = "whats_archive";
	    $this->load->view ( "admin/index", $data );
	}

	// show sms reports
	public function smsReports() {
		if ($this->permissions->sms_reports ["see"] != "1")
			$this->mfunctions->noPermission();
		$reports = $this->mreports->getSmsReports ();
		$data ["sms_reports"] = $reports;
		$data ["target"] = "sms_reports";
		$this->load->view ( "admin/index", $data );
	}

	// delete sms report
	public function deleteSmsReport($report_id = "") {
		if ($report_id != "") {
			$this->db->where ( "id", $report_id );
			$this->db->delete ( "smsreport" );
			$this->mfunctions->actionReport ( "reports", "delete_sms_report" );
		}

		$this->session->set_userdata ( array (
				"msg" => 1
		) );
		redirect ( base_url () . "admin/reports/smsReports", "refresh" );
	}

	// delete sms reports
	public function deleteSmsReports() {
		if (isset ( $_POST ["reports"] )) {
			foreach ( $_POST ["reports"] as $report ) {
				$this->db->where ( "id", $report );
				$this->db->delete ( "smsreport" );
			}
			$this->mfunctions->actionReport ( "reports", "delete_sms_reports" );
		}
		$this->session->set_userdata ( array (
				"msg" => 1
		) );
		redirect ( base_url () . "admin/reports/smsReports", "refresh" );
	}

	// show mobiles of sms report
	public function showMobiles($report_id = "") {
		if ($report_id != "") {
			$report = $this->mreports->getSmsReportById ( $report_id );
			$data ["report"] = $report;
			$data ["target"] = "report_mobiles";
			$this->load->view ( "admin/index", $data );
		} else {
			redirect ( base_url () . "admin/reports/smsReports", "refresh" );
		}
	}

	// show emails reports
	public function emailReports() {
		if ($this->permissions->email_reports ["see"] != "1")
			$this->mfunctions->noPermission();
		$reports = $this->mreports->getEmailReports ();
		$data ["email_reports"] = $reports;
		$data ["target"] = "email_reports";
		$this->load->view ( "admin/index", $data );
	}

	// show reports of sms report
	public function showEmails($report_id = "") {
		if ($report_id != "") {
			$report = $this->mreports->getEmailReportById ( $report_id );
			$data ["report"] = $report;
			$data ["target"] = "report_emails";
			$this->load->view ( "admin/index", $data );
		} else {
			redirect ( base_url () . "admin/reports/emailReports", "refresh" );
		}
	}

	// delete email report
	public function deleteEmailReport($report_id = "") {
		if ($report_id != "") {
			$this->db->where ( "id", $report_id );
			$this->db->delete ( "emailreport" );
			$this->mfunctions->actionReport ( "reports", "delete_email_report" );
		}

		$this->session->set_userdata ( array (
				"msg" => 1
		) );
		redirect ( base_url () . "admin/reports/emailReports", "refresh" );
	}

	// delete email reports
	public function deleteEmailReports() {
		if (isset ( $_POST ["reports"] )) {
			foreach ( $_POST ["reports"] as $report ) {
				$this->db->where ( "id", $report );
				$this->db->delete ( "emailreport" );
			}
			$this->mfunctions->actionReport ( "reports", "delete_email_reports" );
		}
		$this->session->set_userdata ( array (
				"msg" => 1
		) );
		redirect ( base_url () . "admin/reports/emailReports", "refresh" );
	}

	// show users actions reports
	public function actionsReports() {
		if ($this->permissions->actions ["see"] != "1")
			$this->mfunctions->noPermission();
		if (isset ( $_GET ["user"] ))
			$reports = $this->mreports->getActionsReports ( array (
					"user" => $_GET ["user"]
			) );
		else
			$reports = $this->mreports->getActionsReports ();
		$data ["actions"] = $reports;
		$data ["target"] = "user_actions";
		$this->load->view ( "admin/index", $data );
	}

	// delete action report
	public function deleteActionReport($report_id = "") {
		if ($report_id != "") {
			$this->db->where ( "id", $report_id );
			$this->db->delete ( "actions" );
			$this->mfunctions->actionReport ( "reports", "delete_action_report" );
		}

		$this->session->set_userdata ( array (
				"msg" => 1
		) );
		redirect ( base_url () . "admin/reports/actionsReports", "refresh" );
	}

	// delete actions reports
	public function deleteActionReports() {
		if (isset ( $_POST ["reports"] )) {
			foreach ( $_POST ["reports"] as $report ) {
				$this->db->where ( "id", $report );
				$this->db->delete ( "actions" );
			}
			$this->mfunctions->actionReport ( "reports", "delete_action_reports" );
		}
		$this->session->set_userdata ( array (
				"msg" => 1
		) );
		redirect ( base_url () . "admin/reports/actionsReports", "refresh" );
	}

	// delete visit report
	public function deleteVisitReport($report_id = "") {
		if ($report_id != "") {
			$this->db->where ( "id", $report_id );
			$this->db->delete ( "visits" );
			$this->mfunctions->actionReport ( "reports", "delete_visit_report" );
		}

		$this->session->set_userdata ( array (
				"msg" => 1
		) );
		redirect ( base_url () . "admin/reports/visits", "refresh" );
	}

	// delete visits reports
	public function deleteVisitReports() {
		if (isset ( $_POST ["reports"] )) {
			foreach ( $_POST ["reports"] as $report ) {
			$this->db->where ( "id", $report );
			$this->db->delete ( "visits" );
			}
			$this->mfunctions->actionReport ( "reports", "delete_visit_reports" );
		}
		$this->session->set_userdata ( array (
				"msg" => 1
		) );
		redirect ( base_url () . "admin/reports/visits", "refresh" );
	}

	// show daily visits report
	public function visits() {
		$reports = $this->mreports->getDailyVisits ();
		$data ["visits"] = $reports;
		$data ["target"] = "visits";
		$this->load->view ( "admin/index", $data );
	}
}