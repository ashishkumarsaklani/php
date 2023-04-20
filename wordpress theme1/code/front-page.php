<?php
    /**
    * Template Name: Front Page
    */
?>

<?php get_header();?>





<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
   <div class ="cont  ash-posts-container">
    <h2 style="text-align: center;height:0px;"> <i class="fa fa-angle-down fa-4x MoveUpDown"  aria-hidden="true"></i></h2>                       
	

		 <div id="section1" class ="section section1 flex-container">
                                               <?php

                                               $query = new WP_Query( array( 'category_name' => 'main' ) );

                                               if ($query->have_posts()) : 
                                               while ($query->have_posts()) : 

                                               $query->the_post(); 
                                               get_template_part('template-parts/content', get_post_format());

                                      		    
                                               ?>
 																		
                                                <?php	
                                                endwhile; 
                                                endif; 	   ?>
                         
                      
			</div>

   

     
      <div id="section2" class ="section section2 flex-container">
      
          <h2 style="text-align: center;"> Services </h2><p style="text-align: center;">Click to check details</p>
        		<div class="col-xs-10 col-sm-12 col-md-8 col-lg-8 col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-2">

              <div class="row ">
                <div class="cont">
                  <div class="row row-edge"   style="margin-top:4%;">
                    
                    
                      <?php $cat_posts = new WP_Query( array( 'posts_per_page' => '3','category_name' => 'services') );
                      if(have_posts()):
                      if ($cat_posts->have_posts()) : 
                      while ($cat_posts->have_posts()) :
   										?>                 
                    
				 <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                
                   		

																			<?php $cat_posts->the_post(); ?>
											
							   

                      <?php 
           

                                    $images = get_posts(
                                    array(
                                        'post_type'      => 'attachment',
                                        'post_mime_type' => 'image',
                                        'post_parent'    => $post->ID,
                                        'posts_per_page' => 2, /* Save memory, only need one */
                                    )
                                );

           
      									// echo ( wp_get_attachment_image_src( $images[0]->ID )[0]);             if (!( has_post_thumbnail() )){echo  wp_get_attachment_image_src( $images[0]->ID )[0]; }                        else?>
                      
                 	  <div class="circle  align-left  hover-zoom col-xs-offset-3 col-sm-offset-4 col-md-offset-2 col-lg-offset-0" style="background-position:left ; background-image: url(<?php 
                    if ( has_post_thumbnail() ) { the_post_thumbnail_url(); }                                               
                        else {  bloginfo('template_directory'); ?>/img/default-image.jpg<?php }?>)">
										<div class="outerC">
                      <?php  the_title('<h2 style="text-align: center;"class="entry-title">','</h2>');  ?>	
										<div class="cover1 ">
						
                               

                                
                                                                  

                                  </div>
                                  </div>
                                  </div> 
                                      	  <p style="clear:left;">
                               	     <?php  echo wp_trim_words(wp_strip_all_tags( get_the_content() ), $num_words = 105, $more = '.' ); ?>
                                         </p>
                                   
                            </div>
                         <?php  wp_reset_postdata(); ?>   
												<?php	 
                    	endwhile; 
                   		endif; 	
                   		endif; 	
                  		 ?>

                  </div>
                </div>
              </div>
					</div>
     </div>	
   
     <div id="section3"  class ="section section3 flex-container">

                                       
                                  <div id ="value" style="clear:both;">
                                   <h2 style="text-align: center;"> Value we Trust </h2>
                                    <?php $cat_posts = new WP_Query( array( 'post_format' => 'post-format-quote','posts_per_page' => '3','category_name' =>  wp_title('', false)) );
                                              if(have_posts()):
                                                if ($cat_posts->have_posts()) : 

                                                        while ($cat_posts->have_posts()) :
                                                        echo '<div class ="col-sm-4"  >';	
                                                         $cat_posts->the_post(); 
                                                        get_template_part('template-parts/content', get_post_format());
                                                         echo '</div>';
                                                        wp_reset_postdata();
                                                      endwhile; 
                                                endif; 	
                                              endif; 	
                                      ?>
                          			  </div>
                                     
         </div>
        
     <div id="section4" class ="section section4 flex-container">
    
       					    
               <div id ="npost" style="clear:both; ">
                               <h2 style="text-align: center;"> Latest Posts </h2>  

                                              <?php $cat_posts = new WP_Query( array( 'orderby' => 'post_date','post_format' => 'post-format-image','posts_per_page' => '3','category_name' =>  wp_title('', false)) );
                                                        if(have_posts()):
                                                          if ($cat_posts->have_posts()) : 

                                                                  while ($cat_posts->have_posts()) :
                                                                  echo '<div class ="col-sm-4" style="height: 265px;" >';	
                                                                   $cat_posts->the_post(); ?>
                                                               
                 
                            
                 
             																							    		<article id="post-<?php the_ID(); ?>"<?php post_class( 'ash-format-image' );?>>
																										         			  <header class="entry-header text-center background-image" style="background-image: url( <?php 
                                                                                 echo ash_get_attachment() ; ?>);<?php if (is_home()) { echo 'height:400px';}?> ">

                                                                 									<?php the_title('<h3 class="entry-title"><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">','</a></h3>'); ?>
                                                                 
                                                                 
                                                                 
                                                                                    <div class="entry-meta">
                                                                                    <?php echo ash_posted_meta();?>
                                                                                    </div>

                                                                                </header>
                                                          
                                                          
                                                                                         <div class="entry-excerpt">
                                                                                          <?php //the_excerpt(); ?>
                                                                                         </div>	
                                                                                        
                                                          																<!--<div class="button-container text-center">
                                                                                            <a href="<?php// esc_url( the_permalink() ); ?>" class="btn btn-ash" > <?php //_e('Read More' ); ?></a>
                                 																												   </div>		-->
																

                                                                                <footer class="entery-footer">

                                                                                  <?php echo ash_posted_footer(); ?>
                                                                                </footer >


                                                                              </article>
       
                 
                 
                																				 <?php
																					echo '</div>';

                                        wp_reset_postdata();
                                         endwhile; 
                                endif; 	
                           endif; 	
                     ?>

							</div>
       
       
       
       
       
       
       
		</div>
 
    <div id="section5" class ="section section5 flex-container">
  
       
       
       
       
       	<div id ="map" style="clear:both; ">
                                  <h2 style="text-align: center;"> Find US Here </h2>
                                     
                                     
									</div>               
                                      <iframe 
