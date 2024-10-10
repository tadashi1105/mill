<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

do_action( 'mill_archive_before_entry' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( [ 'site-p-entry-list', 'site-p-entry-list--primary', 'site-c-media' ] ); ?>>
	<div class="site-c-media__cell site-c-media__cell--left">
		<a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
			<?php
			if ( ! post_password_required() && has_post_thumbnail() ) :
				the_post_thumbnail( 'entry-image', [
					'alt' => the_title_attribute( [ 'echo' => false ] ),
					'class' => 'site-p-entry-list__object site-c-media__object post-thumbnail',
				] );
			else :
				?>
				<div class="site-p-entry-list__object site-c-media__object site-u-bg-primary post-thumbnail"></div>
				<?php
			endif;
			?>
		</a>
	</div>
	<div class="site-c-media__cell site-c-media__cell--body">
		<header class="site-p-entry-list__header">
			<h2 class="site-p-entry-list__title entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		</header>
		<?php
		if ( has_action( 'mill_archive_before_entry_content' ) ) :
			do_action( 'mill_archive_before_entry_content' );
		endif;
		?>
		<div class="site-p-entry-list__content entry-content hidden-xs-down">
			<?php the_content(); ?>
		</div>
		<?php
		if ( has_action( 'mill_archive_after_entry_content' ) ) :
			do_action( 'mill_archive_after_entry_content' );
		endif;
		?>
	</div>
</article>
<?php
do_action( 'mill_archive_after_entry' );
