<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>

<?php 
$owners = find_owners_by_id($_GET["id"]);
if (!$owners){

$_SESSION["message"]  = "Edit failed here 1st place ";
redirect_to("manage_owners.php");
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
			$id =$owners["id"] ;
			$username = mysql_prep($_POST["username"]);
			$hashed_password=password_encrypt($_POST["password"]);
			$email=mysql_prep($_POST["email"]);
			$imageName = mysqli_real_escape_string($connection,$_FILES["image"]["name"]);
			$imageData = mysqli_real_escape_string($connection,file_get_contents($_FILES["image"]["tmp_name"]));
			$imageType = mysqli_real_escape_string($connection,$_FILES["image"]["type"]);

		if (substr($imageType,0,5) =="image"){	
			
		// to perform database update  
		
		
		$query  = "update owner set username ='{$username}' ,hashed_password='{$hashed_password}',email = '{$email}' ,pic ='$imageData' ";
		$query .= "where id = {$id} ";
		$query .= "limit 1 ;";
		
		
			
	
	
    	$result = mysqli_query($connection, $query);
		}				
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "Owner EDITED";
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
            $('#submit').attr('disabled', 'disabled');
        } else {
            $('#submit').removeAttr('disabled');
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
			<h2>Edit Owner</h2>
		<form action ="edit_owners.php?id=<?php echo urlencode($owners["id"]); ?>" method="post"enctype="multipart/form-data">
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
			<div id = "owner"style="margin:50px;float:left";  >
			<img src="images.php?tab=owner&id=<?php echo $_GET["id"] ?> " style="margin:50px ;float:left" ;"; height=300px ; width=200px  ;>
			
			<p>Picture  	:<input type= "file" name ="image" value="" required/>
								</p>
		<br/> 	
			&nbsp; &nbsp<a href="manage_owners.php">Cancel </a> 			<input type="submit" name="submit" value="Update " />
		</div>

	
		</form>	
		<br/> 
	</div>
	


<?php include ("../includes/layouts/footer.php");?>