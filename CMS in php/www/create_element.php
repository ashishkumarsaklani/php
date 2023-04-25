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


//escaoe all strings


//validation_function
$required_fields = array("menu_name","position");
validate_presences($required_fields);

$fields_with_max_lengths = array("menu_name" => 30);
validate_max_lengths($fields_with_max_lengths);


//continue if no errors
	if(!empty($errors)){

	$_SESSION["errors"] =$errors;
	redirect_to("new_element.php");
}
//perform database query
$query  = "insert into elements (";
$query .= "menu_name, position ) ";
$query .= "values (";
$query .= " '{$menu_name}', {$position}";
$query .= ");";

$result = mysqli_query($connection, $query);

if ($result){

			//success
			$_SESSION["message"] = "element created";
			redirect_to("manage_containers.php");
			} else {
			$_SESSION["message"]= "element creation failed";
			redirect_to("new_element.php");
			}

	}
	
else{
//this is a get request
redirect_to("new_element.php");

 }



?>

<?php 
if (isset($connection)){ mysqli_close($connection);}
?> 