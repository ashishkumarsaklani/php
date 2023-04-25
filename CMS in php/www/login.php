<?php require_once ("../includes/sms/head.php");?>
<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>
<?php require_once ("../includes/sms/func.php");?>
<?php 


	$username ="" ;

 if (isset($_POST['verify'])) {
	$to = $_POST['to'];
	$otp = $_POST['otp']; 
	$check=check_otp($to,$otp);
	if  (!isset($password)){$password="";}
	if ($check =="Otp is valid"){
	 $loginW ="<p> User name: 
			&nbsp;
			 <input type =\"text\"  name=\"username\" value=\"$username\" />	</p><p> Password :		&nbsp;	&nbsp;<input type=\"password\" name=\"password\" value=\"'.$password.'\" />
			</p>
	 
	 
	 	<button onclick=\"window.location='index.php'\"type=\"button\"class=\"steel\" name=\"submit\" > Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type=\"submit\" class=\"steel\" name=\"submit\" >Login </button>";
	$me ="$check please login";
 }
	else 
	{
		$me =	$check;
	}
	 
	 

 }
 
 elseif (isset($_POST['submit'])) {

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
 elseif (isset($_POST['otp'])) {
	 
	 
$required_fields = array("to");
validate_presences($required_fields);
$check =has_min_length($_POST["to"],10);
if ($check == false)
{
$me="please enter a valid phone number";	
	
}



//continue if no errors
	if(empty($errors)){
		 
	 
												 
												
											if  (!isset($uid)){$uid="";}
											if  (!isset($pwd)){$pwd="";}
											if  (!isset($proxy)){$proxy="";}
		

											set_time_limit(0);
											$ser="http://site24.way2sms.com/";
											$ckfile = tempnam ("/tmp", "CURLCOOKIE");
											$login=$ser."Login1.action";
											//$uid=input($_REQUEST['uid']);
											//$pwd=input($_REQUEST['pwd']);

											
											if ($_POST){	
											$to=$_POST['to'];
											

											$otps= get_otp($to);
											$uid=9990988058;
											$pwd="S5989A";
											$msg="Your OTP is {$otps}";


											//$captcha=input($_REQUEST['captcha']);
											}

											//echo '<div class="head">'.$title.'</div>';
											flush();
											if($uid && $pwd)
											{
											$ibal="0";
											$sbal="0";
											$lhtml="0";
											$shtml="0";
											$khtml="0";
											$qhtml="0";
											$fhtml="0";
											$te="0";
											//echo '<div class="content">User: <span class="number"><b>'.$uid.'</b></span><br>';
											flush();

											$loginpost="gval=&username=".$uid."&password=".$pwd."&Login=Login";

											$ch = curl_init();
											$lhtml=post($login,$loginpost,$ch,$ckfile);
											////curl_close($ch);

											if(stristr($lhtml,'Location: '.$ser.'vem.action') || stristr($lhtml,'Location: '.$ser.'MainView.action') || stristr($lhtml,'Location: '.$ser.'ebrdg.action'))
											{
											preg_match("/~(.*?);/i",$lhtml,$id);
											$id=$id['1'];
											if(!$id)
											{
											$me ='Login Failed. We Didnot Get Session Value.';
											goto end;
											}
											$me ='Login Successfull.';
											goto bal;
											}

											elseif(stristr($lhtml,'Location: http://site2.way2sms.com/entry'))
											{

											$me ='Login Failed. Invalid Login Details.';
											goto end;
											}
											else
											{
											$me ='Login Failed. Unknown Error Occured.';
											goto end;
											}
											bal:
											///$ch = curl_init();

											if ($_POST){	
											$msg=urlencode($msg);
											$main=$ser."smstoss.action";
											$ref=$ser."sendSMS?Token=".$id;
											$conf=$ser."smscofirm.action?SentMessage=".$msg."&Token=".$id."&status=0";

											$post="ssaction=ss&Token=".$id."&mobile=".$to."&message=".$msg."&Send=Send Sms&msgLen=".strlen($msg);
											$mhtml=post($main,$post,$ch,$ckfile,$proxy,$ref);
											if(stristr($mhtml,'smscofirm.action?SentMessage='))
											{ $me ="OTP Sent Successfully To {$to}";}
											else
											{ $me ='Error in Sending SmS.';}
											curl_close($ch);

											end:

											//echo "</div>";
											flush();
											}}

											//echo '<div class="content"><form action ="index.php" method="post"><br/>Receipt:<br><input type="text" name="to" value="'.$to.'"/><br/>Message:<br><textarea name="msg"></textarea><br/><input type="submit" value="Send SmS"/></form></div>';
												
												
												
												
												
												
	
 }	
	
	
	
//this is a get request
 }
 //form processing --------------------------------------------------------------------------/form processing 
 ?>

<?php include ("../includes/layouts/header.php");?>



<div id="main">
	<div id="navigation">
		 
	</div>
	<div id="pages">
	
	<?php	
	
	if(!empty($message)){
	
	echo "<div class=]:message\">" . htmlentities($message) . "</div>" ;
	
	}
	if(!empty($me)){
	
	echo "<div class=]:message\">" . htmlentities($me) . "</div>" ;
	
	}
	
	?>
	
	<?php  $errors =errors(); ?>
	<?php  echo form_errors($errors); ?>
			<h2>login</h2>
		<form action ="login.php" class="styleform2" method="post">
			<p><button type="submit" class="steel" name="otp">Get OTP</button> :
			 	&nbsp;<?php if  (!isset($to)){$to="";}  echo '<input type="text" name="to" value="'.$to.'" />';?>
			</p>
				<p><button type="submit" class="steel" name="verify">Verify OTP</button> :
			 	&nbsp;<?php if  (!isset($otp)){$otp="";}  echo '<input type="text" name="otp" value="'.$otp.'" />';?>
			</p>		
			
				
		<br/>
		
		<?php if (!isset($loginW)){$loginW = "OTP supported by<a href=\"http://site23.way2sms.com/content/index.html\"><h3>Way2Sms.com</h3></a> great Site to send free message </br><button onclick=\"window.location='index.php'\"type=\"button\"class=\"steel\" name=\"submit\" > Cancel</button>";}  echo $loginW ;?>
	
	
		</form>	
		<br/> 
		
		
	</div>
	


<?php include ("../includes/layouts/footer.php");?>