<?php

/*
 
@package ash_theme
===============================================
	Gallery POST FORMAT
===============================================

*/

?>

<article id="post-<?php the_ID(); ?>"<?php post_class( 'ash-format-gallery' );?>>
	<header class="entry-header text-center">
	
	<?php if( ash_get_attachment() ):?>
	
	
	<div id="post-gallery-<?php the_ID();  $pgid = get_the_ID();?>" class="carousel slide ash-carousel-thumb" data-ride="carousel">
		
		<div class="carousel-inner " role="listbox">
		
			<?php  
			
			$attachments = ash_get_bs_slides( ash_get_attachment(6) );
			
			foreach( $attachments as $attachment ):	?>
						
			<div class="item <?php echo $attachment['class']; ?> " >
      <div  class="background-image standard-featured " style="background-image: url(<?php echo  $attachment['url']; ?>);;background-attachment:scroll;  <?php  if (is_front_page()) { echo 'height: 95vh;'; }?> "></div>		
        
				<div class="hide next-image-preview" data-image="<?php echo  $attachment['next_img']; ?>"></div>		
				<div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img'];  ?>"></div>

        <?php if (is_front_page()) { ?> 
      <div class="image-text">
        <h2><?php echo $attachment['caption']; ?></h2>
			</div>	
        
       <div class="entry-excerpt image-caption">
			<p><?php echo $attachment['alt']; ?></p>
			</div>	
         <?php } ?>
      </div>

  
      
			<?php   endforeach; ?>	
		</div><!--- for crosel inner   -->		
			<a class="left carousel-control" href="#post-gallery-<?php echo $pgid; ?>" role="button" data-slide="prev">
							
						<div class="table">
							<div class="table-cell">		
								<div class="preview-container" >
									<span class="thumbnail-container  background-image ash-carousel-thumb" style="background-attachment:scroll;"></span>
									<span class="glyphicon glyphicon-menu-left" aria-hiddn="true"></span>
									<span class="sr-only">Previous</span>
								</div>
							</div>
						</div>
			</a>
				
			<a class="right carousel-control" href="#post-gallery-<?php echo $pgid; ?>" role="button" data-slide="next">
					
					<div class="table">
						<div class="table-cell">
							<div class="preview-container">
							<span class="thumbnail-container background-image" style="background-attachment:scroll;"></span>
								<span class="glyphicon glyphicon-menu-right" aria-hiddn="true"></span>
								<span class="sr-only">Next</span>
							</div>
						</div>
					</div>
			</a>		
	
	</div> 
	<!--- for crosel div   -->
	
	
	
	
	
	<?php endif; 
	
				 if (!(is_front_page())) {

                the_title('<h3 class="entry-title"><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">','</a></h3>'); ?>
    
    
                  <div class="entry-meta">
                  <?php echo ash_posted_meta();?>
                  </div>
     						 <?php } ?>
              </header>
              <div class="entry-content">	

                <div class="entry-excerpt">
                <?php the_excerpt(); ?>
                </div>	

                <!--   <div class="button-container text-center">
                  <a href="<?php// esc_url( the_permalink() ); ?>" class="btn btn-ash" > <?php //_e('Read More' ); */?></a>
                </div> -->	


              </div>	

                     <?php if (!(is_front_page())) { ?>
              <footer class="entery-footer">
                <?php echo ash_posted_footer(); ?>
              </footer >
             
              <?php } ?>

</article>
