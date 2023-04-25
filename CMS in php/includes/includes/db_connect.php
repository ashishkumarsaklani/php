<?php

define("DB_SERVER","localhost") ;
define("DB_USER","a_cms");
define("DB_PASS","Saklani");#this is my easy password :D
define("DB_NAME","a_comp");


//connection to data //
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

//check connection //
if (!$connection)
{
	die('Could not connect to MySQL: ' . mysql_error());
}

if(mysqli_connect_errno()){
die("Database connection failed:  ". mysqli_connect_errno() ."(" .mysqli_connect_errno().")"
);
}

?>