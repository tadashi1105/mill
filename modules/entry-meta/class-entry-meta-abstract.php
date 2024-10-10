<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

class Mill_Entry_Meta_Abstract {

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
	public function sticky( $wrap = '' ) {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			if ( '' === $wrap ) {
				// $wrap = '<span class="sticky-post">%s</span>';
				return $wrap;
			}
			return sprintf(
				$wrap,
				__( 'Featured', 'mill' )
			);
		}
	}

	/**
	 *
	 */
	public function format( $wrap = '' ) {
		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			if ( '' === $wrap ) {
				// $wrap = '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>';
				return $wrap;
			}

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
				get_post_format_string( $format )
			);
		}
	}

	/**
	 *
	 */
	public function posted_on( $wrap = '' ) {
		if ( '' === $wrap ) {
			// $wrap = '<span class="posted-on"><span class="screen-reader-text sr-only">%1$s</span>%2$s</span>';
			return $wrap;
		}

		if ( in_array( get_post_type(), [ 'post', 'attachment' ] ) ) {
			$time_string = '<time datetime="%2$s" class="entry-date published updated"> %3$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$updated_string = '<time datetime="%2$s" class="entry-date updated">%3$s</time>';
				$updated_string = $this->updated( $updated_string );
				$time_string = '<time datetime="%2$s" class="entry-date published">%3$s</time>';
				$time_string = $this->published( $time_string ) . $updated_string;
			} else {
				$time_string = $this->published( $time_string );
			}

			return sprintf(
				$wrap,
				_x( 'Posted on', 'Used before publish date.', 'mill' ),
				$time_string
			);
		}
	}

	/**
	 *
	 */
	public function published( $wrap = '' ) {
		if ( '' === $wrap ) {
			$wrap = '<span class="screen-reader-text">%1$s</span><time datetime="%2$s" class="entry-date published updated">%3$s</time>';
		}

		return sprintf(
			$wrap,
			__( 'Published', 'mill' ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	}

	/**
	 *
	 */
	public function updated( $wrap = '' ) {
		if ( '' === $wrap ) {
			$wrap = '<span class="screen-reader-text">%1$s</span><time datetime="%2$s" class="entry-date updated">%3$s</time>';
		}

		return sprintf(
			$wrap,
			__( 'Updated', 'mill' ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
	}

	/**
	 *
	 */
	public function author( $wrap = '' ) {
		if ( is_singular() || is_multi_author() ) {
			if ( '' === $wrap ) {
				// $wrap = '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s</span><a class="url fn n" href="%2$s">%3$s</a></span></span>';
				return $wrap;
			}

			return sprintf(
				$wrap,
				_x( 'Author', 'Used before post author name.', 'mill' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
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

		$categories_list = get_the_category_list(
			_x(
				', ',
				'Used between list items, there is a space after the comma.',
				'mill'
			)
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
		$tags_list = get_the_tag_list(
			'',
			_x(
				', ',
				'Used between list items, there is a space after the comma.',
				'mill'
			)
		);
		if ( $tags_list ) {
			return sprintf(
				$wrap,
				_x( 'Tags', 'Used before tag names.', 'mill' ),
				$tags_list
			);
		}
	}

	/**
	 *
	 */
	public function attachment( $wrap = '' ) {
		if ( '' === $wrap ) {
			// $wrap = '<span class="full-size-link"><span class="screen-reader-text">%1$s</span><a href="%2$s">%3$s &times; %4$s</a></span>';
			return $wrap;
		}

		if ( is_attachment() && wp_attachment_is_image() ) {
			// Retrieve attachment metadata.
			$metadata = wp_get_attachment_metadata();

			return sprintf(
				$wrap,
				_x( 'Full size', 'Used before full size attachment link.', 'mill' ),
				esc_url( wp_get_attachment_url() ),
				$metadata['width'],
				$metadata['height']
			);
		}
	}

	/**
	 *
	 */
	public function comment( $wrap = '' ) {
		if ( '' === $wrap ) {
			// $wrap = '<span class="comments-link">%s</span>';
			return $wrap;
		}

		if (
			! is_single()
			&&
			! post_password_required()
			&&
			( comments_open() || get_comments_number() )
		) {
			ob_start();
			comments_popup_link(
				__( 'Leave a comment', 'mill' ),
				__( '1 Comment', 'mill' ),
				__( '% Comments', 'mill' )
			);
			$comments_popup_link = ob_get_clean();

			return sprintf(
				$wrap,
				$comments_popup_link
			);
		}
	}

	/**
	 *
	 */
	public function edit( $wrap = '' ) {
		if ( '' === $wrap ) {
			// $wrap = '<span class="edit-link">%s</span>';
			return $wrap;
		}

		if ( ! $post = get_post( 0 ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return;
		}

		ob_start();
		edit_post_link( __( 'Edit', 'mill' ), '', '' );
		$edit_post_link = ob_get_clean();
		return sprintf(
			$wrap,
			$edit_post_link
		);
	}

	/**
	 * Determine whether blog/site has more than one category.
	 *
	 * @since Mill 1.0.0
	 * @return bool True of there is more than one category, false otherwise.
	 */
	protected function categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'mill_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( [
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			] );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'mill_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so mill_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so mill_categorized_blog should return false.
			return false;
		}
	}

	/**
	 * Flush out the transients used in {@see categorized_blog()}.
	 *
	 * @since Mill 1.0.0
	 */
	public static function category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'mill_categories' );
	}
}
