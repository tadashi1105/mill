<?php
/**
 * Test & Debug
 *
 * @since Mill 1.0.0
 */

error_reporting(E_ALL);
// echo ini_get('display_errors');

if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

// echo ini_get('display_errors');
ini_set( 'xdebug.var_display_max_children', -1);
ini_set( 'xdebug.var_display_max_data',     -1);
ini_set( 'xdebug.var_display_max_depth',    -1);

/**
 * var_dump alias
 *
 * @since Mill 1.0.0
 */
function vd( $data, $esc = true ) {
	$xdebug = ( extension_loaded( 'xdebug' ) ? true : false );

	$div_start = "";
	$pre_start = "";
	$pre_end = "";
	$div_end = "";

	if ( ! $xdebug ) {
		$div_start = "<div style='color:#000;background:#fff;border:1px solid #000;padding:16px;overflow:auto;'>\n";
		$pre_start = "<pre>\n";
		$pre_end = "\n</pre>\n";
		$div_end = "\n</div>\n";
		if ( is_array( $data ) && $esc ) {
			array_walk_recursive( $data, 'debug_esc_html' );
		} elseif ( is_string( $data ) && $esc ) {
			$data = esc_html( $data );
		}
	}

	echo ( ( $xdebug ) ? '' : $div_start . $pre_start );
    var_dump( $data );
	echo ( ( $xdebug ) ? '' : $pre_end . $div_end );
}

/**
 *
 *
 * @since Mill 1.0.0
 */
function debug_esc_html( &$v ) {
	$v = htmlspecialchars( $v, ENT_QUOTES, 'UTF-8', false );
}

/**
 * 表示ページの種類を調べる関数
 *
 * @since Mill 1.0.0
 */
function test_is_here() {
	if ( is_front_page() ) {
		echo '<p>front page</p>';
	}
	if ( is_home() ) {
		echo '<p>home</p>';
	}
	if ( is_404() ) {
		echo '<p>404</p>';
	}
	if ( is_search() ) {
		echo '<p>search</p>';
	}
	if ( is_tax() ) {
		echo '<p>tax</p>';
	}
	if ( is_attachment() ) {
		echo '<p>attachment</p>';
	}
	if ( is_page() ) {
		echo '<p>page</p>';
	}
	if ( is_single() ) {
		echo '<p>single</p>';
	}
	if ( is_category() ) {
		echo '<p>category</p>';
	}
	if ( is_tag() ) {
		echo '<p>tag</p>';
	}
	if ( is_author() ) {
		echo '<p>author</p>';
	}
	if ( is_day() ) {
		echo '<p>day</p>';
	}
	if ( is_month() ) {
		echo '<p>month</p>';
	}
	if ( is_year() ) {
		echo '<p>year</p>';
	}
	if ( is_post_type_archive() ) {
		echo '<p>post type archive</p>';
	}
}

/**
 * アーカイブページの説明文があるか調べる関数
 *
 * @since Mill 1.0.0
 * @return boolean
 */
function debug_has_term_description() {
	$term_description = term_description();
	if ( !empty( $term_description ) ) {
		return true;
	}
	return false;
}

if ( ! function_exists( 'get_the_post_thumbnail_url' ) ) :
/**
 * WP 4.4
 *
 * @param $post, $size
 */
function get_the_post_thumbnail_url( $post = null, $size = 'post-thumbnail' ) {
	$post_thumbnail_id = get_post_thumbnail_id( $post );
	if ( ! $post_thumbnail_id ) {
		return false;
	}
	return wp_get_attachment_image_url( $post_thumbnail_id, $size );
}
endif;

if ( ! function_exists( 'wp_get_attachment_image_url' ) ) :
/**
 * WP 4.4
 *
 * @param $post, $size
 */
function wp_get_attachment_image_url( $attachment_id, $size = 'thumbnail', $icon = false ) {
    $image = wp_get_attachment_image_src( $attachment_id, $size, $icon );
    return isset( $image['0'] ) ? $image['0'] : false;
}
endif;

/**
 * Disable the feed cache
 *
 */
// add_action( 'wp_feed_options', 'do_not_cache_feeds' );
// function do_not_cache_feeds( &$feed ) {
// 	$feed->enable_cache( false );
// }

/**
 * Time
 *
 */
function debug_time() {
	// $time_start = microtime(true);
  //
	// 計測したい処理
  //
	// $time = microtime(true) - $time_start;
	// echo "{$time} 秒";

	$baseMemoryUsage = memory_get_usage();
	$baseTime = microtime(true);

	for ($i = 0; $i < 100; $i++) {
		$data = range(1, 100000);
		// ここでループ処理を行います。
		$data = null;
	}

	$maxMemoryUsage = (memory_get_peak_usage() - $baseMemoryUsage) / (1024 * 1024);
	$processTime = microtime(true) - $baseTime;

	printf("Max Memory Usage : %.3f [MB]\n", $maxMemoryUsage);
	printf("Process Time : %.2f [s]\n", $processTime);
}
