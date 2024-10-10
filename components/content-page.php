<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

do_action( 'mill_page_before_entry' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( [ 'site-p-entry-card', 'site-c-card' ] ); ?>>
	<?php do_action( 'mill_page_before_entry_header' ); ?>
	<header class="site-p-entry-card__header site-c-card__block">
		<?php
		do_action( 'mill_page_before_entry_title' );
		the_title( '<h1 class="site-p-entry-card__title entry-title">', '</h1>' );
		do_action( 'mill_page_after_entry_title' );
		?>
	</header>
	<?php
	do_action( 'mill_page_before_entry_content' );
	?>
	<div class="site-p-entry-card__content site-c-card__block entry-content">
		<?php
		the_content();
		wp_link_pages( [
			'before'      => '<nav class="site-p-page-links site-p-page-links--number page-links" role="navigation"><span class="site-p-page-links__title">' . __('Pages:', 'mill') . '</span>',
			'after'       => '</nav>',
			'link_before' => '<span class="site-p-page-links__number">',
			'link_after'  => '</span>'
		] );
		?>
	</div>
	<?php
	do_action( 'mill_page_after_entry_content' );
	?>
</article>
<?php
do_action( 'mill_page_after_entry' );
