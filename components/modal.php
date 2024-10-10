<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */
?>
<div id="js-modal-search" tabindex="-1" role="dialog" aria-labelledby="modal-search" aria-hidden="true" class="site-c-modal site-l-modal-search fade">
	<div role="document" class="site-c-modal__dialog">
		<div class="site-c-modal__content">
			<div class="site-c-modal__body">
				<?php /* get_search_form(); */ ?>
				<p><span class="h3"><span class="fa fa-search" aria-hidden="true"></span> <?php _e( 'Search', 'mill' ) ?></span> <small><?php _e( '検索', 'mill' ) ?></small></p>
				<form role="search" method="get" class="" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<div class="site-c-form__group">
						<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'mill' ); ?></span>
						<input type="search" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'mill' ); ?>" class="site-c-form__control search-field" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'mill' ); ?>">
					</div>
					<div class="site-c-row site-c-row--sm">
						<div class="site-c-col-xs-6">
							<button type="button" data-dismiss="modal" class="site-c-btn site-c-btn--block site-c-btn--secondary"><?php _e( 'Cancel', 'mill' ) ?></button>
						</div>
						<div class="site-c-col-xs-6">
							<input type="submit" class="site-c-btn site-c-btn--block site-c-btn--primary search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'mill' ) ?>">
						</div>
					</div>
				</form>
				<hr />
				<p><span class="h3"><span class="fa fa-tag" aria-hidden="true"></span> <?php _e( 'Keywords', 'mill' ) ?></span> <small><?php _e( '人気キーワード', 'mill' ) ?></small></p>
				<?php
				wp_list_categories( [
					'orderby' => 'count',
					'order' => 'DESC',
					'style' => '',
					'show_count' => 1,
					'title_li' => '',
					'number' => 20,
					'taxonomy' => 'post_tag',
					'separator' => ' / ',
				] );
				?>
			</div>
		</div>
	</div>
</div><!-- .site-modal-search -->
