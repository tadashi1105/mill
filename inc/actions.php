<?php
/**
 * Actions file
 *
 * @since Mill 1.0.0
 */

/**
 *
 * Action Fook
 *
 * @since Mill 1.0.0
 */
// add_action( 'mill_before_main', '' );
// add_action( 'mill_after_main', '' );
// add_action( 'mill_before_page_header', '' );
// add_action( 'mill_after_page_header', '' );
// add_action( 'mill_before_entry', '' );
// add_action( 'mill_after_entry', '' );
// add_action( 'mill_single_before_entry', '' );
// add_action( 'mill_single_after_entry', '' );
// add_action( 'mill_page_before_entry', '' );
// add_action( 'mill_page_after_entry', '' );
// add_action( 'mill_single_before_entry_header', '' );
// add_action( 'mill_page_before_entry_header', '' );
// add_action( 'mill_single_before_entry_title', '' );
// add_action( 'mill_single_after_entry_title', '' );
// add_action( 'mill_page_before_entry_title', '' );
// add_action( 'mill_page_after_entry_title', '' );
// add_action( 'mill_single_before_entry_content', '' );
// add_action( 'mill_single_after_entry_content', '' );
// add_action( 'mill_page_before_entry_content', '' );
// add_action( 'mill_page_after_entry_content', '' );
// add_action( 'mill_archive_before_entry_content', '' );
// add_action( 'mill_archive_after_entry_content', '' );
// add_action( 'mill_side_before_widgets', '' );
// add_action( 'mill_side_after_widgets', '' );
// add_action( 'mill_before_footer', '' );
// add_action( 'mill_after_footer', '' );

/**
 *
 *
 * @since Mill 1.0.0
 */
add_action( 'mill_single_after_entry', 'mill_add_widget_after_entry' );
add_action( 'mill_page_after_entry', 'mill_add_widget_after_entry' );
function mill_add_widget_after_entry() {
	if ( ! is_front_page() ) :
		?>
		<div class="site-l-main__widgets">
			<?php get_template_part( 'components/widget', 'main' ); ?>
		</div><!-- .site-l-main__widgets -->
		<?php
	endif;
}

/**
 *
 *
 * @since Mill 1.0.0
 */
add_action( 'mill_single_before_entry_header', 'mill_add_thumbnail_before_entry_header' );
add_action( 'mill_page_before_entry_header', 'mill_add_thumbnail_before_entry_header' );
function mill_add_thumbnail_before_entry_header() {
	get_template_part( 'components/post', 'thumbnail' );
}

/**
 *
 *
 * @since Mill 1.0.0
 */
add_action( 'mill_single_after_entry_title', 'mill_single_and_page_after_entry_title' );
add_action( 'mill_page_after_entry_title', 'mill_single_and_page_after_entry_title' );
function mill_single_and_page_after_entry_title() {
	if ( has_excerpt() ) :
		$class = esc_attr( 'site-p-entry-card__summary entry-summary' );
		?>
		<div class="<?php echo $class; ?>">
			<?php the_excerpt(); ?>
		</div><!-- .<?php echo $class; ?> -->
		<?php
	endif;
}
