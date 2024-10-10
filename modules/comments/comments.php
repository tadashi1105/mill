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
add_action( 'comment_form_before', 'mill_comment_form_before' );
function mill_comment_form_before() {
?>
<div class="site-c-card site-c-card__block site-u-m-b-3">
<?php
}

/**
 *
 *
 * @since Mill 1.0.0
 */
add_action( 'comment_form_after', 'mill_comment_form_after' );
function mill_comment_form_after() {
?>
</div>
<?php
}

/**
 *
 *
 * @since Mill 1.0.0
 */
add_filter( 'comment_form_defaults', 'mill_comment_form_defaults' );
function mill_comment_form_defaults( $defaults ) {
	$post_id   = get_the_ID();
	$commenter = wp_get_current_commenter();
	$user      = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	$format = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );

	$author_field  = '<div class="form-group comment-form-author">';
	$author_field .= '<label for="author">' . __( 'Name', 'mill') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>';
	$author_field .= '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" class="form-control"' . $aria_req . $html_req .'>';
	$author_field .= '</div>';

	$email_field  = '<div class="form-group comment-form-email">';
	$email_field .= '<label for="email">' . __( 'Email', 'mill' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>';
	$email_field .= '<input id="email" name="email" ' . ( $format === 'html5' ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" class="form-control" aria-describedby="email-notes"' . $aria_req . $html_req  . '>';
	$email_field .= '</div>';

	$url_field  = '<div class="form-group comment-form-url">';
	$url_field .= '<label for="url">' . __( 'Website', 'mill' ) . '</label>';
	$url_field .= '<input id="url" name="url" ' . ( $format === 'html5' ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" class="form-control">';
	$url_field .= '</div>';

	$comment_field  = '<div class="form-group comment-form-comment">';
	$comment_field .= '<label for="comment">' . _x( 'Comment', 'noun', 'mill' ) . '</label>';
	$comment_field .= '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="required" class="form-control"></textarea>';
	$comment_field .= '</div>';

	$fields   =  [
		'author' => $author_field,
		'email'  => $email_field,
		'url'    => $url_field,
	];

	$defaults = [
		'fields'               => $fields,
		'comment_field'        => $comment_field,
		'class_submit'         => 'btn btn-primary submit',
	];

	return $defaults;
}


// if ( ! function_exists( 'mill_comments_number' ) ) :
/**
 * Get comments number
 *
 * $type comment trackback pingback pings
 *
 * @param strig $type
 * @since Mill 1.0.0
 */
// add_filter( 'get_comments_number', 'mill_get_comments_number', 10, 2 );
// function mill_get_comments_number( $count, $post_id ) {
// function mill_get_comments_number( $type = 'all' ) {
// 	global $wp_query;
// 	if ( empty( $wp_query->comments ) ) {
// 		return 0;
// 	}
//
// 	if ( $type === 'all' ) {
// 		$comments = $wp_query->comments;
// 	} else {
// 		if ( empty( $wp_query->comments_by_type ) ) {
// 			$wp_query->comments_by_type = separate_comments( $wp_query->comments );
// 		}
//
// 		if ( empty( $wp_query->comments_by_type[$type] ) ) {
// 			return 0;
// 		}
//
// 		$comments = $wp_query->comments_by_type[$type];
// 	}
//
// 	$count = count( $comments );
// 	return $count;
// }
// endif;

/**
 *
 *
 * @since Mill 1.0.0
 */
// add_filter( 'comments_number', 'mill_comments_number', 10, 2 );
function mill_comments_number( $output, $number ) {
	$zero = false;
	$one  = false;
	$more = false;

	$number = mill_get_approved_comments_count( [
		'type' => 'comment',
	] );

	if ( $number > 1 ) {
		$output = str_replace( '%', number_format_i18n( $number ), ( false === $more ) ? __( '% Comments', 'mill' ) : $more );
	} elseif ( $number == 0 ) {
		$output = ( false === $zero ) ? __( 'No Comments', 'mill' ) : $zero;
	} else {
		$output = ( false === $one ) ? __( '1 Comment', 'mill' ) : $one;
	}

	return $output;
}

/**
 *
 *
 * @since Mill 1.0.0
 */
// add_filter( 'get_comments_number', 'mill_get_comments_number', 10, 2 );
function mill_get_comments_number( $count, $post_id ) {
	if ( ! $count ) {
		return $count;
	}
	$count = mill_get_approved_comments_count( [
		'type'    => 'comment',
		'post_id' => $post_id,
	] );

	return $count;
}

/**
 *
 *
 * @since Mill 1.0.0
 */
// add_filter( 'get_comments_number', 'mill_get_pings_number', 10, 2 );
function mill_get_pings_number( $count, $post_id ) {
	if ( ! $count ) {
		return $count;
	}
	$count = mill_get_approved_comments_count( [
		'type'    => 'pings',
		'post_id' => $post_id,
	] );

	return $count;
}

/**
 *
 *
 * @since Mill 1.0.0
 */
// add_filter( 'get_comments_number', 'mill_get_pingbacks_number', 10, 2 );
function mill_get_pingbacks_number( $count, $post_id ) {
	if ( ! $count ) {
		return $count;
	}
	$count = mill_get_approved_comments_count( [
		'type'    => 'pingback',
		'post_id' => $post_id,
	] );

	return $count;
}

/**
 *
 *
 * @since Mill 1.0.0
 */
// add_filter( 'get_comments_number', 'mill_get_trackbacks_number', 10, 2 );
function mill_get_trackbacks_number( $count, $post_id ) {
	if ( ! $count ) {
		return $count;
	}
	$count = mill_get_approved_comments_count( [
		'type'    => 'trackback',
		'post_id' => $post_id,
	] );

	return $count;
}

/**
 *
 *
 * @since Mill 1.0.0
 */
function mill_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	if ( 'div' === $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
<?php
	if ( current_theme_supports( 'html5', 'comment-list' ) ) {
?>
		<article id="div-comment-<?php comment_ID(); ?>" class="site-c-card site-c-card__block comment-body">
			<footer class="site-u-clearfix comment-meta">
				<div class="comment-author vcard">
					<?php
					if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] );
					printf(
						__( '%s <span class="says">says:</span>', 'mill' ),
						sprintf( '<b class="fn">%s</b>', get_comment_author_link() )
					);
					?>
				</div><!-- .comment-author -->
				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php
							printf( _x( '%1$s at %2$s', '1: date, 2: time', 'mill' ),
								get_comment_date(),
								get_comment_time()
							);
							?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'mill' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mill' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->
			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
			<?php
			comment_reply_link( array_merge( $args, [
				'add_below' => 'div-comment',
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
				'before'    => '<div class="reply">',
				'after'     => '</div>'
			] ) );
			?>
		</article><!-- .comment-body -->
<?php
	} else {
?>
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="site-c-card site-c-card__block comment-body">
		<?php endif; ?>
			<div class="comment-author vcard">
			<?php
			if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] );
			printf(
				__( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'mill' ),
				get_comment_author_link()
			);
			?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mill' ); ?></em>
				<br />
			<?php endif; ?>
			<div class="comment-meta commentmetadata">
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
					<?php
					/* translators: 1: date, 2: time */
					printf(
						__( '%1$s at %2$s', 'mill' ),
						get_comment_date(),
						get_comment_time()
					);
					?>
				</a>
				<?php edit_comment_link( __( '(Edit)', 'mill' ), '&nbsp;&nbsp;', '' ); ?>
			</div>
			<?php
			comment_text(
				get_comment_id(),
				array_merge( $args, [ 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ] )
			);
			comment_reply_link( array_merge( $args, [
				'add_below' => $add_below,
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
				'before'    => '<div class="reply">',
				'after'     => '</div>'
			] ) );
			?>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
	}
}

/**
 * コメント数を返すメソッド
 *
 * コメントの数を取得 comment trackback pingback pings
 *
 * @todo global $wp_queryを使うdata baseアクセス回数を減らすために
 * @since Mill 1.0.0
 * @return integer $count
 */
function mill_get_approved_comments_count( array $args = [], $post_id = 0 ) {
	$post = get_post( $post_id );

	if ( ! $post ) {
		return 0;
	}

	$defaults = [
		'type'    => '',
		'post_id' => $post->ID,
		'status'  => 1,
		'order'   => 'ASC',
	];
	$args = wp_parse_args( $args, $defaults );

	$query = new WP_Comment_Query;
	$comments = $query->query( $args );
	$count = count( $comments );

	return $count;
}
