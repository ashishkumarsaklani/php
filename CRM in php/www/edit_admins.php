<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>

<?php 
$admins = find_admins_by_id($_GET["id"]);
if (!$admins){
redirect_to(manage_admins.php);
}
?>





<?php if (isset($_POST['submit'])) {


//escaoe all strings


//validation_function
$required_fields = array("username","password");
validate_presences($required_fields);


$_SESSION["errors"] =errors();

//continue if no errors
	if(empty($errors)){
	
			//perform updates
			//process the form
			$id =$admins["id"] ;
			$username = mysql_prep($_POST["username"]);
			$hashed_password=password_encrypt($_POST["password"]);
			$imageName = mysqli_real_escape_string($connection,$_FILES["image"]["name"]);
			$imageData = mysqli_real_escape_string($connection,file_get_contents($_FILES["image"]["tmp_name"]));
			$imageType = mysqli_real_escape_string($connection,$_FILES["image"]["type"]);

		if (substr($imageType,0,5) =="image"){	
			
		// to perform database update  
		
		
		$query  = "update admins set username ='{$username}' ,hashed_password='{$hashed_password}',pic ='$imageData' ";
		$query .= "where id = {$id} ";
		$query .= "limit 1 ;";
		
		
			
	
	
    	$result = mysqli_query($connection, $query);
		}				
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "Admin EDITED";
			redirect_to("manage_admins.php");
			} else {
			$message = "page update failed here at this place";
			}
	}
}
else{
//this is a get request
 }
 //form processing --------------------------------------------------------------------------/form processing 
 ?>



<?php $layout_context = "admins"; ?>
<?php require_once ("../includes/layouts/header.php");?>



<div id="main">
	<div id="navigation">
		 
	</div>
	<div id="pages">

<script>	
(function() {
    $('form > input').keyup(function() {

        var empty = false;
        $('form > input').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });

        if (empty) {
            $('#Edit Dtails').attr('disabled', 'disabled');
        } else {
            $('#Edit Dtails').removeAttr('disabled');
        }
    });
})()

</script>
	
	<?php	
	$message= message();
	if(!empty($message)){
	
	echo $message;
	
	}

	?>
	

	<?php  echo form_errors($errors); ?>
			<h2>Edit Admin</h2>
		<form action ="edit_admins.php?id=<?php echo urlencode($admins["id"]); ?>" method="post"enctype="multipart/form-data">
			<p> User name : 
			&nbsp;
			 <input type ="text" name="username" value="<?php echo htmlentities($admins["username"]); ?>" />
			</p>
			<p> Password :
				&nbsp;	&nbsp;<input type="password" name="password" value="" />
			</p>
				
		<br/>
			

		&nbsp;
		&nbsp;
		&nbsp;

					<input type= "file" name ="image" required /><p><input type="submit" name="submit" value="Edit Dtails" />
							&nbsp; &nbspn <a href="manage_admins.php">Cancel </a>
	
		</form>	
		<br/> 
	</div>
	


<?php include ("../includes/layouts/footer.php");?>