<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	// admin products controller
class Products extends AdminController {
	function __construct() {
		parent::__construct ();
		$this->load->model ( "mproducts" );
	}
	
	public function index($cat_id="") {
		if ($this->permissions->products ["products_see"] != "1")
			$this->mfunctions->noPermission();
		$products = $this->mproducts->getAllProducts ();
		$data ["products"] = $products;
		if($cat_id!=""){
			$data["products"] = $this->mproducts->getCatProducts($cat_id);
		}
		$data ["target"] = "products";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new product
	public function insertProduct() {
		if ($this->permissions->products ["products_create"] != "1")
			$this->mfunctions->noPermission();
		$data ["langs"] = $this->mfunctions->getAllLangs ();
		$data["cats"] = $this->mproducts->getAllCats();
		if ($_POST) {
			$active = (isset ( $_POST ["active"] ) ? "1" : "0");
			$in_slider = (isset ( $_POST ["in_slider"] ) ? "1" : "0");
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			$this->form_validation->set_rules ( 'title', lang ( 'enter_product_title' ), 'required|is_unique[products.title]' );
			$this->form_validation->set_rules ( 'category', lang ( 'choose_cat' ), "required" );
			$this->form_validation->set_rules ( 'subtitle', lang ( 'enter_product_subtitle' ), 'required' );
			$this->form_validation->set_rules ( 'year', lang ( 'enter_product_year' ), 'required' );
			$this->form_validation->set_rules ( 'director', lang ( 'enter_product_director' ), 'required' );
			$this->form_validation->set_rules ( 'editor', lang ( 'enter_product_editor' ), 'required' );
			$this->form_validation->set_rules ( 'thumb', lang ( 'choose_thumb' ), 'required' );
			$this->form_validation->set_rules ( 'actors', lang ( 'enter_product_actors' ), 'required' );
			$this->form_validation->set_rules ( 'country', lang ( 'enter_product_country' ), 'required' );
			$this->form_validation->set_rules ( 'copyrights', lang ( 'enter_product_copyrights' ), 'required' );
			$this->form_validation->set_rules ( 'description', lang ( 'enter_product_description' ), 'required' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_product";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->mproducts->insertProduct ( array (
						"category" => $_POST ["category"],
						"title" => $_POST ["title"],
						"subtitle" => $_POST ["subtitle"],
						"year" => $_POST ["year"],
						"director" => $_POST ["director"],
						"editor" => $_POST ["editor"],
						"actors" => $_POST ["actors"],
						"country" => $_POST ["country"],
						"copyrights" => $_POST ["copyrights"],
						"description" => $_POST ["description"],
						"lang" => $_POST ["language"],
						"thumb" => $_POST ["thumb"],
						"in_slider" => $in_slider,
						"active" => $active 
				) );
				if($query>0)
					$this->mfunctions->actionReport("products", "insert");
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/products", "refresh" );
			}
		} else {
			$data ["target"] = "insert_product";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed product
	public function modifyProduct($product_id, $atts = array()) {
		if ($this->permissions->products ["products_modify"] != "1")
			$this->mfunctions->noPermission();
		$data ["langs"] = $this->mfunctions->getAllLangs ();
		$data["cats"] = $this->mproducts->getAllCats();
		if ($product_id != "") {
			$product = $this->mproducts->getProductById ( $product_id );
			if ($product) {
				$data ["product"] = $product;
				if ($_POST) {
					$active = (isset ( $_POST ["active"] ) ? "1" : "0");
					$in_slider = (isset ( $_POST ["in_slider"] ) ? "1" : "0");
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
					$this->form_validation->set_rules ( 'title', lang ( 'enter_product_title' ), "required|callback_checkTitleExist[$product_id]" );
					$this->form_validation->set_rules ( 'category', lang ( 'choose_cat' ), "required" );
					$this->form_validation->set_rules ( 'subtitle', lang ( 'enter_product_subtitle' ), 'required' );
					$this->form_validation->set_rules ( 'year', lang ( 'enter_product_year' ), 'required' );
					$this->form_validation->set_rules ( 'director', lang ( 'enter_product_director' ), 'required' );
					$this->form_validation->set_rules ( 'editor', lang ( 'enter_product_editor' ), 'required' );
					$this->form_validation->set_rules ( 'thumb', lang ( 'choose_thumb' ), 'required' );
					$this->form_validation->set_rules ( 'actors', lang ( 'enter_product_actors' ), 'required' );
					$this->form_validation->set_rules ( 'country', lang ( 'enter_product_country' ), 'required' );
					$this->form_validation->set_rules ( 'copyrights', lang ( 'enter_product_copyrights' ), 'required' );
					$this->form_validation->set_rules ( 'description', lang ( 'enter_product_description' ), 'required' );
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_product";
						$this->load->view ( "admin/index", $data );
					} else {
						$query = $this->mproducts->modifyProduct ( $product_id, array (
								"category" => $_POST ["category"],
								"title" => $_POST ["title"],
								"subtitle" => $_POST ["subtitle"],
								"year" => $_POST ["year"],
								"director" => $_POST ["director"],
								"editor" => $_POST ["editor"],
								"actors" => $_POST ["actors"],
								"country" => $_POST ["country"],
								"copyrights" => $_POST ["copyrights"],
								"description" => $_POST ["description"],
								"lang" => $_POST ["language"],
								"thumb" => $_POST ["thumb"],
								"in_slider" => $in_slider,
								"active" => $active 
						) );
						if($query>0)
							$this->mfunctions->actionReport("products", "modify");
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/products", "refresh" );
					}
				} else {
					$data ["target"] = "modify_product";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// delete an existed product
	public function deleteProduct($product_id) {
		if ($this->permissions->products ["products_delete"] != "1")
			$this->mfunctions->noPermission();
		if ($product_id != "") {
			$query = $this->mproducts->deleteProduct ( $product_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if($query>0)
				$this->mfunctions->actionReport("products", "delete");
			redirect ( base_url () . "admin/products", "refresh" );
		}
	}
	
	// check product title exist for modify
	public function checkTitleExist($title, $product_id) {
		$request = $this->mproducts->checkTitleExist ( $product_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	// show product slides
	public function slides($product_id) {
		if ($this->permissions->products ["products_see"] != "1")
			$this->mfunctions->noPermission();
		if ($product_id != "") {
			$slides = $this->mproducts->getProductSlides ( $product_id );
			$product = $this->mproducts->getProductById ( $product_id );
			$data ["slides"] = $slides;
			$data ["product"] = $product;
			
			$data ["target"] = "slides";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// insert slide to an existed product
	public function insertSlide($product_id) {
		if ($this->permissions->products ["products_create"] != "1")
			$this->mfunctions->noPermission();
		if ($product_id != "") {
			$data ["product"] = $this->mproducts->getProductById ( $product_id );
			if ($_POST) {
				$this->form_validation->set_message ( 'required', "%s" );
				$this->form_validation->set_rules ( 'url', lang ( 'enter_slide_url' ), 'required' );
				if ($this->form_validation->run () == FALSE) {
					$data ["msg"] = "-1";
					$data ["message"] = validation_errors ();
					$data ["target"] = "insert_slide";
					$this->load->view ( "admin/index", $data );
				} else {
					$query = $this->mproducts->insertSlide ( array (
							"url" => $_POST ["url"],
							"product" => $product_id,
							"order" => "0" 
					) );
					if($query>0)
						$this->mfunctions->actionReport("products", "insert_slide");
					$this->session->set_userdata ( array (
							"msg" => "1" 
					) );
					redirect ( base_url () . "admin/products/slides/$product_id", "refresh" );
				}
			} else {
				$data ["target"] = "insert_slide";
				$this->load->view ( "admin/index", $data );
			}
		}
	}
	
	// set product slides order
	public function setSlidesOrder($product_id) {
		if ($product_id != "") {
			if ($_POST) {
				$this->mproducts->setSlidesOrder ( $_POST ["slide"] );
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
					$this->mfunctions->actionReport("products", "set_slides_order");
				redirect ( base_url () . "admin/products/slides/$product_id", "refresh" );
			}
		}
	}
	
	// set products order
	public function setOrder() {
		if ($_POST) {
			$this->mproducts->setProductsOrder ( $_POST ["product"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
				$this->mfunctions->actionReport("products", "set_order");
			redirect ( base_url () . "admin/products", "refresh" );
		}
	}
	
	// delete product slide
	public function deleteSlide($product_id, $slide_id) {
		if ($this->permissions->products ["products_delete"] != "1")
			$this->mfunctions->noPermission();
		if ($slide_id != "" && $product_id != "") {
		$query = $this->mproducts->deleteSlide ( $slide_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if($query>0)
				$this->mfunctions->actionReport("products", "delete_slide");
			redirect ( base_url () . "admin/products/slides/$product_id", "refresh" );
		}
	}
	
	// show categories of products table
	public function categories() {
		if ($this->permissions->products ["products_see"] != "1")
			$this->mfunctions->noPermission();
		$cats = $this->mproducts->getAllCats ();
		$data ["cats"] = $cats;
		$data ["target"] = "pro_cats";
		$this->load->view ( "admin/index", $data );
	}
	
	// insert new cat category
	public function insertCat() {
		if ($this->permissions->products ["products_create"] != "1")
			$this->mfunctions->noPermission();
		$data ["langs"] = $this->mfunctions->getAllLangs ();
		if ($_POST) {
			$active = (isset ( $_POST ["active"] ) ? "1" : "0");
			$this->form_validation->set_message ( 'required', "%s" );
			$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
			$this->form_validation->set_rules ( 'title', lang ( 'enter_cat_title' ), 'required|is_unique[products_categories.title]' );
			if ($this->form_validation->run () == FALSE) {
				$data ["msg"] = "-1";
				$data ["message"] = validation_errors ();
				$data ["target"] = "insert_pro_cat";
				$this->load->view ( "admin/index", $data );
			} else {
				$query = $this->mproducts->insertCat ( array (
						"title" => $_POST ["title"],
						"lang" => $_POST ["language"],
						"active" => $active 
				) );
				if($query>0)
					$this->mfunctions->actionReport("products", "insert_pro_cat");
				$this->session->set_userdata ( array (
						"msg" => "1" 
				) );
				redirect ( base_url () . "admin/products/categories", "refresh" );
			}
		} else {
			$data ["target"] = "insert_pro_cat";
			$this->load->view ( "admin/index", $data );
		}
	}
	
	// modify existed cat
	public function modifyCat($cat_id, $atts = array()) {
		if ($this->permissions->products ["products_modify"] != "1")
			$this->mfunctions->noPermission();
		$data ["langs"] = $this->mfunctions->getAllLangs ();
		if ($cat_id != "") {
			$cat = $this->mproducts->getCatById ( $cat_id );
			if ($cat) {
				$data ["cat"] = $cat;
				if ($_POST) {
					$active = (isset ( $_POST ["active"] ) ? "1" : "0");
					$this->form_validation->set_message ( 'required', "%s" );
					$this->form_validation->set_message ( 'is_unique', " %s " . lang ( "exist" ) );
					$this->form_validation->set_rules ( 'title', lang ( 'enter_cat_title' ), "required|callback_checkCatTitleExist[$cat_id]" );
					if ($this->form_validation->run () == FALSE) {
						$data ["msg"] = "-1";
						$data ["message"] = validation_errors ();
						$data ["target"] = "modify_pro_cat";
						$this->load->view ( "admin/index", $data );
					} else {
						$query = $this->mproducts->modifyCat ( $cat_id, array (
								"title" => $_POST ["title"],
								"lang" => $_POST ["language"],
								"active" => $active 
						) );
						if($query>0)
							$this->mfunctions->actionReport("products", "modify_pro_cat");
						$this->session->set_userdata ( array (
								"msg" => "1" 
						) );
						redirect ( base_url () . "admin/products/categories", "refresh" );
					}
				} else {
					$data ["target"] = "modify_pro_cat";
					$this->load->view ( "admin/index", $data );
				}
			}
		}
	}
	
	// check product category title exist for modify
	public function checkCatTitleExist($title, $cat_id) {
		$request = $this->mproducts->checkCatTitleExist ( $cat_id, $title );
		if (! $request) {
			$this->form_validation->set_message ( 'checkCatTitleExist', " %s " . lang ( "exist" ) );
			return FALSE;
		} else {
			return TRUE;
		}
	}
	// set product categories order
	public function setCatsOrder() {
		if ($_POST) {
			$this->mproducts->setCatsOrder ( $_POST ["cats"] );
			$this->session->set_userdata ( array (
					"msg" => "1" 
			) );
				$this->mfunctions->actionReport("products", "set_cat_order");
			redirect ( base_url () . "admin/products/categories", "refresh" );
		}
	}
	
	// delete an existed category
	public function deleteCat($cat_id) {
		if ($this->permissions->products ["products_delete"] != "1")
			$this->mfunctions->noPermission();
		if ($cat_id != "") {
			$query = $this->mproducts->deleteCat ( $cat_id );
			$this->session->set_userdata ( array (
					"msg" => 1 
			) );
			if($query>0)
				$this->mfunctions->actionReport("products", "delete_pro_cat");
			redirect ( base_url () . "admin/products/categories", "refresh" );
		}
	}
	
/*
	//update product languages titles
	public function updateTitles(){
		if($_POST){
			if ($this->permissions->langs_titles["modify"] != "1")
				$this->mfunctions->noPermission();
			$count = 0;
			$data["message"] = "";
			foreach($_POST as $key => $value){
				$name_array = explode("_", $key);
				$name = $name_array[0]."_".$name_array[1];
				$lang_code = $name_array[2];
				if($value==""){
					$count++;
					$lang = $this->mfunctions->getLangByCode($lang_code);
					$data ["msg"] = "-1";
					$data ["message"] .= lang("enter")." ".lang($name)." ....". lang("language"). ": ".$lang->language."<br/>";
				}else{
					$query = $this->mproducts->updateTitles($lang_code, $name, $value);
					if($query>0)
						$this->mfunctions->actionReport("products", "update_titles");
				}
			}
			if($count==0){
				$this->session->set_userdata ( array (
						"msg" => "1"
				) );
				redirect ( base_url () . "admin/products", "refresh" );
			}
		}
		$data["products_titles"] = $this->mproducts->getProductsTitles();
		$data["target"] = "products_titles";
		$data["langs"] = $this->mfunctions->getAllLangs();
		$this->load->view("admin/index", $data);
	}
	*/
}