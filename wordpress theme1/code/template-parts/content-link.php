<?php

/*
 
@package ash_theme
===============================================
	STANDARD POST FORMAT
===============================================

*/

?>

<article id="post-<?php the_ID(); ?>"<?php post_class( 'ash-format-link' );?>>
	<header class="entry-header text-center">
		<?php the_title('<h1 class="entry-title">','<div class="link-icon"> <span class ="glyphicon glyphicon-link"></span></div></h1>'); ?>

	</header>
	


</article>
