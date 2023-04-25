<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>

<?php $layout_context = "admin"; ?>
<?php require_once ("../includes/layouts/header.php");?>
<?php	find_selected_properties(); ?>


<div id="main">
	<div id="navigation">
		<a href="admins.php">&laquo;Main Menu</a> <br/>
<?php echo container_navigation($current_elements,$current_properties,$current_values);?>
		 
	</div>
	<div id="pages">
	<?php  echo message(); ?>
	<?php  $errors =errors(); ?>
	<?php  echo form_errors($errors); ?>
			<h2> Create elements</h2>
		<form action ="create_element.php" method="post">
			<p> element name : 
				<input type ="text" name="menu_name" value="" />
			</p>
			<p> Position         :
				<select name ="position">
				<?php
				$elements_set =find_all_elements(false);
				$elements_count = mysqli_num_rows($elements_set);
				for ($count=1;$count <=$elements_count +1;$count++) {
				
				echo "<option value=\"{$count}\">{$count}</option>";
				}?>
				
			</select>
			</p>
			
				<input type="submit" name="submit" value="Create element" />
		</form>
		<br/>
		<a href="manage_containers.php">Cancel </a>
			
	</div>
	

<?php include ("../includes/layouts/footer.php");?>