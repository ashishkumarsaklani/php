<?php

/*
 
 Template Name : Front Page paralax
@package ash_theme
===============================================
	Contacts Page Template 
===============================================

*/






get_header();?>





<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
			<div class ="container  ash-posts-container">

					<div id="cont"  style="overflow: hidden;margin-bottom: 57px;height: 500px;top:3px;">

			<div  class=" header-container background-image text-center layer"  data-depth="0.50" style="background-image: url(<?php header_image(); ?> );background-attachment: scroll;-webkit-background-size: cover;  -moz-background-size: cover;  -o-background-size: cover;  background-size: cover;width: 130%; height: 130%;margin-left:-10%;margin-top:-8%;" > 
		
				

					<header class="header-content table " >		
						<div class="header-content  layer table-cell" data-depth="0.20"  ">
							<h2 class="site-description " style="position:fixed;z-index:10;letter-spacing: .5vw;color:rgb(255, 246, 119);;text-shadow: none;font-weight: bold;margin-top:40vh;margin-left:30vw;"><?php bloginfo('description'); ?> </h2>
							<h1 class="site-title " style="position:fixed;z-index:10;margin-top:20vh;margin-left:29vw;"><?php bloginfo('name');  ?> </h1>
						</div>
						
							
							
							

					</div> <!--table-->
			
			 </header><!--header-container-->
			 
		
			 


		    </div> <!--col-xs-12-->
                                                                                                         
                                                                                                         
                                                                                                         
                                                                                                         
                                                                                                         
                                                                                                         
                                                                                                         
                                                                                                         
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2">
	<div class="row ">
		<div class="cont">
			<div class="row row-edge" style ="margin: 40px 0;" >
			 <a href="contact-us/#value">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="circlebox  align-left  hover-zoom " style="background-position:left ; background-image: url(<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); } else {  bloginfo('template_directory'); ?>/images/default-image.jpg<?php }?>)">
						<div class="cover1 " />
						<span class="glyphicon glyphicon-plus cover-icon "></span>
                <div class="cover-text">
                Value We add
                </div>
						</div>
					</div>
				</div>
        </a>

				  <a href="contact-us/#Expert">
      	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="circlebox  align-left  hover-zoom" style="background-image: url(<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); } else {  bloginfo('template_directory'); ?>/images/default-image.jpg<?php }?>)">
						<div class="cover1  ">
						<span class="glyphicon glyphicon-signal cover-icon"></span>
               <div class="cover-text">
								Experts guidance
                 </div>
						</div>
					</div>
				</div>
        </a>    
                <a href="contact-us/#Map">
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="circlebox  align-left  hover-zoom " style="background-position:right ; background-image: url(<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); } else {  bloginfo('template_directory'); ?>/images/default-image.jpg<?php }?>)">
                      <div class="cover1  ">
                      <span class="glyphicon glyphicon-king cover-icon"></span>
                         <div class="cover-text">
                        About US
                          </div>
                      </div>
                    </div>
                  </div>
                </a>	
			</div>
		</div>
	</div>



		<?php	






									endwhile; 
						endif; 	   ?>
			 </div>

	</main>
</div>




<?php get_sidebar();?>
<?php get_footer();?>