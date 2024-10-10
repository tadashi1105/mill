<?php
/**
 * Mill includes
 *
 * The $mill_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @since Mill 1.0.0
 * @link https://github.com/roots/sage/pull/1042
 */
// define( 'WP_DEBUG', true );
$mill_includes = [
	'inc/class-base-configuration.php',
	// 'inc/template-tags.php',
	'inc/actions.php',
	'inc/filters.php',
	// 'inc/custom.php',
	'modules/comments/comments.php',
	'modules/customizer/customizer.php',
	// 'modules/nav/nav.php',
	'modules/breadcrumbs/breadcrumbs.php',
	'modules/entry-meta/entry-meta.php',
	'modules/related-posts/related-posts.php',
	'modules/tab/tab.php',
	'modules/author-box/author-box.php',
];

if ( ( defined( 'WP_DEBUG' ) && WP_DEBUG === true ) ) {
	$mill_includes[] = 'inc/debug.php';
}

array_walk( $mill_includes, function ($file) {
	if ( ! locate_template( $file, true, true) ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'mill' ), $file ), E_USER_ERROR );
	}
} );
