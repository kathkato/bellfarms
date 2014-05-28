<?php
class Database {
	private $host = 'localhost';
	private $database = '2013spring_21500knavarre';
	private $user = 'knavarre';
	private $password = '';
	public $conn;
	
	//Constructor
	public function __construct(){
		$this->conn = $this->db_connect();
		return $this->conn;}

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
	
	//db_connect() method
	private function db_connect(){
		try
	{
		$conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->exec('SET NAMES "utf8"');
	}
		catch (PDOException $e)
	{
		echo $output = 'Unable to connect to the database server. ' . $e->getMessage();
		exit();

	}
	return $conn;
	}
}

?>