<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php $layout_context = "admin"; ?>
<?php include ("../includes/functions.php");?>
<?php include ("../includes/layouts/header.php");?>
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
	




<?php if (isset($_POST['submit'])) {


//escaoe all strings



$_SESSION["errors"] =errors();

//continue if no errors
	if(empty($errors)){
	
			//perform updates
			//process the form
			$imageName = mysqli_real_escape_string($connection,$_FILES["image"]["name"]);
			$imageData = mysqli_real_escape_string($connection,file_get_contents($_FILES["image"]["tmp_name"]));
			$imageType = mysqli_real_escape_string($connection,$_FILES["image"]["type"]);

		if (substr($imageType,0,5) =="image"){	
		// to perform database update  
		
		
						
		$query  = "update subjects set menu_pic ='$imageData' ";
		$query .= "where id = {$current_subjects["id"]} ";
		$query .= "limit 1 ;";
		
								
					
		}
		else {
		
		$_SESSION["message"] = "please select a proper image below 20 mb";
		
		}
			
		
	
    	$result = mysqli_query($connection, $query);
			
        if ($result && mysqli_affected_rows($connection) >= 1 ){
			
			//success
			$_SESSION["message"] = "Picture updated";
			$url = "manage_content.php?subjects={$current_subjects["id"]}" ;
			redirect_to($url);
			} else {
			$message = "page update failed here at this place";
			}
	}
}
else{
//this is a get request
 }
 //form processing --------------------------------------------------------------------------/form processing 
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
		 <a href ="new_subject.php"> +  Add A Subject </a>
	<?php echo navigation($current_subjects,$current_pages,$current_step1,$current_step2);?>
	 
	  

	 
	</div>
	<?php	
	// echo message();
	
	if(!empty($message)){
	
	echo "<div class=]:message\">" . htmlentities($message) . "</div>" ;
	
	}
	
	?>
	<div id="pages">
		<?php  echo message(); ?>
		
			<?php if ($current_subjects)  {	?>
			
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
				<h2>Manage <?php echo $current_subjects["menu_name"];?></h2>
				<div class="container">
							
								
									<form action ="manage_content.php?subjects=<?php echo $current_subjects["id"] ;?>" method="post" enctype="multipart/form-data">
									<img src="image1.php?tab=subjects&r=menu_pic&id=<?php echo $current_subjects["id"] ;?>  height="350"; width ="300" ;class="img"	alt=""> 
									<input type= "file" name ="image"  required/>
									<input type="submit" name="submit" value="Update Pic" />
									</form>
						
						
					</div>
			<div class="container">
			Menu name : <?php echo htmlentities($current_subjects["menu_name"]);?>	<br/>
			Position  &nbsp;	&nbsp;	&nbsp: <?php echo  $current_subjects["position"]; 	?>	<br/>
			Visible	  &nbsp;	&nbsp;	&nbsp; &nbsp: <?php echo  $current_subjects["visible"] == 1 ? 'yes' : 'no' ; 	?>	<br/><br/>
			
			<a href="edit_subject.php?subjects=<?php echo urlencode($current_subjects["id"]); ?>"> EDIT <?php echo $current_subjects["menu_name"];?> PAGE</a>
								</div>
			<div class="container">						
			<h3> Pages in  <?php echo $current_subjects["menu_name"];?></h3>
			<ul>
			<?php $subjects_pages = find_pages_for_subjects($current_subjects["id"]);
			while ($pages =mysqli_fetch_assoc($subjects_pages)) {
			
			echo "<li>";
			$safe_pages_id =urlencode($pages["id"]);
			echo "<a href=\"manage_content.php?pages={$safe_pages_id}\">";
			echo htmlentities($pages["menu_name"]);
			echo "</a>";
			echo "</li>";
			}
			?>
			</ul>
			
			<br/>
			+ <a href ="new_pages.php?subjects=<?php echo urlencode($current_subjects["id"]);?>">Add a new page to <?php echo $current_subjects["menu_name"];?></a>
		</div>	
			
																<?php } elseif ($current_step2){ ?>
														<h2>Manage <?php echo $current_step2["menu_name"];?> </h2>
															Menu name : <?php echo  htmlentities($current_step2["menu_name"]); 	?>	<br/>
															Position  : <?php echo  $current_step2["position"]; 	?>	<br/>
															Visible	  : <?php echo  $current_step2["visible"] == 1 ? 'yes' : 'no' ; 	?>	<br/>
															Content   : <br/>
															<div class ="view-content">
															<?php echo  nl2br(htmlentities($current_step2["content"])); ?>
															</div>
															<a href="edit_step2.php?pages=<?php echo urlencode($page);?>&step2=<?php echo urlencode($current_step2["id"]); ?>"> <button type="submit" style="float:right;margin-right:10px" class="steel" name="submit" >Update Page </button><?php echo $current_step2["menu_name"];?> </a>
											
											<?php
											}
											elseif ($current_step1){ ?>
											<h2>Manage <?php echo $current_step1["menu_name"];?> </h2>
											Menu name : <?php echo  htmlentities($current_step1["menu_name"]); 	?>	<br/>
											Position  : <?php echo  $current_step1["position"]; 	?>	<br/>
											Visible	  : <?php echo  $current_step1["visible"] == 1 ? 'yes' : 'no' ; 	?>	<br/>
											Content   : <br/>
											<div class ="view-content">
											<?php echo  nl2br(htmlentities($current_step1["content"])); ?>
											</div>
											<a href="edit_step1.php?pages=<?php  echo urlencode($current_step1["pages_id"]);?>&step1=<?php echo urlencode($current_step1["id"]); ?>"><button type="submit" style="float:right;margin-right:10px" class="steel" name="submit" >Update Page </button> <?php echo $current_step1["menu_name"];?></a>
											<h3> PAGES in <?php echo $current_step1["menu_name"];?></h3>
											<ul>
											<?php $pages_step2 = find_step2_for_step1($current_step1["id"]);
											while ($step2 =mysqli_fetch_assoc($pages_step2)) {
											echo "<li>";
											$safe_step2_id =urlencode($step2["id"]);
											echo "<a href=\"manage_content.php?pages={$current_step1["pages_id"]}&step2={$safe_step2_id}\">";
											echo htmlentities($step2["menu_name"]);
											echo "</a>";
											echo "</li>";}?>
											</ul>
											<br/>
											+ <a href ="new_step2.php?step1=<?php echo urlencode($current_step1["id"]);?>">Add a new pages to <?php echo $current_step1["menu_name"];?></a>
										

											
						<?php }elseif ($current_pages){ ?>
						<h2>Manage <?php echo $current_pages["menu_name"];?> </h2>
							Menu name : <?php echo  htmlentities($current_pages["menu_name"]); 	?>	<br/>
							Position  : <?php echo  $current_pages["position"]; 	?>	<br/>
							Visible	  : <?php echo  $current_pages["visible"] == 1 ? 'yes' : 'no' ; 	?>	<br/>
							Content   : <br/>
						<div class ="view-content">
							<?php echo  nl2br(htmlentities($current_pages["content"])); ?>
						</div>
						<a href="edit_pages.php?pages=<?php echo urlencode($current_pages["id"]); ?>"> <button type="submit" style="float:right;margin-right:10px" class="steel" name="submit" >Update Page </button> <?php echo $current_pages["menu_name"];?></a>
						<h3> PAGES in <?php echo $current_pages["menu_name"];?></h3>
						<ul>
						<?php $pages_step1 = find_step1_for_pages($current_pages["id"]);
						while ($step1 =mysqli_fetch_assoc($pages_step1)) {
											
						echo "<li>";
						$safe_step1_id =urlencode($step1["id"]);
						echo "<a href=\"manage_content.php?pages={$current_pages["id"]}&step1={$safe_step1_id}\">";
						echo htmlentities($step1["menu_name"]);
						echo "</a>";
						echo "</li>";}?>
						</ul>
						<br/>
						+ <a href ="new_step1.php?pages=<?php echo urlencode($current_pages["id"]);?>">Add a new page to <?php echo $current_pages["menu_name"];?></a>
											<?php }
											
											
											else { ?> 
											Please select a Subject or Page
											<?php }


?> 
	</div>
</div>
	

<?php include ("../includes/layouts/footer.php");?>