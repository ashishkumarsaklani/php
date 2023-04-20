<?php

/*
 
@package ash_theme
===============================================
	COMMENTS SECTION
===============================================

*/

if( post_password_required()){
	return;
}

?>
<div id="comments" class="comments-area">
     
 <?php if ( have_comments() ):
     		// have comments
     ?>
  
  	<h2 class="comment-title">
  
 		<?php 
  		printf(
      		esc_html( _nx( 'One comment on &ldquo; %2$s &rdquo; ','%1$s commments on  &ldquo; %2$s &rdquo;', get_comments_number(), 'comments title', 'Ash_theme' ) ),
        	number_format_i18n(get_comments_number() ),
        '<span>'. get_the_title() . '</span>'
      
      		);
      
      ?>
  	</h2>
  
   
  <?php ash_get_post_navigation() ;?>
  
  
  
     <ol class="comment-list">
			<?php
       
       $args = array(
       		'walker' 					=> 	null,
         	'max_depth'				=> 	'',
       		'style'						=>	'ol', 
       		'callback'				=>  null,
         	'end-callback'		=>	null,
         	'type'						=>  'all',
					'reply_text'			=>	'Reply',
         	'page'						=>	'',
         	'per_page'				=>	'',
					'avatar_size'			=>	32,
         	'reverse_top_level' => null,
         	'reverse_children'	=> '',
         	'format'					=> 'html5',
         	'short_ping'			=> false,
         	'echo'						=> true
	       );
       
       
				wp_list_comments( $args );
			?>
	</ol>
    
 
  
  <?php ash_get_post_navigation() ;?>
  
  
	<?php
		if (!comments_open() && get_comments_number() ):
     ?>
          
	<p class="no-comments"><?php esc_html_e('Comments are closed.','Ash_theme');?></p>     
    
		// <?php  endif; ?>
	
		 <?php		endif; ?>
     <?php
  
  //    STYLING COMMENTS FORM
  		$fields = array(
      
      'author' 				=>   
      
    '<div class="form-group"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> <span class="required">*</span> <input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) .
    '" required="required" /></div>',
        
        'email'			=> 
        
        '<div class="form-group"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> <span class="required">*</span><input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" required="required" /></div>',
        
        'url'				=>
        '<div class="form-group last-field"><label for="url">' . __( 'Website', 'domainreference' ) . '</label><input id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" /></div>'
      
      );
  	
  
      $args = array(
        'class_submit' 	=> 'btn btn-block btn-lg btn-warning',
        'label_submit' 	=> __( 'Submit Comment'),
        'comment_field'	=>	
       			 '<div class="form-group"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" class="form-control"  rows="4" aria-required="true"></textarea></div>',
        'fields'				=> apply_filters('comment_form_default_fields', $fields)



      ); 
      ?>

<?php echo '<div id="contactushere" style="clear:both; ">'; comment_form($args);echo '</div>'; ?>

</div> <!-- .comments-area-->
