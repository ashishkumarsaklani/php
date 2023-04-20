<?php

/*
 
@package ash_theme
===============================================
	QUOTE POST FORMAT
===============================================

*/

?>

<article id="post-<?php the_ID(); ?>"<?php post_class('ash-format-quote');?>>
	<header class="entry-header text-center">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
	
					<h3 class= "quote-content"><a href="<?php the_permalink(); ?>" rel="bookmark" ><?php echo get_the_content();?></a></h3>
		
        <?php  $avatar = get_user_meta( get_the_author_meta('ID'),  'shr_pic', true);    
                  // $image = wp_get_attachment_image($avatar); echo $image ; will work direcly
               $image = wp_get_attachment_url($avatar);
                                      
                                      if ( $image ) { ?>
      							<div class="inline" style="width:50px;height:50px;float:right;background-size: 100%;background-image: url(<?php    echo $image ; ?>)"></div>
      							
      					<?php } ?>
				<h3 class="inline" > <?php  the_author();?>  </h3>
		</div><!-- /* col-md-8 */ -->
	</div><!-- /* row */ -->
	
	</header>
          <div class="entry-content">	
         
            <div class="entry-excerpt">
            <?php //the_excerpt(); ?>
					
         
           <!--   <div class="button-container text-center">
              <a href="<?php/* esc_url( the_permalink() ); ?>" class="btn btn-ash" > <?php _e('Read More' ); */?></a>
            </div> -->	
	  		 </div>	
		 </div>	
	<footer class="entery-footer">
		<?php echo ash_posted_footer();  ?>
	</footer >
	

</article>
