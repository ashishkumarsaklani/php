<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php $layout_context = "admin"; ?>
<?php include ("../includes/layouts/header.php");?>
<?php include ("../includes/functions.php");?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>
<?php	find_selected_pages(); ?>


<div id="main">

	<div id="navigation">
	
	<a href="admins.php">&laquo;Main Menu</a> <br/>
	<?php echo navigation($current_subjects,$current_pages,$current_step1,$current_step2);?>
	 
	  <br/>
	 <a href ="new_subject.php"> +  Add A Subject </a>
	 
	</div>
	<div id="pages">
		<?php  echo message(); ?>
			<?php if ($current_subjects)  {	?>
				<h2>Manage Subject</h2>
			Menu name : <?php echo htmlentities($current_subjects["menu_name"]);?>	<br/>
			Position  &nbsp;	&nbsp;	&nbsp: <?php echo  $current_subjects["position"]; 	?>	<br/>
			Visible	  &nbsp;	&nbsp;	&nbsp; &nbsp: <?php echo  $current_subjects["visible"] == 1 ? 'yes' : 'no' ; 	?>	<br/><br/>
			<a href="edit_subject.php?subjects=<?php echo urlencode($current_subjects["id"]); ?>"> Edit Subject</a>
			
			<h3> Pages in this Subject</h3>
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
			+ <a href ="new_pages.php?subjects=<?php echo urlencode($current_subjects["id"]);?>">Add a new page to this Subject</a>
	
			
													<?php}elseif ($current_step2){ ?>
													
														<h2>Manage Page </h2>
															Menu name : <?php echo  htmlentities($current_step2["menu_name"]); 	?>	<br/>
															Position  : <?php echo  $current_step2["position"]; 	?>	<br/>
															Visible	  : <?php echo  $current_step2["visible"] == 1 ? 'yes' : 'no' ; 	?>	<br/>
															Content   : <br/>
															<div class ="view-content">
															<?php echo  htmlentities($current_step2["content"]); ?>
															</div>
															<a href="edit_step2.php?step2=<?php echo urlencode($current_step2["id"]); ?>"> Edit Page</a>
											
											<?php
											}
											elseif ($current_step1){ ?>
											<h2>Manage Page </h2>
											Menu name : <?php echo  htmlentities($current_step1["menu_name"]); 	?>	<br/>
											Position  : <?php echo  $current_step1["position"]; 	?>	<br/>
											Visible	  : <?php echo  $current_step1["visible"] == 1 ? 'yes' : 'no' ; 	?>	<br/>
											Content   : <br/>
											<div class ="view-content">
											<?php echo  htmlentities($current_step1["content"]); ?>
											</div>
											<a href="edit_step1.php?step1=<?php echo urlencode($current_step1["id"]); ?>"> Edit Page</a>
											<h3> Steps2 in this Step1</h3>
											<ul>
											<?php $pages_step2 = find_step2_for_step1($current_step1["id"]);
											while ($step2 =mysqli_fetch_assoc($pages_step2)) {
											echo "<li>";
											$safe_step2_id =urlencode($step2["id"]);
											echo "<a href=\"manage_content.php?step2={$safe_step2_id}\">";
											echo htmlentities($step2["menu_name"]);
											echo "</a>";
											echo "</li>";}?>
											</ul>

											
						<?php }elseif ($current_pages){ ?>
						<h2>Manage Page </h2>
							Menu name : <?php echo  htmlentities($current_pages["menu_name"]); 	?>	<br/>
							Position  : <?php echo  $current_pages["position"]; 	?>	<br/>
							Visible	  : <?php echo  $current_pages["visible"] == 1 ? 'yes' : 'no' ; 	?>	<br/>
							Content   : <br/>
						<div class ="view-content">
							<?php echo  htmlentities($current_pages["content"]); ?>
						</div>
						<a href="edit_pages.php?pages=<?php echo urlencode($current_pages["id"]); ?>"> Edit Page</a>
						<h3> Steps in this Page</h3>
						<ul>
						<?php $pages_step1 = find_step1_for_pages($current_pages["id"]);
						while ($step1 =mysqli_fetch_assoc($pages_step1)) {
											
						echo "<li>";
						$safe_step1_id =urlencode($step1["id"]);
						echo "<a href=\"manage_content.php?step1={$safe_step1_id}\">";
						echo htmlentities($step1["menu_name"]);
						echo "</a>";
						echo "</li>";}?>
						</ul>
						<br/>
						+ <a href ="new_step1.php?pages=<?php echo urlencode($current_pages["id"]);?>">Add a new page to this Subject</a>
											<?php }
											
											
											else { ?> 
											Please select a Subject or Page
											<?php } ?> 
	</div>
</div>
	

<?php include ("../includes/layouts/footer.php");?>
