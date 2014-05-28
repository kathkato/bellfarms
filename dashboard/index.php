<?php
include '../config.php';
include constant("ABSOLUTE_PATH").'/controllers/auth_check.php';

$page_title = 'Dashboard';

include constant("ABSOLUTE_PATH").'/models/user.model.php';

$errors = array();
// Include the user model.
if(count($errors) == 0) {

// Make a call to the get_user() method.
$user = new User();
$auth = $user->get_user($_SESSION['user_id']);
// Determine if zero or one records were returned.
$user_count = $auth->rowCount();
// If exactly one record was returned...
if($user_count == 1){
	while ($record = $auth->fetch(PDO::FETCH_OBJ)) {
		$output = '<p><strong>E-mail: </strong>'.$record->email.'</p>';
		$output .= '<p><strong>First Name: </strong>'.$record->first_name.'</p>';
		$output .= '<p><strong>Last Name: </strong>'.$record->last_name.'</p>';
		$output .= '<p><strong>Member Since: </strong>'.$record->create_date.'</p>';
		$output .= '<p><strong>Last Update: </strong>'.$record->last_update.'</p>';
		// Include hyperlink
	$output .= '<a href="' . URL_ROOT . 'profile/index.php">Edit Profile</a>';
		}
}
} else {
	// If no records are returned...
	// Include the error view.
	include (ABSOLUTE_PATH.'/views/error.php');
	$errors[] = "No records were returned!";
	exit;
}
unset($user);

include constant("ABSOLUTE_PATH").'/views/dashboard.php';
?>