<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */
?>
<div id="colophon" class="site-l-footer__colophon site-p-colophon site-info">
	<div class="site-c-container">
		<div class="site-c-row">
			<div class="site-c-col-lg-8">
			<?php
			if ( has_nav_menu( 'footer-nav' ) ) :
				wp_nav_menu( [
					'theme_location'  => 'footer-nav',
					'container'       => 'nav',
					'container_id'    => 'footer-navigation',
					'container_class' => 'site-p-colophon__nav footer-navigation',
					'menu_class'      => 'site-c-nav site-c-nav--inline small',
					'link_before'     => '',
					'link_after'      => '',
					'depth'           => -1,
				] );
			endif;
			?>
			</div>
			<div class="site-c-col-lg-4">
				<div class="site-p-colophon__copyright">
					<small>&copy; 2013-<?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>. All rights reserved.</small>
				</div>
			</div>
		</div>
	</div>
</div>