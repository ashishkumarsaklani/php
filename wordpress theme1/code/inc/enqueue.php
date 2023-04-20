<?php

/*

@package ash_theme
===============================================
	aDMIN ENQUEUE FUNCTIONs
===============================================

*/

function ash_load_admin_scripts( $hook ){
	//echo $hook;
	
	if ('toplevel_page_ash' == $hook ){
		
	wp_enqueue_media(); // to trigger media to work
	
	wp_register_script('ash-admin-script', get_template_directory_uri().'/js/ash-admin.js',array('jquery'),'1.0.0',true);
	wp_enqueue_script('ash-admin-script');
	
	wp_register_style('ash_admin', get_template_directory_uri().'/css/ash.admin.css'); //store file 
	wp_enqueue_style('ash_admin');																			// admin initializtion or to trigger	


    

  }
	

  
  if ('ashish_page_ash_css' == $hook ){
		
		wp_register_style('ace', get_template_directory_uri().'/css/ash.ace.css',array(),'1.0.0','all');
		wp_enqueue_style('ace', get_template_directory_uri().'/css/ash.ace.css',array(),'1.0.0','all');
		wp_register_script('ash-ace',get_template_directory_uri().'/js/ace/ace.js', array('jquery') , '1.2.1', true );
		wp_enqueue_script('ash-ace',get_template_directory_uri().'/js/ace/ace.js', array('jquery') , '1.2.1', true );
		wp_register_script('ash-custom-css-script',get_template_directory_uri().'/js/ash.custom_css.js' , array('jquery') , '1.0.0', true );
		wp_enqueue_script('ash-custom-css-script',get_template_directory_uri().'/js/ash.custom_css.js' , array('jquery') , '1.0.0', true );
	} 
}
add_action('admin_enqueue_scripts','ash_load_admin_scripts');

/*
===============================================
	FRONT END ENQUEUE FUNCTIONs
===============================================
*/

function ash_load_scripts(){
	//wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css',array(),'3.3.7','all');

  wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
	wp_enqueue_style('raleway','https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
	wp_enqueue_style('ash', get_template_directory_uri().'/css/ash.php',array(),'1.0.0','all');	
	wp_enqueue_style('fawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  
	wp_deregister_script( 'jquery' );
	wp_register_script('jquery',get_template_directory_uri().'/js/jquery.js' , false, '1.11.3', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('bootstrap',get_template_directory_uri().'/js/bootstrap.min.js', array('jquery') , '3.3.7', true );
	wp_enqueue_script('ashjs',get_template_directory_uri().'/js/ash.js', array('jquery') , '1.0.0', true );
//	wp_enqueue_script('paralax',get_template_directory_uri().'/js/paralax.js',array() , '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'ash_load_scripts' );