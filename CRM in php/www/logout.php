<?php require_once ("../includes/session.php");?>
<?php include ("../includes/functions.php");?>
<?php if ((!isset($_SESSION["admins_id"])) and(!isset($_SESSION["owner_id"]))){ redirect_to("login.php");};?>


<?php

/* simple logout

session_start();
$_SESSION["admin_id"] =null;
$_SESSION["username"] =null;
redirect_to(login.php);

*/


session_start();

$_SESSION =array();
if (isset($_COOKIE[session_name()])){
setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
redirect_to("index.php");




?>

