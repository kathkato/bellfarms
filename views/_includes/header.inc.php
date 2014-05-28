<?php include 'main_nav.inc.php'; ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $page_title. '|' . constant("COMPANY_NAME"); ?></title>
<link href="<?php echo constant("URL_ROOT");?>_assets/css/stylesheet.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="page">

<?php include'loginform.inc.php'; ?>

<h1><a href="<?php echo constant("URL_ROOT"); ?>" title="<?php echo constant("COMPANY_NAME"); ?>"></a><?php echo constant("COMPANY_NAME"); ?></h1>

<div id="main_nav">
<? main_nav(); ?>

<h2><?php echo $page_title;?></h2>