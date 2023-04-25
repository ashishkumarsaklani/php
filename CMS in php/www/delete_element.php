<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>


<?php

	$current_step2 = find_step2_by_id($_GET["step2"],false);
		
	if (!$current_step2){ 
		redirect_to("manage_content.php"); 
	}
	
	
	
	$page=$_GET["pages"];
	$id=$_GET["id"];
	$table=trim($current_step2["menu_name"]);
	$query = "delete from `{$table}` where id ={$id} limit 1 ";
	$result =mysqli_query($connection,$query);
	
	
			
if ($result && mysqli_affected_rows($connection) ==1 ){
			//success
			$_SESSION["message"] = "Page deleted";
			redirect_to("edit_step2.php?pages={$page}&step2={$current_step2["id"]}");

			} else {
			$message = "Page deletion failed";
			redirect_to("manage_content.php?pages={$page}&step2={$id}");
			}

	
?>