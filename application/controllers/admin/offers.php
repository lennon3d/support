<?php if (! defined ( 'BASEPATH' ))	exit ( 'No direct script access allowed' );
	// admin offers controller
class Offers extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "moffers" );
	}
	
	public function index() {
		if ($this->permissions->gallery ["see"] != "1")
			$this->mfunctions->noPermission();
		$offers = $this->moffers->getAllOffers();
		$data ["offers"] = $offers;
		$data ["target"] = "offers";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new offer
	public function insert() {
		if ($this->permissions->offers ["create"] != "1")
			$this->mfunctions->noPermission();
		foreach($this->_LANGS as $lang){
			$data["post"]["title_$lang->code"] = "";
			$data["post"]["thumb_$lang->code"] = "";
			$data["post"]["subtitle_$lang->code"] = "";
			$data["post"]["country_$lang->code"] = "";
			$data["post"]["city_$lang->code"] = "";
			$data["post"]["url_$lang->code"] = "";
			$data["post"]["desc_$lang->code"] = "";
			$data["post"]["status_$lang->code"] = "";
		}
		$data["countries"] = $this->mfunctions->getCountries();
		$data["pages"] = $this->mfunctions->getALlPages();
		if ($_POST) {
			$common_id = $this->moffers->getCommonId();
			foreach($_POST as $key => $value){
				$data["post"][$key] = $value;
			}
			foreach($this->_LANGS as $lang)
				$data["post"]["cities_$lang->code"] = $this->mfunctions->getCountryCities($_POST["country_$lang->code"]);
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			foreach($this->_LANGS as $lang){
				$this->form_validation->set_rules ( 'title_'.$lang->code, $lang->language ." - " . lang ( 'enter_offer_title' ), 'trim|required|is_unique[offers.title]' );
			}
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_offer";
				$this->load->view ( "admin/index", $data );
			} else {
				foreach($this->_LANGS as $lang){
					$query = $this->moffers->insertOffer( array (
						"title" => trim($_POST ["title_$lang->code"]),
						"desc" => trim($_POST ["desc_$lang->code"]),
						"thumb" => trim($_POST ["thumb_$lang->code"]),
						"subtitle" => trim($_POST ["subtitle_$lang->code"]) ,
						"city" => trim($_POST ["city_$lang->code"]) ,
						"url" => trim($_POST ["url_$lang->code"]) ,
						"lang" => $lang->code,
						"common_id" => $common_id,
						"order" => 0 ,
						"status" => (isset($_POST["status_$lang->code"])?1:0)								
					) );
				}
				if ($query > 0)
					$this->mfunctions->actionReport ( "offers", "insert" );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/offers", "refresh" );
			}
		} else {
			$data ["target"] = "insert_offer";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed offer  
	public function modify($offer_id, $atts = array()) {
		if ($this->permissions->offers ["modify"] != "1")
			$this->mfunctions->noPermission();
		if ($offer_id != "") {
			$data["pages"] = $this->mfunctions->getALlPages();
			$offer = $this->moffers->getOfferById ( $offer_id );
			if ($offer) {
				$data ["offer"] = $offer;
				if ($_POST) {
					$this->form_validation->set_message ( 'required', "%s" );
					foreach($this->_LANGS as $lang){
						$this->form_validation->set_rules ( 'title_'.$lang->code, lang ( 'enter_offer_title' )." - " . $lang->language, "trim|required|callback_checkTitleExist[$offer_id]" );
					}
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_offer";
						$this->load->view ( "admin/index", $data );
					} else {
						foreach($this->_LANGS as $lang){
							$query = $this->moffers->modifyOffer ( $offer_id, $lang->code, array (
								"title" => trim($_POST ["title_$lang->code"]),
								"desc" => trim($_POST ["desc_$lang->code"]),
								"thumb" => trim($_POST ["thumb_$lang->code"]),
								"subtitle" => trim($_POST ["subtitle_$lang->code"]) ,
								"city" => trim($_POST ["city_$lang->code"]) ,
								"url" => trim($_POST ["url_$lang->code"]) ,
								"status" => (isset($_POST["status_$lang->code"])?1:0)	
							) );
						}
						if ($query > 0)
							$this->mfunctions->actionReport ( "offers", "modify" );
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/offers", "refresh" );
					}
				} else {
					$data ["target"] = "modify_offer";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed offer
	public function delete($offer_id) {
		if ($this->permissions->offer ["delete"] != "1")
			$this->mfunctions->noPermission();
		if ($photo_id != "") {
			$query = $this->moffers->deleteOffer ( $offer_id);
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if ($query > 0)
				$this->mfunctions->actionReport ( "offers", "delete" );
			redirect ( base_url () . "admin/offers", "refresh" );
		}
	}
	
	// check offer title exist for offer 
	public function checkTitleExist($title, $offer_id) {
		$request = $this->moffers->checkTitleExist ( $offer_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// set offers order
	public function setOrder() {
		if ($_POST) {
			$this->moffers->setOffersOrder ( $_POST ["offer"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
			$this->mfunctions->actionReport ( "offers", "set_order" );
			redirect ( base_url () . "admin/offers", "refresh" );
		}
	}
	
	//get country cities
	public function getCountryCities(){
		if(isset($_GET["country_id"])){
			$cities = $this->mfunctions->getCountryCities($_GET["country_id"]);
			if($cities){
				exit(json_encode($cities));
			}
		}
		exit(false);
	}
}