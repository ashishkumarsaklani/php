<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>


<?php find_selected_pages(); 

 if ((!isset($_SESSION["admins_id"])) and (!isset($_SESSION["owner_id"]))) { redirect_to("login.php");};
if (isset($_GET["pages"]))
	{
	$page = urlencode($_GET["pages"]) ;
	$subject =find_owner_for_page($page) ;
	}
				if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $current_subjects["owner_id"] )) or (isset($_SESSION["admins_id"]))) 
				{
				} 
				elseif (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subject["owner_id"] )) or (isset($_SESSION["admins_id"])))
				{
				}
				else 
				{
					
					redirect_to( "index.php");
				}



	if (!$current_step1){ 
		redirect_to("manage_content.php"); 
	
}

 if (isset($_POST['submit'])) {
//process the form

$step1_id = $current_step1["id"];
$menu_name=mysql_prep($_POST["menu_name"]);
$menu_name=trim($menu_name);
$position=(int)$_POST["position"];
$visible=(int)$_POST['visible'];	
$content=mysql_prep($_POST["content"]);
//escaoe all strings


//validation_function
$required_fields = array("menu_name","position","visible","content");
validate_presences($required_fields);

$fields_with_max_lengths = array("menu_name" => 30);
validate_max_lengths($fields_with_max_lengths);



//continue if no errors
	if(empty($errors)){
	
//perform database query

create_step2_table($menu_name);



$query  = "insert into step2 (";
$query .= "menu_name, position, step1_id, visible, content) ";
$query .= "values (";
$query .= " '{$menu_name}', {$position}, {$step1_id},{$visible}, '{$content}'";
$query .= ");";

$result = mysqli_query($connection, $query);
/* 		// to perform database update  
		$query  = "select * ";
		$query .= "from step2 ";
		$query .= "where menu_name={$menu_name} ";
		$step2_set = mysqli_query($connection,$query);						
		while ($step2=mysqli_fetch_assoc($step2_set)){
		$step2id= $step2["id"] ;
						}
		 */
		
		

		
		if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "page updated";
			redirect_to("manage_content.php?&step1={$step1_id}");
			} else {
			$message = "page update failed here at this place";
			redirect_to("new_step2.php");
			
			}

	} 	
else {
	$_SESSION["message"] = " Please fill all required Fields";
	 

	}
	 
	 
}
 //form processing --------------------------------------------------------------------------/form processing 
?>



<?php $layout_context = "admin"; ?>
<?php require_once ("../includes/layouts/header.php");?>



<div id="main">
	<div id="navigation">
		<a href="admins.php">&laquo;Main Menu</a> <br/>
     <?php echo navigation($current_subjects,$current_pages,$current_step1,$current_step2);
	 	$step1_id = $current_step1["id"];?>
		 
	</div>
	<div id="pages">
	
	
	<?php	
	$message= message();
	if(!empty($message)){
	
	echo $message ;
	
	}
	$step1_id = $current_step1["id"];
	?>
	
	<?php  $errors =errors(); ?>
	<?php  echo form_errors($errors); ?>

		


	<h2>Create page </h2>
		<form action ="new_step2.php?step1=<?php echo urlencode($current_step1["id"]); ?>" method="post">
			<p> Page name : 
				<input type ="text" name="menu_name" value="" />
 
			<p> Position :
					&nbsp;	&nbsp;	&nbsp;<select name ="position">
				<?php
				$step2_set =find_step2_for_step1($current_step1["id"]);
				$step2_count = mysqli_num_rows($step2_set);
				for ($count=1;$count <=($step2_count +1) ;$count++) {
				
				echo "<option value=\"{$count}\" >{$count}</option>";
				}?>
				
				</select>
			</p>
			<p>Visible :
					&nbsp;	&nbsp;	&nbsp;	<input type="radio" name="visible" value="0"/> No
				&nbsp;
				<input type="radio" name="visible" value="1" checked /> Yes
			</p>
				
			  Content : 
			 
			<p> 
				<textarea name="content" rows="20" cols ="50" ></textarea>
			</p> 
			

		<br/>
		
		<a href="manage_content.php?step1=<?php echo urlencode($current_step1["id"]); ?>">Cancel </a>
		&nbsp;
		&nbsp;
		&nbsp;
		<a href="delete_step2.php?step2=<?php echo urlencode($current_step2["id"]); ?>" onclick = "return confirm('Are you sure ? you want to delete <?php echo  $current_step2["menu_name"]; ?>');"> Delete page</a>
		&nbsp;
		&nbsp;
		&nbsp;
	
		<input type="submit" name="submit" value=" Create page" />
		</form>	
		<br/> 
	</div>

	


<?php include ("../includes/layouts/footer.php");?>