			<script type="text/javascript">

function toggle(target){

				  var artz = document.getElementsByClassName('article');
				  var targ = document.getElementById(target);  
				  var isVis = targ.style.display=='block';

				  // hide all
				  for(var i=0;i<artz.length;i++){
					 artz[i].style.display = 'none';
				  }
				  // toggle current
				  targ.style.display = isVis?'none':'block';

				  return false;
				}
function check(btn,targetd){
var	targetc = document.getElementById(targetd);
var alld = document.getElementsByClassName('txtbox');

for(var i = 0; i < alld.length; i = i + 1) {
    alld[i].style.display="none";
}

if(document.getElementById(btn).checked) { 


	targetc.style.display = 'block';

				  }else {
					   targetc.style.display = 'none';

				  }
				  return false;
				}

			</script>
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
function form_errors($errors=array()){
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
function find_all_step1() {
		global $connection ;
		
		$query  = "select * ";
		$query .= "from step1 ";
//		$query .= "where visible =1 ";
		$query .= "order by position ASC";

		$step1_set = mysqli_query($connection,$query);
		confirm_query($step1_set);
		return $step1_set;
		}
function find_all_step2() {
		global $connection ;
		
		$query  = "select * ";
		$query .= "from step2 ";
//		$query .= "where visible =1 ";
		$query .= "order by position ASC";

		$step2_set = mysqli_query($connection,$query);
		confirm_query($step2_set);
		return $step2_set;
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
function find_all_owners(){
global $connection;


		$query  = "select * ";
		$query .= "from owner ";
		$query .= "order by username ASC ";
		$owners_set = mysqli_query($connection,$query);
		confirm_query($owners_set);
		return $owners_set;
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
		}//navigation takes current  [subjects or pages ] or null
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
		}//navigation takes current  [pages or step1 ] or null
function find_step2_for_step1($step1_id, $public=true) {

		global $connection;
		$safe_step1_id =mysqli_real_escape_string($connection,$step1_id);
		$query  = "select * ";
		$query .= "from step2 ";
		$query .= "where step1_id={$safe_step1_id} ";
if ($public)	{$query .= "and visible =1 ";}
		$query .= "order by position ASC";

		$step2_set = mysqli_query($connection,$query);
		confirm_query($step2_set);
		return $step2_set;
		}//navigation takes current  [step1 or step2 ] or null		
function navigation($subjects_array,$pages_array,$step1_array,$step2_array) {


		$output = "<ul class =\"subjects\"> ";
		$subjects_set = find_all_subjects(false); 
		while($subjects =mysqli_fetch_assoc($subjects_set)) {	
		$output .= "<li";
			if ($subjects_array && $subjects["id"] == $subjects_array["id"]) 
			{   $output .= " class=\"selected\" ";}
			    $output .= ">" ;
			if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subjects["owner_id"] )) or (isset($_SESSION["admins_id"]))) {
				$output .= "<a href=\"manage_content.php?subjects=";
			}else{
				$output .= "<a href=\"index.php?subjects=";
				}
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
					$subject =find_owner_for_page($pages["id"]);
				if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subject["owner_id"] )) or (isset($_SESSION["admins_id"]))) {
					$output .= "<a href=\"manage_content.php?pages=";
				}else{
					$output .= "<a href=\"index.php?pages=";
					}
					$output .= urlencode($pages["id"]); 
					$output .="\">";
					$output .= htmlentities($pages["menu_name"]);  
					$output .= "</a> </li>";

						$step1_set = find_step1_for_pages($pages["id"],false) ;
						$output .="<ul class=\"pages\">";
						while($step1 =mysqli_fetch_assoc($step1_set)) { 
						$output .= "<li";
						if ($step1_array["id"] && $step1["id"]==$step1_array["id"]) 
						{$output .= " class=\"selected\" ";}
						$output .= ">" ;
						$subject =find_owner_for_page($pages["id"]);
						if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subject["owner_id"] )) or (isset($_SESSION["admins_id"]))) {
							$output .= "<a href=\"manage_content.php?pages=";
						}else{
							$output .= "<a href=\"index.php?pages=";
							}
						$output .= urlencode($pages["id"]); 
						$output .= "&step1=";
						$output .= urlencode($step1["id"]); 

						$output .="\">";
						$output .= htmlentities($step1["menu_name"]);  
						$output .= "</a> </li>";
						
						
								$step2_set = find_step2_for_step1($step1["id"],false) ;
								$output .="<ul class=\"step1\">";
								while($step2 =mysqli_fetch_assoc($step2_set)) { 
								$output .= "<li";
								if ($step2_array["id"] && $step2["id"]==$step2_array["id"]) 
								{$output .= " class=\"selected\" ";}
								$output .= ">" ;
								if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subject["owner_id"] )) or (isset($_SESSION["admins_id"]))) {
								$output .= "<a href=\"manage_content.php?pages=";
								}else{
								$output .= "<a href=\"index.php?pages=";
								}
								$output .= urlencode($pages["id"]); 
								$output .= "&step1=";
								$output .= urlencode($step1["id"]);
								$output .= "&step2=";
								$output .= urlencode($step2["id"]);
								$output .="\">";
								$output .= htmlentities($step2["menu_name"]);  
								$output .= "</a> </li>";
			}	
		$output .="</ul> ";
		mysqli_free_result($step2_set);
			}	
		$output .="</ul> ";
		mysqli_free_result($step1_set);
					
		}	
		mysqli_free_result($pages_set);
		$output .="</ul> </li> ";
		} 
		mysqli_free_result($subjects_set); 
		$output .="</ul>";
		return $output;
		}
