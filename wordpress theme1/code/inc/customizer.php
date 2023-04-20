 
<?php

/* 
===============================================
			THEME Color customizer
===============================================

			@package Ash_theme
  

*/


//Contact form shortcode

function ash_customize_register( $wp_customize ) {

/*******************************************
Color scheme
********************************************/
 
// add the section to contain the settings
$wp_customize->add_section( 'textcolors' , array(
    'title' =>  'Color Scheme',
) );


// main color ( site title, h1, h2, h4. h6, widget headings, nav links, footer headings )
$txtcolors[] = array(
    'slug'=>'color_scheme_1', 
    'default' => '#000',
    'label' => 'Heading color'
);
 
// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
$txtcolors[] = array(
    'slug'=>'color_scheme_2', 
    'default' => '#666',
    'label' => 'background'
);
 
// link color
$txtcolors[] = array(
    'slug'=>'link_color', 
    'default' => '#008AB7',
    'label' => 'Link Color'
);
 
// link color ( hover, active )
$txtcolors[] = array(
    'slug'=>'hover_link_color', 
    'default' => '#9e4059',
    'label' => 'Link Color (on hover)'
);

// text color ( hover, active )
$txtcolors[] = array(
    'slug'=>'text_color', 
    'default' => '#9e4059',
    'label' => 'text color'
);
  
// meta color ( hover, active )
$txtcolors[] = array(
    'slug'=>'meta_color', 
    'default' => '#9e4059',
    'label' => 'Meta color'
);

// add the settings and controls for each color
foreach( $txtcolors as $txtcolor ) {
 
    // SETTINGS
    $wp_customize->add_setting(
        $txtcolor['slug'], array(
            'default' => $txtcolor['default'],
            'type' => 'option', 
            'capability' => 
            'edit_theme_options'
        )
    );
    // CONTROLS
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            $txtcolor['slug'], 
            array('label' => $txtcolor['label'], 
            'section' => 'textcolors',
            'settings' => $txtcolor['slug'])
        )
    );
}
 
}
add_action( 'customize_register', 'ash_customize_register' );




?>
		
