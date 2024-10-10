<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */
?>
<form role="search" method="get" class="form-inline" action="<?php echo esc_url(home_url( '/' ) ); ?>">
	<div class="form-group">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'mill' ); ?></span>
		<input type="search" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'mill' ); ?>" class="form-control search-field" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'mill' ); ?>">
	</div>
	<input type="submit" class="btn btn-primary search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'mill' ) ?>">
</form>
