<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

if ( has_nav_menu( 'drawer-nav' ) ) : ?>
	<nav class="site-l-drawer-left drawer-nav" role="navigation">
		<div class="drawer-menu">
			<?php
			wp_nav_menu( [
				'theme_location' => 'drawer-nav',
				'container' => false,
				'menu_class' => 'site-c-list-group',
				'depth' => -1,
			] );
			?>
		</div>
	</nav><!-- .site-l-drawer-left -->
<?php endif;

