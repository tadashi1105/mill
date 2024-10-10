<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

if ( post_password_required() ) {
	return;
}

if ( have_comments() ) :
	?>
	<div id="comments" class="site-c-card site-c-card__block site-u-m-b-3 comments-area">
		<h3 class="site-c-card__title comments-title">
			<?php comments_number(); ?>
		</h3>
		<?php
		if ( wp_list_comments( [ 'type' => 'pings', 'echo' => false, ] ) ) {
			?>
			<h4 class="site-c-card__title comments-title">
				<?php esc_html_e( 'Pings', 'mill' ); ?>
			</h4>
			<ol class="comment-list">
				<?php
				wp_list_comments( [
					'type'       => 'pings',
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 80,
					'callback'=> 'mill_comment',
				] );
				?>
			</ol>
			<?php
		}

		if ( wp_list_comments( [ 'type' => 'comment', 'echo' => false, ] ) ) {
			?>
			<h4 class="site-c-card__title comments-title">
				<?php esc_html_e( 'Comments', 'mill' ); ?>
			</h4>
			<ol class="comment-list">
				<?php
				wp_list_comments( [
					'type'       => 'comment',
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 80,
					'callback'=> 'mill_comment',
				] );
				?>
			</ol>
			<?php
		}

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="comment-navigation navigation" role="navigation">
				<?php
				paginate_comments_links( [
					'end_size' => 3,
					'mid_size' => 3,
				] );
				?>
			</nav>
		<?php endif; ?>
	</div>
	<?php
endif; // have_comments()
// If comments are closed and there are comments, let's leave a little note, shall we?
if (
	! comments_open()
	&&
	get_comments_number()
	&&
	post_type_supports( get_post_type(), 'comments' )
) :
	?>
	<div class="site-c-card site-c-card__block site-u-m-b-3 no-comments-area">
		<p class="site-c-card__text no-comments">
			<?php esc_html_e( 'Comments are closed.', 'mill' ); ?>
		</p>
	</div>
	<?php
endif;
comment_form();
