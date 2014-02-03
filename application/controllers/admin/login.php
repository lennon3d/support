<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Login extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model("mfunctions");
		$this->lang->load ( "arabic", "arabic" );
		if ($this->session->userdata ( 'validated' )) {
			redirect ( base_url () . 'admin' );
		}
	}
	public function index($msg = NULL) {
		// Load our view to be displayed
		// to the user
		$data ['msg'] = $msg;
		$this->load->view ( 'admin/login', $data );
	}
	public function process() {
		// Validate the user can login
		$result = $this->mfunctions->validate ();
		// Now we verify the result
		if (! $result) {
			// If user did not validate, then show them login page again
			$msg = lang ( "invalid_login" );
			$this->index ( $msg );
		} else {
			// If user did validate,
			// Send them to members area
			redirect ( base_url () . 'admin' );
		}
	}
}
