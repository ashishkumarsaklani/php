<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>
<?php	find_selected_pages(); ?>
<?php
$current_subjects =find_subjects_by_id($_GET["subjects"],false);

	if (!$current_subjects){ 
		redirect_to("manage_content.php"); 
	}
	
	$pages_set =find_pages_for_subjects($current_subjects["id"]);
	if (mysqli_num_rows($pages_set) >0) {
	
	
	$_SESSION["message"] = "Cant delete a Subject with Pages" ;
	redirect_to("manage_content.php?subjects={$current_subjects["id"]}");
	}

	$id =$current_subjects["id"] ;
	$query = "delete from subjects where id = {$id} limit 1" ;
	$result = mysqli_query($connection, $query);
			
if ($result && mysqli_affected_rows($connection) ==1 ){
			//success
			$_SESSION["message"] = "Subject deleted";
			redirect_to("manage_content.php");

			} else {
			$message = "Subject delete failed";
			redirect_to("new_subject.php?subject={$id}");
			}

	
?>
