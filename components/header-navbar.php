<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */
?>
<nav id="masthead" class="site-l-header__navbar site-c-toolbar">
	<div class="site-c-toolbar__grid">
		<div class="site-c-toolbar__cell">
			<button type="button" class="site-c-toolbar__btn site-c-toolbar__btn--left drawer-toggle">
			<?php if ( has_nav_menu( 'drawer-nav' ) ) : ?>
				<span class="fa fa-bars" aria-hidden="true"></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'mill' ); ?></span>
			<?php endif; ?>
			</button>
		</div>
		<div class="site-c-toolbar__cell site-u-w-100per site-u-text-xs-center">
			<<?php if ( is_front_page() && is_home() ) : ?>h1<?php else : ?>p<?php endif; ?> class="site-c-toolbar__brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-c-toolbar__brand-link" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</<?php if ( is_front_page() && is_home() ) : ?>h1<?php else : ?>p<?php endif; ?>>
		</div>
		<div class="site-c-toolbar__cell">
			<button type="button" class="site-c-toolbar__btn site-c-toolbar__btn--right" data-toggle="modal" data-target="#js-modal-search">
				<span class="fa fa-search" aria-hidden="true"></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Search', 'mill' ); ?></span>
			</button>
		</div>
	</div>
</nav><!-- .site-l-header__navbar -->
