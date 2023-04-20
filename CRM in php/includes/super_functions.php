<?php
function redirect_to($new_location) {
header("Location: ".$new_location);
exit;
}

function mysql_prep( $string){
global $connection;

$escaped_string = mysqli_real_escape_string($connection,$string);
return $escaped_string;
}

function confirm_query($result_set) {

		if (!$result_set) {
		die("Database query failed. "); }
		}

function find_all_subjects($public=true) {
		global $connection ;
		
		$query  = "select * ";
		$query .= "from subjects ";
		if ($public) {
		$query .= "where visible =1 ";
		}
		$query .= "order by position ASC";

		$subjects_set = mysqli_query($connection,$query);
		confirm_query($subjects_set);
		return $subjects_set;
		}

function find_pages_for_subjects($subjects_id, $public=true) {

		global $connection;
		$safe_subjects_id =mysqli_real_escape_string($connection,$subjects_id);
		$query  = "select * ";
		$query .= "from pages ";
		$query .= "where subjects_id={$safe_subjects_id} ";
if ($public)	{$query .= "and visible =1 ";}
		$query .= "order by position ASC";

		$pages_set = mysqli_query($connection,$query);
		confirm_query($pages_set);
		return $pages_set;
		}
//navigation takes current  [subjects or pages ] or null

function find_step1_for_pages($pages_id, $public=true) {

		global $connection;
		$safe_pages_id =mysqli_real_escape_string($connection,$pages_id);
		$query  = "select * ";
		$query .= "from step1 ";
		$query .= "where pages_id={$safe_pages_id} ";
if ($public)	{$query .= "and visible =1 ";}
		$query .= "order by position ASC";

		$step1_set = mysqli_query($connection,$query);
		confirm_query($step1_set);
		return $step1_set;
		}
//navigation takes current  [pages or step1 ] or null


function navigation($subjects_array,$pages_array) {


		$output = "<ul class =\"subjects\"> ";
		$subjects_set = find_all_subjects(false); 
		while($subjects =mysqli_fetch_assoc($subjects_set)) {	
		$output .= "<li";
			if ($subjects_array && $subjects["id"] == $subjects_array["id"]) 
			{   $output .= " class=\"selected\" ";}
			    $output .= ">" ;
				$output .= "<a href=\"manage_content.php?subjects=";
				$output .= urlencode($subjects["id"]); 
				$output .= "\">";
				$output .= htmlentities($subjects["menu_name"]) ; 
				$output .= "</a>";
				$pages_set = find_pages_for_subjects($subjects["id"],false) ;
				$output .="<ul class=\"pages\">";
		while($pages =mysqli_fetch_assoc($pages_set)) { 
		$output .= "<li";
			if ($pages_array["id"] && $pages["id"]==$pages_array["id"]) 
		{$output .= " class=\"selected\" ";}
		$output .= ">" ;
		$output .= "<a href=\"manage_content.php?pages=";
		$output .= urlencode($pages["id"]); 
		$output .="\">";
		$output .= htmlentities($pages["menu_name"]);  
		$output .= "</a> </li>";
		}	
		mysqli_free_result($pages_set);
		$output .="</ul> </li> ";
		} 
		mysqli_free_result($subjects_set); 
		$output .="</ul>";
		return $output;
		}

function find_subjects_by_id($subjects_id,$public=true){


		global $connection ;
		$safe_subjects_id =mysqli_real_escape_string($connection,$subjects_id);
		$query  = "select * ";
		$query .= "from subjects ";
		$query .= "where id ={$safe_subjects_id} ";
			if ($public){
		$query .= "and visible = 1 "; }
		$query .= "LIMIT 1";
		$subjects_set = mysqli_query($connection,$query);
		confirm_query($subjects_set);
    	if ($subjects= mysqli_fetch_assoc($subjects_set)){
			return $subjects; 
			}else{
			return null;
			}
	}
		
