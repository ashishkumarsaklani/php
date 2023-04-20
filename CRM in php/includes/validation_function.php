<?php
 
$errors = array();

//presents field name as text
function fieldname_as_text($fieldname){
	$fieldname =str_replace("_"," ",$fieldname);
	$fieldname =ucfirst($fieldname);
	return $fieldname;
	
	}


	//presence
function has_presence($value) {
	return isset($value) && $value !== "" ;
	}

function validate_presences($required_fields){
	global $errors;
	foreach($required_fields as $field){
	$value =trim($_POST[$field]);
	if(!has_presence($value)){
	$errors[$field] = fieldname_as_text($field) . " can't be blank ";
			}
		}
	}	
	
	//max lenth
function  has_max_length($value,$max){
	return strlen($value) <= $max ;
	}

	//validate max lenth
function  validate_max_lengths($field_with_max_lengths){
		global $errors;

		foreach($field_with_max_lengths as $field => $max) {
		$value =trim($_POST[$field]);
		if (!has_max_length($value,$max)){
		$errors[$field] =fieldname_as_text($field) ." is too long";
				}
			}
		}

	
	// in a set(array)
function  has_inclusion_in($value,$set ){
	return in_array($value,$set) ;
	}
	
		

		
function  has_min_length($value,$min){

//min lenth
if (strlen($value) <$min) {
global $errors;
$errors ="min {$min} digits required";
}
}

/*

function  has_max_length(){
//type

if (!is_string($value))   {
echo "Validation failed. not a srtring<br/>";
}





//uniqueness
//uses database to check uniqueness

// format
if (!preg_match("/.com/",$value))  {
echo "Validation failed. not a Site .<br/>";

}


if (strpos($value,"@") === false)  {
echo "Validation failed. not a email .<br/>";

}








*/


?>