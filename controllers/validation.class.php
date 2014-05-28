<?php

// Class Definition
class Validation {
	
	public $first_name;
	public $last_name;
	public $email;
	public $area_code;
	public $ph_pref;
	public $ph_suff;
	public $message; 
	public $password;
	public $password2;
	public $product_id;
	
	//Constructor
	public function __construct(){}

	//Destructor
	public function __destruct(){}
	
	//Get
	public function __get($var_val){
		return $this->$var_val;
	}
	
	//Set
	public function __set($var_val,$value){
		$this->$var_val=$value;
	}
	
	// New Validation Public Method
	public function valid_match($var1=0, $var2=1, $field_name){
		if ($var1 != $var2){
			return "Error: " . $field_name . " do not match.";
		}
	}

// Sanitization Functions
public function clean_txt($txt, $letter_case = '')
{
$txt = trim($txt);
$txt = filter_var($txt, FILTER_SANITIZE_STRING);

switch($letter_case)
{
case 'L':
strtolower($txt);
break;

case 'U':
strtoupper($txt);
break;

case 'T':
ucwords($txt);
break;
}
return $txt;
}

public function clean_email($email)
{
$email = $this->clean_txt($email, 'L');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
return $email;
}

public function clean_int($int)
{
$int = trim($int);
$int = filter_var($int, FILTER_SANITIZE_NUMBER_INT);
return $int;
}

//Validation Functions
public function required($var, $min_num = 1, $field_name)
{
if (strlen($var) < $min_num)
{
return $field_name.' is a required field.';
}
}

public function valid_email($email, $field_name)
{
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
return 'Please provide a valid e-mail address for '. $field_name.'.';
}
}

public function valid_int($int, $min_num = 1, $field_name)
{
$required = $this->required($int, $min_num, $field_name);
if ($required == '')
{
if (!filter_var($int, FILTER_VALIDATE_INT))
{
return 'Please provide a valid numeric value for ' .$field_name.'.';
}
}
else
{
return $required;
}
}
	
}
	
?>