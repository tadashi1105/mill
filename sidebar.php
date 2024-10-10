<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */
?>
<div id="secondary" class="site-l-side secondary" role="complementary">
	<?php do_action( 'mill_side_before_widgets' ); ?>
	<div id="widget-area" class="site-l-side__widgets widget-area">
		<?php get_template_part( 'components/widget', 'side' ); ?>
	</div>
	<?php do_action( 'mill_side_after_widgets' ); ?>
</div><!-- .site-l-side -->
