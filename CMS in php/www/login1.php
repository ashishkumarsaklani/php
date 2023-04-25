<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>

<?php 
	$username ="" ;

 if (isset($_POST['submit'])) {


//escaoe all strings


//validation_function
$required_fields = array("username","password");
validate_presences($required_fields);




//continue if no errors
	if(empty($errors)){
	
			//attempt login
			//process the form
		$username =$_POST["username"] ;
		$password =$_POST["password"] ;
		
		$found_admins =attempt_login_admin($username,$password);
		
        if ($found_admins){
			
			//success mark user as logged in 
			$_SESSION["admins_id"] = $found_admins["id"];
			$_SESSION["username"] = $found_admins["username"];
			$_SESSION["pic"] = $found_admins["pic"];
			redirect_to("admins.php");
			
			
			} else {
			$found_owner =attempt_login_owner($username,$password);		
			if ($found_owner){
			
			//success mark user as logged in 
			$_SESSION["owner_id"] = $found_owner["id"];
			$_SESSION["username"] = $found_owner["username"];
			$_SESSION["pic"] = $found_owner["pic"];
			redirect_to("index.php");
			
			} 
			
			else {
			$message = "Username / Password not found";
			}
		}	
	}
}
else{
//this is a get request
 }
 //form processing --------------------------------------------------------------------------/form processing 
 ?>




<?php require_once ("../includes/layouts/header.php");?>



<div id="main">
	<div id="navigation">
		 
	</div>
	<div id="pages">
	
	<?php	
	
	if(!empty($message)){
	
	echo "<div class=]:message\">" . htmlentities($message) . "</div>" ;
	
	}
	
	?>
	
	<?php  $errors =errors(); ?>
	<?php  echo form_errors($errors); ?>
			<h2>login</h2>
		<form action ="login.php" method="post">
			<p> User name: 
			&nbsp;
			 <input type ="text"  name="username" value="<?php echo htmlentities($username);?>" />
			</p>
			<p> Password :
				&nbsp;	&nbsp;<input type="password" name="password" value="" />
			</p>
				
		<br/>
		

	
	
		<input type="submit" name="submit" value="Login" /><input type="button" name="cancel" value="Cancel"
onclick="window.location='index.php'" />
		</form>	
		<br/> 
	</div>
	


<?php include ("../includes/layouts/footer.php");?>