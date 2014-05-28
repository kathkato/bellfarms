<?php

require_once('database.model.php');

class Contact {
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
	
	//add_contact() function
	public function add_contact($first_name,$last_name,$email,$phone,$message){
		try
		{
		$sql = 'INSERT INTO contacts SET
		first_name = :first_name,
		last_name = :last_name,
		email = :email,
		phone = :phone,
		message = :message';
		$s=$this->conn->prepare($sql);
		$s->bindValue(':first_name', $first_name);
		$s->bindValue(':last_name', $last_name);
		$s->bindValue(':email', $email);
		$s->bindValue(':phone', $phone);
		$s->bindValue(':message', $message);
		$s->execute();
		}
		
		catch (PDOException $e)
		{
		echo 'Error adding contact: ' . $e->getMessage();
		exit();
}
	}
}
?>