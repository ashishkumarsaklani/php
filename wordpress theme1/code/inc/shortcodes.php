 
<?php

/* 
===============================================
			THEME SHORTCODE PAGE
===============================================

			@package Ash_theme
  

*/



//POP OVER
function ash_pop_over( $atts, $content = null ){
  
//[popover title="Popover title" trigger ="click" content="this is popover content" placement="top"] this is clickable content[/popover]
  
  // get the attributes
  
  $atts = shortcode_atts(
  
  		 array(
          'placement'		=> 'top',
          'title'				=> '',
    			'trigger'			=> 'click',
    			'content'		=>'',
       		 ),$atts,	   
    	'popover'
			 );
  	
  //trurn HTML
  return '<span class="ash-popover" data-toggle="popover" data-placement="'.$atts['placement'].'" title="'. $atts['title'] .'" data-trigger="'. $atts['trigger'] .'" data-content ="'. $atts['content'] .'">'. $content .'</span>'; 

  
  
}
add_shortcode('popover', 'ash_pop_over' );
  
  
  
  
  
  
//Contact form shortcode

function ash_contact_form( $atts, $content=null ){

//Contact form
  
  //get the attributes
	$atts = shortcode_atts(
      array(),
      $atts,
			'contact_form'
  	  );
  
  //retrn Html
	ob_start();
  include 'templates/contact-form.php';
	return ob_get_clean();
}

add_shortcode('contact_form', 'ash_contact_form' )

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
?>
		
