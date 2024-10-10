<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

/**
 *
 *
 * @since Mill 1.0.0
 */
// add_filter( 'nav_menu_css_class', 'mill_nav_menu_css_class', 10, 4 );
// function mill_nav_menu_css_class( $classes, $item, $args, $depth ) {
// 	if ( $depth === 0 ) {
// 		$classes[] = 'nav-item';
// 	}
//
// 	if (
// 		$args->theme_location === 'modal-nav'
// 		||
// 		$args->theme_location === 'drawer-nav'
// 	) {
// 		$classes[] = 'list-group-item';
// 	}
//
// 	if ( $args->depth === -1 || $args->depth === 1 ) {
// 		return $classes;
// 	}
//
// 	if ( $args->theme_location === 'main-nav' ) {
// 		if (
// 			! empty( $item->classes )
// 			&&
// 			in_array( 'menu-item-has-children', $item->classes )
// 		) {
// 			$classes[] = 'dropdown';
// 			if ( $depth !== 0 ) {
// 				$classes[] = 'dropdown-submenu';
// 			}
// 		}
//
// 		if ( $depth !== 0 ) {
// 			$classes[] = 'dropdown-item';
// 		}
// 	}
//
// 	return $classes;
// }

/**
 *
 *
 * @since Mill 1.0.0
 */
// add_filter( 'nav_menu_link_attributes', 'mill_nav_menu_link_attributes', 10, 4 );
// function mill_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
// 	$classes = [];
//
// 	if (
// 		$depth === 0
// 		&&
// 		$args->theme_location !== 'footer-nav'
// 		&&
// 		$args->theme_location !== ''
// 	) {
// 		$classes[] = 'nav-link';
// 	}
//
// 	if ( ! empty( $item->current ) ) {
// 		$classes[] = 'active';
// 	}
//
// 	if ( $args->depth === -1 || $args->depth === 1 ) {
// 		$class_names = join( ' ', array_filter( $classes ) );
// 		if ( $class_names ) {
// 			$atts['class'] = $class_names;
// 		}
// 		return $atts;
// 	}
//
// 	if ( $args->theme_location === 'main-nav' ) {
// 		if (
// 			! empty( $item->classes )
// 			&&
// 			in_array( 'menu-item-has-children', $item->classes )
// 		) {
// 			$atts['role']          = 'button';
// 			$atts['data-toggle']   = 'dropdown';
// 			$atts['aria-haspopup'] = 'true';
// 			$atts['aria-expanded'] = 'false';
// 			$classes[] = 'dropdown-toggle';
// 		}
//
// 		if ( $depth !== 0 ) {
// 			// $classes[] = 'dropdown-item';
// 			$classes[] = 'dropdown-link';
// 		}
// 	}
//
// 	$class_names = join( ' ', array_filter( $classes ) );
// 	if ( $class_names ) {
// 		$atts['class'] = $class_names;
// 	}
// 	return $atts;
// }

/**
 *
 *
 * @since Mill 1.0.0
 */
// add_filter( 'nav_menu_item_title', 'mill_nav_menu_item_title', 10, 4 );
// function mill_nav_menu_item_title( $title, $item, $args, $depth ) {
// 			vd( $items );
// 	if ( ! empty( $item->current ) ) {
// 		$title = $title . '<span class="screen-reader-text">(current)</span>';
// 	}
// 	return $title;
// }

/**
 *
 *
 * @since Mill 1.0.0
 */
// add_filter( 'wp_nav_menu_items', 'mill_wp_nav_menu_items', 10, 2 );
// function mill_wp_nav_menu_items( $items, $args ) {
// 	if ( $args->depth === -1 || $args->depth === 1 ) {
// 		return $items;
// 	}
//
// 	if ( $args->theme_location === 'main-nav' ) {
// 		$items = str_replace(
// 			'class="sub-menu"',
// 			'class="sub-menu dropdown-menu"',
// 			$items
// 		);
// 	}
// 	return $items;
// }
