<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

do_action( 'mill_before_page_header' );
if ( is_archive() ) :
	do_action( 'mill_archive_before_page_header' );
	?>
	<div class="site-p-page-header">
		<div class="site-c-container">
			<?php
			the_archive_title(
				'<h1 class="site-p-page-header__title page-title">',
				'</h1>'
			);
			the_archive_description(
				'<div class="site-p-page-header__description taxonomy-description">',
				'</div>'
			);
			?>
		</div>
	</div>
	<?php
	do_action( 'mill_archive_after_page_header' );
endif;
do_action( 'mill_after_page_header' );
