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
class Mill_Customizer_Abstract {

	/**
	 * Default theme options
	 * @var array
	 */
	protected static $defaults = [];

	/**
	 * @var Mill_Customizer_Framework
	 */
	protected $customizer_framework;

	public function __construct() {
		$this->customizer_framework = new Mill_Customizer_Framework();
	}

	/**
	 * Return the theme option
	 *
	 * @param string $key
	 * @return null|string
	 */
	public static function get( $key ) {
		$default   = self::get_default( $key );
		$theme_mod = get_theme_mod( $key, $default );
		return $theme_mod;
	}

	/**
	 * Return default value
	 *
	 * @param string $key
	 * @return null|string
	 */
	public static function get_default( $key ) {
		self::$defaults = apply_filters(
			'mill_theme_mods_defaults',
			[
				'logo'                             => '',
			]
		);
		if ( isset( self::$defaults[$key] ) ) {
			return self::$defaults[$key];
		}
	}

	/**
	 * Set the original item on the theme customizer
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	public function customize_register( $wp_customize ) {
		$this->customizer_framework->register_customizer( $wp_customize );


		// Remove section
		// $this->customizer_framework->remove_section( 'colors' );

		// Add panel
		// $this->customizer_framework->add_panel( 'mill_colors', [
		// 	'title'    => __( 'Colors', 'mill' ),
		// 	'priority' => 110,
		// ] );

		// Add section
		// $this->customizer_framework->add_section( 'colors', [
		// 	'title' =>  __( 'General', 'mill' ),
		// 	'panel' => 'mill_colors',
		// ] );

		// Add color field
		// $this->customizer_framework->color( 'logo_text_color', [
		// 	'label'   => __( 'Logo text color', 'mill' ),
		// 	'default' => self::get_default( 'logo_text_color' ),
		// 	'section' => 'colors',
		// ] );

		// Add image field
		// $this->customizer_framework->image( 'logo', [
		// 	'label'   => __( 'Logo', 'mill' ),
		// 	'section' => 'mill_design',
		// ] );

		// Add number field
		// $this->customizer_framework->number( 'excerpt_length', array(
		// 	'label'   => __( 'Excerpt length', 'mill' ),
		// 	'default' => self::get_default( 'excerpt_length' ),
		// 	'section' => 'mill_design',
		// 	'input_attrs' => array(
		// 		'size'  => 3,
		// 		'style' => 'width: 60px;'
		// 	),
		// ) );

		// Add radio field
		// $this->customizer_framework->radio( 'is_displaying_thumbnail', array(
		// 	'label'   => __( 'Displaying thumbnail in archive page', 'mill' ),
		// 	'default' => self::get_default( 'is_displaying_thumbnail' ),
		// 	'section' => 'mill_design',
		// 	'choices' => array(
		// 		'false' => __( 'No', 'mill' ),
		// 		'true'  => __( 'Yes', 'mill' ),
		// 	),
		// ) );

		// Add range field
		// $this->customizer_framework->range( 'slider_option_overlay_opacity', array(
		// 	'label'   => __( 'Overlay opacity', 'mill' ),
		// 	'default' => self::get_default( 'slider_option_overlay_opacity' ),
		// 	'section' => 'mill_slider_option',
		// 	'input_attrs' => array(
		// 		'min'  => 0,
		// 		'max'  => 100,
		// 		'step' => 1,
		// 	),
		// ) );

		// Add textarea field
		// $this->customizer_framework->textarea( 'slider_content_' . $i, array(
		// 	'label'   => __( 'Content', 'mill' ),
		// 	'section' => $section_id,
		// ) );

		// Add url field
		// $this->customizer_framework->url( 'slider_url_' . $i, array(
		// 	'label'   => __( 'URL', 'mill' ),
		// 	'section' => $section_id,
		// ) );

		// Add checkbox field
		// $this->customizer_framework->checkbox( 'slider_target_' . $i, array(
		// 	'label'   => __( 'Open link in new window', 'mill' ),
		// 	'default' => self::get_default( 'slider_target_' . $i ),
		// 	'section' => $section_id,
		// ) );
	}

	/**
	 * Convert the color code to the RGB
	 *
	 * @param string $hex
	 */
	protected function _hex_to_rgb( $hex ) {
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		return [ $r, $g, $b ];
	}

	/**
	 * Register styles
	 */
	public function register_styles() {
		// $rgb_header_bg_color = $this->_hex_to_rgb( self::get( 'header_bg_color' ) );

		// Add css
		// $this->customizer_framework->register_styles(
		// 	'a',
		// 	sprintf( 'color: %s', self::get( 'link_color' ) )
		// );

		// Add css
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'a:focus',
		// 		'a:active',
		// 		'a:hover',
		// 	),
		// 	array(
		// 		sprintf( 'color: %s', self::get( 'link_hover_color' ) ),
		// 	)
		// );

		// Add css
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.responsive-nav a',
		// 	),
		// 	array(
		// 		sprintf( 'color: %s', self::get( 'gnav_link_color' ) ),
		// 		sprintf( 'font-size: %spx', self::get( 'gnav_fontsize' ) ),
		// 	)
		// );

		// $gnav_link_bg_color = self::get( 'gnav_link_bg_color' );
		// if ( $this->_hex_to_rgb( $gnav_link_bg_color ) == $rgb_header_bg_color ) {
		// 	$gnav_link_bg_color = 'transparent';
		// }

		// Add breakpoint css
		// if ( $gnav_breakpoint = self::get_gnav_breakpoint() ) {
		// 	$this->customizer_framework->register_styles(
		// 		array(
		// 			'.responsive-nav',
		// 		),
		// 		array(
		// 			'display: block',
		// 		),
		// 		'',
		// 		$gnav_breakpoint
		// 	);
		// }
	}
}
