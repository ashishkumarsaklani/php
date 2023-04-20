<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>

<?php 
$admins = find_admins_by_id($_GET["id"]);

if (!$admins){

$message = "delete failed here 1st place ";
redirect_to(manage_admins.php);

}



		$id =$admins["id"];
		$query  = "delete from admins where id = {$id} limit 1";
		$result = mysqli_query($connection, $query);

         if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "Admin deleted";
			redirect_to("manage_admins.php");
			} else {
			$message = "delete failed here at this place";
			redirect_to("manage_admins.php");
}