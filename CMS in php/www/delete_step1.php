<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>


<?php

	$current_step1 = find_step1_by_id($_GET["step1"],false);
		
	if (!$current_step1){ 
		redirect_to("manage_content.php"); 
	}
	
	
	
	
	$id=$current_step1["id"];
	$query = "delete from step1 where id ={$id} limit 1 ";
	$result =mysqli_query($connection,$query);
	
	
			
if ($result && mysqli_affected_rows($connection) ==1 ){
			//success
			$_SESSION["message"] = "Page deleted";
			redirect_to("manage_content.php");

			} else {
			$message = "Page deletion failed";
			redirect_to("manage_content.php?step1={$id}");
			}

	
?>