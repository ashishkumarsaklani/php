<?php

/* 
===============================================
			THEME TEMPLATE HEADER
===============================================

			@package Ash_theme
*/


    
?>

<html <?php language_attributes(); ?>>
	<head>
		<title><?php bloginfo('name'); wp_title();?></title>
		<meta property="og:type" content="website" />
		<meta property="og:description" content="<?php echo get_option('blogdescription');  ?>">
		<meta charset="<?php bloginfo( 'charset' ) ;?> All that is Trending lets Explore">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<meta property="og:image" itemprop="image" content="http://logicaltrends.com/wp-content/themes/Ashish/img/icon-logicaltrends.png">
<link rel=”shortcut icon” href=”http://logicaltrends.com/wp-content/themes/Ashish/img/icon-logicaltrends.png" type=”image/x-icon” />
		<link itemprop="thumbnailUrl" href="http://logicaltrends.com/wp-content/themes/Ashish/img/icon-logicaltrends.png" />
		<link rel="profile"	href="http://gmpg.org/xnf/11">
		<?php if( is_singular() && pings_open( get_queried_object() ) ):?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" >
		<?php endif ;?>
		<?php wp_head();?>
	</head>	

<body  <?php body_class(); ?>>
	
	<div  class="container" >
				 <div  class = "col-xs-12">


			
				<div  class="nav-container container layer"  data-depth="0.30" >
					<?php ash_custom_logo();  ?> 
						<h1 class="site-title " style="z-index:1031;"> <?php bloginfo('name');  ?> </h1>
		
					<button href="#" type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div id="navbarCollapse" class="collapse navbar-collapse">
					 
						<nav id="nav" class="navbar navbar-ash navbar-fixed-top" >

							<?php wp_nav_menu( array(
							//'menu'              => 'primary',
							'theme_location'    => 'primary',
							'depth'             => 0,
							'container'			=> false,
							'menu_class'        => 'nav navbar-nav menu_left_middle',
							'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
							'walker'            => new Ash_Walker_Nav_Primary()
						) ) ;
							?>
						</nav>

					</div> <!--nav-collapse-->
				 </div> <!--nav-container-->
			
			
	</div> <!--col-xs-12-->
	
			
			
			
			
			