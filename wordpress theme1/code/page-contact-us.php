<?php

/**
* Template Name: Contacts Page

@package ash_theme
===============================================
	Contacts Page Template 
===============================================

*/


get_header();?>





<div id="primary" class="content-area" >




		<main id="main" class="site-main" role="main">
      
      
      
      
			<div class ="container">
                           <?php                   if(have_posts()):
                                                     while (have_posts()) :
                                                       the_post(); 
							//            templte part follows
														?>        
        
                     <article id="post-<?php the_ID(); ?>"<?php post_class();?>>
                        <header class="entry-header text-center ">
                          <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        </header>
                        <div class="entry-content clearfix">	
                          <?php the_content(); ?>
                        </div>	
                    </article>


        <?php                        wp_reset_postdata();
                                                      endwhile; 
                                              endif; 	
                                      ?>
		  </div>
                                   
		</main>
</div>




<?php get_sidebar();?>

<?php get_footer();?>