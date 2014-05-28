<?php
include '../config.php';

$page_title = 'Signed Out';

// Unset all authenticated user session data.
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['first_name']);
unset($_SESSION['last_name']);

// Destroy the session using the session_destroy() function.
session_destroy();

// Output variables...
$output = '<h2>Signed Out</h2>';
$output = '<p>You have been signed out of your account. Thanks for visiting.</p>';

include constant("ABSOLUTE_PATH").'/views/template.php';
?>