function find_pages_by_id($pages_id,$public =true){
		global $connection ;
		$safe_pages_id =mysqli_real_escape_string($connection,$pages_id);
		$query  = "select * ";
		$query .= "from pages ";
		$query .= "where id ={$safe_pages_id} ";
		if ($public){
		$query .= "and visible = 1 "; }
		$query .= "LIMIT 1";
		$pages_set = mysqli_query($connection,$query);
		confirm_query($pages_set);
    	if ($pages= mysqli_fetch_assoc($pages_set)){
			return $pages; 
			} else {
			return null;
			}
	}
	
	
function find_step1_by_id($step1_id,$public =true){
		global $connection ;
		$safe_step1_id =mysqli_real_escape_string($connection,$step1_id);
		$query  = "select * ";
		$query .= "from step1 ";
		$query .= "where id ={$safe_step1_id} ";
		if ($public){
		$query .= "and visible = 1 "; }
		$query .= "LIMIT 1";
		$step1_set = mysqli_query($connection,$query);
		confirm_query($step1_set);
    	if ($step1= mysqli_fetch_assoc($step1_set)){
			return $step1; 
			} else {
			return null;
			}
	}	
	
	
function find_selected_pages($public =false) {
		global $current_subjects;
		global $current_pages;
		global $current_step1;		
	if(isset($_GET["subjects"])) {
	$current_subjects = find_subjects_by_id($_GET["subjects"],$public);
	if ($current_subjects&&$public){
	$current_pages = find_default_page_for_subject($current_subjects["id"]);
	} else {	$current_pages = null;$current_subjects =null;
	}
	}	elseif(isset($_GET["pages"])) {
	$current_step1 =null;
	$current_subjects =null;
	$current_pages = find_pages_by_id($_GET["pages"],$public);	
	} 	elseif(isset($_GET["step1"])){
	
	$current_pages =null;
	$current_subjects =null;
	$current_step1 = find_step1_by_id($_GET["step1"],$public);	
	}else
	{
	$current_step1 =null;
	$current_subjects =null;
	$current_pages = null;
	} 
}	
	// check form  error 		
	$errors = array();
function  form_errors($errors=array()){
	$output ="";
	if (!empty($errors)) {
	$output .="<div class=\"error\">";
	$output .="Please fix the following errors : ";
	$output .="<ul>" ;
	foreach ($errors as $key => $error) { 
	$output .= "<li> ";
	$output .= htmlentities($error);
	$output .= "</li>";
		}
	$output .="</ul>";
	$output .="</div>";
	}
	return $output ;
	}
		
function find_all_pages() {
		global $connection ;
		
		$query  = "select * ";
		$query .= "from pages ";
//		$query .= "where visible =1 ";
		$query .= "order by position ASC";

		$pages_set = mysqli_query($connection,$query);
		confirm_query($pages_set);
		return $pages_set;
		}
	

function public_navigation($subjects_array,$pages_array,$step1_array) {


		$output = "<ul class =\"subjects\"> ";
		$subjects_set = find_all_subjects(); 
		while($subjects =mysqli_fetch_assoc($subjects_set)) {	
		$output .= "<li";
			if ($subjects_array && $subjects["id"] == $subjects_array["id"]) 
			{   $output .= " class=\"selected\" ";}
			    $output .= ">" ;
				$output .= "<a href=\"index.php?subjects=";
				$output .= urlencode($subjects["id"]); 
				$output .= "\">";
				$output .= htmlentities($subjects["menu_name"]) ; 
				$output .= "</a>";
			// accordian effect
				if ($subjects_array["id"] == $subjects["id"] || $pages_array["subjects_id"] == $subjects["id"]) {
					$pages_set = find_pages_for_subjects($subjects["id"]) ;
					$output .="<ul class=\"pages\">";
						while($pages =mysqli_fetch_assoc($pages_set)) { 
					$output .= "<li";
						if ($pages_array["id"] && $pages["id"]==$pages_array["id"]) 
					{$output .= " class=\"selected\" ";}
					$output .= ">" ;
					$output .= "<a href=\"index.php?pages=";
					$output .= urlencode($pages["id"]); 
					$output .="\">";
					$output .= htmlentities($pages["menu_name"]);  
					$output .= "</a> </li>";
							if ($pages_array["id"] == $pages["id"] || $step1_array["pages_id"] == $pages["id"]) {
								$step1_set = find_step1_for_pages($pages["id"]) ;
								$output .="<ul class=\"pages\">";
									while($step1 =mysqli_fetch_assoc($step1_set)) { 
								$output .= "<li";
									if ($step1_array["id"] && $step1["id"]==$step1_array["id"]) 
								{$output .= " class=\"selected\" ";}
								$output .= ">" ;
								$output .= "<a href=\"index.php?step1=";
								$output .= urlencode($step1["id"]); 
								$output .="\">";
								$output .= htmlentities($step1["menu_name"]);  
								$output .= "</a> </li>";
			}	
		$output .="</ul> ";
		mysqli_free_result($step1_set);
		}
			}	
		$output .="</ul> ";
		mysqli_free_result($pages_set);
		}
	
		$output .= "</li> ";//end of subject li
		} 
		mysqli_free_result($subjects_set); 
		$output .="</ul>";
		return $output;
		}

		
