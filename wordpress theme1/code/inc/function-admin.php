<?php

/*
 
@package ash_theme
===============================================
	aDMIN PaGE
===============================================

*/
function 	ash_add_admin_page(){
	/*========================================generating a admin page =============================================*/
			add_menu_page('ash Theme Options','ashish','manage_options','ash','ash_theme_create_page','dashicons-palmtree', 110 ); 
		//	get_template_directory_uri().'/img/ash.png',110);  or 'dashicons-shield', 110 );// https://developer.wordpress.org/resource/dashicons
	/*========================================generating a admin subpage =============================================*/	
			add_submenu_page('ash','ash Sidebar Options','Sidebar','manage_options','ash','ash_theme_create_page');
			add_submenu_page('ash','ash Theme Options','Theme Options','manage_options','ash_theme','ash_theme_support_page');
			add_submenu_page('ash','ash Contact Form','Contact form','manage_options','ash_theme_contact','ash_contact_form_page');
			add_submenu_page('ash','ash css Options','Custom css','manage_options','ash_css','ash_theme_setting_page');

			
			add_action('admin_init','ash_custom_settings');	//	activate custom settings//added inside so if main function is called then only this function will be initiated
}	
			add_action('admin_menu','ash_add_admin_page');
			
			
function 	ash_custom_settings(){
	//	Sidebar Options
			register_setting('ash-settings-group','profile_picture');
			register_setting('ash-settings-group','first_name');
			register_setting('ash-settings-group','last_name');
			register_setting('ash-settings-group','last_name');
			register_setting('ash-settings-group','user_details');
			register_setting('ash-settings-group','twitter_handler', 'ash_sanitize_twitter_handler');
			register_setting('ash-settings-group','facebook_handler');
			register_setting('ash-settings-group','gplus_handler');
			
			add_settings_section('ash-sidebar-options','sidebar Options','ash_sidebar_options','ash');

			add_settings_field('sidebar-profile-picture','Profile picture', 'ash_sidebar_profile','ash','ash-sidebar-options');
			add_settings_field('sidebar-name','Full Name', 'ash_sidebar_name','ash','ash-sidebar-options');
			add_settings_field('sidebar-details','user Details', 'ash_sidebar_details','ash','ash-sidebar-options');
			add_settings_field('sidebar-twitter','Twitter handler','ash_sidebar_twitter','ash','ash-sidebar-options');
			add_settings_field('sidebar-facebook','facebook handler','ash_sidebar_facebook','ash','ash-sidebar-options');
			add_settings_field('sidebar-gplus','gplus handler','ash_sidebar_gplus','ash','ash-sidebar-options');
			
	//		Theme Support Options		
	
			register_setting('ash-theme-support','post_formats');
			register_setting('ash-theme-support','custom_header');
			register_setting('ash-theme-support','custom_background');
			
			add_settings_section('ash-theme-options','Theme Options','ash_theme_options','ash_theme');	
			
			add_settings_field('post-formats','Post Formats', 'ash_post_formats','ash_theme','ash-theme-options');
			add_settings_field('custom-header','Custom Header', 'ash_custom_header','ash_theme','ash-theme-options');
			add_settings_field('custom-background','Custom background', 'ash_custom_background','ash_theme','ash-theme-options');
		// CONTACT FORM options 

			register_setting('ash-contact-options','activate_contact');
			add_settings_section('ash-contact-section','Contact Form','ash_contact_section','ash_theme_contact');
			add_settings_field('activate-form','Activate Contact Form', 'ash_activate_contact','ash_theme_contact','ash-contact-section');

	
			// CUSTOM css options 

			register_setting('ash-custom-css-options','ash_css', 'ash_sanitize_custom_css' );
			//register_setting( string $option_group, string $option_name, callback $sanitize_callback);
			add_settings_section('ash-custom-css-section','Custom css','ash_custom_css_section_callback','ash_theme_css');
			//add_settings_section( string $id, string $title, string $callback, string $page );
			add_settings_field('custom-css','Use your Own css', 'ash_custom_css_callback','ash_theme_css','ash-custom-css-section');
			//	add_settings_field(string $id, string $title, string $callback, string $page, string $section, array $args );
}



function ash_custom_css_section_callback(){
	echo 'Customize AsH theme with your css';
}

function ash_custom_css_callback(){

	$css =  get_option( 'ash_css' );
	$css = ( empty($css)  ? '/* Ash Theme Custom css */' : $css );
	echo '<div id="customcss">'.$css.'</div><textarea id="ash_css" name="ash_css" style="display:none ; visibility:hidden ;">'.$css.'</textarea>';
}


