<?php
include '../config.php';

$page_title = "Product Detail";

// Determine if a product_id parameter exists in the url’s query string. If product_id is present...
if (isset($_GET['product_id'])){
	// Create a Validation object.
	include (ABSOLUTE_PATH.'/controllers/validation.class.php');
	$validation = new Validation();
	// Sanitize product_id.
	$product_id=$validation->clean_int($_GET['product_id']);
	// Validate product_id is numeric.
	$validations = array();
	$validations[] = $validation->valid_int($product_id, 1, 'Product ID');
	// Determine if there is a validation error...	
$errors = array();
	
	// If there are no errors...
	if(count($errors) == 0) {
	include (ABSOLUTE_PATH.'/models/product.model.php');
	
	// Make a call to the get_product() method...
	$product = new Product();
	$auth = $product->get_product($product_id);
	// Determine if one or zero records are returned.
	$product_count = $auth->rowCount(); 
	
	// If exactly one record is returned...
	if($product_count == 1){
		// Display the product's information (name, description, sales_unit, unit_price) in a presentable manner...
while ($record = $auth->fetch(PDO::FETCH_OBJ)) {
		$output = '<h3>'.$record->product_name.'</h3>' . "\n";
		$output .= '<p>'.$record->product_description.'</p>' . "\n";
		$output .= '<p>'.'$'.number_format($record->unit_price, 2).'/'.$record->sales_unit.'</p>' . "\n"; 
}
		
		// Make a call to the product_options() method.
		$product_options = $product->product_options($product_id);
		// Add a form that points to a cart controller.
		$output .= '<form action="" method="post"><input type="hidden" name="product_id" value="0">';
		$output .= '<label for="options"><strong>Options:</strong></label><br /><select id="options" name="options"><option value="0">-- SELECT OPTION --</option>';
		
		while ($record = $product_options->fetch(PDO::FETCH_OBJ)) {
		$output .='<option value="'.$record->option_id.'">'.$record->option_name.'</option>'  . "\n"; }
		$output .='</select><br />';
		
		$output .= '<label for="quantity"><strong>Quantity:</strong></label><br /><select id="qtys" name="qty" class="qty"><option value="0">-- SELECT QUANTITY --</option>';
		
		for($qty = 1; $qty <= 25; ++$qty) {
		$output .= '<option value="'.$qty.'">'.$qty.'</option>' . "\n"; }
		$output .= '</select><br /><input type="submit" id="submit" name="submit" value="Submit"></form>'; 
	} else {
		$errors[]= 'No product records were returned!';
		// Include the Error view.
		include (ABSOLUTE_PATH.'/views/error.php');
		exit; } 
	}
}
else {
	// If there are no records returned...
	$errors[]= 'No product_id is in the URL query string!';
		// Include the Error view.
		include (ABSOLUTE_PATH.'/views/error.php');
		exit;
}

	// If there are errors...
	if (count($errors) != 0) {
		$errors[]= 'Cannot get product detail!';
		// Include the Error view.
		include (ABSOLUTE_PATH.'/views/error.php');
		exit;
	}
	
unset($product);

include constant("ABSOLUTE_PATH").'/views/template.php';
?>