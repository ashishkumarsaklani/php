<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>
<?php	find_selected_properties(); ?>
<?php
	if (!$current_properties){ 
		redirect_to("manage_content.php"); 
}
//form processing --------------------------------------------------------------------------/form processing 
?>
<?php if ((!isset($_SESSION["admins_id"])) and (!isset($_SESSION["owner_id"]))) { redirect_to("login.php");};
if (isset($_GET["properties"]))
	{
	$propertie = urlencode($_GET["properties"]) ;
		}
if (!isset($_SESSION["admins_id"]))
{
	redirect_to( "index.php");
}

 if (isset($_POST['submit'])){

//escaoe all strings


//validation_function
$required_fields = array("menu_name","position");
validate_presences($required_fields);

$fields_with_max_lengths = array("menu_name" => 30);
validate_max_lengths($fields_with_max_lengths);


//continue if no errors
	if(empty($errors)){
	
			//perform updates
			//process the form
			$menu_name=mysql_prep($_POST["menu_name"]);
			$position=(int)$_POST["position"];


			
		// to perform database update  
		
			$id =$current_properties["id"];
			 
			$query  = "update properties set menu_name ='{$menu_name}' ,position ={$position} ";
			//$query .= "set menu_name =  , ";        
			//$query .= "position =  ";
			//$query .= "visible =  ";
			$query .= "where id = {$id} ";
			$query .= "limit 1 ;";
		
	
    	$result = mysqli_query($connection, $query);
			
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "propertie updated";
			redirect_to("manage_containers.php?&properties={$propertie}");
			} else {
			$message = "propertie update failed here";
			//redirect_to("new_propertie.php");
			}

	}
	
}elseif (isset($_POST['delete'])) {
	if(empty($errors)){
	
			//perform updates
			//process the form
			
		// to perform database update  
		
			$id =$current_properties["id"];
			 
	
			$query = "delete from `properties` where id ={$id} limit 1 ";
			$result =mysqli_query($connection,$query);
			$query .= "limit 1 ;";
	    	$result = mysqli_query($connection, $query);
		
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "element Deleted";
			redirect_to("manage_containers.php?&elements={$element}");
			} else {
			$message = "element update failed";
			//var_dump($owner);
			//redirect_to("new_element.php");
			}



						
			
			
	//}
	
}

}else{
//this is a get request
 }
 //form processing --------------------------------------------------------------------------/form processing 
?>
<?php $layout_context = "admin"; ?>
<?php include ("../includes/layouts/header.php");?>

<div id="main">
	<div id="navigation">
		<a href="admins.php">&laquo;Main Menu</a> <br/>
<?php echo container_navigation($current_elements,$current_properties,$current_values);?>
		 
	</div>
	<div id="pages">
	
	<?php	
	// echo message();
	
	if(!empty($message)){
	
	echo "<div class=]:message\">" . htmlentities($message) . "</div>" ;
	
	}
	
	?>
	
	<?php  $errors =errors(); ?>
	<?php  echo form_errors($errors); ?>
			<h2> Edit propertie <?php echo htmlentities($current_properties["menu_name"]);?> </h2>
		<form action ="edit_properties.php?properties=<?php echo urlencode($current_properties["id"]); ?>" method="post">
			<p> propertie name : 
				<input type ="text" name="menu_name" value=" <?php echo htmlentities($current_properties["menu_name"]);?>" />
			</p>
			<p> Position :
					&nbsp;	&nbsp;	&nbsp;<select name ="position">
				<?php
				$properties_set =find_all_properties(false);
				$properties_count = mysqli_num_rows($properties_set);
				for ($count=1;$count <=$properties_count ;$count++) {
				
				echo "<option value=\"{$count}\" ";
				if ($current_properties["position"] == $count ) {
				echo " selected" ;
				}
				echo ">{$count}</option>";
				}?>
				
				</select>
			</p>
					

		<br/>
		&nbsp;
		&nbsp;
		<a href="manage_content.php?properties=<?php echo $current_properties["id"];?>">Cancel </a>
		&nbsp;
		&nbsp;
		&nbsp;
		<button type="submit" class="steel" name="delete"  onclick = "return confirm('Are you sure ? you want to delete <?php echo  $current_properties["menu_name"]; ?>');">Delete propertie</button>	 
		&nbsp;
		&nbsp;
		&nbsp;
	
		<button type="submit" class="steel" name="submit"  >Edit Property</button>
		</form>
	</div>
	

<?php include ("../includes/layouts/footer.php");?>