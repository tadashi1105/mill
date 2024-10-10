<?php
/**
 * Extend the default WordPress body classes.
 * Add and remove body_class() classes
 *
 * @since Mill 1.0.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
add_filter( 'body_class', 'mill_body_classes' );
function mill_body_classes( $classes ) {
	// Remove unnecessary classes
	$home_id_class = 'page-id-' . get_option( 'page_on_front' );
	$remove_classes = array(
		'page-template-default',
		$home_id_class
	);
	$classes = array_diff( $classes, $remove_classes );

	 if ( is_multi_author() ) {
	   $classes[] = 'group-blog';
	 }

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	//  if ( get_header_image() ) {
	//    $classes[] = 'header-image';
	//  } else {
	//    $classes[] = 'masthead-fixed';
	//  }

	//  if ( is_archive() || is_search() || is_home() ) {
	//    $classes[] = 'list-view';
	//  }

	if ( is_singular() && !is_front_page() ) {
		$classes[] = 'singular';
	}

	return $classes;
}

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Mill 1.0.0
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
add_filter( 'post_class', 'mill_post_classes' );
function mill_post_classes( $classes ) {
	 // if (!post_password_required() && has_post_thumbnail()) {
	 //   $classes[] = 'has-post-thumbnail';
	 // }

	if ( is_singular() ) {
		$classes[] = 'site-p-content-style';
	}
	return $classes;
}

add_filter( 'navigation_markup_template', 'mill_navigation_markup_template', 10, 2 );
function mill_navigation_markup_template( $template, $class ) {
	if ( $class === 'post-navigation' ) {
		$template = '
			<nav class="site-p-post-nav navigation %1$s" role="navigation">
				<h2 class="screen-reader-text">%2$s</h2>
				<div class="site-p-post-nav__links site-c-card nav-links">%3$s</div>
			</nav>';
	}
		return $template;
}

if ( ! function_exists( 'mill_adjacent_post_link' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Mill 1.0.0
 */
add_filter( 'previous_post_link', 'mill_adjacent_post_link', 10, 5 );
add_filter( 'next_post_link', 'mill_adjacent_post_link', 10, 5 );
function mill_adjacent_post_link( $output, $format, $link, $post, $adjacent ) {
	if( $link !== '%title' ) {
		return $output;
	}

	$link = '';

	if ( $post ) {
		$title = $post->post_title;
		if ( empty( $post->post_title ) ) {
			if ( $adjacent === 'previous' ) {
				$title = __( 'Previous Post', 'mill' );
			} else {
				$title = __( 'Next Post', 'mill' );
			}
		}
		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $title, $post->ID );
		$title = wp_trim_words( $title, 40 );

		$link .= '<div class="site-c-media">';
		if ( has_post_thumbnail( $post->ID ) ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
			$image = sprintf(
				'<img src="%s" class="site-p-entry-list__object site-c-media__object" alt="%s">',
				esc_url( $image[0] ),
				'%title'
			);

			$link .= '<div class="site-c-media__cell site-c-media__cell--left">' . $image . '</div>';
		} else {
			$link .= '<div class="site-c-media__cell site-c-media__cell--left">';
			$link .= '<div class="site-p-entry-list__object site-c-media__object site-u-bg-primary">';
			$link .= '</div></div>';
		}

		$in_same_term = false;
		$excluded_terms = '';
		$taxonomy = 'category';

		$format = '<div class="site-p-entry-list nav-previous">%link</div>';
		$previous = true;

		$link .= '<div class="site-c-media__cell site-c-media__cell--body">';
		if ( $adjacent === 'previous' ) {
			$link .= '<p class="site-p-entry-list__title site-p-post-nav__title">' . __( 'Previous Post', 'mill' ) . '</p>';
		} else {
			$link .= '<p class="site-p-entry-list__title site-p-post-nav__title">' . __( 'Next Post', 'mill' ) . '</p>';
			$format = '<div class="site-p-entry-list nav-next">%link</div>';
			$previous = false;
		}
		$link .= '<p class="site-p-post-nav__text post-title">' . $title . '</p>';
		$link .= '</div></div>';

		return get_adjacent_post_link(
			$format,
			$link,
			$in_same_term,
			$excluded_terms,
			$previous,
			$taxonomy
		);
	} else {
		return $link;
	}
}
endif;

/**
 *
 *
 * @since Mill 1.0.0
 */
add_filter( 'the_password_form', 'mill_get_the_password_form' );
function mill_get_the_password_form( $output ) {
	global $post;
	$label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="site-c-form site-c-form--inline post-password-form" method="post">
		<p>' . __( 'This content is password protected. To view it please enter your password below:', 'mill' ) . '</p>
		<div class="site-c-form__group"><label for="' . $label . '">' . __( 'Password:', 'mill' ) . '</label><input name="post_password" id="' . $label . '" class="site-c-form__control" type="password" size="20" /></div><div class="form-group"><input type="submit" class="site-c-btn site-c-btn-primary" name="Submit" value="' . esc_attr__( 'Submit', 'mill' ) . '" /></div></form>';
	return $output;
}
