<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

require_once get_template_directory() . '/modules/breadcrumbs/class-breadcrumbs.php';

/**
 *
 *
 * @since Mill 1.0.0
 */
function mill_get_breadcrumb ( array $args = [] ) {
	$defaults = [
		'attr' => [
			'id'    => 'breadcrumb',
			'class' => 'site-p-breadcrumb site-u-scrollable-x site-u-text-nowrap site-u-hidden-sm-down',
		],
		'separator'   => '<span class="site-p-breadcrumb__separator" aria-hidden="true"> &gt; </span>',
		'wrap_format' => '<nav itemscope itemtype="http://schema.org/BreadcrumbList"%1$s><div class="site-c-container">%2$s</div></nav>',
		'link_format' => '<a itemprop="item" href="%1$s">%2$s</a><meta itemprop="position" content="%3$d" />',
		'last_format' => '<span>%1$s</span>',
		'before'      => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">',
		'after'       => '</span>',
		'link_before' => '<span itemprop="name">',
		'link_after'  => '</span>',
		'front_label' => '',
		'home_label'  => __( 'Home', 'mill' ),
		'echo'        => false,
		// 'structured_data' => 'microdata',
		// 'structured_data' => 'rdfa',
		// 'structured_data' => 'json-ld',
		// 'show_front' => false,
		// 'bold_last' => true,
	];

	$args = wp_parse_args( $args, $defaults );
	return Mill_Breadcrumbs::get_instance( $args );
}

/**
 *
 *
 * @since Mill 1.0.0
 */
add_action( 'mill_before_page_header', 'mill_display_breadcrumb' );
function mill_display_breadcrumb() {

	if ( function_exists( 'yoast_breadcrumb' ) ) {
  		yoast_breadcrumb( '<nav id="breadcrumbs" class="site-p-breadcrumb site-u-scrollable-x site-u-text-nowrap site-u-hidden-sm-down"><div class="site-c-container">', '</div></nav>' );
	} elseif (
		! ( get_option( 'show_on_front' ) === 'page' && is_front_page() )
		&&
		! ( get_option( 'show_on_front' ) === 'posts' && is_home() )
		&&
		function_exists( 'mill_get_breadcrumb' )
	) {
		echo mill_get_breadcrumb();
	}
}

