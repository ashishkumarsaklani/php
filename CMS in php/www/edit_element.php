<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>
<?php	find_selected_properties(); ?>
<?php if ((!isset($_SESSION["admins_id"])) and (!isset($_SESSION["owner_id"]))) { redirect_to("login.php");};
if (isset($_GET["properties"]))
	{
	$propertie = urlencode($_GET["properties"]) ;
	$element =find_owner_for_propertie($propertie) ;
	}elseif(isset($_GET["elements"])){
	$element =	urlencode($_GET["elements"]) ;
		
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
?>
<?php
	if (!$current_elements){ 
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
		
			$id =$current_elements["id"];
			 
			$query  = "update elements set menu_name ='{$menu_name}' , position ={$position} "; // pic ='$imageData'
			$query .= "where id = {$id} ";
			
			$query .= "limit 1 ;";
		
	
    	$result = mysqli_query($connection, $query);
		
		
						
		
			
		
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "element updated";
			redirect_to("manage_containers.php?&elements={$element}");
			} else {
			$message = "element update failed";
			//var_dump($owner);
			//redirect_to("new_element.php");
			}



						
			
			
	//}
	
}
}elseif (isset($_POST['delete'])) {
	if(empty($errors)){
	
			//perform updates
			//process the form
			
		// to perform database update  
		
			$id =$current_elements["id"];
			 
	
			$query = "delete from `elements` where id ={$id} limit 1 ";
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

			<h2> Edit element <?php echo htmlentities($current_elements["menu_name"]);?> </h2>
		<form action ="edit_element.php?elements=<?php echo urlencode($current_elements["id"]); ?>"  method="post"enctype="multipart/form-data">
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
            $('#Edit element').attr('disabled', 'disabled');
        } else {
            $('#Edit element').removeAttr('disabled');
        }
    });
})()

</script>
			<p> element name : 
				<input type ="text" name="menu_name" value=" <?php echo htmlentities($current_elements["menu_name"]);?>" />
			</p>
			<p> Position   :&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
			&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;		
				<select name ="position">
				<?php
				$elements_set =find_all_elements(false);
				$elements_count = mysqli_num_rows($elements_set);
				for ($count=1;$count <=$elements_count ;$count++) {
				
				echo "<option value=\"{$count}\" ";
				if ($current_elements["position"] == $count ) {
				echo " selected" ;
				}
				echo ">{$count}</option>";
				}?>
				
				</select>
			</p>
			
				<button type="submit" class="steel" name="submit"  >Edit element</button>
				<button type="submit" class="steel" name="delete"  onclick = "return confirm('Are you sure ? you want to delete <?php echo  $current_elements["menu_name"]; ?>');">Delete Element</button>	
		</form>
		
	
	
		<a href="manage_containers.php?elements=<?php echo $current_elements["id"] ;?>">Cancel </a>
		&nbsp;
		&nbsp;
		</div>
	

<?php include ("../includes/layouts/footer.php");?>