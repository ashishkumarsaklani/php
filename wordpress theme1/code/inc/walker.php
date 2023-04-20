<?php 
/*
 
@package ash_theme
===============================================
	walker PAGE
===============================================
wp_nav_menu()

<div class="menu-container">
	<ul> // start level
		<li> // start_el
		
		 <a><span>discription </spaan></a> 
		</li>//end_el
		<li><a>Link</a></li>
	</ul>
</div>	

 */

 
 class Ash_Walker_Nav_Primary extends Walker_Nav_menu{
	 
	 function start_lvl( &$output, $depth = 0, $args= array() ){

		$indent = str_repeat("\t", $depth );
		$submenu = 'sub-menu ';// ($depth > 0) ? ' sub-menu ' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu $submenu depth_$depth\">\n";
	 }
	 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){
	
		$indent = ( $depth ) ? str_repeat("\t",$depth ) : '' ;
		$li_attributes = '';
		$class_names = $value = '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = ( $args->walker->has_children)? 'dropdown' : '';
		$classes[] = ( $item->current || $item->current_item_anchestor ) ? 'active' : '';
	  if ( in_array('current-page-ancestor', $classes) || in_array( 'current-menu-item', $classes ) ){		$class_names .= 'class = "active"'; }

		$classes[] = 'menu-item-' . $item->ID;
		
     
     if( $depth && $args->walker->has_children ){
			$classes[] = 'dropdown-submenu';
		}
		$class_name = join(' ', apply_filters('nav_menu_css_class',array_filter( $classes ),$item, $args ) );
		$class_name = ' class=' . esc_attr($class_names) .'"';
		
		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
		$id = strlen( $id ) ? ' id="'. esc_attr( $id ) .'"' : '';
			
		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
			

	 
		$attributes = ! empty( $item->attr_title )? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= ! empty( $item->target )? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= ! empty( $item->xfn )? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= ! empty( $item->url )? ' href="' . esc_attr($item->url) . '"' : '';
		
		$attributes .= ( $args->walker->has_children )? 'class="dropdown-toggle" data-toggle="dropdown"': '';
    	  if ( in_array('current-page-ancestor', $classes) || in_array( 'current-menu-item', $classes ) ){
      	$attributes  .= 'style ="color:#;"' ;
     }

		$item_output = $args->before;
		$item_output .= '<a class="smooth" ' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title',$item->title,$item->ID ) . $args->link_after;
		$item_output .= ( $args->walker->has_children ) ? '<b class="caret"></b></a>' : '</a>';

		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
		
	 }
	 
/*	 function end_el(){
		 
	 }
	 function end_lvl(){
		 
	 }
*/
	 
 }