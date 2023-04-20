<?php

/*
@package ash_theme
===============================================
	AUDIO POST FORMAT
===============================================

*/

?>

<article id="post-<?php the_ID(); ?>"<?php post_class('ash-format-audio');?>>
	<header class="entry-header">
		<?php the_title('<h3 class="entry-title"><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">','</a></h3>'); ?>
			<div class="entry-meta">
			<?php echo ash_posted_meta();?>
			</div>
	</header>
	<div class="entry-content">	
		
		<?php 	echo ash_get_embedded_media( array('audio','iframe')  );	?>

	</div>	
	
	<footer class="entery-footer">
		<?php echo ash_posted_footer(); ?>
	</footer >
	

</article>
