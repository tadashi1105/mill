<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

if ( has_nav_menu( 'main-nav' ) ) : ?>
	<nav id="site-navigation" class="site-l-header__main-nav" role="navigation">
		<?php
		wp_nav_menu( [
			'theme_location' => 'main-nav',
			'container' => 'div',
			'container_class' => 'site-u-scrollable-x site-u-text-nowrap',
			'menu_class' => 'site-c-nav site-c-nav--tabs site-c-nav--dark',
			'depth' => -1,
		] );
		?>
	</nav><!-- .site-l-header__main-nav -->
<?php endif;
