<?php
//Main Navigation Function

function main_nav()
{
$nav_sections = array(
"home" => "",
"products" => "products/",
"services" => "services/",
"about" => "about/",
"contact" => "contact/",
);

if(isset($_SESSION['user_id'])) {
	$nav_sections = array(
	"home" => "",
	"products" => "products/",
	"services" => "services/",
	"about" => "about/",
	"contact" => "contact/",
	"dashboard" => "dashboard/");
}

echo $output = '<ul id="navigation">';
foreach($nav_sections as $key => $value) {
echo'<li><a href="'.constant("URL_ROOT").$value.'" title="'.$key.'">'.$key.'</a></li>'."\n";
}
echo $output = '</ul>';

}?>