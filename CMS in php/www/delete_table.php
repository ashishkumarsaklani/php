<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php include ("../includes/layouts/header.php");?>



<?php

	
	$step2 = find_step2_by_id(64,false,"menu_name");
	foreach($step2 as $table){
	$table=strtolower(trim($table));
	
	$query = "drop table `{$table}`";
	$result =mysqli_query($connection,$query);
	
?>		