function ash_theme_options(){
	echo 'Activate and deactivate specfic theme option';
}


function ash_contact_section(){
	echo 'Activate and deactivate the Built in Contact form';
}

function ash_activate_contact(){

	$options =  get_option('activate_contact');
	$checked = (@$options == 1 ? 'checked' : '');
	echo '<label><input type ="checkbox" id ="custom_header" name ="activate_contact" value ="1" '.$checked.'/></label>';
}


function ash_post_formats(){

	$options =  get_option('post_formats');
	$formats = array('aside','gallery','link','image','quote','status','video','audio','chat');
	$output ='' ;
	foreach( $formats  as $format ){
				$checked = (@$options[$format] == 1 ? 'checked' : '');
				$output .= '<label><input type ="checkbox" id ="'.$format.'" name ="post_formats['.$format.']" value ="1" '.$checked.'/>'.$format.'</label><br>';
				}
				echo $output;
}
function ash_custom_header(){

	$options =  get_option('custom_header');
	$checked = (@$options == 1 ? 'checked' : '');
	echo '<label><input type ="checkbox" id ="custom_header" name ="custom_header" value ="1" '.$checked.'/>Activate Custom Header</label>';
}


function ash_custom_background(){

	$options =  get_option('custom_background');
	$checked = (@$options == 1 ? 'checked' : '');
	echo '<label><input type ="checkbox" id ="custom_background" name ="custom_background" value ="1" '.$checked.'/>Activate Custom Background</label>';
}
				
//   Sidebar Options Functions
function 	ash_sidebar_options(){
echo 		'Customize Your sidebar Information';
}

function    ash_sidebar_profile(){
			$picture = esc_attr( get_option('profile_picture') );
			if( empty ($picture)){
				echo       '<input type ="button" class ="button button-secondary" value="upload profile picture"id="upload-button">  <input type ="hidden" id="profile-picture" name ="profile_picture" value="'.$picture.'" />';
			}else {
				echo       '<input type ="button" class ="button button-secondary" value="Replace profile picture"id="upload-button">  <input type ="hidden" id="profile-picture" name ="profile_picture" value="'.$picture.'" /><input type ="button" class ="button button-secondary" value="Remove profile picture" id="remove-picture">';
			}
}


function    ash_sidebar_name(){
			$firstName = esc_attr( get_option('first_name') );
			$lastName = esc_attr( get_option('last_name') );
echo		'<input type ="text" name ="first_name" value="'.$firstName.'" placeholder="First Name"/> <input type ="text" name ="last_name" value="'.$lastName.'" placeholder="Last Name"/>';
}
function 	ash_sidebar_details(){
			$details = esc_attr( get_option('user_details') );
echo		'<input type ="text" name ="user_details" value="'.$details.'" placeholder="user_details"/><p class= "details">write something about you</p>';
} 


function 	ash_sidebar_twitter(){
			$twitter = esc_attr( get_option('twitter_handler') );
echo		'<input type ="text" name ="twitter_handler" value="'.$twitter.'" placeholder="twitter_handler"/>';
}

function 	ash_sidebar_facebook(){
			$facebook = esc_attr( get_option('facebook_handler') );
echo		'<input type ="text" name ="facebook_handler" value="'.$facebook.'" placeholder="facebook_handler"/>';
}
function 	ash_sidebar_gplus(){
			$gplus = esc_attr( get_option('gplus_handler') );
echo		'<input type ="text" name ="gplus_handler" value="'.$gplus.'" placeholder="gplus_handler"/>';
}


//   sanitizeing user input 

function ash_sanitize_twitter_handler( $input ){
	$output = sanitize_text_field( $input );
	$output = str_replace('@','',$output);
	return $output;
}

function ash_sanitize_custom_css( $input ){
	$output = esc_textarea( $input );
	return $output;
}




// Template submenu function


function 	ash_theme_create_page(){ //settings page 1
require_once( get_template_directory().'/inc/templates/ash-admin.php' );
}

function 	ash_theme_support_page(){ //theme page 1
require_once( get_template_directory().'/inc/templates/ash-theme-support.php' );
}

function 	ash_contact_form_page(){ //theme page 1
require_once( get_template_directory().'/inc/templates/ash-contact-form.php' );
}

function 	ash_theme_setting_page(){//settings page 2
require_once( get_template_directory().'/inc/templates/ash-custom-css.php' );
}

?>
