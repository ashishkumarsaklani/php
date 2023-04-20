<?php 

if (!isset($layout_context)) {
$layout_context = "public"; }; ?>
<html lang="en">

	<head>
	<link sizes="57x57" rel="icon" href="images/S.png" type="image/x-icon" />
</head>
	<title>A_Comp <?php if ($layout_context == "admin") {
	echo "Admin" ;} ?></title>
	<link href ="css/public.php" media="all" rel= "stylesheet" type="text/css"/></head>

	
<body>
	<div id="header">	<h1>A Company<?php if ($layout_context == "admin") {
	if (isset($_SESSION["admins_id"])){  ?> <img src="images.php?tab=admins&id=<?php echo $_SESSION["admins_id"];?>"width=50px > <?php 
	} elseif (isset($_SESSION["owner_id"])) {  ?> <img src="image1.php?tab=owner&r=pic&id=<?php echo $_SESSION["owner_id"] ?> "; width=50px > <?php 
	}
	}
	
	?>   </h1> <?php if (!isset($_SESSION["admins_id"]) and !isset($_SESSION["owner_id"]) ){?> <a href ="login.php"> Admin Login</a><br/><?php }else {?>
	 <a href ="logout.php">Logout</a> <?php if (isset($_SESSION["admins_id"])){
													?><a href ="admins.php"><?php } 
			elseif (isset($_SESSION["owner_id"])) { 
												$subjects = find_subjects_for_owner($_SESSION["owner_id"]);
													?> <a href ="manage_content.php?subjects=<?php echo $subjects["id"] ; ?>" >  <?php
												} echo $_SESSION["username"]; ?></a></li> <?php }?> 

	</div>

	
</image>