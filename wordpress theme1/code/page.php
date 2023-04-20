<?php
    /**
    * Template Name: common Page
    */
?>
<?php get_header();?>

<div id="primary" class="content-area">

<!--<div class="sidebar col-xs-2" style="height:100%;" >
        
  <?php 
                                                /*wp_nav_menu( array(
                                                                'theme_location'  	=> 'secondary'
                                                  )); */
//  wp_nav_menu( array(
//								'theme_location'  	=> 'primary',
//								'walker'			=> new sub_nav_walker()
//						) ) ;

  
  ?>
        </div>

-->
		<main id="main" class="site-main" role="main">
      
      
      
      
			<div class ="container  ash-posts-container">
			
			<?php
			
				if (is_home()){
					//echo "1";		
					//wp_title('', true);
					if(have_posts()):
						echo'<div class="page-limit" data-title="' .wp_title("",false);'" data-page="/'. ash_check_paged().'">';
						while(have_posts()): the_post();

						get_template_part('template-parts/content', get_post_format());
						endwhile;
						echo'</div>';
						
					endif;	
				}else{
				//	wp_title('', true);
				//	echo"2";					
					
				$cat_posts = new WP_Query( array('category_name' =>  wp_title('', false)) );
			
			
				if(have_posts()):
					if ($cat_posts->have_posts()) : 
				
						while ($cat_posts->have_posts()) :
						echo '<div class ="col-sm-3 art-cont flipper" ontouchstart="this.classList.toggle(\'hover\');" ><div class ="flipper">';	
          	 $cat_posts->the_post(); 
						get_template_part('template-parts/content', get_post_format());
						echo '</div> ';
						?>
      			<div class="button-container text-center">
            <a href="<?php esc_url( the_permalink() ); ?>" class="btn btn-ash" > <?php _e('Read More' ); ?></a>
     		 </div>	</div>
      	<?php 
          wp_reset_postdata();
					endwhile; 
					endif; 	
				endif; 	
					

						
				}
				
					
					

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