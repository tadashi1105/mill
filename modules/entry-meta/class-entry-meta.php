<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

/**
 *
 *
 * @since Mill 1.0.0
 */
class Mill_Entry_Meta extends Mill_Entry_Meta_Abstract {

	/**
	 * Display Entry Meta
	 */
	public function display( array $args =[] ) {
		$defaults = [
			'before' => '<div class="entry-meta">',
			'after' => '</div><!-- .entry-meta -->',
			'sticky_wrap' => '<span class="sticky-post">%s</span>',
			'format_wrap' => '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			'posted_on_wrap' => '<span class="posted-on"><span class="screen-reader-text">%1$s</span>%2$s</span>',
			'author_wrap' => '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s</span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
			'categories_wrap' => '<span class="cat-links"><span class="screen-reader-text">%1$s</span>%2$s</span>',
			'tags_wrap' => '<span class="tags-links"><span class="screen-reader-text">%1$s</span>%2$s</span>',
			'attachment_wrap' => '<span class="full-size-link"><span class="screen-reader-text">%1$s</span><a href="%2$s">%3$s &times; %4$s</a></span>',
			'comment_wrap' => '<span class="comments-link">%s</span>',
			'edit_wrap' => '<span class="edit-link">%s</span>',
		];
		$args = wp_parse_args( apply_filters( 'mill_entry_meta_args', $args ), $defaults );
		$entry_meta = [];

		$entry_meta['sticky']    = $this->sticky( $args['sticky_wrap'] );
		$entry_meta['format']    = $this->format( $args['format_wrap'] );
		$entry_meta['posted_on'] = $this->posted_on( $args['posted_on_wrap'] );
		if ( 'post' === get_post_type() ) {
			$entry_meta['author']     = $this->author( $args['author_wrap'] );
			$entry_meta['categories'] = $this->categories( $args['categories_wrap'] );
			$entry_meta['tags']       = $this->tags( $args['tags_wrap'] );
		}
		$entry_meta['attachment'] = $this->attachment( $args['attachment_wrap'] );
		$entry_meta['comment']    = $this->comment( $args['comment_wrap'] );
		$entry_meta['edit']       = $this->edit( $args['edit_wrap'] );
		$entry_meta = apply_filters( 'mill_entry_meta', $entry_meta );
		$entry_meta = implode( '', $entry_meta );

		do_action( 'mill_before_entry_meta' );
		echo $args['before'];
		echo $entry_meta;
		echo $args['after'];
		do_action( 'mill_after_entry_meta' );
	}

	/**
	 *
	 */
	public function format( $wrap = '' ) {
		if ( '' === $wrap ) {
			// $wrap = '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>';
			return $wrap;
		}

		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			$icon = '<span aria-hidden="true" class="fa fa-thumb-tack"></span>';
			if ($format === 'aside')
				$icon = '<span aria-hidden="true" class="fa fa-file-text-o"></span>';
			elseif ($format === 'image')
				$icon = '<span aria-hidden="true" class="fa fa-file-image-o"></span>';
			elseif ($format === 'video')
				$icon = '<span aria-hidden="true" class="fa fa-file-video-o"></span>';
			elseif ($format === 'quote')
				$icon = '<span aria-hidden="true" class="fa fa-quote-left"></span>';
			elseif ($format === 'link')
				$icon = '<span aria-hidden="true" class="fa fa-link"></span>';
			elseif ($format === 'gallery')
				$icon = '<span aria-hidden="true" class="fa fa-files-o"></span>';
			elseif ($format === 'status')
				$icon = '<span aria-hidden="true" class="fa fa-ellipsis-h"></span>';
			elseif ($format === 'audio')
				$icon = '<span aria-hidden="true" class="fa fa-file-audio-o"></span>';
			elseif ($format === 'chat')
				$icon = '<span aria-hidden="true" class="fa fa-comments-o"></span>';

			return sprintf(
				$wrap,
				sprintf(
					'<span class="screen-reader-text">%s</span>',
					_x(
						'Format', 'Used before post format.',
						'mill'
					)
				),
				esc_url( get_post_format_link( $format ) ),
				get_post_format_string( $format ),
				$icon
			);
		}
	}

	/**
	 *
	 */
	public function categories( $wrap = '' ) {
		if ( '' === $wrap ) {
			// $wrap = '<span class="cat-links"><span class="screen-reader-text">%1$s</span>%2$s</span>';
			return $wrap;
		}

		$categories_list = get_the_term_list(
			0,
			'category',
			'',
			'',
			''
		);

		if ( $categories_list && $this->categorized_blog() ) {
			return sprintf(
				$wrap,
				_x( 'Categories', 'Used before category names.', 'mill' ),
				$categories_list
			);
		}
	}

	/**
	 *
	 */
	public function tags( $wrap = '' ) {
		if ( '' === $wrap ) {
			// $wrap = '<span class="tags-links"><span class="screen-reader-text">%1$s</span>%2$s</span>';
			return $wrap;
		}

		$tags_list = get_the_term_list(
			0,
			'post_tag',
			'',
			'',
			''
		);

		if ( $tags_list ) {
			return sprintf(
				$wrap,
				_x( 'Tags', 'Used before tag names.', 'mill' ),
				$tags_list
			);
		}
	}
}
