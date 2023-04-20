
<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>


<?php
//=================================to Confirm if name and table exists=========================	

	$current_step2 = find_step2_by_id($_GET["step2"],false);
	if (!$current_step2){ 
		redirect_to("manage_content.php"); 
	}
//=================================deltes header name table=========================	
	$step2 = find_step2_by_id($_GET["step2"],false,"menu_name");
	foreach($step2 as $table){
	$table=strtolower(trim($table));
	}
	$query = "drop table `{$table}`";
	$result =mysqli_query($connection,$query);
	
//=================================deltes header name from step2 table=========================	
	
	$id=$current_step2["id"];
	$query = "delete from step2 where id ={$id} limit 1 ";
	$result =mysqli_query($connection,$query);
	
	
			
if ($result && mysqli_affected_rows($connection) ==1 ){
			//success
			$_SESSION["message"] = "Page deleted";
			redirect_to("manage_content.php");

			} else {
			$message = "Page deletion failed";
			redirect_to("manage_content.php?step2={$id}");
			}

	
?>