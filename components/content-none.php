<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */
?>
<section class="site-c-card site-c-card__block no-results not-found">
	<h1 class="site-c-card__title">
		<?php esc_html_e( 'Nothing Found', 'mill' ); ?>
	</h1>
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<p class="site-c-card__text">
		<?php
		printf(
			wp_kses(
				__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mill' ),
				[ 'a' => [ 'href' => [] ] ]
			),
			esc_url( admin_url( 'post-new.php' ) )
		);
		?>
		</p>
	<?php elseif ( is_search() ) : ?>
		<p class="site-c-card__text">
		<?php
		esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mill' );
		?>
		</p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<p class="site-c-card__text">
		<?php
		esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mill' );
		?>
		</p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</section>
