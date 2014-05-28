<?php
require_once('database.model.php');

class User {
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
	
	//register() method
	public function register($first_name,$last_name,$email, $password){
		try
		{
		$sql = 'INSERT INTO users SET
		first_name = :first_name,
		last_name = :last_name,
		email = :email,
		password = :password,
		create_date = CURDATE(),
		last_update = CURDATE()';
		$s=$this->conn->prepare($sql);
		$s->bindValue(':first_name', $first_name);
		$s->bindValue(':last_name', $last_name);
		$s->bindValue(':email', $email);
		$s->bindValue(':password', md5($password));
		$s->execute();
		}
		
		catch (PDOException $e)
		{
		echo 'Error adding user: ' . $e->getMessage();
		exit();
}
	}
	
	public function authenticate($email='',$password=''){
		try {
			// Password is encrypted.
			$password = md5($password);

			$sql = "SELECT user_id, first_name, last_name FROM users WHERE email='".$email."' AND password='".$password."' LIMIT 0,1";
			$result = $this->conn->query($sql);
		return $result;
		}
		
		catch (PDOException $e)
		{
		echo 'Unable to authenticate e-mail and password: ' . $e->getMessage();
		exit();
}
	}
	
	//set_last_login() function
	public function set_last_login($user_id=0){
		try
		{
			$sql = "UPDATE users SET last_login = NOW() WHERE user_id='".$user_id."'";
			$result = $this->conn->query($sql);
		return $result;
		}
		catch (PDOException $e)
		{
		echo 'Unable to set last login: ' . $e->getMessage();
		exit();
		}
	}
	
	//get_user() function
	public function get_user($user_id=0){
		try
		{
			$sql = "SELECT first_name, last_name, email, create_date, last_update FROM users WHERE user_id='".$user_id."' LIMIT 0,1";
			$result = $this->conn->query($sql);
		return $result;
		}
		catch (PDOException $e)
		{
		echo 'Unable to get user: ' . $e->getMessage();
		exit();
		}
	}
	
	//update_user() function
	public function update_user($user_id,$first_name,$last_name,$email,$password){
		try
		{
			$sql = "UPDATE users SET first_name='".$first_name."', last_name='".$last_name."', email='".$email."', password='".md5($password)."', last_update=CURDATE() WHERE user_id='".$user_id."'";
			$result = $this->conn->query($sql);
		return $result;
		}
		catch (PDOException $e)
		{
		echo 'Unable to update user: ' . $e->getMessage();
		exit();
		}
	}
}
?>