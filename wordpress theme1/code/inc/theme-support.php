<?php

/*
 
@package ash_theme
===============================================
	THEME SUPPORT PAGE
===============================================

*/




$options =  get_option( 'post_formats' );
$formats = array('aside','gallery','link','image','quote','status','video','audio','chat');
$output = array () ;
	foreach( $formats  as $format ){
				$output[] = ( @$options[$format] == 1 ? $format : '');
}

if  ( !empty( $options )){
	add_theme_support('post-formats',$output);
}


$header =  get_option( 'custom_header' );
if (@$header == 1){
	
	add_theme_support( 'custom-header');
}

$background =  get_option( 'custom_background' );
if (@$background == 1){
	
	add_theme_support( 'custom-background');
}


	add_theme_support( 'post-thumbnails');


add_theme_support( 'custom-logo', array(
	'height'      => 40,
	'width'       => 40,
	'flex-height' => false,
	'flex-width'  => false,
	'header-text' => array( 'site-title', 'site-description' ),
) );


function ash_custom_logo() {
   if ( function_exists( 'the_custom_logo' ) ) {
      the_custom_logo();
   }
}



//  ACTZIVATE NAV MENU OPTION //
function ash_register_nav_menu(){
register_nav_menus( array (
  'primary' => __( 'primary','primary navigation menu in header'),
	'secondary' => __( 'secondary','secondary  menu in sidebarr'),
  ));
  }
add_action( 'after_setup_theme', 'ash_register_nav_menu' );
//  ACTZIVATE HTML 5 COMPONENTS //
	add_theme_support( 'html5', array('comment-list','comment-form','search-form','gallery','caption' ) ) ;



//  BLOG LOOP CUSTOM FUNCTION //

function ash_posted_meta(){
	$posted_on = human_time_diff( get_the_time('U') , current_time('timestamp') );
	$categories = get_the_category();
	$separator = ', ';
	$output = '';
	$i = 1;
	
	if( !empty($categories) ):
		foreach( $categories as $category ) :
			if ($i > 1): $output .= $saperator; endif;
			$output .= '<a href="'.esc_url( get_category_link( $category->term_id ) ). '" alt"'. esc_attr( 'View all posts in %s ',$category->name ) .'"> '. esc_html( $category->name ) .' </a> ';
			$i++;
			endforeach;
	endif;		


	return '<span class="posted-on"> Posted <a href="'.esc_url(get_permalink() ) .'">' . $posted_on .'</a> ago </span> / <span class="posted-in">' . $output . '</span>';
}


function ash_posted_footer(){
$comments_num = get_comments_number();
echo '<span class="glyphicon glyphicon-eye-open">  '.wpb_get_post_views(get_the_ID()).'</span>' ;
if( comments_open()){
	//get comments list
	if ( $comments_num == 0){
		$comments = __('No Comments');
	} elseif ( $comments_num > 1){
		$comments = $comments_num . __(' Comments');
	} else {
		$comments = __('1 Comment');
	}
	$comments = '<a href="' . get_comments_link() . '">' . $comments . '</a>';
} else {
	
	$comments = __('Closed') ;
}

	return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6 ">' .get_the_tag_list('<div class="tags-list"><span class="glyphicon glyphicon-tag"></span>',' ','</div>') . '</div><div class="col-xs-12 col-sm-6 text-right">' .$comments . '<span class="glyphicon glyphicon-comments"></span></div></div></div> ';
}



function ash_get_attachment( $num = 1 ){
	
	
			$output ='';
			if( has_post_thumbnail() && $num == 1 ): 
			$output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
			 
			else: 
					$attachments = get_posts( array( 
					'post_type' 	=> 'attachment',
					'posts_per_page'	=> $num,
					'post_parent' 	=> get_the_ID()
				) );
				if ( $attachments && $num == 1 ):
					foreach ( $attachments as $attachment ):
						$output = wp_get_attachment_url( $attachment->ID );
					endforeach;	
				elseif ( $attachments && $num > 1 ):
						$output = $attachments;
				endif;
			//	wp_reset_postdata();	
			endif; 
					
			return $output ;
}

function ash_get_embedded_media( $type = array() ){
		$content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
		$embed= get_media_embedded_in_content( $content, $type );
		
		if ( in_array( 'audio' , $type) ):
		$output= str_replace( '?visual=true','?visual=false', $embed[0]);
		else: 
		$output= $embed[0] ;	
		endif;
		
		return $output;
}

