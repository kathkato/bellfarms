<?php

include('../config.php');

$page_title = "Registration";

if(isset($_POST['submit'])){
	include constant("ABSOLUTE_PATH").'/controllers/validation.class.php';
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

require ABSOLUTE_PATH.'/models/user.model.php';
$user = new User();
$user->register($first_name,$last_name,$email,$password);
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

if (!isset($errors) || count($errors) !=0)
{
include constant("ABSOLUTE_PATH").'/views/_includes/header.inc.php';
include constant("ABSOLUTE_PATH").'/views/_includes/registration_form.php';
include constant("ABSOLUTE_PATH").'/views/_includes/footer.inc.php';
}
else
{
$output = "<h3>Registration Confirmation</h3>\n<p><strong>$first_name $last_name \n<br /><a href=\"mailto:$email\" title=\"email_address $first_name $last_name\">$email</a>\n<br />$validation->password</strong></p>";

$output .= '<p>' . htmlspecialchars($message, ENT_QUOTES, 'utf-8') . '</p>';
$output .= '<hr /><p>Joined: ' .date('l, F d, Y') . '</p>';

include constant("ABSOLUTE_PATH").'/views/template.php';
}

?>