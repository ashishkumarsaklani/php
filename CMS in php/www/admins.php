<?php $layout_context = "admin"; ?>
<?php require_once ("../includes/session.php");?>
<?php include ("../includes/functions.php");?>
<?php if (!isset($_SESSION["admins_id"])){ redirect_to("login.php");};?>
<?php include ("../includes/layouts/header.php");?>


<div id="main">
	<div id="navigation">
welcome to the admin area  .<?php echo $_SESSION["username"] ; ?>
	</div>
	<div id="page">
	<h2>Admin menu</h2>
	
	<ul>
		<li><a href ="manage_content.php">Manage Website Content</a></li>
		<li><a href ="manage_containers.php">Manage Containers</a></li>
		<li><a href ="manage_admins.php">Manage Admin users</a></li>
		<li><a href ="manage_owners.php">Manage Owner users</a></li>
		<li><a target="_blank" href ="http://localhost/phpmyadmin/">Manage database</a></li>
		<li><a href ="logout.php">Logout</a></li>

	</ul>
	</div>
</div>

<?php include ("../includes/layouts/footer.php");?>

