function public_navigation($subjects_array,$pages_array,$step1_array,$step2_array) {


		$output = "<ul class =\"subjects\"> ";
		$subjects_set = find_all_subjects(); 
			$output .= "<a href=\"index.php\">HOME</a>";
		while($subjects =mysqli_fetch_assoc($subjects_set)) {	
		$output .= "<li";
			if ($subjects_array && $subjects["id"] == $subjects_array["id"]) 
			{   $output .= " class=\"selected\" ";}
			    $output .= ">" ;
				if ((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subjects["owner_id"] ))  {
				$output .= "<a href=\"manage_content.php?subjects="; 
				} else {	
				$output .= "<a href=\"index.php?subjects=";
				} 
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
					$subject =find_owner_for_page($pages["id"]);
					if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subject["owner_id"] )) or (isset($_SESSION["admins_id"]))) {
					$output .= "<a href=\"manage_content.php?pages=";
					}else{
					$output .= "<a href=\"index.php?pages=";
					}
					$output .= urlencode($pages["id"]); 
					$output .="\">";
					$output .= htmlentities($pages["menu_name"]);  
					$output .= "</a> </li>";
							if ($pages_array["id"] == $pages["id"]  )
							{
								$step1_set = find_step1_for_pages($pages["id"]) ;
								$output .="<ul class=\"pages\">";
									while($step1 =mysqli_fetch_assoc($step1_set)) { 
								$output .= "<li";
									if ($step1_array["id"] && $step1["id"]==$step1_array["id"]) 
								{$output .= " class=\"selected\" ";}
								$output .= ">" ;
							if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subject["owner_id"] )) or (isset($_SESSION["admins_id"]))) {
								$output .= "<a href=\"manage_content.php?pages=";
							}else{
								$output .= "<a href=\"index.php?pages=";
								}
								$output .= urlencode($pages["id"]); 
								$output .= "&step1=";
								$output .= urlencode($step1["id"]); 
								$output .="\">";
								$output .= htmlentities($step1["menu_name"]);  
								$output .= "</a> </li>";
									//////////////////////////////
												if ($step1_array["id"] == $step1["id"]  )
													
													{
												$step2_set = find_step2_for_step1($step1["id"]) ;
												$output .="<ul class=\"step1\">";
													while($step2 =mysqli_fetch_assoc($step2_set)) { 
												$output .= "<li";
													if ($step2_array["id"] && $step2["id"]==$step2_array["id"]) 
												{$output .= " class=\"selected\" ";}
												$output .= ">" ;
											if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subject["owner_id"] )) or (isset($_SESSION["admins_id"]))) {
												$output .= "<a href=\"manage_content.php?pages=";
											}else{
												$output .= "<a href=\"step2.php?pages=";
												}
												$output .= urlencode($pages["id"]); 
												$output .= "&step1=";
												$output .= urlencode($step1["id"]); 
												$output .= "&step2=";
												$output .= urlencode($step2["id"]); 
												$output .="\">";
												$output .= htmlentities($step2["menu_name"]);  
												$output .= "</a> </li>";
			}	
		$output .="</ul> ";
		mysqli_free_result($step2_set);
		}
			}	
		///////////////////////////////////////
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
function public_navigation2($subjects_array,$pages_array,$step1_array,$step2_array) {

		

		$output = "<ul class =\"subjects\"> ";
		$subjects_set = find_all_subjects(); 
			$output .= "<a href=\"index.php\">HOME</a>";
		while($subjects =mysqli_fetch_assoc($subjects_set)) {	
		$output .= "<li";
			if ($subjects_array && $subjects["id"] == $subjects_array["id"]) 
			{   $output .= " class=\"selected\" ";}
			    $output .= ">" ;
				if ((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subjects["owner_id"] ))  {
				$output .= "<a href=\"manage_content.php?subjects="; 
				} else {	
				$output .= "<a href=\"index.php?subjects=";
				} 
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
					$subject =find_owner_for_page($pages["id"]);
					if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subject["owner_id"] )) or (isset($_SESSION["admins_id"]))) {
					$output .= "<a href=\"manage_content.php?pages=";
					}else{
					$output .= "<a href=\"step2.php?pages=";
					}
					$output .= urlencode($pages["id"]); 
					$output .="\">";
					$output .= htmlentities($pages["menu_name"]);  
					$output .= "</a> </li>";

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
function public_navigation3($pages,$step1_array,$step2_array) {

						$step1_set = find_step1_for_pages($pages) ;
						$output ="<ul class=\"pages\" >";
						while($step1 =mysqli_fetch_assoc($step1_set)) { 
						$output .= "<li";
						if ($step1_array["id"] && $step1["id"]==$step1_array["id"]) 
						{$output .= " class=\"selected\" ";}
						$output .= ">" ;
						$subject =find_owner_for_page($pages);
						$output .= "<a href=\"#\""; 
						$output .=" onclick=\"toggle('{$step1["id"]}')\">";
						$output .= htmlentities($step1["menu_name"]);  
						$output .= "</a> </li>";
						
						
								$step2_set = find_step2_for_step1($step1["id"],false) ;
								$output .="<ul id =\"{$step1["id"]}\" class=\"step1\"";
								$output .="style=\"display:none;margin-left:-22;list-style-type:none\">";
								while($step2 =mysqli_fetch_assoc($step2_set)) { 
								$output .= "<li";
								if ($step2_array["id"] && $step2["id"]==$step2_array["id"]) 
								{$output .= " class=\"selected\" ";}
								$output .= ">" ;
								$output .= "<a href=\"#\""; 
								$output .="><label for=\"{$step2["id"]}\">";
								$output .= htmlentities($step2["menu_name"]);  
								$output .= "</label></a>"; 
								$output .= "<input type=\"radio\" style=\"visibility:hidden;\" id=\"{$step2["id"]}\" name=\"r\" ";
								$output .= "onchange=\"check('{$step2["id"]}','{$step2["menu_name"]}')\"></li>";

			}	
		$output .="</ul> ";
		mysqli_free_result($step2_set);
			}	
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
function find_subjects_for_owner($owner_id) {
global $owner_subject ;
global $connection ;
		$safe_owner_id =mysqli_real_escape_string($connection,$owner_id);
		$query  = "select * ";
		$query .= "from subjects ";		
		$query .= "where owner_id ='{$safe_owner_id}' ";
		$subject_owner_set = mysqli_query($connection, $query);
		confirm_query($subject_owner_set);
    	if ($owner_subject= mysqli_fetch_assoc($subject_owner_set)){
			
			 return $owner_subject;
					
				} else {
				return null;
				}
			
	}		
function find_owner_by_id($owner_id,$public=true){

		global $owner	;
		global $connection ;
		$safe_owner_id =mysqli_real_escape_string($connection,$owner_id);
		$query  = "select * ";
		$query .= "from owner ";
		$query .= "where id ={$safe_owner_id} ";
		$query .= "LIMIT 1";
		$owner_set = mysqli_query($connection,$query);
		confirm_query($owner_set);
    	if ($owner= mysqli_fetch_assoc($owner_set)){
			return $owner; 
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
function find_step2_by_id($step2_id,$public =true){
		global $connection ;
		$safe_step2_id =mysqli_real_escape_string($connection,$step2_id);
		$query  = "select * ";
		$query .= "from step2 ";
		$query .= "where id ={$safe_step2_id} ";
		if ($public){
		$query .= "and visible = 1 "; }
		$query .= "LIMIT 1";
		$step2_set = mysqli_query($connection,$query);
		confirm_query($step2_set);
    	if ($step2= mysqli_fetch_assoc($step2_set)){
			return $step2; 
			} else {
			return null;
			}
	}		
function find_selected_pages($public =false) {
		global $current_subjects;
		global $current_pages;
		global $current_step1;	
		global $current_step2;	
			
		if(isset($_GET["step2"]))
									{
									$current_step2 =find_step2_by_id($_GET["step2"],$public);
									}
		elseif(isset($_GET["step1"]))
						{
						//else{$current_step2 =null;}
						$current_step1 =find_step1_by_id($_GET["step1"],$public);

						}
		
		
		elseif(isset($_GET["pages"]))
			{
			$current_pages = find_pages_by_id($_GET["pages"],$public);	

			
			}
		
		elseif(isset($_GET["subjects"])) {
			$current_subjects = find_subjects_by_id($_GET["subjects"],$public);

		}
		else{
		$current_step2 =null;
		$current_step1 =null;
		$current_subjects =null;
		$current_pages = null;
		}
		// check form  error 	
	}	$errors = array();
function find_selected_pages_public($public =false) {
		global $current_subjects;
		global $current_pages;
		global $current_step1;	
		global $current_step2;	
		
	if(isset($_GET["subjects"])) {
	$current_subjects = find_subjects_by_id($_GET["subjects"],$public);
	if ($current_subjects&&$public){
	$current_pages = null ;//find_default_page_for_subject($current_subjects["id"]);
	}else {	$current_pages = null;$current_step1 =null;$current_step2 =null;
	}
		}	elseif(isset($_GET["pages"]))
			{
						if(isset($_GET["step1"]))
						{
									if(isset($_GET["step2"]))
									{
									$current_step2 =find_step2_by_id($_GET["step2"],$public);
									}
							
						$current_step1 =find_step1_by_id($_GET["step1"],$public);
						}else{$current_step1=null;$current_step2 =null;}
			$current_subjects =null;
			$current_pages = find_pages_by_id($_GET["pages"],$public);	
			}
		else{
		$current_step2 =null;
		$current_step1 =null;
		$current_subjects =null;
		$current_pages = null;
		}
		// check form  error 	
	}	$errors = array();
function find_default_page_for_subject($subjects_id){

$pages_set = find_pages_for_subjects($subjects_id);


	if ($first_pages= mysqli_fetch_assoc($pages_set)){
			return $first_pages; 
			} else {
			return null;
			}

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
function find_owners_by_id($owners_id){


		global $connection ;
		$safe_owners_id =mysqli_real_escape_string($connection,$owners_id);
		$query  = "select * ";
		$query .= "from owner ";
		$query .= "where id ={$safe_owners_id} ";
		$query .= "LIMIT 1";
		$owners_set = mysqli_query($connection,$query);
		confirm_query($owners_set);
    	if ($owners= mysqli_fetch_assoc($owners_set)){
			return $owners; 
			}else{
			return null;
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
function find_owner_by_username($username){

global $connection ;
		$safe_username =mysqli_real_escape_string($connection,$username);
		$query  = "select * ";
		$query .= "from owner ";
		$query .= "where username ='{$safe_username}' ";
		$query .= "LIMIT 1";
		$owners_set = mysqli_query($connection, $query);
		confirm_query($owners_set);
    	if ($owner= mysqli_fetch_assoc($owners_set)){
			return $owner; 
			} else {
			return null;
			}
	}	
function find_owner_for_page($pages_id) {
global $subject ;
global $connection ;
		$safe_pages_id =mysqli_real_escape_string($connection,$pages_id);
		$query  = "select * ";
		$query .= "from pages ";
		$query .= "where id ='{$safe_pages_id}' ";
		$query .= "LIMIT 1";
		$pages_set = mysqli_query($connection, $query);
		confirm_query($pages_set);
		if ($pages= mysqli_fetch_assoc($pages_set))
				{

				$safe_subject_id =mysqli_real_escape_string($connection,$pages["subjects_id"]);
				$query  = "select * ";
				$query .= "from subjects ";
				$query .= "where id ='{$safe_subject_id}' ";
				$query .= "LIMIT 1";
				$subject_set = mysqli_query($connection, $query);
				confirm_query($subject_set);
				if ($subject= mysqli_fetch_assoc($subject_set)){
					
					 return $subject;
							
						} else {
						return null;
						}
				}
				else 
				{
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
function attempt_login_admin($username,$password){

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
	}
 else {
// admins not found 
return false ;
}
}
function attempt_login_owner($username,$password){


$owner = find_owner_by_username($username);
if ($owner){
					//found admins check password

				if (password_check($password, $owner["hashed_password"])) {
				//password matches
				return $owner;
					} else {
				//password does not match
				return false ;
					}
	}

 else {
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

function find_all_elements($public=false) {
		global $connection ;
		
		$query  = "select * ";
		$query .= "from elements ";
		$query .= "order by position ASC";

		$elements_set = mysqli_query($connection,$query);
		confirm_query($elements_set);
		return $elements_set;
		}
function find_selected_properties($public =false) {
		global $current_elements;
		global $current_properties;
		global $current_values;

			
		if(isset($_GET["values"]))
						{
						//else{$current_step2 =null;}
						$current_values =find_values_by_id($_GET["values"],$public);

						}
		
		
		elseif(isset($_GET["properties"]))
			{
			$current_properties = find_properties_by_id($_GET["properties"],$public);	

			
			}
		
		elseif(isset($_GET["elements"])) {
			$current_elements = find_elements_by_id($_GET["elements"],$public);

		}
		else{
		$current_values =null;
		$current_elements =null;
		$current_properties = null;
		$current_step2 = null;
		}
		// check form  error 	
	}	$errors = array();		
function find_values_by_id($values_id){
		global $connection ;
		$safe_values_id =mysqli_real_escape_string($connection,$values_id);
		$query  = "select * ";
		$query .= "from `values` ";
		$query .= "where id ={$safe_values_id} ";
		$query .= "LIMIT 1";
		$values_set = mysqli_query($connection,$query);
		confirm_query($values_set);
    	if ($values= mysqli_fetch_assoc($values_set)){
			return $values; 
			} else {
			return null;
			}
	}			
function find_properties_by_id($properties_id){
		global $connection ;
		$safe_properties_id =mysqli_real_escape_string($connection,$properties_id);
		$query  = "select * ";
		$query .= "from properties ";
		$query .= "where id ={$safe_properties_id} ";
		$query .= "LIMIT 1";
		$properties_set = mysqli_query($connection,$query);
		confirm_query($properties_set);
    	if ($properties= mysqli_fetch_assoc($properties_set)){
			return $properties; 
			} else {
			return null;
			}
	}	
function find_elements_by_id($elements_id){


		global $connection ;
		$safe_elements_id =mysqli_real_escape_string($connection,$elements_id);
		$query  = "select * ";
		$query .= "from elements ";
		$query .= "where id ={$safe_elements_id} ";
		$query .= "LIMIT 1";
		$elements_set = mysqli_query($connection,$query);
		confirm_query($elements_set);
    	if ($elements= mysqli_fetch_assoc($elements_set)){
			return $elements; 
			}else{
			return null;
			}
	}
function find_properties_for_elements($elements_id) {

		global $connection;
		$safe_elements_id =mysqli_real_escape_string($connection,$elements_id);
		$query  = "select * ";
		$query .= "from properties ";
		$query .= "where elements_id={$safe_elements_id} ";

		$query .= "order by position ASC";

		$properties_set = mysqli_query($connection,$query);
		confirm_query($properties_set);
		return $properties_set;
		}//navigation takes current  [subjects or pages ] or null
function find_values_for_properties($properties_id, $public=false) {

		global $connection;
		$safe_properties_id =mysqli_real_escape_string($connection,$properties_id);
		$query  = "select * ";
		$query .= "from `values` ";
		$query .= "where properties_id={$safe_properties_id} ";
		$query .= "order by position ASC";
		$values_set = mysqli_query($connection,$query);
		confirm_query($values_set);
		return $values_set;
		}//navigation takes current  [pages or step1 ] or null		
function container_navigation($elements_array,$properties_array,$values_array) {


		$output = "<ul class =\"elements\"> ";
		$elements_set = find_all_elements(); 
			$output .= "<a href=\"index.php\">HOME</a>";
		while($elements =mysqli_fetch_assoc($elements_set)) {	
		$output .= "<li";
			if ($elements_array && $elements["id"] == $elements_array["id"]) 
			{   $output .= " class=\"selected\" ";}
			    $output .= ">" ;
				$output .= "<a href=\"manage_containers.php?elements="; 
				$output .= urlencode($elements["id"]); 
				$output .= "\">";
				$output .= htmlentities($elements["menu_name"]) ; 
				$output .= "</a>";
			// accordian effect
				if ($elements_array["id"] == $elements["id"] || $properties_array["elements_id"] == $elements["id"]) {
					$properties_set = find_properties_for_elements($elements["id"]) ;
					$output .="<ul class=\"properties\">";
						while($properties =mysqli_fetch_assoc($properties_set)) { 
					$output .= "<li";
						if ($properties_array["id"] && $properties["id"]==$properties_array["id"]) 
					{$output .= " class=\"selected\" ";}
					$output .= ">" ;
					$output .= "<a href=\"manage_containers.php?properties=";
					$output .= urlencode($properties["id"]); 
					$output .="\">";
					$output .= htmlentities($properties["menu_name"]);  
					$output .= "</a> </li>";
							if ($properties_array["id"] == $properties["id"]   )//|| $values_array["elements_id"] == $properties["id"]
							{
								$values_set = find_values_for_properties($properties["id"]) ;
								$output .="<ul class=\"properties\">";
									while($values =mysqli_fetch_assoc($values_set)) { 
								$output .= "<li";
									if ($values_array["id"] && $values["id"]==$values_array["id"]) 
								{$output .= " class=\"selected\" ";}
								$output .= ">" ;
								$output .= "<a href=\"manage_containers.php?properties=";
								$output .= urlencode($properties["id"]); 
								$output .= "&values=";
								$output .= urlencode($values["id"]); 
								$output .="\">";
								$output .= htmlentities($values["menu_name"]);  
								$output .= "</a> </li>";
									//////////////////////////////
											/* 	if ($values_array["id"] == $values["id"]  )
													
													{
												$step2_set = find_step2_for_values($values["id"]) ;
												$output .="<ul class=\"values\">";
													while($step2 =mysqli_fetch_assoc($step2_set)) { 
												$output .= "<li";
													if ($step2_array["id"] && $step2["id"]==$step2_array["id"]) 
												{$output .= " class=\"selected\" ";}
												$output .= ">" ;
												$output .= "<a href=\"manage_containers.php?properties=";
												$output .= urlencode($properties["id"]); 
												$output .= "&values=";
												$output .= urlencode($values["id"]); 
												$output .= "&step2=";
												$output .= urlencode($step2["id"]); 
												$output .="\">";
												$output .= htmlentities($step2["menu_name"]);  
												$output .= "</a> </li>"; 
			}	
		$output .="</ul> ";
		mysqli_free_result($step2_set);
		}*/
			}	
		///////////////////////////////////////
		$output .="</ul> ";
		mysqli_free_result($values_set);
		}
			}	
		$output .="</ul> ";
		
		mysqli_free_result($properties_set);
		}
	
		
		$output .= "</li> ";//end of subject li
		} 
		mysqli_free_result($elements_set); 
		
		$output .="</ul>";
		return $output;
		}

function find_default_propertie_for_elements($elements_id){

$properties_set = find_properties_for_elements($elements_id);


	if ($first_properties= mysqli_fetch_assoc($properties_set)){
			return $first_properties; 
			} else {
			return null;
			}

}	
function find_all_properties() {
		global $connection ;
		
		$query  = "select * ";
		$query .= "from properties ";
//		$query .= "where visible =1 ";
		$query .= "order by position ASC";

		$properties_set = mysqli_query($connection,$query);
		confirm_query($properties_set);
		return $properties_set;
		}
function find_all_values() {
		global $connection ;
		
		$query  = "select * ";
		$query .= "from `values` ";
//		$query .= "where visible =1 ";
		$query .= "order by position ASC";

		$value_set = mysqli_query($connection,$query);
		confirm_query($value_set);
		return $value_set;
		}
	
function find_all_container($container){
	global $connection ;
		
		$query  = "select * ";
		$query .= "from `values` ";
//		$query .= "where visible =1 ";
		$query .= "order by position ASC";

		$value_set = mysqli_query($connection,$query);
		confirm_query($value_set);
		return $value_set;
		}
function check_step2_tables($table_name)	{
	
	global $connection ;	

	$query = "select 1 from `{$table_name}`";
	$result = mysqli_query($connection, $query);
if($result != FALSE) {
	confirm_query($result);
    return $result;
}else{
  return FALSE;
}
		
}
function find_all($table_name){
	global $connection ;
		
		$query  = "select * ";
		$query .= "from `{$table_name}` ";
//		$query .= "where visible =1 ";
		$query .= "order by position ASC";

		$table_set = mysqli_query($connection,$query);
		confirm_query($table_set);
		return $table_set;
		}

function find_row($table,$condition){
	global $connection ;
		
		$query  = "select * ";
		$query .= "from `{$table}` ";
		$query .= "where {$condition} ";
		$query .= "order by position ASC";

		$table_set = mysqli_query($connection,$query);
		confirm_query($table_set);
		return $row_set;
		}
		
		
		?>