function ash_get_bs_slides( $attachments ){
	
		$output= array();
		$count = count($attachments)-1 ;
			for( $i = 0; $i <= $count; $i++  ):
					$active = ( $i == 0 ? 'active' : '' );
					$n = ( $i == $count ? 0 : $i+1 );
					$nextImg = wp_get_attachment_thumb_url( $attachments[$n]->ID );
					$p = ( $i == 0 ? $count : $i-1 );
					$prevImg = wp_get_attachment_thumb_url( $attachments[$p]->ID );
					
			$output[$i] = array( 
			'class' 		=> $active,
			'url'			=>  wp_get_attachment_url( $attachments[$i]->ID ),
			'next_img'		=>  $nextImg,
			'prev_img'		=>  $prevImg,
      'alt' => get_post_meta( $attachments[$i]->ID, '_wp_attachment_image_alt', true ),
			'caption'		=>	$attachments[$i]->post_excerpt

			);
		endfor;
		return $output ;
	
}

// POST Navigation //

function ash_get_post_navigation(){

		//	if (get_comment_pages_count() > 1 && get_option('page_comments')):
			
  			require( get_template_directory() . '/inc/templates/ash-comment-nav.php');
  
 		//	endif; 
}

// POST VIEWS//


function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');


// calling  Post Count //

function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}




// for customizing POST NAVIGATION LINK CLASS

add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');

function post_link_attributes($output) {
    $injection = 'class="btn btn-ash"';
    return str_replace('<a href=', '<a '.$injection.' href=', $output);
}




function shr_extra_profile_fields( $user ) {
 
    $profile_pic = ($user!=='add-new-user') ? get_user_meta($user->ID, 'shr_pic', true): false;
 
    if( !empty($profile_pic) ){
        $image = wp_get_attachment_image_src( $profile_pic, 'thumbnail' );
 
    } ?>
 
    <table class="form-table fh-profile-upload-options">
        <tr>
            <th>
                <label for="image"><?php _e('Main Profile Image', 'shr') ?></label>
            </th>
 
            <td>
                <input type="button" data-id="shr_image_id" data-src="shr-img" class="button shr-image" name="shr_image" id="shr-image" value="Upload" />
                <input type="hidden" class="button" name="shr_image_id" id="shr_image_id" value="<?php echo !empty($profile_pic) ? $profile_pic : ''; ?>" />
                <img id="shr-img" src="<?php echo !empty($profile_pic) ? $image[0] : ''; ?>" style="<?php echo  empty($profile_pic) ? 'display:none;' :'' ?> max-width: 100px; max-height: 100px;" />
            </td>
        </tr>
    </table><?php
 
}
add_action( 'show_user_profile', 'shr_extra_profile_fields' );
add_action( 'edit_user_profile', 'shr_extra_profile_fields' );
add_action( 'user_new_form', 'shr_extra_profile_fields' );


function shr_add_admin_scripts(){
 	wp_enqueue_media(); // to trigger media to work
	
	wp_register_script('ash-admin-script', get_template_directory_uri().'/js/ash-admin.js',array('jquery'),'1.0.0',true);
	wp_enqueue_script('ash-admin-script');
}
add_action('admin_enqueue_scripts', 'shr_add_admin_scripts');




function shr_profile_update($user_id){
 
    if( current_user_can('edit_users') ){
        $profile_pic = empty($_POST['shr_image_id']) ? '' : $_POST['shr_image_id'];
        update_user_meta($user_id, 'shr_pic', $profile_pic);
    }
 
}
add_action('profile_update', 'shr_profile_update');
add_action('user_register', 'shr_profile_update');



function autoset_featured() {
    global $post;
    $already_has_thumb = has_post_thumbnail($post->ID);
        if (!$already_has_thumb)  {
        $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
            if ($attached_image) {
                foreach ($attached_image as $attachment_id => $attachment) {
                    set_post_thumbnail($post->ID, $attachment_id);
                }
            }
        }
}
add_action('the_post', 'autoset_featured');
add_action('save_post', 'autoset_featured');
add_action('draft_to_publish', 'autoset_featured');
add_action('new_to_publish', 'autoset_featured');
add_action('pending_to_publish', 'autoset_featured');
add_action('future_to_publish', 'autoset_featured');
?>
