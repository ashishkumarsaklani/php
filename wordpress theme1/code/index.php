<?php get_header();?>





<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if (is_paged() ): ?>
		
		
		
			<div class="container text-center container-load-previous">
				<a class="btn-ash-load ash-load-more" data-prev= "1" data-page="<?php echo ash_check_paged(1); ?>" data-title="<?php wp_title("",true);?>" data-url="<?php echo admin_url('admin-ajax.php');?>">
					<span class= "glyphicon glyphicon-refresh"></span>
					<span class= "text">Load Previous</span>
				</a>
			</div>
			
				
		
		
		
		<?php endif; ?>






			
			
			<div class ="container  ash-posts-container">
			
			<?php
			
			
					//echo "1";		
					//wp_title('', true);
					if(have_posts()):
						echo'<div class="page-limit" data-title="'.wp_title("",false) .'" data-page="/'. ash_check_paged().'">';
						while(have_posts()): the_post();
						get_template_part('template-parts/content', get_post_format());
      			?>
        
        	 			<div class="button-container text-center">
                  <a href="<?php esc_url( the_permalink() ); ?>" class="btn btn-ash" > <?php _e('Read More' ); ?></a>
                </div>	
				
        		<?php 
        		endwhile;
						echo'</div>';
						
					endif;	
							


/*
$popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
while ( $popularpost->have_posts() ) : $popularpost->the_post();

the_title();

endwhile;

*/





	
					

				//wp_reset_postdata();
			
			
			
			?>
			</div>
			
			<div class="container text-center">
				<a class="btn-ash-load ash-load-more" data-page="<?php echo ash_check_paged(1); ?>" data-title="<?php wp_title("",true);?>" data-url="<?php echo admin_url('admin-ajax.php');?>">
					<span class= "glyphicon glyphicon-refresh"></span>
					<span class= "text">Load More</span>
				</a>
			</div>
			
			
		</main>
</div>




<?php get_sidebar();?>
<?php get_footer();?>