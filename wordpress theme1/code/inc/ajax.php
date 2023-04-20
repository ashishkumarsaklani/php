<?php
/*
@package ash_theme
===============================================
			AJAX VERSION
===============================================
*/

add_action( 'wp_ajax_nopriv_ash_load_more', 'ash_load_more' );
add_action( 'wp_ajax_ash_load_more', 'ash_load_more' );
	

add_action( 'wp_ajax_nopriv_ash_save_contact_form', 'ash_save_contact' );
add_action( 'wp_ajax_ash_save_contact_form', 'ash_save_contact' );


function ash_load_more(){	
	$paged = $_POST["page"]+1;
	$prev = $_POST["prev"];
	$title =$_POST["title"];
	
	if( $prev == 1 && $_POST["page"] != 1 ){
		$paged = $_POST["page"]-1;
	}
	
	if (is_home()){
	$args =  array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $paged
		);
	} else {
		$args =  array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $paged,
		'category_name' => $title
		);
		
	}
	
	
	$query = new WP_Query( $args );
	
		if( $query->have_posts() ):
				
				echo'<div class="page-limit" data-page="/page/' .$paged. '">';
		
				while( $query->have_posts() ): 
  			echo '<div class ="col-sm-3 art-cont">';	
  			$query->the_post();
				get_template_part('template-parts/content', get_post_format());
  			echo '</div>';
				endwhile;
				echo '</div>';
		else:
	
		echo 0;
		
	endif;
	
	wp_reset_postdata();
	
	die();
	
}


function ash_check_paged( $num = null ){
	$output= '';
	
	if ( is_paged() ){	$output = 'page/' . get_query_var( 'paged' );	}
		if( $num == 1){
			$paged = ( get_query_var( 'paged' ) == 0 ? 1 : get_query_var('paged'));
			return $paged;
		} else {
			return $output;
		}

} 


function ash_save_contact(){

	$title = wp_strip_all_tags($_POST["name"]);
  	$email = wp_strip_all_tags($_POST["email"]);
	$message = wp_strip_all_tags($_POST["message"]);

  
  
  $args = array(
    	'post_title' 		=> $title,
    	'post_content'	=> $message,
    	'post_author' 	=> 1,
    	'post_status'		=> 'publish',
    	'post_type'			=> 'ash-contact',
    	'meta_input' 		=> array(
  				'_contact_email_value_key'		=> $email	
  				)
  		 );
  
  $postID = wp_insert_post( $args );    //add  , wp_error with $args to check errors     we can save something in the post  powerful tool  already sanitized and validated by wordpress  
  if ($postID !== 0 ){

    	$to 		= get_bloginfo('admin_email');
    	$subject	= 'Ash-Theme -'.$title;
    
    	$headers[]  = 'From:  '. get_bloginfo('name') .' <'.$to.'>';
    	$headers[]  = 'Reply-To: '.$title.' <'.$email.'>';
    	$headers[]  = 'Content-Type:  text/html: charset=UTF-8';
    
        
   															  $users = get_users( array( 'fields' => array( 'ID' ) ) );
                                    foreach($users as $user_id){
                                      
                                      $Uemail = get_userdata( $user_id->ID )->user_email ;
    																//	$headers[]  = 'CC:'. $Uemail ;
                                    	$message .= '<br>'. $Uemail ;
                                    }
  
    

   wp_mail($to , $subject, '<p>'.$message.'</p><br>'.$title.'<p>'.$email.'</p>' ,$headers );  //    wp_mail($to , $subject, $message ,'header', array('for attachment') );

    echo $postID;  
    
  }else{
  		echo 0;
  }

    die();
}




function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );






