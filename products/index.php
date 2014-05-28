<?php
require '../config.php';

$page_title = "Products";

require_once (constant("ABSOLUTE_PATH").'/models/product.model.php');
$product = new Product();
$product_list = $product->product_list();
$product_count = $product_list->rowCount();
$output = '<h3>Available Products: ('.$product_count.')</h3>';

if ($product_count > 0){
		
$output = $output . '<table id="product_list"><tr><th>Product</th><th>Description</th><th>Price</th></tr>';

while ($record = $product_list->fetch(PDO::FETCH_OBJ))
  {
$output = $output. '<tr><td><a href="' . URL_ROOT . 'product/?product_id='. $record->product_id .'">'.$record->product_name.'</a>'.'</td>' . "\n";
$output = $output. '<td>'.$record->product_description.'</td>' . "\n";
$output = $output. '<td>'.'$'.number_format($record->unit_price, 2).'/'.$record->sales_unit.'</td></tr>' . "\n";
}
$output = $output. '</table>';
}
else
{
	echo 'No products are currently available.';
}
unset($product);

include constant("ABSOLUTE_PATH").'/views/template.php';
?>