<?php
/**
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

if ( ! empty( $tabs ) && is_array( $tabs ) ) :
	?>
	<ul class="site-c-nav site-c-nav--tabs site-c-nav--justified">
	<?php
	foreach ( $tabs as $key => $value ) :
		if ( ! empty( $value['name'] ) ) :
			?>
			<li class="site-c-nav__item" role="presentation">
				<a href="#<?php echo $value['id']; ?>" class="site-c-nav__link<?php echo $key === 1 ? ' active' : '' ?>" role="tab" aria-controls="<?php echo $value['id']; ?>" data-toggle="tab">
					<?php echo $value['name']; ?>
				</a>
			</li>
			<?php
		endif;
	endforeach;
	?>
	</ul>
	<div class="site-c-tabs__content site-u-clearfix">
	<?php
	foreach ( $tabs as $key => $value ) :
		if ( ! empty( $value['name'] ) && ! empty( $value['content'] ) ) :
			if (
				( $value['content'] === 'category' )
				||
				( $value['content'] === 'post_tag' )
			) :
				?>
				<div id="<?php echo $value['id']; ?>" class="site-c-tabs__tab-pane site-c-card__block site-u-clearfix fade<?php echo $key === 1 ? ' in active' : '' ?>" role="tabpanel">
					<?php
					$this->term_list( $value['content'] );
					?>
				</div>
				<?php
			else :
				?>
				<div id="<?php echo $value['id']; ?>" class="site-c-tabs__tab-pane fade<?php echo $key === 1 ? ' in active' : '' ?>" role="tabpanel">
					<?php
					$this->show_posts( [
						'orderby' => $value['content'],
						'posts_per_page' => $number,
					] );
					?>
				</div>
				<?php
			endif;
		endif;
	endforeach;
	?>
	</div>
	<?php
endif;
