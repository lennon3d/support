<?php
class MProducts extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}

	//insert new product
	public function insertProduct($atts=array()){
		return $this->db->insert("products", $atts);
	}
	
	//modify an existed product
	public function modifyProduct($id, $atts=array()){
		$this->db->where("id", $id);
		return $this->db->update("products", $atts);
	}
	
	//delete an existed product
	public function deleteProduct($id){
		$product = $this->getProductById($id);
		$this->db->where("product", $product->id);
		$query = $this->db->get("productslides");
		if($query->num_rows()>0){
			$this->db->where("product", $product->id);
			$this->db->delete("productslides");
		}
		$this->db->where("id", $id);
		return $this->db->delete("products");
	}
	
	//get all products
	public function getAllProducts(){
		$query = $this->db->get("products");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get product by id
	public function getProductById($id){
		$query = $this->db->get_where("products", array("id"=>$id));
		if($query->num_rows==1)
			return $query->row();
		return false;
	}
	
	//add slide to an existed product
	public function insertSlide($atts=array()){
		return $this->db->insert("productslides", $atts);
	}
	
	// get all products slides
	public function getAllSlides(){
		$query = $this->db->get("productslides");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get slides of an existed product
	public function getProductSlides($product_id){
		$query = $this->db->get_where("productslides", array("product"=>$product_id));
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//modify slide of a product
	public function modifySlide($id, $atts=array()){
		$this->db->where("id", $id);
		return $this->db->update("productslides", $atts);
	}
	
	//delete an existed slide
	public function deleteSlide($id){
		$this->db->where("id", $id);
		return $this->db->delete("productslides");
	}
	
	// check product title exist for modify product
	public function checkTitleExist($id, $title) {
		$query = $this->db->get_where ( "products", array (
				"title" => $title
		) );
		$product1 = $this->getProductById ( $id );
		if ($query->num_rows () > 0) {
			$product = $query->row ();
			if ($product->title == $product1->title)
				return true;
			return false;
		}
		return true;
	}
	
	//set product slides order
	public function setSlidesOrder($orders=array()){
		foreach($orders as $id=>$order){
			$this->db->where("id", $id);
			$this->db->update("productslides", array("order" => $order));
		}
	}
	
	//set products order
	public function setProductsOrder($orders=array()){
		foreach($orders as $id=>$order){
			$this->db->where("id", $id);
			$this->db->update("products", array("order" => $order));
		}
	}
	
	//add new product cat
	public function insertCat($atts=array()){
		$this->db->insert("products_categories", $atts);
		return $this->db->insert_id();
	}
	
	//modify existed product category
	public function modifyCat($id, $atts){
		$this->db->where("id", $id);
		$this->db->update("products_categories", $atts);
		return $this->db->affected_rows();
	}
	
	//delete existed cat
	public function deleteCat($id){
		$cat = $this->getCatById($id);
		$this->db->where("category", $cat->id);
		$query = $this->db->get("products");
		if($query->num_rows()>0){
			foreach($query->result() as $product)
			$this->deleteProduct($product->id);
		}
		$this->db->where("id", $id);
		$this->db->delete("products_categories");
	}
	
	//set products categories order
	public function setCatsOrder($orders=array()){
		foreach($orders as $id=>$order){
			$this->db->where("id", $id);
			$this->db->update("products_categories", array("order" => $order));
		}
	}
	
	//get all category
	public function getAllCats(){
		$query = $this->db->get("products_categories");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get cat by id
	public function getCatById($id){
		$query = $this->db->get_where("products_categories", array("id"=>$id));
		if($query->num_rows==1)
			return $query->row();
		return false;
	}
	
	// check cat title exist for modify cat
	public function checkCatTitleExist($id, $title) {
		$query = $this->db->get_where ( "products_categories", array (
				"title" => $title
		) );
		$cat1 = $this->getCatById ( $id );
		if ($query->num_rows () > 0) {
			$cat = $query->row ();
			if ($cat->title == $cat1->title)
				return true;
			return false;
		}
		return true;
	}
	
	//get category products
	public function getCatProducts($cat_id){
		$query = $this->db->get_where("products", array("category" => $cat_id));
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//get products languages titles from database and return array with them
	public function getProductsTitles(){
		$this->db->like("title", "product");
		$query = $this->db->get("langs_titles");
		if($query->num_rows()>0)
			return $query->result();
		return false;
	}
	
	//update products languages titles
	public function updateTitles($lang, $title, $text){
		$this->db->where(array("lang" => $lang, "title" => $title));
		return $this->db->update("langs_titles", array("text" => $text));
	}
}