function find_default_page_for_subject($subjects_id){

$pages_set = find_pages_for_subjects($subjects_id);


	if ($first_pages= mysqli_fetch_assoc($pages_set)){
			return $first_pages; 
			} else {
			return null;
			}

}

function find_all_admins(){
global $connection;


		$query  = "select * ";
		$query .= "from admins ";
		$query .= "order by username ASC ";
		$admins_set = mysqli_query($connection,$query);
		confirm_query($admins_set);
		return $admins_set;
}

function find_admins_by_id($admins_id){


		global $connection ;
		$safe_admins_id =mysqli_real_escape_string($connection,$admins_id);
		$query  = "select * ";
		$query .= "from admins ";
		$query .= "where id ={$safe_admins_id} ";
		$query .= "LIMIT 1";
		$admins_set = mysqli_query($connection,$query);
		confirm_query($admins_set);
    	if ($admins= mysqli_fetch_assoc($admins_set)){
			return $admins; 
			}else{
			return null;
			}
	}
		
function password_encrypt($password) {



	$hash_format ="$2y$10$";
	
	$salt_length =22; //blowfish method to be used need 22 char or more
	
	$salt = generate_salt($salt_length);

	$format_and_salt =$hash_format .$salt;
	$hash =crypt($password,$format_and_salt);
	
	return $hash;
	
}

function generate_salt($length) {

//not 100% unique or random,
//md5 returns 32 chars

$unique_random_string = md5(uniqid(mt_rand(),true));
//valid char for salt are [a-z A-Z0-9./]

$base64_string = base64_encode($unique_random_string);
//but not + which is used in base encoding 
$modified_base64_string =str_replace('+','.',$base64_string);
//truncates strings to correct lengths
$salt =substr($modified_base64_string, 0, $length);

return $salt;
}

function password_check	($password, $existing_hash) {
$hash =crypt($password, $existing_hash);
if ($hash===$existing_hash) {
return true ;
}
else {
return false;
}
}


function find_admins_by_username($username){

global $connection ;
		$safe_username =mysqli_real_escape_string($connection,$username);
		$query  = "select * ";
		$query .= "from admins ";
		$query .= "where username ='{$safe_username}' ";
		$query .= "LIMIT 1";
		$admins_set = mysqli_query($connection, $query);
		confirm_query($admins_set);
    	if ($admins= mysqli_fetch_assoc($admins_set)){
			return $admins; 
			} else {
			return null;
			}
	}


function attempt_login($username,$password){

$admins= find_admins_by_username($username);
if ($admins) {
//found admins check password

if (password_check($password, $admins["hashed_password"])) {
//password matches
return $admins;
	} else {
//password does not match
return false ;
	}
	} else {
// admins not found 
return false ;
}
}


function logged_in(){

isset($_SESSION['admins_id']) ;

}

function confirm_logged_in(){

if (!logged_in()){

redirect_to ("login.php");

}

}

?>