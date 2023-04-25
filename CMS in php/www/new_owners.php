<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>

<?php if (isset($_POST['submit'])) {


//escaoe all strings


//validation_function
$required_fields = array("username", "password");
validate_presences($required_fields);


$_SESSION["errors"] =errors();

//continue if no errors
	if(empty($errors)){
	
			//perform updates
			//process the form
			$username = mysql_prep($_POST["username"]);
			$hashed_password=password_encrypt($_POST["password"]);
			$email=mysql_prep($_POST["email"]);
			$imageName = mysqli_real_escape_string($connection,$_FILES["image"]["name"]);
			$imageData = mysqli_real_escape_string($connection,file_get_contents($_FILES["image"]["tmp_name"]));
			$imageType = mysqli_real_escape_string($connection,$_FILES["image"]["type"]);

		if (substr($imageType,0,5) =="image"){	
		// to perform database update  
		
		
		$query  = "insert into owner (";
		$query .= " username,email,hashed_password,pic ) ";
		$query .= "values (";
		$query .= " '{$username}', '{$email}', '{$hashed_password}', '$imageData' ";
		$query .= ");";
		
		}
		else {
		
		$_SESSION["message"] = "please select a proper image below 20 mb";
		
		}
			
		
	
    	$result = mysqli_query($connection, $query);
			
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "Admin created";
			redirect_to("manage_owners.php");
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
	
	

	
	<?php	
	$message= message();

	if(!empty($message)){
	
	echo $message;
	
	}

	?>
	

	<?php  echo form_errors($errors); ?>
			<h2>Create Admin</h2>
			
			
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
            $('#Submit').attr('disabled', 'disabled');
        } else {
            $('#Submit').removeAttr('disabled');
        }
    });
})()

</script>
		<form action ="new_owners.php" method="post" enctype="multipart/form-data">
			
			<p> User name : 
			&nbsp;
			 <input type ="text"  name="username" value="" />
			</p>
			<p> Password :
				&nbsp;	&nbsp;<input type="password" name="password" value="" />
			</p>
			<p>	E mail  	:
				&nbsp;
		&nbsp;
		&nbsp; &nbsp;	&nbsp;<input type ="text"  name="email" value="" />
			</p>
			<p>Picture  	:

		&nbsp;&nbsp; &nbsp;	&nbsp;		<input type= "file" name ="image" value="">
								</p>
		<br/> 	
		

		&nbsp;
		&nbsp;
		&nbsp;
				<p>
	
					<input type="submit" name="submit" value="Submit" />
							&nbsp; &nbsp<a href="manage_owners.php">Cancel </a>
		</form>	
		<br/> 
	</div>
	


<?php include ("../includes/layouts/footer.php");?>