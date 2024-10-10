<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

get_header();
?>
<div id="content" class="site-l-content">
	<div class="site-c-container">
		<div class="site-c-row">
			<div class="site-c-col-lg-8">
				<?php do_action( 'mill_after_main' ); ?>
				<main id="main" class="site-l-main" role="main">
					<?php get_template_part( 'components/content', 'none' ); ?>
				</main><!-- .site-l-main -->
				<?php do_action( 'mill_after_main' ); ?>
			</div>
			<div class="site-c-col-lg-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div><!-- .site-l-content -->
<?php get_footer();
