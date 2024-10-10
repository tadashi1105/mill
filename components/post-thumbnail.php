<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

if (
	! post_password_required()
	&&
	! is_attachment()
	&&
	has_post_thumbnail()
) :
	$caption = get_post( get_post_thumbnail_id() )->post_excerpt;
	?>
	<div class="site-p-entry-card__media">
		<figure class="site-c-figure">
			<?php
			the_post_thumbnail( 'post-thumbnail', [
				'alt' => the_title_attribute( [ 'echo' => false ] ),
				'class' => 'site-c-figure__img site-u-img-fluid post-thumbnail',
			] );
			?>
			<?php if ( $caption ) : ?>
				<figcaption class="site-c-figure__caption">
					<?php echo $caption; ?>
				</figcaption>
			<?php endif; ?>
		</figure><!-- .site-c-figure -->
	</div><!-- .site-p-entry-card__media -->
	<?php
endif;
