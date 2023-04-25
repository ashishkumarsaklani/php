<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/layouts/header.php");?>
<?php require_once ("../includes/validation_function.php");?>
<?php include ("../includes/functions.php");?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>

<?php if (isset($_POST['submit'])) {
//process the form
$menu_name=mysql_prep($_POST["menu_name"]);
$position=(int)$_POST["position"];
$owner_id=(int)$_POST["owner"];
$visible=(int)$_POST["visible"];

//escaoe all strings


//validation_function
$required_fields = array("menu_name","position","visible","owner");
validate_presences($required_fields);

$fields_with_max_lengths = array("menu_name" => 30);
validate_max_lengths($fields_with_max_lengths);


//continue if no errors
	if(!empty($errors)){

	$_SESSION["errors"] =$errors;
	redirect_to("new_subject.php");
}
//perform database query
$query  = "insert into subjects (";
$query .= "menu_name, position,  owner_id, visible) ";
$query .= "values (";
$query .= " '{$menu_name}', {$position}, {$owner_id}, {$visible}";
$query .= ");";

$result = mysqli_query($connection, $query);

if ($result){

			//success
			$_SESSION["message"] = "Subject created";
			redirect_to("manage_content.php");
			} else {
			$_SESSION["message"]= "Subject creation failed";
			redirect_to("new_subject.php");
			}

	}
	
else{
//this is a get request
redirect_to("new_subject.php");

 }



?>

<?php 
if (isset($connection)){ mysqli_close($connection);}
?> 