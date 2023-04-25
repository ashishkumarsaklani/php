<?php 

if (!isset($layout_context)) {
$layout_context = "public"; }; ?>
<html lang="en">

	<head>
	<title>A_Comp </title>
	<link href ="css/public.css" media="all" rel= "stylesheet" type="text/css"/></head>

<body>
	<div id="header"><?php if (!isset($_SESSION["admins_id"]) ){?> <a href ="login.php"> Admin Login</a><br/></h1><?php }else {?>
	<?php echo $_SESSION["username"] ;}?>
	<h1>A Company <?php if ($layout_context == "admin") {
	echo "Admin" ;} ?></h1> 
	</div>