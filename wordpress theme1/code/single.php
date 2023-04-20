<?php
    /**
    * Template Name: Single Page
    */
?>

<?php get_header();?>





<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class ="container  ash-posts-container">
			
			<?php
			
			
					//echo "1";		
					//wp_title('', true);
					if(have_posts()):

						while(have_posts()): the_post();
						get_template_part('template-parts/single', get_post_format());
        
        
        
        // Optional. Default post navigation arguments. Default empty array. 
          $args = array( 
              'prev_text' => 'Previous Post',//'%title', 
              'next_text' => 'Next Post',//'%title', 
              'in_same_term' => false, 
              'excluded_terms' => '', 
              'taxonomy' => 'category' 
          ); 
						the_post_navigation($args);

						
							if (comments_open()):
							comments_template();
							endif;

						endwhile;
						
					endif;	
							


			
			?>
			</div>

	</main>
</div>




<?php get_sidebar();?>
<?php get_footer();?>