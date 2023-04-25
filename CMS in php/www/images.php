<?php require_once ("../includes/db_connect.php");

$id =$_GET['id'];
$tab=$_GET['tab'];
		$query  = "select * ";
		$query .= "from $tab ";
		$query .= "where id = '$id'";
		$row = mysqli_query($connection, $query);
	
	
	
	if ($admins= mysqli_fetch_assoc($row)){
$imagedata = $admins["pic"];
header("content-type: image/jpg");
echo $imagedata;

			}else{
			return null;
			}


?>
