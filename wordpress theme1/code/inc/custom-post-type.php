
<?php
/*
 
@package ash_theme
===============================================
	THEME CUSTOM POST TYPE
===============================================

*/


$contact=  get_option( 'activate_contact' );
if ( @$contact == 1 ){
	
 add_action( 'init','ash_contact_custom_post_type');
 add_filter( 'manage_ash-contact_posts_columns', 'ash_set_contact_columns');
 
 add_action( 'manage_ash-contact_posts_custom_column', 'ash_contact_custom_column',10,2 );
 add_action( 'add_meta_boxes' , 'ash_contact_add_meta_box');
 add_action( 'save_post', 'ash_save_contact_email_data');
 
 }



/* CONTACT CUSTOM POST TYPE */

function ash_contact_custom_post_type(){
	
	$labels=  array(
		'name'				=>  'Messages',
		'singular_name' 	=>  'Message',
		'menu_name'			=>	'Messages',
		'name_admin_bar'	=> 	'Message',
	);
	
	$args =		array(
	
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_in_menu'		=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=>	false,
		'menu_position'		=>	26,
		'menu_icon'			=>	'dashicons-email-alt',	
		'supports'			=> array('title','editor','author')	
	);
	register_post_type( 'ash-contact',$args );
	
	
}

function ash_set_contact_columns( $columns ){
	
	 //unset( $columns ['author']);  to remove
	
	$newColumns  = array();
	$newColumns['title'] = 'Full Name';
	$newColumns['message'] = 'Message';
	$newColumns['email'] = 'Email';
	$newColumns['date'] = 'Date';
	return $newColumns;

}

function ash_contact_custom_column( $column , $post_id ){
	
	switch (  $column ) {
	
		case 'message' :
		echo get_the_excerpt();
		break ;

		case 'email' :
		$email =get_post_meta( $post_id,'_contact_email_value_key' , true );
		echo '<a href="mailto:' . $email . '">'.$email.'</a>' ;
		break ;

	}

}

//CONTACT META BOXES //

function ash_contact_add_meta_box(){
	
	// 	add_meta_box( string $id , string $ titile, callback $callback, mixed $screen ,string $context, string $priority, array $callback_args )
		add_meta_box('contact_email','User Email','ash_contact_email_callback','ash-contact','side','default');
		
	
	
}

function ash_contact_email_callback( $post ){
	
	//wp_nonce_field( mixed $action ,string $name ,bool $referer , bool $echo )
	wp_nonce_field('ash_save_contact_email_data','ash_contact_email_meta_box_nonce');
	//get_post_meta( int $post_id, string $key, bool $single)
	$value= get_post_meta( $post -> ID,'_contact_email_value_key' , true );
	echo '<label for = "ash_contact_email_field">User Email Address :</lable>' ;
	echo '<input type ="email" id ="ash_contact_email_field" name="ash_contact_email_field" value ="' . esc_attr( $value ) . '" size="25" />'; 
	}


function ash_save_contact_email_data( $post_id ) {
	if (! isset ($_POST['ash_contact_email_meta_box_nonce']	) ) {
		return;
	}
	if (! wp_verify_nonce ( $_POST['ash_contact_email_meta_box_nonce'], 'ash_save_contact_email_data') ) {
		return;
	}
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( ! isset( $_POST['ash_contact_email_field'] ) ) {
		return;
	}
	
	$my_data = sanitize_text_field($_POST['ash_contact_email_field']);
	//update_post_meta( int $post_id, string $meta_key , mixed $meta_value, mixed $prev_value )
	update_post_meta($post_id , '_contact_email_value_key', $my_data );
	
}


