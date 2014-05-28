<?php
require '../config.php';

$page_title = "Contact";

if(isset($_POST['submit']))
{
include '../controllers/validation.class.php';
// Instantiate an Validation object
$validation = new Validation();
 
// Set attributes
$first_name=$validation->clean_txt($_POST ['first_name'], 'T');
$last_name=$validation->clean_txt($_POST ['last_name'], 'T');
$email=$validation->clean_email($_POST ['email']);
$area_code=$validation->clean_int($_POST ['area_code']);
$ph_pref=$validation->clean_int($_POST ['ph_pref']);
$ph_suff=$validation->clean_int($_POST ['ph_suff']);
$message=$validation->clean_txt($_POST ['message']);

$validations = array();

$validations[] = $validation->required($first_name, 2, 'First Name');
$validations[] = $validation->required($last_name, 2, 'Last Name');
$validations[] = $validation->valid_email($email, 'E-mail Address');
$validations[] = $validation->valid_int($area_code, 3, 'Area Code');
$validations[] = $validation->valid_int($ph_pref, 3, 'Phone Prefix');
$validations[] = $validation->valid_int($ph_suff, 4, 'Phone Suffix');
$validations[] = $validation->required($message, 10, 'Message');

$errors = array();

foreach ($validations as $rule)
{
if($rule !='')
{
$errors[] = $rule;
}
}

$phone = $area_code.'-'.$ph_pref.'-'.$ph_suff;
require ABSOLUTE_PATH.'/models/contact.model.php';
$contact = new Contact();
$contact->add_contact($first_name,$last_name,$email,$phone,$message);
unset($contact);

}
else
{
$first_name = '';
$last_name = '';
$email = '';
$area_code = '';
$ph_pref = '';
$ph_suff = '';
$message = '';

}

if (!isset($errors) || count($errors) !=0)
{
include '../views/_includes/header.inc.php';
include '../views/_includes/contact_form.php';
include '../views/_includes/footer.inc.php';
}
else
{
$output = "<h3>Message Confirmation</h3>\n<p><strong>$first_name $last_name \n<br /><a href=\"mailto:$mail\" title=\"email_address $first_name $last_name\">$email</a>\n<br />($area_code) $ph_pref&dash;$ph_suff</strong></p><hr />";

$output .= '<p>' . htmlspecialchars($message, ENT_QUOTES, 'utf-8') . '</p>';
$output .= '<hr /><p>Submitted: ' .date('l, F d, Y') . '</p>';

include constant("ABSOLUTE_PATH").'/views/template.php';
}

?>