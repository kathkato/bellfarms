<?php
require_once('database.model.php');

class Product {
	public $conn;
	
		//Constructor
	public function __construct(){
		$db = new Database();
		$this->conn = $db->conn;}

	//Destructor
	public function __destruct(){
		$this->conn = null;}
	
	//Get
	public function __get($name){
		return $this->$name;
	}
	
	//Set
	public function __set($name,$value){
		$this->$name=$value;
	}
	
	//product_list() method
	public function product_list(){
		try
		{
		$result = $this->conn->query('SELECT product_id, product_name, product_description, unit_price, sales_unit FROM products ORDER BY product_name');
		return $result;
		}
		
		catch (PDOException $e)
		{
		echo 'Unable to retrieve products: ' . $e->getMessage();
		exit();
}
	}
	
	//getproduct() method
	public function get_product($product_id=0){
		try
		{
		$result = $this->conn->query("SELECT product_name, product_description, unit_price, sales_unit FROM products WHERE product_id='".$product_id."' LIMIT 0,1");
		return $result;
		}
		
		catch (PDOException $e)
		{
		echo 'Unable to retrieve products: ' . $e->getMessage();
		exit();
}
	}
	
	//product_options() method
	public function product_options($product_id=0){
		try
		{
		$result = $this->conn->query("SELECT option_id, options.option AS option_name FROM options WHERE product_id='".$product_id."' ORDER BY 'option'");
		return $result;
		}
		
		catch (PDOException $e)
		{
		echo 'Unable to retrieve products: ' . $e->getMessage();
		exit();
}
	}
}
?>