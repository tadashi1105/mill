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
function mill_header_logo() {
	$logo = Mill_Customizer::get( 'logo' );

	if ( $logo ) {
		$logo = sprintf(
			'<img src="%s" alt="%s" class="site-p-branding__logo" />',
			esc_url( $logo ),
			get_bloginfo( 'name' )
		);
	} else {
		$logo = get_bloginfo( 'name' );
	}

	printf(
		'<a href="%s" rel="home">%s</a>',
		esc_url( home_url( '/' ) ),
		$logo
	);
}
