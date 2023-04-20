<?php

/*
 
@package ash_theme
===============================================
	VIDEO POST FORMAT
===============================================

*/

?>

<article id="post-<?php the_ID(); ?>"<?php post_class('ash-format-video');?>>
	<header class="entry-header text-center" >
	
	<div class="embed-responsive embed-responsive-16by9">
	<?php 	echo ash_get_embedded_media( array('video','iframe')  );	?>
	</div>
	<?php   $shorttitle = wp_trim_words( get_the_title() , $num_words = 4, $more = '. ' );
    
    
    echo '<h3 class="entry-title"><a href="'. esc_url( get_permalink() ) .'" rel="bookmark" >'.$shorttitle.'</a></h3>'; ?>	
    
			<div class="entry-meta">
			<?php echo ash_posted_meta();?>
			</div>
	</header>
	
        		 <div class="entry-content">	
                <?php if( ash_get_attachment() ):?>
                  <a class="standard-featured-link" href="<?php the_permalink();?>">
                  <div class="standard-featured background-image" style="background-image: url( <?php echo ash_get_attachment() ; ?>);"></div>
                  </a>
                <?php endif; ?>

                <div class="entry-excerpt">
                <?php the_excerpt(); ?>
                </div>	
               


              </div>	
	
	<footer class="entery-footer">
         
		<?php echo ash_posted_footer(); ?>
	</footer >
  
<?php	wp_reset_postdata(); ?>

</article>
