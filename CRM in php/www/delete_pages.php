<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>


<?php

	$current_pages = find_pages_by_id($_GET["pages"],false);
		
	if (!$current_pages){ 
		redirect_to("manage_content.php"); 
	}
	
	
	
	
	$id=$current_pages["id"];
	$query = "delete from pages where id ={$id} limit 1 ";
	$result =mysqli_query($connection,$query);
	
	
			
if ($result && mysqli_affected_rows($connection) ==1 ){
			//success
			$_SESSION["message"] = "Page deleted";
			redirect_to("manage_content.php");

			} else {
			$message = "Page deletion failed";
			redirect_to("manage_content.php?pages={$id}");
			}

	
?>