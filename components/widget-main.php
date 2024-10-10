<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

if ( ! dynamic_sidebar( 'main-widget' ) ) : ?>
	<aside id="main-archives" class="site-p-widget widget widget_archive site-u-m-b-3">
		<h3 class="site-p-widget__title widget-title">
			<?php _e( 'Archives', 'mill' ); ?>
		</h3>
		<ul>
			<?php wp_get_archives( [ 'type' => 'monthly' ] ); ?>
		</ul>
	</aside>
<?php endif; // end main widget area
