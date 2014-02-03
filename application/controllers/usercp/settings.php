<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// site main
class Settings extends SiteController {
	function __construct() {
		parent::__construct ();
	}

	public function index(){
        $data["target"] = "settings";
        $this->load->view("site/cp/index", $data);
	}
}