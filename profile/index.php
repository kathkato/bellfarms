<?php

include '../config.php';

// Perform an authorization check using the process from Part #1.
include (ABSOLUTE_PATH.'/controllers/auth_check.php');
// Include the User model.
include (ABSOLUTE_PATH.'/models/user.model.php');
$page_title = 'Update Profile';
$user = new User();

// Determine if a profile form was submitted...
if(isset($_POST['profile_submit'])){
// Include the validation controller.	
include (ABSOLUTE_PATH.'/controllers/validation.class.php');
	// Instantiate Validation Object
$validation = new Validation();

	// Sanitize
$first_name=$validation->clean_txt($_POST ['first_name'], 'T');
$last_name=$validation->clean_txt($_POST ['last_name'], 'T');
$email=$validation->clean_email($_POST ['email']);
$password=$validation->clean_txt($_POST ['password'], 'L');
$password2=$validation->clean_txt($_POST ['password2'], 'L');
	// Encrypt Each Password
$validation->password = md5($_POST['password']); 
$validation->password2 = md5($_POST['password2']); 

$validations = array();

$validations[] = $validation->required($first_name, 2, 'First Name');
$validations[] = $validation->required($last_name, 2, 'Last Name');
$validations[] = $validation->valid_email($email, 'E-mail Address');
$validations[] = $validation->required($password, 6, 'Password');

$validations[] = $validation->valid_match($validation->password, $validation->password2, 'Passwords');

$errors = array();

foreach ($validations as $rule)
{
if($rule !='')
{
$errors[] = $rule;
}
}

$user->update_user($_SESSION['user_id'], $first_name, $last_name, $email, $password);

unset($user);

}
else
{
$first_name = '';
$last_name = '';
$email = '';
$password = '';
$password2 = '';
}

if (!isset($errors) || count($errors) !=0) {
	// Make a call to the get_user() method.
	$user = new User();
	$result = $user->get_user($_SESSION['user_id']);
    foreach ($result as $row)
    {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
		
	// Display profile form.
include constant("ABSOLUTE_PATH").'/views/_includes/header.inc.php';
include constant("ABSOLUTE_PATH").'/views/_includes/profile_form.php';
include constant("ABSOLUTE_PATH").'/views/_includes/footer.inc.php'; 
}

}
	 else {
	// Display confirmation message.
	$output = "<h3>Update Confirmation</h3>\n<p><strong>Success! Your profile has been updated.</strong></p>\n<p><strong>$first_name $last_name \n<br /><a href=\"mailto:$email\" title=\"email_address $first_name $last_name\">$email</a>\n<br />$validation->password</strong></p>";
	
	$output .= '<hr /><p>Updated: ' .date('l, F d, Y') . '</p>';

	include constant("ABSOLUTE_PATH").'/views/template.php';
}
?>