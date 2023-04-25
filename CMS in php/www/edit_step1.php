<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php require_once ("../includes/validation_function.php");?>
<?php	find_selected_pages(); ?>
<?php


	if (!$current_step1){ 
		redirect_to("manage_content.php"); 
}
//form processing --------------------------------------------------------------------------/form processing 
?>

<?php if (isset($_POST['submit'])) {

//escaoe all strings


//validation_function
$required_fields = array("menu_name","content","position","visible");
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
			$content=mysql_prep($_POST["content"]);

			
		// to perform database update  
		
			$id =$current_step1["id"];
			 
			$query  = "update step1 set menu_name ='{$menu_name}' ,content='{$content}', position ={$position}, visible ={$visible} ";
			//$query .= "set menu_name =  , ";        
			//$query .= "position =  ";
			//$query .= "visible =  ";
			$query .= "where id = {$id} ";
			$query .= "limit 1 ;";
		
	
    	$result = mysqli_query($connection, $query);
			
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "page updated";
			redirect_to("manage_content.php");
			} else {
			$message = "page update failed here";
			//redirect_to("new_page.php");
			}

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
			<h2> Edit page <?php echo htmlentities($current_step1["menu_name"]);?> </h2>
		<form action ="edit_step1.php?pages=<?php echo $current_step1["pages_id"] ;?>&step1=<?php echo $current_step1["id"];?>" method="post">
			<p> Page name : 
				<input type ="text" name="menu_name" value=" <?php echo htmlentities($current_step1["menu_name"]);?>" />
			</p>
			<p> Position :
					&nbsp;	&nbsp;	&nbsp;<select name ="position">
				<?php
				$step1_set =find_all_step1(false);
				$step1_count = mysqli_num_rows($step1_set);
				for ($count=1;$count <=$step1_count ;$count++) {
				
				echo "<option value=\"{$count}\" ";
				if ($current_step1["position"] == $count ) {
				echo " selected" ;
				}
				echo ">{$count}</option>";
				}?>
				
				</select>
			</p>
			<p>Visible :
					&nbsp;	&nbsp;	&nbsp;	<input type="radio" name="visible" value="0" <?php if ($current_step1["visible"] == 0 ) {echo "checked";} ?> /> No
				&nbsp;
				<input type="radio" name="visible" value="1" <?php if ($current_step1["visible"] == 1 ) {echo "checked";} ?> /> Yes
			</p>
				
			  Content : 
			 
			<p> 
	<textarea name="content" style="margin-left:-5;width: calc(100% - 152px);height:60%;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box; " > <?php echo  htmlentities($current_step1["content"]); ?>  </textarea> 
			</p> 
			

		<br/>
		&nbsp;
		&nbsp;
		<button class="steel" ><a href="manage_content.php?pages=<?php echo $current_step1["pages_id"] ;?>&step1=<?php echo $current_step1["id"];?>">Cancel </a></button>
		&nbsp;
		&nbsp;
		&nbsp;
		<button class="steel" ><a href="delete_step1.php?step1=<?php echo urlencode($current_step1["id"]); ?>" onclick = "return confirm('Are you sure ? you want to delete <?php echo  $current_step1["menu_name"]; ?>');"> Delete page</a></button>
		&nbsp;
		&nbsp;
		&nbsp;
	
		<button type="submit" style="float:right;margin-right:10px" class="steel" name="submit" >Update Page </button><br/> 
		</form>
	</div>
	

<?php include ("../includes/layouts/footer.php");?>