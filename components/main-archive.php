<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

do_action( 'mill_before_main' );
?>
<main id="main" class="site-l-main" role="main">
	<?php
	if ( have_posts() ) :
		?>
		<div class="site-c-card">
			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'components/content', 'summary' );
			endwhile;
			?>
		</div>
		<?php
		the_posts_pagination( [
			'end_size' => 3,
			'mid_size' => 3,
		] );
	else :
		get_template_part( 'components/content', 'none' );
	endif;
	?>
</main><!-- .site-l-main -->
<?php do_action( 'mill_after_main' ); ?>
