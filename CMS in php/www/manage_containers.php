<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php $layout_context = "admin"; ?>
<?php include ("../includes/functions.php");?>
<?php include ("../includes/layouts/header.php");?>
<?php	find_selected_properties(); ?>
<?php if ((!isset($_SESSION["admins_id"]))) { redirect_to("login.php");};
if (isset($_GET["properties"]))
	{
	$properties = urlencode($_GET["properties"]) ;
	$elements =find_properties_for_elements($properties) ;
	}
if (isset($_GET["elements"]))
	{
	$elements =	$_GET["elements"];
	} 
if (!isset($_SESSION["admins_id"]))
	{
	redirect_to( "index.php");
	}

?>
	
 <?php if (isset($_POST['submit'])){	

	$values_set = find_values_for_properties($properties);
	while($values =mysqli_fetch_assoc($values_set)){
		
		if (isset($_POST["{$values["id"]}"])) {

						
			$query  = "update `values` set menu_name ='{$_POST[$values["id"]]}'" ;
			$query .= "where id = {$values["id"]} ";
			$query .= "limit 1 ;";		
		
			    	$result = mysqli_query($connection, $query);
			
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "page updated";
			redirect_to("manage_containers.php?elements={$elements}");
			} else {
			$message = "page update failed here";
			//redirect_to("new_page.php");
			}

		

		}
 }	
 }
 ?>
	
<div id="main">

	
	<div id="navigation">
			   <?php
				   if (isset($_SESSION["admins_id"])) { ?> 
				   <a href="admins.php">
				<?php } 
					else  {	?>
					<a href="index.php">
				<?php }	?>
				
	HOME </a> 
		 <a href ="new_element.php"> +  Add A element </a>
	<?php echo container_navigation($current_elements,$current_properties,$current_values);?>
	 
	  

	 
	</div>
	<?php	
	// echo message();
	
	if(!empty($message)){
	
	echo "<div class=]:message\">" . htmlentities($message) . "</div>" ;
	
	}
	
	?>
	<div id="properties">
		<?php  echo message(); ?>
		
			<?php if ($current_elements)  {	?>
			
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
																			$('#Update Pic').attr('disabled', 'disabled');
																		} else {
																			$('#Update Pic').removeAttr('disabled');
																		}
																	});
																})()

																</script>
				<h2>Manage <?php echo $current_elements["menu_name"];?></h2>
						<!---<div class="container">
							
						
									<form action ="manage_containers.php?elements=<?php //echo $current_elements["id"] ;?>" method="post" enctype="multipart/form-data">
									<img src="image1.php?tab=elements&r=menu_pic&id=<?php //echo $current_elements["id"] ;?>  height="350"; width ="300" ;class="img"	alt=""> 
									<input type= "file" name ="image"  required/>
									<input type="submit" name="submit" value="Update Pic" />
									</form>
				
						 
					</div>		--->
			<div >
			Menu name : <?php echo htmlentities($current_elements["menu_name"]);?><span style="padding-left:20;"> Position  &nbsp;	&nbsp;	&nbsp: <?php echo  $current_elements["position"]; 	?></span>	<br/>
		
			<a href="edit_element.php?elements=<?php echo urlencode($current_elements["id"]); ?>"> EDIT <?php echo $current_elements["menu_name"];?> propertie</a>
			</div>
			<div >						
			<h3> properties in  <?php echo $current_elements["menu_name"];?></h3>
			<ul>
			<?php $elements_properties = find_properties_for_elements($current_elements["id"]);
			while ($properties =mysqli_fetch_assoc($elements_properties)) {
			$values_set = find_values_for_properties($properties["id"]);
			while($values =mysqli_fetch_assoc($values_set)){
			echo "<div class=\"styleform\"><form action =\"manage_containers.php?elements={$current_elements["id"]}&properties={$properties["id"]}\" method=\"post\" enctype=\"multipart/form-data\">";
			echo "<li>";
			$safe_properties_id =urlencode($properties["id"]);
			echo "<label style=\"width:40;\">";
			echo htmlentities($properties["menu_name"]);
			echo "</label>";
			echo " <input type =\"text\" name=\"{$values["id"]}\" value=\"{$values["menu_name"]}\"> ";
			echo "<input type=\"submit\" name=\"submit\" value=\"Update {$properties["menu_name"]}\" />";
			echo "</form></div>";
			}
			echo "</li>";
			}
			?>
			</ul>
			
			<br/>
			+ <a href ="new_properties.php?elements=<?php echo urlencode($current_elements["id"]);?>">Add a new propertie to <?php echo $current_elements["menu_name"];?></a>
		</div>	
			<div id= <?php echo "{$current_elements["menu_name"]}{$current_elements["id"]}";?> style="visibility:hidden;">
			
			<form action ="manage_containers.php?elements=<?php echo $current_elements["id"] ;?>" method="post" enctype="multipart/form-data">
			Add a new propertie to <?php echo $current_elements["menu_name"];?>
			
			
				<p> Menu name: 
			&nbsp;
			 <input type ="text"  name="Property"  />
			</p>
			<p> Position :
				&nbsp;	&nbsp;<input type="number" name="position" value="" />
			</p>
				
			<br/>
		

	
	
			<input type="submit" name="submit" value="Login" /><input type="button" name="cancel" value="Cancel"
					onclick="window.location='manages_containers.php'" />
			</div>
			
											<?php } elseif ($current_values){ ?>
											<h2>Manage <?php echo $current_values["menu_name"];?> </h2>
											Menu name : <?php echo  htmlentities($current_values["menu_name"]); 	?>	<br/>
											Position  : <?php echo  $current_values["position"]; 	?>	<br/>
											<a href="edit_value.php?properties=<?php  echo urlencode($current_values["properties_id"]);?>&values=<?php echo urlencode($current_values["id"]); ?>"> Edit <?php echo $current_values["menu_name"];?></a>
											

											
											
						<?php }elseif ($current_properties){ ?>
						<h2>Manage <?php echo $current_properties["menu_name"];?> </h2>
							Menu name : <?php echo  htmlentities($current_properties["menu_name"]); 	?>	<br/>
							Position  : <?php echo  $current_properties["position"]; 	?>	<br/>
						<a href="edit_properties.php?properties=<?php echo urlencode($current_properties["id"]); ?>"> Edit <?php echo $current_properties["menu_name"];?></a>
						<h3> Vaues in <?php echo $current_properties["menu_name"];?></h3>
						<ul>
						<?php $properties_value = find_values_for_properties($current_properties["id"]);
						while ($value =mysqli_fetch_assoc($properties_value)) {
											
						echo "<li>";
						$safe_value_id =urlencode($value["id"]);
						echo "<a href=\"manage_containers.php?properties={$current_properties["id"]}&value={$safe_value_id}\">";
						echo htmlentities($value["menu_name"]);
						echo "</a>";
						echo "</li>";}?>
						</ul>
						<br/>
						+ <a href ="new_value.php?properties=<?php echo urlencode($current_properties["id"]);?>">Add a new propertie to <?php echo $current_properties["menu_name"];?></a>
											<?php }
											
											
											else { ?> 
											Please select a element or propertie
											<?php }


?> 
	</div>



	

<?php include ("../includes/layouts/footer.php");?>