<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

function mi_footer_widget_class_name() {
	echo "site-c-col-md-" . 12 / count( array_filter( [
		is_active_sidebar( 'footer-widget-one' ),
		is_active_sidebar( 'footer-widget-two' ),
		is_active_sidebar( 'footer-widget-three' )
	] ) );
}
?>
<div id="footer-widgets" class="site-l-footer__widgets widget-area">
	<div class="site-c-container">
		<div class="site-c-row">
			<?php if ( is_active_sidebar( 'footer-widget-one' ) ) : ?>
				<div class="<?php mi_footer_widget_class_name(); ?>">
					<?php dynamic_sidebar( 'footer-widget-one' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-widget-two' ) ) : ?>
				<div class="<?php mi_footer_widget_class_name(); ?>">
					<?php dynamic_sidebar( 'footer-widget-two' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-widget-three' ) ) : ?>
				<div class="<?php mi_footer_widget_class_name(); ?>">
					<?php dynamic_sidebar( 'footer-widget-three' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
