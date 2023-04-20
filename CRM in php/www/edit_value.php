<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>
<?php	find_selected_properties(); ?>
<?php


	if (!$current_values){ 
		redirect_to("manage_containers.php"); 
}
//form processing --------------------------------------------------------------------------/form processing 
?>

<?php if (isset($_POST['submit'])) {

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
		
			$id =$current_values["id"];
			 
			$query  = "update `values` set menu_name ='{$menu_name}' , position ={$position} ";
			$query .= "where id = {$id} ";
			$query .= "limit 1 ;";
		
	
    	$result = mysqli_query($connection, $query);
			
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "page updated";
			redirect_to("manage_containers.php");
			} else {
			$message = "page update failed here";
			//redirect_to("new_page.php");
			}

	}
	
}elseif (isset($_POST['delete'])) {
	if(empty($errors)){
	
			//perform updates
			//process the form
			
		// to perform database update  
		
			$id =$current_values["id"];
			 
	
			$query = "delete from `values` where id ={$id} limit 1 ";
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

}
else{
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
			<h2> Edit page <?php echo htmlentities($current_values["menu_name"]);?> </h2>
		<form action ="edit_value.php?properties=<?php echo $current_values["properties_id"] ;?>&values=<?php echo $current_values["id"];?>" method="post">
			<p> Page name : 
				<input type ="text" name="menu_name" value=" <?php echo htmlentities($current_values["menu_name"]);?>" />
			</p>
			<p> Position :
					&nbsp;	&nbsp;	&nbsp;<select name ="position">
				<?php
				$values_set =find_all_values(false);
				$values_count = mysqli_num_rows($values_set);
				for ($count=1;$count <=$values_count ;$count++) {
				
				echo "<option value=\"{$count}\" ";
				if ($current_values["position"] == $count ) {
				echo " selected" ;
				}
				echo ">{$count}</option>";
				}?>
				
				</select>
			</p>
			
		&nbsp;
		&nbsp;
		<a href="manage_containers.php?properties=<?php echo $current_values["properties_id"] ;?>&values=<?php echo $current_values["id"];?>">Cancel </a>
		&nbsp;
		&nbsp;
		&nbsp;
		<button type="submit" class="steel" name="delete"  onclick = "return confirm('Are you sure ? you want to delete <?php echo  $current_values["menu_name"]; ?>');">Delete Value</button>	 
		&nbsp;
		&nbsp;
		&nbsp;
	
	<button type="submit" class="steel" name="submit"  >Edit value</button>
		</form>
	</div>
	

<?php include ("../includes/layouts/footer.php");?>