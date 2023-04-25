 <?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php $layout_context = "admins"; ?>
<?php include ("../includes/functions.php");?>
<?php if (!isset($_SESSION["admins_id"])){redirect_to("login.php");};?>
<?php $layout_context = "admin"; ?>
<?php include ("../includes/layouts/header.php");?>
<?php	find_selected_pages(); ?>

<?php  $owners_set = find_all_owners(); ?>

<div id="main">

	<div id="navigation">
		<a href="admins.php">&laquo;Main Menu</a> <br/>
	<?php echo navigation($current_subjects,$current_pages,$current_step1,$current_step2);?>
	    <br/>
	 
	</div>
	<div id="pages">
	
	<?php echo message();?>
		<h2 >Manage Owners</h2>
		<table>
		<tr>
		<th	style= "text-allign:left; width:auto;">Username</th>
		<th	style= "text-allign:left; width:auto;">128 bit encrypted Hashed_Password</th>
		<th	colspan= "2" style= "text-allign:left;">Email</th>
		<th	colspan= "2" style= "text-allign:left;">Actions</th>
		</tr>
		
		
			<?php while ($owner =mysqli_fetch_assoc($owners_set)) {?>
		<tr>
		
		<td><?php echo htmlentities($owner["username"]); ?><hr></td>

			
		<td><?php echo htmlentities($owner["hashed_password"]); ?><hr></td> 
				
		
		<td><?php echo htmlentities($owner["email"]); ?> <hr></td>
		

	
		


		
			<th>
			<td><img src="images.php?tab=owner&id=<?php echo $owner["id"];?>" height=70px ; width=70px ><td><br/>
		</th>
		
		
			
		<td><a href="edit_owners.php?id=<?php echo urlencode($owner["id"]); ?>">Edit</a></td>
		<td><a href="delete_owners.php?id=<?php echo urlencode($owner["id"]); ?>" onclick ="return confirm('Are you sure ?');">Delete</a></td>
		
		</tr>
		
		
	<?php }?>
		<hr>
		</table>
		<br/>
		
		
		
	<a href="new_owners.php?">Add a new Owner </a>
	
	
<hr>
	</div>	


	

</div>
	

<?php include ("../includes/layouts/footer.php");?>