<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>
<?php	find_selected_pages(); ?>
<?php if ((!isset($_SESSION["admins_id"])) and (!isset($_SESSION["owner_id"]))) { redirect_to("login.php");};
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

?>
<?php
	if (!$current_step2){ 
		redirect_to("manage_content.php"); 
}
//form processing --------------------------------------------------------------------------/form processing 
?>

<?php if (isset($_POST['submit'])) {

//escaoe all strings


//validation_function
$required_fields = array("menu_name","position","visible");
validate_presences($required_fields);

$fields_with_max_lengths = array("menu_name" => 30);
validate_max_lengths($fields_with_max_lengths);


//continue if no errors
	if(empty($errors)){
	
			//perform updates
			//process the form
			$menu_name=mysql_prep($_POST["menu_name"]);
			$position=(int)$_POST["position"];
			$visible=(int)$_POST["visible"];
			$id =$current_step2["id"];

			
//=========================================renames related table=====================================			
			
	$step2 = find_step2_by_id($id,false,"menu_name");
	foreach($step2 as $table){
	$table=strtolower(trim($table));
	}			
		$query .= "rename table `{$table}`to `{$menu_name}`";
		$result = mysqli_query($connection, $query);
			
			
		// to perform database update  
		

		 
			$query  = "update step2 set menu_name ='{$menu_name}' , position ={$position}, visible ={$visible} ";
			$query .= "where id = {$id} ";
			$query .= "limit 1 ;";
		
	
    	$result = mysqli_query($connection, $query);
			
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "page updated";
			redirect_to("manage_content.php?pages={$page}&step2={$current_step2["id"]}");
			} else {
			$message = "page update failed here";
			redirect_to("new_page.php");
			}
	}
}elseif (isset($_POST['add'])) {
//===================================add elements=======================================



//validation_function
$required_fields = array("Elements","position","visible");
validate_presences($required_fields);


	if(empty($errors)){

			$elemetnts=mysql_prep($_POST["Elements"]);
			$position=(int)$_POST["position"];
			$visible=(int)$_POST["visible"];
			$table = trim($current_step2["menu_name"]);
			$id =trim($current_step2["id"]);
			
			
			$table_name = check_table($table);
			if ($table_name == FALSE ){
			create_step2_table($table);
			}
	
			$query  = "insert into `{$table}` (";
			$query .= "menu_name, position, content, step2_id) ";
			$query .= "values (";
			$query .= " '{$elemetnts}', {$position}, '{$elemetnts}', {$id}";
			$query .= ");";
		
	
    	$result = mysqli_query($connection, $query);
			
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "New Element Added";
			redirect_to("edit_step2.php?pages={$page}&step2={$current_step2["id"]}");
			} else {
			$message = "Element not updated here";
			//redirect_to("new_page.php");
			}



	}
}elseif (isset($_POST['update'])) {
//===================================update properties====================================



//validation_function

$required_fields = array("data","id");
validate_presences($required_fields);


	if(empty($errors)){

			$data=mysql_prep($_POST["data"]);
			$properties=mysql_prep($_POST["properties"]);
			$id=(int)$_POST["id"];
			$table = trim($current_step2["menu_name"]);

			
			$query  = "update `{$table}`  set `{$properties}` ='{$data}'  ";
			$query .= "where id = {$id} ";
			$query .= "limit 1 ;";
			

    	$result = mysqli_query($connection, $query);
			
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "New Element Added";
			redirect_to("edit_step2.php?pages={$page}&step2={$current_step2["id"]}");
			} else {
			$message = "Element not updated here";
			redirect_to("new_page.php");
			}



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
     <?php echo navigation($current_subjects,$current_pages,$current_step1,$current_step2);?>


	 
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
	
	<div class="head2"style ="margin-top:10;margin-left:20%;">
			<form action ="edit_step2.php?pages=<?php echo urlencode($page);?>&step2=<?php echo urlencode($current_step2["id"]); ?>" method="post">
			 Page name :<input type ="text" name="menu_name" value=" <?php echo htmlentities($current_step2["menu_name"]);?>" />
			 Position :<select name ="position">
				<?php
				$step2_set =find_all_step2(false);
				$step2_count = mysqli_num_rows($step2_set);
				for ($count=1;$count <=$step2_count ;$count++) {
				
				echo "<option value=\"{$count}\" ";
				if ($current_step2["position"] == $count ) {
				echo " selected" ;
				}
				echo ">{$count}</option>";
				}?>
				
				</select>
			Visible :<input type="radio" name="visible" value="0" <?php if ($current_step2["visible"] == 0 ) {echo "checked";} ?> /> No
				<input type="radio" name="visible" value="1" <?php if ($current_step2["visible"] == 1 ) {echo "checked";} ?> /> Yes
				<button class="steel" ><a href="delete_step2.php?step2=<?php echo urlencode($current_step2["id"]); ?>" onclick = "return confirm('Are you sure ? you want to delete <?php echo  $current_step2["menu_name"]; ?>');"> Delete page</a></button>
		<button class="steel" type="submit" name="submit"  >Update Page</button>
		</form>

		
		
	
		<form action ="edit_step2.php?pages=<?php echo urlencode($page);?>&step2=<?php echo urlencode($current_step2["id"]); ?>" method="post">
			Add New Elements on this page:<select name ="Elements">
				<?php
				$elements_set =find_all_elements(false);
				while($elements=mysqli_fetch_assoc($elements_set)) {
				echo "<option value=\"{$elements["menu_name"]}\" ";
				echo ">{$elements["menu_name"]}</option>";
				}?>
				</select>
			Position :<select name ="position">
				<?php
				$table_count = mysqli_num_rows($current_step2["menu_name"]);
				for ($count=1;$count <=$table_count+1 ;$count++) {
				
				echo "<option value=\"{$count}\" ";
				echo ">{$count}</option>";
				}?>
				</select>
			Visible :<input type="radio" name="visible" value="0" <?php if ($current_step2["visible"] == 0 ) {echo "checked";} ?> /> No
				<input type="radio" name="visible" value="1" checked /> Yes	<button class="steel"  type="submit" name="add" > Add Elements </button>  
		</form>
	</div>	
	
	
	
	<?php 
	$table_name = trim($current_step2["menu_name"]);
	$table =check_table($table_name);
	
	if(!empty($message)){
	
	echo "<div class=]:message\">" . htmlentities($message) . "</div>" ;
	
	}
	

	if ($table != FALSE ){
		
	//=================================================================page starts here====================================================

	$table = trim($current_step2["menu_name"]);
	
	$tables_set = find_all($table) ;
	
	echo "</br>";
	echo "<div style =\"width:100% ;margin-top:0;\"></br>"	;	
	echo "<h2 style=\"margin-top:-90;\" >{$current_step2["menu_name"]}</h2></br>";
	
	while ($table =mysqli_fetch_assoc($tables_set)){

	

	
	
		if (($table["content"]) != null){

		

		echo "<div class=\"hoverzone\" style=\"z-index:10;padding-top:20px;float:left;width:calc(100% - 162px);margin:0;" ;// will apply proprties set to DIV
		$elements_properties = find_properties_for_elements_name($table["menu_name"]);
		while ($properties =mysqli_fetch_assoc($elements_properties)) {
	if 	(trim(strtolower($properties["menu_name"]))!="content"){		
		echo "{$properties["menu_name"]}:";
		$name = trim(strtolower($properties["menu_name"]));
		$value_set=find_row($current_step2["menu_name"],"id = {$table["id"]}");
		while ($value =mysqli_fetch_assoc($value_set)) {
		echo nl2br(htmlentities($value[$name]));	
		}
			echo ";";
		}
		}
			echo "\">";
		
		echo  nl2br(htmlentities($table["content"]));
		echo ". ";
		}

?>

<div class="head3"style ="float:left;position:absolute;width:calc(100% - 162px);height:50%;margin-top:-10;font-size:12;color:black;background-color:rgba(253, 253, 253, .7);">
<?php	echo "<button class=\"steel\" ><a href=\"delete_element.php?pages={$page}&step2={$current_step2["id"]}&id={$table["id"]}\" onclick = \"return confirm('Are you sure ? you want to delete {$table["menu_name"]}\"> Delete {$table["menu_name"]}</a></button>";
			$elements_properties = find_properties_for_elements_name($table["menu_name"]);
			while ($properties =mysqli_fetch_assoc($elements_properties)) {
			$values_set = find_values_for_properties($properties["id"]);


			echo "</br>";
			echo "<div class=\"styleform\"><form action =\"edit_step2.php?pages={$page}&step2={$current_step2["id"]}\" method=\"post\" enctype=\"multipart/form-data\">";
			$safe_id =urlencode($table["id"]);
			echo "<label style=\"width:80;\">";
			echo htmlentities($properties["menu_name"]);// will get name of property applicable from Proprtties table associated with type of element
			echo "</label>";
			$name = trim(strtolower($properties["menu_name"]));
		
	if 	((trim(strtolower($table["menu_name"]))=="div") and(trim($properties["menu_name"])=="content")){

			echo "<textarea  name=\"data\" style=\"margin-left:-5;margin-top:0;width: calc(100% - 152px);height:30%;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box; \">{$table[$name]}</textarea>";
		}else{			
			echo " <input type =\"text\" name=\"data\" value=\"{$table[$name]}\"> ";
		}
			echo " <input type =\"hidden\" name=\"id\" value=\"{$safe_id}\"> ";
			echo " <input type =\"hidden\" name=\"properties\" value=\"{$name}\"> ";
			echo "<input type=\"submit\" name=\"update\" value=\"Update {$name}\" />";
			echo "</form></div>";

			}
			echo "</div>";
	
		
		//}	
				
			?>

	</div>	
	
	<?php

		 
	echo "";
	echo "</br>";
	echo "</br>";		
	}	
	
echo "</div>"	;
	
	//=================================================================page ends here====================================================	
				/*	if (($table["menu_name"]) != null){ echo ($table["menu_name"]); }
					if (($table["content"]) != null){ echo ($table["content"]); }
					if (($table["height"]) != null){ echo ($table["height"]); }
					if (($table["width"]) != null){ echo ($table["width"]); }
					if (($table["position"]) != null){ echo ($table["position"]); }
					if (($table["float"]) != null){ echo ($table["float"]); }
					if (($table["clear"]) != null){ echo ($table["clear"]); }
					if (($table["color"]) != null){ echo ($table["color"]); }
					if (($table["border"]) != null){ echo ($table["border"]); }
					if (($table["border-bottom"]) != null){ echo ($table["border-bottom"]); }
					if (($table["border-top"]) != null){ echo ($table["border-top"]); }
					if (($table["border-left"]) != null){ echo ($table["border-left"]); }
					if (($table["border-right"]) != null){ echo ($table["border-right"]); }
					if (($table["padding"]) != null){ echo ($table["padding"]); }
					if (($table["padding-top"]) != null){ echo ($table["padding-top"]); }
					if (($table["padding-bottom"]) != null){ echo ($table["padding-bottom"]); }
					if (($table["padding-left"]) != null){ echo ($table["padding-left"]); }
					if (($table["padding-right"]) != null){ echo ($table["padding-right"]); }
					if (($table["margin"]) != null){ echo ($table["margin"]); }
					if (($table["margin-left"]) != null){ echo ($table["margin-left"]); }
					if (($table["margin-right"]) != null){ echo ($table["margin-right"]); }
					if (($table["margin-bottom"]) != null){ echo ($table["margin-bottom"]); }
					if (($table["margin-top"]) != null){ echo ($table["margin-top"]); }
					if (($table["background-color"]) != null){ echo ($table["background-color"]); }
					if (($table["display"]) != null){ echo ($table["display "]); }
					if (($table["font-size"]) != null){ echo ($table["font-size"]); }
					if (($table["line-height"]) != null){ echo ($table["line-height"]); }
					if (($table["list-style"]) != null){ echo ($table["list-style"]); }
					if (($table["overflow"]) != null){ echo ($table["overflow "]); }
					if (($table["resize"]) != null){ echo ($table["resize"]); }
					if (($table["size"]) != null){ echo ($table["size"]); }
					if (($table["text-decoration"]) != null){ echo ($table["text-decoration"]); }
					if (($table["text-align"]) != null){ echo ($table["text-align"]); }
					if (($table["text-overflow"]) != null){ echo ($table["text-overflow"]); }
					if (($table["visibility"]) != null){ echo ($table["visibility "]); }
					if (($table["z-index"]) != null){ echo ($table["z-index` "]); } */
	}?>
		

	
</div>		

 <?php include ("../includes/layouts/footer.php");?>


<!---  Content : 
			 
			<p> 
					<textarea name="content" style="width: calc(100% - 160px);height:60%;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box; " ><?php echo  htmlentities($current_step2["content"]); ?>  </textarea> 
			</p> 
			
				
			--->
			