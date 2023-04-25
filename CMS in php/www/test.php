

<?php require_once ("../includes/db_connect.php");?>
<div id="main">
	<div id="navigation">
	 
	</div>
	<div id="pages">

	
		

<?php
function generate_salt($length) {

//not 100% unique or random,
//md5 returns 32 chars

$unique_random_string =md5(uniqid(mt_rand(),true));
//valid char for salt are [a-z A-Z0-9./]

$base64_string =base64_encode($unique_random_string);
//but not + which is used in base encoding 
$modified_base64_string =str_replace('+','.',$base64_string);
//truncates strings to correct lengths
$salt =substr($modified_base64_string, 0, $length);

return $salt;
}

function password_check	($password, $existing_hash) {
$hash =crypt($password,$existing_hash);
if ($hash === $existing_hash) {
return true ;
}
else {
return false;
}
}

// function to generate salt




		
	$password ="Saklani";
	$hash_format ="$2y$10$";
//	$salt_length =26; //blowfish method to be used need 22 char or more
	
//	$salt = generate_salt($salt_length);

//	$format_and_salt =$hash_format .$salt;
//	$hash =crypt($password,$format_and_salt);
	
$subjects ="Ashish saklani is a good boy";

$table = array('subjects','pages','step1','step2');

echo $$table[0];	

	
	echo $password ;
		echo "<br/>" ;	echo "<br/>" ;
	
	
	
		$safe_username =mysqli_real_escape_string($connection,"Ashish");
		$query  = "select * ";
		$query .= "from admins ";
		$query .= "where username ='{$safe_username}' ";
		$query .= "LIMIT 1";
		$admins_set = mysqli_query($connection, $query);

    	$admins= mysqli_fetch_assoc($admins_set) ;
		
		$db_password =$admins["hashed_password"];

	
	
	$hash2 = crypt($password ,$db_password );
	echo "<br/>" ;
	echo $db_password ;
		echo "<br/>" ;
		echo "<br/>" ;

	echo $hash2 ;

	
if ($hash2==$db_password){

	
	echo "<br/>" ;
echo "password match";

}
else {

	echo "<br/>" ;
echo "password not match";
}

?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	</div>
	

</div>


