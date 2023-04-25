<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>



<?php find_selected_properties(); 
 if ((!isset($_SESSION["admins_id"])) and (!isset($_SESSION["owner_id"]))) { redirect_to("login.php");};
if (isset($_GET["properties"]))
	{
	$propertie = urlencode($_GET["properties"]) ;

	}
				if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $current_elements["owner_id"] )) or (isset($_SESSION["admins_id"]))) 
				{
				} 
				elseif (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $element["owner_id"] )) or (isset($_SESSION["admins_id"])))
				{
				}
				else 
				{
					
					redirect_to( "index.php");
				}




	if (!$current_properties){ 
		redirect_to("manage_containers.php"); 
	
}

 if (isset($_POST['submit'])) {
//process the form

$properties_id = $current_properties["id"];
$menu_name=mysql_prep($_POST["menu_name"]);
$position=(int)$_POST["position"];
//escaoe all strings


//validation_function
$required_fields = array("menu_name","position");
validate_presences($required_fields);

$fields_with_max_lengths = array("menu_name" => 30);
validate_max_lengths($fields_with_max_lengths);



//continue if no errors
	if(empty($errors)){
	
//perform database query
$query  = "insert into `values` (";
$query .= "menu_name, position,properties_id) ";
$query .= "values (";
$query .= " '{$menu_name}', {$position}, {$properties_id}";
$query .= ");";

$result = mysqli_query($connection, $query);
		// to perform database update  
		
			
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "propertie updated";
			//redirect_to("manage_containers.php?properties={$properties_id}");
			} else {
			$message = "propertie update failed here at this place";
			//redirect_to("new_value.php");
			
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
 	<?php echo container_navigation($current_elements,$current_properties,$current_values);
	 	$properties_id = $current_properties["id"];?>
		 
	</div>
	<div id="pages">
	
	
	<?php	
	$message= message();
	if(!empty($message)){
	
	echo $message ;
	
	}
	$properties_id = $current_properties["id"];
	?>
	
	<?php  $errors =errors(); ?>
	<?php  echo form_errors($errors); ?>

		


	<h2>Create propertie </h2>
		<form action ="new_value.php?properties=<?php echo urlencode($current_properties["id"]); ?>" method="post">
			<p> propertie name : 
				<input type ="text" name="menu_name" value="" />
 
			<p> Position :
					&nbsp;	&nbsp;	&nbsp;<select name ="position">
				<?php
				$values_set =find_values_for_properties($current_properties["id"]);
				$values_count = mysqli_num_rows($values_set);
				for ($count=1;$count <=($values_count +1) ;$count++) {
				
				echo "<option value=\"{$count}\" >{$count}</option>";
				}?>
				
				</select>
			</p>

		<a href="manage_containers.php?properties=<?php echo urlencode($current_properties["id"]); ?>">Cancel </a>
		&nbsp;
		&nbsp;
		&nbsp;
		<a href="delete_values.php?values=<?php echo urlencode($current_values["id"]); ?>" onclick = "return confirm('Are you sure ? you want to delete <?php echo  $current_values["menu_name"]; ?>');"> Delete propertie</a>
		&nbsp;
		&nbsp;
		&nbsp;
	
		<input type="submit" name="submit" value=" Create propertie" />
		</form>	
		<br/> 
	</div>
	


<?php include ("../includes/layouts/footer.php");?>