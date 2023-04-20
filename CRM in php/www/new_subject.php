<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>

<?php $layout_context = "admin"; ?>
<?php require_once ("../includes/layouts/header.php");?>
<?php	find_selected_pages(); ?>


<div id="main">
	<div id="navigation">
		<a href="admins.php">&laquo;Main Menu</a> <br/>
     <?php echo navigation($current_subjects,$current_pages,$current_step1,$current_step2);?>
		 
	</div>
	<div id="pages">
	<?php  echo message(); ?>
	<?php  $errors =errors(); ?>
	<?php  echo form_errors($errors); ?>
			<h2> Create Subjects</h2>
		<form action ="create_subject.php" method="post">
			<p> Subject name : 
				<input type ="text" name="menu_name" value="" />
			</p>
			<p> Position         :
				<select name ="position">
				<?php
				$subjects_set =find_all_subjects(false);
				$subjects_count = mysqli_num_rows($subjects_set);
				for ($count=1;$count <=$subjects_count +1;$count++) {
				
				echo "<option value=\"{$count}\">{$count}</option>";
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
			<p>Visible 	        :
				<input type="radio" name="visible" value="0" /> No
				&nbsp;
				<input type="radio" name="visible" value="1" /> Yes
			</p>
				<input type="submit" name="submit" value="Create Subject" />
		</form>
		<br/>
		<a href="manage_content.php">Cancel </a>
			
	</div>
	

<?php include ("../includes/layouts/footer.php");?>