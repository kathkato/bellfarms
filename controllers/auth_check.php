<?php
// If "user_id" does not exist in the user's session...
if(!isset($_SESSION['user_id'])){
	// Display error message in an $errors array and include the Error view.
	$errors = array();
	$errors[]= "Unauthorized access. Please login.";
	
	// Include the Error view.
	include (ABSOLUTE_PATH.'/views/error.php');
	exit;
};
?>