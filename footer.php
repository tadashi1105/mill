<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

do_action( 'mill_before_footer' ); ?>
<footer id="footer" class="site-l-footer" role="contentinfo">
<?php
if (
	is_active_sidebar( 'footer-widget-one' )
	||
	is_active_sidebar( 'footer-widget-two' )
	||
	is_active_sidebar( 'footer-widget-three' )
) :
	do_action( 'mill_before_footer_widgets' );
	get_template_part( 'components/widget', 'footer' );
	do_action( 'mill_after_footer_widgets' );
endif;
?>
<a href="#top" class="site-p-back-to-top">
	<span class="site-p-back-to-top__icon fa fa-chevron-up" aria-hidden="true"></span>
	<span class="site-p-back-to-top__text"><?php _e( 'Back to top of page', 'mill' ); ?></span>
</a>
<?php get_template_part( 'components/colophon' ); ?>
</footer><!-- .site-l-footer -->
<?php do_action( 'mill_after_footer' ); ?>
</div><!-- .site -->
<?php
get_template_part( 'components/modal' );
get_template_part( 'components/drawer' );
wp_footer();
?>
</body>
</html>