src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1472.3669458913091!2d77.21938824419176!3d28.632804122007904!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfe24b2f4d9674097!2
sCentral+Park!5e0!3m2!1sen!2sin!4v1492482742165" width="100%" height="450" frameborder="0" style="border:0;pointer-events: none;" allowfullscreen></iframe>
       
       
     </div>    
     
   <div id="section6" class ="section section6 flex-container">
      
               <div id ="expert" style="clear:both; ">
                  <h2 style="text-align: center;"> Our Experts IDS</h2>  
                 
                 
                          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2">
                            <div class="row ">
                              <div class="cont">
                                <div class="row row-edge"  >
                 

          
                            <?php 
                                 $users = get_users( array( 'fields' => array( 'ID' ) ) );
                                    foreach($users as $user_id){
                                      
                                      $_UFName = get_user_meta($user_id->ID, 'first_name', true);
                                      $_ULName = get_user_meta($user_id->ID, 'last_name', true);
                                      $details = get_user_meta($user_id->ID, 'description', true);
                                      $website  = get_user_meta($user_id->ID, ' user_url', true);
                                      
                                          $U_name =  $_UFName&'  '&  $_ULName;
                                          $Uemail = get_userdata( $user_id->ID )->user_email ; 
                                       $avatar = get_user_meta( $user_id->ID,  'shr_pic', true);    
                                      // $image = wp_get_attachment_image($avatar); echo $image ; will work direcly
                                      $image = wp_get_attachment_url($avatar);
                                      
                                      if ( $image ) {
                                      ?>
                                      
                                     										  <div class="col-xs-offset-3 col-sm-offset-4 col-md-offset-0 col-lg-offset-0 col-xs-12 col-sm-6 col-md-6 col-lg-3 ">
                                                            
                                                           <div class ="art-cont-horizontal flipper" ><div class ="flipper">
                                                            
                                                              <div class="circlebox  align-left " style="  background-size: 100%;background-image: url(<?php    echo $image ; ?>)">
                                                            <div class="outer">

                                                                   <div class="cover-text">
                                                                    <?php 
                                        														echo '<h3><br>'.$_UFName.'<h3>'; 
                                                                    echo '<br><p>'.$details;
                                                                    //echo '<br>'.$Uemail;
                                                                    echo '<br>'.$website.'<p>';
                                                                    ?>     
                                                                     </div>
                                                                </div>
                                                          
                                                           </div>  
                                                         </div>
     																										</div>  
                                                     </div>

                                      <?php    
                                               }                                 
                                              }
                                      ?> 
                                  
                                  </div>			
                              </div>			
                            </div>			
                 				</div>
                              
                                  
                                  
                                  
                                  
                                  
          			</div>
      		</div>    
           		
   <div id="section7" class ="section section7 flex-container">

                      
                                    <h2 style="text-align: center;"> Contact us </h2>  

                                               <?php

                                               $query = new WP_Query( array( 'name' => 'form' ) );

                                               if ($query->have_posts()) : 
                                               while ($query->have_posts()) : 

                                               $query->the_post(); ?>
									                               <article id="post-<?php the_ID(); ?>"<?php post_class();?>>
                  														  	<div class="entry-content clearfix">	
                         																	 <?php the_content(); ?>
                       														 </div>	
                   															 </article>


                                                <?php	
                                                endwhile; 
                                                endif; 	   ?>
                                               
                     
             </div>    
    
    
</div>
</main>
</div>




<?php get_sidebar();?>
<?php get_footer();?>