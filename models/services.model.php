<?php
include 'database.model.php';

class Services {
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
	
	//service_list() method
	public function service_list(){
	try
		{
		$result = $this->conn->query('SELECT service_name, service_description FROM services ORDER BY service_name');
		return $result;
		}
		
		catch (PDOException $e)
		{
		echo 'Unable to retrieve services: ' . $e->getMessage();
		exit();
}
	}
}
?>