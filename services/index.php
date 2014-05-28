<?php
require '../config.php';

$page_title = "Services";

include (constant("ABSOLUTE_PATH").'/models/services.model.php');
$services = new Services();
$service_list = $services->service_list();
$service_count = $service_list->rowCount();
$output = '<h3>Available Services: ('.$service_count.')</h3>';


if ($service_count > 0){
		
$output = $output . '<table id="service_list"><tr><th>Service</th><th>Description</th></tr>';

while ($record = $service_list->fetch(PDO::FETCH_OBJ))
  {
$output = $output. '<tr><td>'.$record->service_name.'</td>' . "\n";
$output = $output. '<td>'.$record->service_description.'</td>' . "\n";
}
$output = $output. '</table>';
}
else
{
	echo 'No services currently available.';
}
unset($services);

include constant("ABSOLUTE_PATH").'/views/template.php';
?>