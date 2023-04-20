 <?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php $layout_context = "admins"; ?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>
<?php $layout_context = "admin"; ?>
<?php include ("../includes/layouts/header.php");?>
<?php include ("../includes/functions.php");?>
<?php	find_selected_pages(); ?>

<?php  $admins_set = find_all_admins(); ?>

<div id="main">

	<div id="navigation">
		<a href="admins.php">&laquo;Main Menu</a> <br/>
	<?php echo navigation($current_subjects,$current_pages,$current_step1,$current_step2);?>
	    <br/>
	 
	</div>
	<div id="pages">
	
	<?php echo message();?>
		<h2 >Manage Admins</h2>
		<table>
		<tr>
		<th	style= "text-allign:left; width:auto;">Username</th>

		<th	colspan= "2" style= "text-allign:left;">Actions</th>
		</tr>
<?php while ($admins =mysqli_fetch_assoc($admins_set)) {?>
		<tr>
		<td><?php echo htmlentities($admins["username"]); ?></td> <hr>

		</tr>
		
		<tr>
		<th	style= "text-allign:left; width:auto;">128 bit encrypted Hashed_Password</th>
			</tr>	<tr>
		<td><?php echo htmlentities($admins["hashed_password"]); ?></td> <hr>
	
		</tr>
			<th>	<td><img src="images.php?tab=admins&id=<?php echo $admins["id"];?>" height=70px ; width=70px ><td><br/>
		</th>
		
		
			<td><a href="edit_admins.php?id=<?php echo urlencode($admins["id"]); ?>">Edit</a></td>
		<td><a href="delete_admins.php?id=<?php echo urlencode($admins["id"]); ?>" onclick ="return confirm('Are you sure ?');">Delete</a></td>
		<?php }?>
		
		</table>
		<br/>
		
		
		
	<a href="new_admins.php?">Add a new Admin </a>
	
	<hr />

	</div>	


	

</div>
	

<?php include ("../includes/layouts/footer.php");?>