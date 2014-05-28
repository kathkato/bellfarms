<?php 
include '../config.php';

$page_title = "Log In";

if(isset($_POST['login_submit'])){
	// Include validation controller and create a validation object.
	include constant("ABSOLUTE_PATH").'/controllers/validation.class.php';
$validation = new Validation();

// Sanitize the e-mail address and password.
$email=$validation->clean_email($_POST ['email']);
$password=$validation->clean_txt($_POST ['password'], 'L');

// Validate the e-mail address and password. Store errors in $errors array.
$validations = array();
$validations[] = $validation->valid_email($email, 'E-mail Address');
$validations[] = $validation->required($password, 6, 'Password');

$errors = array();
	
	// If there are no errors...
	if(count($errors) == 0) {
		// Include the user model and create a user object.
		include (ABSOLUTE_PATH.'/models/user.model.php');
		$user = new User();
		// Pass the e-mail address and password variables and store in the $auth variable.
		$auth = $user->authenticate($email, $password);
		$user_count = $auth->rowCount();
		// If the $user_count is equal to exactly one...
		if($user_count == 1){
			$auth_user = $auth->fetch(PDO::FETCH_OBJ);
			$_SESSION['username'] = $email;
			$_SESSION['user_id'] = $auth_user->user_id;
			$_SESSION['first_name'] = $auth_user->first_name;
			$_SESSION['last_name'] = $auth_user->last_name;
			// Make a call to the set_last_login() method...
			$auth = $user->set_last_login($user_id);
			
			header("Location:" . URL_ROOT . 'dashboard/');
		} else {
			$errors[]= 'Invalid username and password. Please try again.';
			include (ABSOLUTE_PATH.'/views/error.php');
		}
		// Destroy User object.
		unset($user);
	} else {
		// Include the Error view.
		include (ABSOLUTE_PATH.'/views/error.php');
	}
} else {
	$errors[]= "<p>Please complete the login form to sign into your account.</p>";
	include (ABSOLUTE_PATH.'/views/error.php');
}
?>