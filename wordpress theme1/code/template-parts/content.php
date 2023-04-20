<?php

/*
 
@package ash_theme
===============================================
	STANDARD POST FORMAT
===============================================

*/

?>

<article id="post-<?php the_ID(); ?>"<?php post_class();?>>
	<header class="entry-header text-center ">
		<?php the_title('<h3 class="entry-title"><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">','</a></h3>'); ?>
			
       	<?php 
    
    $shortcontent = wp_trim_words( get_the_content() , $num_words = 55, $more = '… ' );
    
    echo '<p>'. $shortcontent .'</p>';
    
    
    
    $tag= get_the_tags(get_the_ID()); 
//  var_dump( $tag);
    ?> 
   <div class="entry-meta">
			<?php echo '</br>'.ash_posted_meta();?>
		</div> 	
  </header>
	<div class="entry-content">	
		<?php if( ash_get_attachment() ):?>
			<a class="standard-featured-link" href="<?php the_permalink();?>">
			
			</a>
		<?php endif; ?>
		<div class="entry-excerpt">
		<?php  ?>
		</div>	

           <!--   <div class="button-container text-center">
              <a href="<?php/* esc_url( the_permalink() ); ?>" class="btn btn-ash" > <?php _e('Read More' ); */?></a>
            </div> -->	
	</div>	
	<footer class="entery-footer">
		<?php echo ash_posted_footer();?>
	</footer >

	

</article>
