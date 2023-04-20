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
	if (!$current_subjects){ 
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
			$owner=(int)$_POST["owner"];
		//	$imageName = mysqli_real_escape_string($connection,$_FILES["image"]["name"]);
		//	$imageData = mysqli_real_escape_string($connection,file_get_contents($_FILES["image"]["tmp_name"]));
		//	$imageType = mysqli_real_escape_string($connection,$_FILES["image"]["type"]);

		//if (substr($imageType,0,5) =="image"){	
			

			
		// to perform database update  
		
			$id =$current_subjects["id"];
			 
			$query  = "update subjects set menu_name ='{$menu_name}' , position ={$position}, visible ={$visible}, owner_id ={$owner} "; // pic ='$imageData'
			$query .= "where id = {$id} ";
			
			$query .= "limit 1 ;";
		
	
    	$result = mysqli_query($connection, $query);
		
		
						
		
						$query  = "update `subjects`,`owner` \n"
								. "set `subjects`.pic = `owner`.pic \n"
								. "where `owner`.id = {$owner} and `subjects`.owner_id = {$owner} ";
												
				
						$result = mysqli_query($connection, $query);
			 
						
		
		
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "Subject updated";
			redirect_to("manage_content.php");
			} else {
			$message = "Subject update failed";
			//var_dump($owner);
			//redirect_to("new_subject.php");
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

			<h2> Edit Subject <?php echo htmlentities($current_subjects["menu_name"]);?> </h2>
		<form action ="edit_subject.php?subjects=<?php echo urlencode($current_subjects["id"]); ?>"  method="post"enctype="multipart/form-data">
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
            $('#Edit Subject').attr('disabled', 'disabled');
        } else {
            $('#Edit Subject').removeAttr('disabled');
        }
    });
})()

</script>
			<p> Subject name : 
				<input type ="text" name="menu_name" value=" <?php echo htmlentities($current_subjects["menu_name"]);?>" />
			</p>
			<p> Position   :&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
			&nbsp;	&nbsp;	&nbsp;	&nbsp;&nbsp;		
				<select name ="position">
				<?php
				$subjects_set =find_all_subjects(false);
				$subjects_count = mysqli_num_rows($subjects_set);
				for ($count=1;$count <=$subjects_count ;$count++) {
				
				echo "<option value=\"{$count}\" ";
				if ($current_subjects["position"] == $count ) {
				echo " selected" ;
				}
				echo ">{$count}</option>";
				}?>
				
				</select>
			</p>
			
			<p> Owner   :&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
			&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
				<select name ="owner">
				<?php
				$owners_set =find_all_owners(false);
				$owners_count = mysqli_num_rows($owners_set);
		
			
				while($owners=mysqli_fetch_assoc($owners_set)) {
				echo "<option value=\"{$owners["id"]}\" ";
				echo ">{$owners["username"]}</option>";
				}?>
				
				</select>

			</p>
				
			<p>Visible 	        :&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp
				<input type="radio" name="visible" value="0" <?php if ($current_subjects["visible"] == 0 ) {echo "checked";} ?> /> No
				&nbsp;
				<input type="radio" name="visible" value="1" <?php if ($current_subjects["visible"] == 1 ) {echo "checked";} ?> /> Yes
			</p>	<!--	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
			&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	
							<input type= "file" name ="image" required /><p> -->
					&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
			&nbsp;	&nbsp;	&nbsp;	&nbsp;		&nbsp;	&nbsp;	
				<input type="submit" name="submit" value="Edit Subject" />

	
		</form>
		
		<a href="manage_content.php?subjects=<?php echo $current_subjects["id"] ;?>">Cancel </a>
		&nbsp;
		&nbsp;
		<a href="delete_subjects.php?subjects=<?php echo urlencode($current_subjects["id"]); ?>" onclick = "return confirm('Are you sure ? you want to delete <?php echo  $current_subjects["menu_name"]; ?>');"> Delete Subject</a>
	</div>
	

<?php include ("../includes/layouts/footer.php");?>