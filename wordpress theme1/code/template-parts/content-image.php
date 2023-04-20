<?php

/*
 
@package ash_theme
===============================================
	IMAGE POST FORMAT
===============================================

*/

?>

<article id="post-<?php the_ID(); ?>"<?php post_class( 'ash-format-image' );?>>

	<header class="entry-header text-center background-image" style="background-image: url( <?php echo ash_get_attachment() ; ?>);background-attachment: fixed;<?php if (is_home()) { echo 'height:400px';}?> ">

			<?php the_title('<h3 class="entry-title"><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">','</a></h3>'); ?>
			<div class="entry-meta">
			<?php echo ash_posted_meta();?>
			</div>



	</header>
            <div class="entry-content">	

            <div class="entry-excerpt">
            <?php //the_excerpt(); ?>
            </div>	
         <!--   <div class="button-container text-center">
              <a href="<?php/* esc_url( the_permalink() ); ?>" class="btn btn-ash" > <?php _e('Read More' ); */?></a>
            </div> -->	


          </div>	
  


	<footer class="entery-footer">
  
		<?php echo ash_posted_footer(); ?>
	</footer >
	

</article>
