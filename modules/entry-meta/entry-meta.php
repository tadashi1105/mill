<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

require_once get_template_directory() . '/modules/entry-meta/class-entry-meta-abstract.php';
require_once get_template_directory() . '/modules/entry-meta/class-entry-meta.php';

add_action( 'edit_category', [ 'Mill_Entry_Meta', 'category_transient_flusher' ] );
add_action( 'save_post',     [ 'Mill_Entry_Meta', 'category_transient_flusher' ] );

if ( ! function_exists( 'mill_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since Mill 1.0.0
 */
function mill_entry_meta( array $args = [] ) {
	$defaults = [
		'before'          => '<div class="entry-meta">',
		'after'           => '</div>',
		'sticky_wrap'     => '<span class="sticky-post site-u-hidden-sm-down"><span aria-hidden="true" class="fa fa-sticky-note"></span> %s</span>',
		'format_wrap'     => '<span class="entry-format site-u-hidden-sm-down">%1$s%4$s<a href="%2$s"> %3$s</a></span>',
		'posted_on_wrap'  => '<span class="posted-on"><span class="screen-reader-text">%1$s</span><span aria-hidden="true" class="fa fa-clock-o"></span> %2$s</span>',
		'author_wrap'     => '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s</span><span aria-hidden="true" class="fa fa-user"></span><a class="url fn n" href="%2$s"> %3$s</a></span></span>',
		'categories_wrap' => '<span class="cat-links"><span class="screen-reader-text">%1$s</span><span aria-hidden="true" class="fa fa-archive"></span> <span class="cat-links__list">%2$s</span></span>',
		'tags_wrap'       => '<span class="tags-links site-u-hidden-sm-down"><span class="screen-reader-text">%1$s</span><span aria-hidden="true" class="fa fa-tag"></span> <span class="tags-links__list">%2$s</span></span>',
		'attachment_wrap' => '<span class="full-size-link site-u-hidden-sm-down"><span class="screen-reader-text">%1$s</span><span aria-hidden="true" class="fa fa-picture-o"></span><a href="%2$s"> %3$s &times; %4$s</a></span>',
		'comment_wrap'    => '<span class="comments-link site-u-hidden-sm-down"><span aria-hidden="true" class="fa fa-comment-o"></span> %s</span>',
		'edit_wrap'       => '<span class="edit-link site-u-hidden-sm-down"><span aria-hidden="true" class="fa fa-edit"></span> %s</span>',
	];

	$args = wp_parse_args( $args, $defaults );
	$entry_meta = new Mill_Entry_Meta();
	$entry_meta->display( $args );
}
endif;

/**
 *
 *
 * @since Mill 1.0.0
 */
add_filter( 'mill_entry_meta_args', 'mill_entry_meta_secondary_poats_tag' );
function mill_entry_meta_secondary_poats_tag( $args ) {
	if ( get_query_var( 'is_related', false ) || get_query_var( 'is_tab_posts', false ) ) {
		if ( isset( $args['before'] ) ) {
			$args['before'] = '<div class="site-p-entry-list__meta entry-meta">';
		}

		if ( isset( $args['after'] ) ) {
			$args['after'] = '</div>';
		}
	}
	return $args;
}

/**
 *
 *
 * @since Mill 1.0.0
 */
add_filter( 'mill_entry_meta', 'mill_entry_meta_archive' );
function mill_entry_meta_archive( $entry_meta ) {
	if ( is_home() || is_tag() || is_archive() || is_category() || is_search() ) {
		$category = get_the_category();
		if ( isset( $entry_meta['categories'] ) && $category[0] ) {
			$wrap = '<span class="cat-links"><span class="screen-reader-text">%1$s</span><span aria-hidden="true" class="fa fa-archive"></span> %2$s</span>';
			$tag = sprintf(
				$wrap,
				_x( 'Categories', 'Used before category names.', 'mill' ),
				'<a href="' . get_category_link( $category[0]->term_id ) . '" class="cat-links__link">' . $category[0]->cat_name . '</a>'
			);
			$entry_meta['categories'] = $tag;
		}

		if ( isset( $entry_meta['tags'] ) ) {
			$entry_meta['tags'] = '';
		}

		if ( isset( $entry_meta['format'] ) ) {
			$entry_meta['format'] = '';
		}

		if ( isset( $entry_meta['sticky'] ) ) {
			$entry_meta['sticky'] = '';
		}

		if ( isset( $entry_meta['attachment'] ) ) {
			$entry_meta['attachment'] = '';
		}

		if ( isset( $entry_meta['comment'] ) ) {
			$entry_meta['comment'] = '';
		}
	}
	return $entry_meta;
}

/**
 *
 *
 * @since Mill 1.0.0
 */
add_filter( 'mill_entry_meta', 'mill_entry_meta_secondary_poats' );
function mill_entry_meta_secondary_poats( $entry_meta ) {
	if ( get_query_var( 'is_related', false ) || get_query_var( 'is_tab_posts', false ) ) {
		$category = get_the_category();
		if ( isset( $entry_meta['categories'] ) && $category[0] ) {
			$wrap = '<span class="cat-links"><span class="screen-reader-text">%1$s</span><span aria-hidden="true" class="fa fa-archive"></span> %2$s</span>';
			$tag = sprintf(
				$wrap,
				_x( 'Categories', 'Used before category names.', 'mill' ),
				$category[0]->cat_name
			);
			$entry_meta['categories'] = $tag;
		}
		if ( isset( $entry_meta['author'] ) ) {
			if ( is_singular() || is_multi_author() ) {
				$wrap = '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s</span><span aria-hidden="true" class="fa fa-user"></span> %2$s</span></span>';

				$tag = sprintf(
					$wrap,
					_x( 'Author', 'Used before post author name.', 'mill' ),
					esc_html( get_the_author() )
				);
				$entry_meta['author'] = $tag;
			}
		}

		if ( isset( $entry_meta['tags'] ) ) {
			$entry_meta['tags'] = '';
		}

		if ( isset( $entry_meta['format'] ) ) {
			$entry_meta['format'] = '';
		}

		if ( isset( $entry_meta['sticky'] ) ) {
			$entry_meta['sticky'] = '';
		}

		if ( isset( $entry_meta['attachment'] ) ) {
			$entry_meta['attachment'] = '';
		}

		if ( isset( $entry_meta['comment'] ) ) {
			$entry_meta['comment'] = '';
		}

		if ( isset( $entry_meta['edit'] ) ) {
			$entry_meta['edit'] = '';
		}
	}
	return $entry_meta;
}

/**
 *
 *
 * @since Mill 1.0.0
 */
add_action( 'mill_archive_after_entry_content', 'mill_add_meta_on_archive_after_entry_content' );
function mill_add_meta_on_archive_after_entry_content() {
	?>
	<footer class="site-p-entry-list__footer">
		<?php
		mill_entry_meta( [
			'before' => '<div class="site-p-entry-list__meta entry-meta">',
			'after' => '</div>',
		] );
		?>
	</footer><!-- .site-p-entry-list__footer -->
	<?php
}
