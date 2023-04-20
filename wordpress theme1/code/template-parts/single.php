<?php

/*
 
@package ash_theme
===============================================
	STANDARD POST FORMAT
===============================================

*/

?>

<article id="post-<?php the_ID(); ?>"<?php post_class();?>>
	<header class="entry-header text-center">
		<?php the_title('<h1 class="entry-title">','</h1>'); ?>
			<div class="entry-meta">
			<?php echo ash_posted_meta();?>
			</div>
	</header>
	<div class="entry-content">	

	<?php the_content(); ?>
	
	</div>	
	
	<footer class="entery-footer">
		<?php echo ash_posted_footer(); ?>
	</footer >
	

</article>
