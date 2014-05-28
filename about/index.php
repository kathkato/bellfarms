<?php
require '../config.php';

$page_title = "About";
$output = "<p>This is the About page.</p>";

include constant("ABSOLUTE_PATH").'/views/template.php';
?>