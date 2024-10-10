<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

if ( ! dynamic_sidebar( 'sidebar-widget' ) ) : ?>
	<aside id="side-search" class="site-p-widget widget widget_search m-b-3">
		<?php get_search_form(); ?>
	</aside>

	<aside id="side-archives" class="site-p-widget widget widget_archive m-b-3">
		<h3 class="site-p-widget__title  widget-title">
			<?php _e( 'Archives', 'mill' ); ?>
		</h3>
		<ul>
			<?php wp_get_archives( [ 'type' => 'monthly' ] ); ?>
		</ul>
	</aside>

	<aside id="side-meta" class="site-p-widget widget widget_meta m-b-3">
		<h3 class="site-p-widget__title widget-title">
			<?php _e( 'Meta', 'mill' ); ?>
		</h3>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</aside>
<?php endif; // end sidebar widget area
