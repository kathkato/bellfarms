<?php
include constant("ABSOLUTE_PATH").'/views/_includes/header.inc.php';

echo '<h2 style="color:red;">Welcome back, '.$_SESSION['first_name'].'!</h2>';
echo $output;

include constant("ABSOLUTE_PATH").'/views/_includes/footer.inc.php';
?>