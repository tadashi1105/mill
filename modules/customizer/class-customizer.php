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
class Mill_Customizer extends Mill_Customizer_Abstract {

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
				// 'logo'                             => '',
				// 'logo_text_color'                  => '#000',
				// 'header'                           => 'header--default',
				// 'header_fixed'                     => '',
				// 'footer_columns'                   => 'col-md-4',
				// 'blog_template'                    => 'right-sidebar',
				// 'search_template'                  => 'right-sidebar',
				// '404_template'                     => 'right-sidebar',
				// 'is_displaying_thumbnail'          => 'true',
				// 'is_displaying_bread_crumb'        => 'true',
				// 'is_displaying_related_posts'      => 'true',
				// 'is_displaying_page_header'        => 'true',
				// 'is_displaying_page_header_lead'   => 'true',
				// 'link_color'                       => '#337ab7',
				// 'link_hover_color'                 => '#23527c',
				// 'main_nav_bg_color'                    => '#fff',
				// 'main_nav_link_color'                  => '#000',
				// 'main_nav_link_hover_color'            => '#337ab7',
				// 'main_nav_link_bg_color'               => '#fff',
				// 'main_nav_link_bg_hover_color'         => '#fff',
				// 'main_nav_sub_label_color'             => '#777',
				// 'main_nav_sub_label_hover_color'       => '#777',
				// 'main_nav_pulldown_link_color'         => '#777',
				// 'main_nav_pulldown_link_hover_color'   => '#337ab7',
				// 'main_nav_pulldown_bg_color'           => '#000',
				// 'main_nav_pulldown_bg_hover_color'     => '#191919',
				// 'offcanvas_nav_fontsize'           => 12,
				// 'offcanvas_nav_direction'          => 'right',
				// 'hamburger_btn_text_color'         => '#000',
				// 'hamburger_btn_text_hover_color'   => '#000',
				// 'hamburger_btn_border_color'       => '#eee',
				// 'hamburger_btn_border_hover_color' => '#eee',
				// 'hamburger_btn_bg_color'           => '#fff',
				// 'hamburger_btn_bg_hover_color'     => '#f5f5f5',
				// 'header_bg_color'                  => '#fff',
				// 'footer_bg_color'                  => '#111113',
				// 'footer_text_color'                => '#555',
				// 'footer_link_color'                => '#777',
				// 'page_header_bg_color'             => '#222',
				// 'page_header_text_color'           => '#fff',
				// 'main_nav_breakpoint'              => 'md',
				// 'main_nav_fontsize'                => 12,
				// 'main_nav_sub_label_fontsize'      => 10,
				// 'main_nav_link_x_padding'          => 15,
				// 'main_nav_link_y_padding'          => 23,
				// 'slider_option_effect'             => 'horizontal',
				// 'slider_option_interval'           => 4000,
				// 'slider_option_speed'              => 500,
				// 'slider_option_overlay_color'      => '#000',
				// 'slider_option_overlay_opacity'    => '90',
				// 'slider_option_height'             => 0,
				// 'slider_option_target_1'           => false,
				// 'slider_option_target_2'           => false,
				// 'slider_option_target_3'           => false,
				// 'slider_option_target_4'           => false,
				// 'slider_option_target_5'           => false,
				// 'excerpt_length'                   => ( get_locale() == 'ja' ) ? 110 : 220,
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

		// colors

		$this->customizer_framework->remove_section( 'colors' );
		$this->customizer_framework->add_panel( 'mill_colors', [
			'title'    => __( 'Colors', 'mill' ),
			'priority' => 110,
		] );

		// colors - general

		$this->customizer_framework->add_section( 'colors', [
			'title' =>  __( 'General', 'mill' ),
			'panel' => 'mill_colors',
		] );

		// $this->customizer_framework->color( 'logo_text_color', [
		// 	'label'   => __( 'Logo text color', 'mill' ),
		// 	'default' => self::get_default( 'logo_text_color' ),
		// 	'section' => 'colors',
		// ] );
        //
		// $this->customizer_framework->color( 'link_color', [
		// 	'label'   => __( 'Link text color', 'mill' ),
		// 	'default' => self::get_default( 'link_color' ),
		// 	'section' => 'colors',
		// ] );
        //
		// $this->customizer_framework->color( 'link_hover_color', [
		// 	'label'   => __( 'Link text hover color', 'mill' ),
		// 	'default' => self::get_default( 'link_hover_color' ),
		// 	'section' => 'colors',
		// ] );
        //
		// // colors - header
        //
		// $this->customizer_framework->add_section( 'colors_header', [
		// 	'title' =>  __( 'Header', 'mill' ),
		// 	'panel' => 'mill_colors',
		// ] );
        //
		// $this->customizer_framework->color( 'header_bg_color', [
		// 	'label'   => __( 'Background color', 'mill' ),
		// 	'default' => self::get_default( 'header_bg_color' ),
		// 	'section' => 'colors_header',
		// ] );
        //
		// // colors - footer
        //
		// $this->customizer_framework->add_section( 'colors_footer', [
		// 	'title' =>  __( 'Footer', 'mill' ),
		// 	'panel' => 'mill_colors',
		// ] );
        //
		// $this->customizer_framework->color( 'footer_bg_color', [
		// 	'label'   => __( 'Background color', 'mill' ),
		// 	'default' => self::get_default( 'footer_bg_color' ),
		// 	'section' => 'colors_footer',
		// ] );
        //
		// $this->customizer_framework->color( 'footer_text_color', [
		// 	'label'   => __( 'Text color', 'mill' ),
		// 	'default' => self::get_default( 'footer_text_color' ),
		// 	'section' => 'colors_footer',
		// ] );
        //
		// $this->customizer_framework->color( 'footer_link_color', [
		// 	'label'   => __( 'Link text color', 'mill' ),
		// 	'default' => self::get_default( 'footer_link_color' ),
		// 	'section' => 'colors_footer',
		// ] );
        //
		// // colors - main nav
        //
		// $this->customizer_framework->add_section( 'colors_main_nav', [
		// 	'title' =>  __( 'Main Navigation', 'mill' ),
		// 	'panel' => 'mill_colors',
		// ] );
        //
		// $this->customizer_framework->color( 'main_nav_bg_color', [
		// 	'label'   => __( 'Background color', 'mill' ),
		// 	'default' => self::get_default( 'main_nav_bg_color' ),
		// 	'section' => 'colors_main_nav',
		// ] );
        //
		// $this->customizer_framework->color( 'gnav_link_color', array(
		// 	'label'   => __( 'Link text color', 'mill' ),
		// 	'default' => self::get_default( 'gnav_link_color' ),
		// 	'section' => 'colors_gnav',
		// ) );
        //
		// $this->customizer_framework->color( 'gnav_link_hover_color', array(
		// 	'label'   => __( 'Link text hover color', 'mill' ),
		// 	'default' => self::get_default( 'gnav_link_hover_color' ),
		// 	'section' => 'colors_gnav',
		// ) );
        //
		// $this->customizer_framework->color( 'gnav_link_bg_color', array(
		// 	'label'   => __( 'Menu background color', 'mill' ),
		// 	'default' => self::get_default( 'gnav_link_bg_color' ),
		// 	'section' => 'colors_gnav',
		// ) );
        //
		// $this->customizer_framework->color( 'gnav_link_bg_hover_color', array(
		// 	'label'   => __( 'Menu background hover color', 'mill' ),
		// 	'default' => self::get_default( 'gnav_link_bg_hover_color' ),
		// 	'section' => 'colors_gnav',
		// ) );
        //
		// $this->customizer_framework->color( 'gnav_sub_label_color', array(
		// 	'label'   => __( 'Sub label color', 'mill' ),
		// 	'default' => self::get_default( 'gnav_sub_label_color' ),
		// 	'section' => 'colors_gnav',
		// ) );
        //
		// $this->customizer_framework->color( 'gnav_sub_label_hover_color', array(
		// 	'label'   => __( 'Sub label hover color', 'mill' ),
		// 	'default' => self::get_default( 'gnav_sub_label_hover_color' ),
		// 	'section' => 'colors_gnav',
		// ) );
        //
		// $this->customizer_framework->color( 'gnav_pulldown_link_color', array(
		// 	'label'   => __( 'Pulldown link text color', 'mill' ),
		// 	'default' => self::get_default( 'gnav_pulldown_link_color' ),
		// 	'section' => 'colors_gnav',
		// ) );
        //
		// $this->customizer_framework->color( 'gnav_pulldown_link_hover_color', array(
		// 	'label'   => __( 'Pulldown link text hover color', 'mill' ),
		// 	'default' => self::get_default( 'gnav_pulldown_link_hover_color' ),
		// 	'section' => 'colors_gnav',
		// ) );
        //
		// $this->customizer_framework->color( 'gnav_pulldown_bg_color', array(
		// 	'label'   => __( 'Pulldown menu background color', 'mill' ),
		// 	'default' => self::get_default( 'gnav_pulldown_bg_color' ),
		// 	'section' => 'colors_gnav',
		// ) );
        //
		// $this->customizer_framework->color( 'gnav_pulldown_bg_hover_color', array(
		// 	'label'   => __( 'Pulldown menu background hover color', 'mill' ),
		// 	'default' => self::get_default( 'gnav_pulldown_bg_hover_color' ),
		// 	'section' => 'colors_gnav',
		// ) );

		// colors - hamburger button

		// $this->customizer_framework->add_section( 'colors_hamburger_button', array(
		// 	'title' =>  __( 'hamburger Button', 'mill' ),
		// 	'panel' => 'mill_colors',
		// ) );
        //
		// $this->customizer_framework->color( 'hamburger_btn_text_color', array(
		// 	'label'   => __( 'Text color', 'mill' ),
		// 	'default' => self::get_default( 'hamburger_btn_text_color' ),
		// 	'section' => 'colors_hamburger_button',
		// ) );
        //
		// $this->customizer_framework->color( 'hamburger_btn_text_hover_color', array(
		// 	'label'   => __( 'Text hover color', 'mill' ),
		// 	'default' => self::get_default( 'hamburger_btn_text_hover_color' ),
		// 	'section' => 'colors_hamburger_button',
		// ) );
        //
		// $this->customizer_framework->color( 'hamburger_btn_border_color', array(
		// 	'label'   => __( 'Border color', 'mill' ),
		// 	'default' => self::get_default( 'hamburger_btn_border_color' ),
		// 	'section' => 'colors_hamburger_button',
		// ) );
        //
		// $this->customizer_framework->color( 'hamburger_btn_border_hover_color', array(
		// 	'label'   => __( 'Border hover color', 'mill' ),
		// 	'default' => self::get_default( 'hamburger_btn_border_hover_color' ),
		// 	'section' => 'colors_hamburger_button',
		// ) );
        //
		// $this->customizer_framework->color( 'hamburger_btn_bg_color', array(
		// 	'label'   => __( 'Background color', 'mill' ),
		// 	'default' => self::get_default( 'hamburger_btn_bg_color' ),
		// 	'section' => 'colors_hamburger_button',
		// ) );
        //
		// $this->customizer_framework->color( 'hamburger_btn_bg_hover_color', array(
		// 	'label'   => __( 'Background hover color', 'mill' ),
		// 	'default' => self::get_default( 'hamburger_btn_bg_hover_color' ),
		// 	'section' => 'colors_hamburger_button',
		// ) );

		// colors - page header

		// $this->customizer_framework->add_section( 'colors_page_header', array(
		// 	'title' =>  __( 'Page Header', 'mill' ),
		// 	'panel' => 'mill_colors',
		// ) );
        //
		// $this->customizer_framework->color( 'page_header_bg_color', array(
		// 	'label'   => __( 'Background color', 'mill' ),
		// 	'default' => self::get_default( 'page_header_bg_color' ),
		// 	'section' => 'colors_page_header',
		// ) );
        //
		// $this->customizer_framework->color( 'page_header_text_color', array(
		// 	'label'   => __( 'Text color', 'mill' ),
		// 	'default' => self::get_default( 'page_header_text_color' ),
		// 	'section' => 'colors_page_header',
		// ) );

		// design

		$this->customizer_framework->add_section( 'mill_design', [
			'title'    => __( 'Settings', 'mill' ),
			'priority' => 111,
		] );

		$this->customizer_framework->image( 'logo', [
			'label'   => __( 'Logo', 'mill' ),
			'section' => 'mill_design',
		] );

		if ( ! class_exists( 'WPSEO_Frontend' ) ) {
			$this->customizer_framework->textarea( 'before_feed_content', [
				'label'   => __( 'Before feed content', 'mill' ),
				'section' => 'mill_design',
			] );
			$this->customizer_framework->textarea( 'after_feed_content', [
				'label'   => __( 'After feed content', 'mill' ),
				'section' => 'mill_design',
			] );
		}

		// $this->customizer_framework->number( 'excerpt_length', array(
		// 	'label'   => __( 'Excerpt length', 'mill' ),
		// 	'default' => self::get_default( 'excerpt_length' ),
		// 	'section' => 'mill_design',
		// 	'input_attrs' => array(
		// 		'size'  => 3,
		// 		'style' => 'width: 60px;'
		// 	),
		// ) );
        //
		// $this->customizer_framework->radio( 'is_displaying_thumbnail', array(
		// 	'label'   => __( 'Displaying thumbnail in archive page', 'mill' ),
		// 	'default' => self::get_default( 'is_displaying_thumbnail' ),
		// 	'section' => 'mill_design',
		// 	'choices' => array(
		// 		'false' => __( 'No', 'mill' ),
		// 		'true'  => __( 'Yes', 'mill' ),
		// 	),
		// ) );
        //
		// $this->customizer_framework->radio( 'is_displaying_bread_crumb', array(
		// 	'label'   => __( 'Displaying the Bread Crumb', 'mill' ),
		// 	'default' => self::get_default( 'is_displaying_bread_crumb' ),
		// 	'section' => 'mill_design',
		// 	'choices' => array(
		// 		'false' => __( 'No', 'mill' ),
		// 		'true'  => __( 'Yes', 'mill' ),
		// 	),
		// ) );
        //
		// $this->customizer_framework->radio( 'is_displaying_related_posts', array(
		// 	'label'   => __( 'Displaying related posts in single page', 'mill' ),
		// 	'default' => self::get_default( 'is_displaying_related_posts' ),
		// 	'section' => 'mill_design',
		// 	'choices' => array(
		// 		'false' => __( 'No', 'mill' ),
		// 		'true'  => __( 'Yes', 'mill' ),
		// 	),
		// ) );
        //
		// $this->customizer_framework->radio( 'is_displaying_page_header', array(
		// 	'label'   => __( 'Displaying page header', 'mill' ),
		// 	'default' => self::get_default( 'is_displaying_page_header' ),
		// 	'section' => 'mill_design',
		// 	'choices' => array(
		// 		'false' => __( 'No', 'mill' ),
		// 		'true'  => __( 'Yes', 'mill' ),
		// 	),
		// ) );
        //
		// $this->customizer_framework->radio( 'is_displaying_page_header_lead', array(
		// 	'label'   => __( 'Displaying lead of page header in page', 'mill' ),
		// 	'default' => self::get_default( 'is_displaying_page_header_lead' ),
		// 	'section' => 'mill_design',
		// 	'choices' => array(
		// 		'false' => __( 'No', 'mill' ),
		// 		'true'  => __( 'Yes', 'mill' ),
		// 	),
		// ) );

		// layout

		// $this->customizer_framework->add_panel( 'mill_layout', array(
		// 	'title'    => __( 'Layout', 'mill' ),
		// 	'priority' => 112,
		// ) );
        //
		// // layout - header
        //
		// $this->customizer_framework->add_section( 'mill_layout_header', array(
		// 	'title' =>  __( 'Header', 'mill' ),
		// 	'panel' => 'mill_layout',
		// ) );
        //
		// $this->customizer_framework->radio( 'header', array(
		// 	'label'   => __( 'Header', 'mill' ),
		// 	'default' => self::get_default( 'header' ),
		// 	'section' => 'mill_layout_header',
		// 	'choices' => array(
		// 		'header--default'      => __( 'Default', 'mill' ),
		// 		'header--2row'         => __( '2 rows', 'mill' ),
		// 		'header--center'       => __( 'Center Logo', 'mill' ),
		// 		'header--transparency' => __( 'Transparency', 'mill' ),
		// 	),
		// ) );
        //
		// $this->customizer_framework->radio( 'header_fixed', array(
		// 	'label'   => __( 'Header Fixed', 'mill' ),
		// 	'default' => self::get_default( 'header_fixed' ),
		// 	'section' => 'mill_layout_header',
		// 	'choices' => array(
		// 		''              => __( 'No', 'mill' ),
		// 		'header--fixed' => __( 'Yes', 'mill' ),
		// 	),
		// ) );
        //
		// // layout - footer
        //
		// $this->customizer_framework->add_section( 'mill_layout_footer', array(
		// 	'title' =>  __( 'Footer', 'mill' ),
		// 	'panel' => 'mill_layout',
		// ) );
        //
		// $this->customizer_framework->radio( 'footer_columns', array(
		// 	'label'   => __( 'Number of footer columns', 'mill' ),
		// 	'default' => self::get_default( 'footer_columns' ),
		// 	'section' => 'mill_layout_footer',
		// 	'choices' => array(
		// 		'col-md-6' => __( '2 Columns', 'mill' ),
		// 		'col-md-4' => __( '3 Columns', 'mill' ),
		// 		'col-md-3' => __( '4 Columns', 'mill' ),
		// 	),
		// ) );
        //
		// // layout - gnav
        //
		// $this->customizer_framework->add_section( 'mill_layout_gnav', array(
		// 	'title' =>  __( 'Global Navigation', 'mill' ),
		// 	'panel' => 'mill_layout',
		// ) );
        //
		// $this->customizer_framework->radio( 'gnav_breakpoint', array(
		// 	'label'   => __( 'Breakpoint to switch off canvas navigation', 'mill' ),
		// 	'default' => self::get_default( 'gnav_breakpoint' ),
		// 	'section' => 'mill_layout_gnav',
		// 	'choices' => array(
		// 		''   => __( 'Always', 'mill' ),
		// 		'md' => __( 'Tablet size', 'mill' ),
		// 		'lg' => __( 'Laptop size', 'mill' ),
		// 	),
		// ) );
        //
		// $this->customizer_framework->number( 'gnav_fontsize', array(
		// 	'label'   => __( 'Font size ( px )', 'mill' ),
		// 	'default' => self::get_default( 'gnav_fontsize' ),
		// 	'section' => 'mill_layout_gnav',
		// 	'input_attrs' => array(
		// 		'size'  => 3,
		// 		'style' => 'width: 60px;'
		// 	),
		// ) );
        //
		// $this->customizer_framework->number( 'gnav_sub_label_fontsize', array(
		// 	'label'   => __( 'Sub label font size ( px )', 'mill' ),
		// 	'default' => self::get_default( 'gnav_sub_label_fontsize' ),
		// 	'section' => 'mill_layout_gnav',
		// 	'input_attrs' => array(
		// 		'size'  => 3,
		// 		'style' => 'width: 60px;'
		// 	),
		// ) );
        //
		// $this->customizer_framework->number( 'gnav_link_horizontal_padding', array(
		// 	'label'   => __( 'link padding ( Horizontal )', 'mill' ),
		// 	'default' => self::get_default( 'gnav_link_horizontal_padding' ),
		// 	'section' => 'mill_layout_gnav',
		// 	'input_attrs' => array(
		// 		'size'  => 3,
		// 		'style' => 'width: 60px;'
		// 	),
		// ) );
        //
		// $this->customizer_framework->number( 'gnav_link_vertical_padding', array(
		// 	'label'   => __( 'link padding ( Vertical )', 'mill' ),
		// 	'default' => self::get_default( 'gnav_link_vertical_padding' ),
		// 	'section' => 'mill_layout_gnav',
		// 	'input_attrs' => array(
		// 		'size'  => 3,
		// 		'style' => 'width: 60px;'
		// 	),
		// ) );
        //
		// $this->customizer_framework->number( 'offcanvas_nav_fontsize', array(
		// 	'label'   => __( 'Offcanvas Navigation font size ( px )', 'mill' ),
		// 	'default' => self::get_default( 'offcanvas_nav_fontsize' ),
		// 	'section' => 'mill_layout_gnav',
		// 	'input_attrs' => array(
		// 		'size'  => 3,
		// 		'style' => 'width: 60px;'
		// 	),
		// ) );
        //
		// $this->customizer_framework->radio( 'offcanvas_nav_direction', array(
		// 	'label'   => __( 'Offcanvas Navigation slide direction', 'mill' ),
		// 	'default' => self::get_default( 'offcanvas_nav_direction' ),
		// 	'section' => 'mill_layout_gnav',
		// 	'choices' => array(
		// 		'right' => __( 'Right', 'mill' ),
		// 		'left'  => __( 'Left', 'mill' ),
		// 	),
		// ) );

		// layout - template

		// $this->customizer_framework->add_section( 'mill_layout_template', array(
		// 	'title' =>  __( 'Template', 'mill' ),
		// 	'panel' => 'mill_layout',
		// ) );
        //
		// $this->customizer_framework->radio( 'blog_template', array(
		// 	'label'   => __( 'Blog Template', 'mill' ),
		// 	'default' => self::get_default( 'blog_template' ),
		// 	'section' => 'mill_layout_template',
		// 	'choices' => array(
		// 		'right-sidebar'    => __( 'Right Sidebar', 'mill' ),
		// 		'left-sidebar'     => __( 'Left Sidebar', 'mill' ),
		// 		'no-sidebar'       => __( 'No Sidebar', 'mill' ),
		// 		'full-width-fixed' => __( 'Full Width ( Fixed )', 'mill' ),
		// 		'full-width-fluid' => __( 'Full Width ( Fluid )', 'mill' ),
		// 	),
		// ) );
        //
		// $this->customizer_framework->radio( 'search_template', array(
		// 	'label'   => __( 'Search Template', 'mill' ),
		// 	'default' => self::get_default( 'search_template' ),
		// 	'section' => 'mill_layout_template',
		// 	'choices' => array(
		// 		'right-sidebar'    => __( 'Right Sidebar', 'mill' ),
		// 		'left-sidebar'     => __( 'Left Sidebar', 'mill' ),
		// 		'no-sidebar'       => __( 'No Sidebar', 'mill' ),
		// 		'full-width-fixed' => __( 'Full Width ( Fixed )', 'mill' ),
		// 		'full-width-fluid' => __( 'Full Width ( Fluid )', 'mill' ),
		// 	),
		// ) );
        //
		// $this->customizer_framework->radio( '404_template', array(
		// 	'label'   => __( '404 Template', 'mill' ),
		// 	'default' => self::get_default( '404_template' ),
		// 	'section' => 'mill_layout_template',
		// 	'choices' => array(
		// 		'right-sidebar'    => __( 'Right Sidebar', 'mill' ),
		// 		'left-sidebar'     => __( 'Left Sidebar', 'mill' ),
		// 		'no-sidebar'       => __( 'No Sidebar', 'mill' ),
		// 		'full-width-fixed' => __( 'Full Width ( Fixed )', 'mill' ),
		// 		'full-width-fluid' => __( 'Full Width ( Fluid )', 'mill' ),
		// 	),
		// ) );
        //
		// // mill_slider
        //
		// $this->customizer_framework->add_panel( 'mill_slider', array(
		// 	'title'    => __( 'Front page Slider', 'mill' ),
		// 	'priority' => 113,
		// ) );
        //
		// $this->customizer_framework->add_section( 'mill_slider_option', array(
		// 	'title' =>  __( 'Settings', 'mill' ),
		// 	'panel' => 'mill_slider',
		// ) );
        //
		// $this->customizer_framework->radio( 'slider_option_effect', array(
		// 	'label'   => __( 'Effect', 'mill' ),
		// 	'default' => self::get_default( 'slider_option_effect' ),
		// 	'section' => 'mill_slider_option',
		// 	'choices' => array(
		// 		'horizontal' => __( 'Slide', 'mill' ),
		// 		'fade'       => __( 'Fade', 'mill' ),
		// 	),
		// ) );
        //
		// $this->customizer_framework->number( 'slider_option_interval', array(
		// 	'label'   => __( 'Interval ( ms )', 'mill' ),
		// 	'default' => self::get_default( 'slider_option_interval' ),
		// 	'section' => 'mill_slider_option',
		// ) );
        //
		// $this->customizer_framework->number( 'slider_option_speed', array(
		// 	'label'   => __( 'Effect Speed ( ms )', 'mill' ),
		// 	'default' => self::get_default( 'slider_option_speed' ),
		// 	'section' => 'mill_slider_option',
		// ) );
        //
		// $this->customizer_framework->color( 'slider_option_overlay_color', array(
		// 	'label'   => __( 'Overlay color', 'mill' ),
		// 	'default' => self::get_default( 'slider_option_overlay_color' ),
		// 	'section' => 'mill_slider_option',
		// ) );
        //
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
        //
		// $this->customizer_framework->number( 'slider_option_height', array(
		// 	'label'       => __( 'Height ( px )', 'mill' ),
		// 	'default'     => self::get_default( 'slider_option_height' ),
		// 	'section'     => 'mill_slider_option',
		// 	'description' => __( 'If 0, height is auto.', 'mill' ),
		// ) );
        //
		// for ( $i = 1; $i <= 5; $i ++ ) {
		// 	$section_id = 'mill_slider_image_' . $i;
		// 	$this->customizer_framework->add_section( $section_id, array(
		// 		'title' =>  sprintf( __( 'Image (%d)', 'mill' ), $i ),
		// 		'panel' => 'mill_slider',
		// 	) );
		// 	$this->customizer_framework->image( 'slider_image_' . $i, array(
		// 		'label'   => __( 'Image', 'mill' ),
		// 		'section' => $section_id,
		// 	) );
		// 	$this->customizer_framework->textarea( 'slider_content_' . $i, array(
		// 		'label'   => __( 'Content', 'mill' ),
		// 		'section' => $section_id,
		// 	) );
		// 	$this->customizer_framework->url( 'slider_url_' . $i, array(
		// 		'label'   => __( 'URL', 'mill' ),
		// 		'section' => $section_id,
		// 	) );
		// 	$this->customizer_framework->checkbox( 'slider_target_' . $i, array(
		// 		'label'   => __( 'Open link in new window', 'mill' ),
		// 		'default' => self::get_default( 'slider_target_' . $i ),
		// 		'section' => $section_id,
		// 	) );
		// }
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

		// $this->customizer_framework->register_styles(
		// 	'a',
		// 	sprintf( 'color: %s', self::get( 'link_color' ) )
		// );
        //
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
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.site-branding a',
		// 	),
		// 	array(
		// 		sprintf( 'color: %s', self::get( 'logo_text_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.responsive-nav a',
		// 	),
		// 	array(
		// 		sprintf( 'color: %s', self::get( 'gnav_link_color' ) ),
		// 		sprintf( 'font-size: %spx', self::get( 'gnav_fontsize' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.responsive-nav a small',
		// 	),
		// 	array(
		// 		sprintf( 'color: %s', self::get( 'gnav_sub_label_color' ) ),
		// 		sprintf( 'font-size: %spx', self::get( 'gnav_sub_label_fontsize' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.responsive-nav a:hover small',
		// 		'.responsive-nav a:active small',
		// 		'.responsive-nav .current-menu-item small',
		// 		'.responsive-nav .current-menu-ancestor small',
		// 		'.responsive-nav .current-menu-parent small',
		// 		'.responsive-nav .current_page_item small',
		// 		'.responsive-nav .current_page_parent small',
		// 	),
		// 	array(
		// 		sprintf( 'color: %s', self::get( 'gnav_sub_label_hover_color' ) ),
		// 	)
		// );

		// $gnav_link_bg_color = self::get( 'gnav_link_bg_color' );
		// if ( $this->_hex_to_rgb( $gnav_link_bg_color ) == $rgb_header_bg_color ) {
		// 	$gnav_link_bg_color = 'transparent';
		// }
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.responsive-nav .menu>.menu-item>a',
		// 		'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.menu-item>a',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', $gnav_link_bg_color ),
		// 		sprintf( 'padding: %dpx %dpx', self::get( 'gnav_link_vertical_padding' ), self::get( 'gnav_link_horizontal_padding' ) ),
		// 	)
		// );
        //
		// $gnav_link_bg_hover_color = self::get( 'gnav_link_bg_hover_color' );
		// if ( $this->_hex_to_rgb( $gnav_link_bg_hover_color ) == $rgb_header_bg_color ) {
		// 	$gnav_link_bg_hover_color = 'transparent';
		// }
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.responsive-nav .menu>.menu-item>a:hover',
		// 		'.responsive-nav .menu>.menu-item>a:active',
		// 		'.responsive-nav .menu>.current-menu-item>a',
		// 		'.responsive-nav .menu>.current-menu-ancestor>a',
		// 		'.responsive-nav .menu>.current-menu-parent>a',
		// 		'.responsive-nav .menu>.current_page_item>a',
		// 		'.responsive-nav .menu>.current_page_parent>a',
		// 		'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.menu-item>a:hover',
		// 		'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.menu-item>a:active',
		// 		'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.current-menu-item>a',
		// 		'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.current-menu-ancestor>a',
		// 		'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.current-menu-parent>a',
		// 		'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.current_page_item>a',
		// 		'.header--transparency.header--fixed--is_scrolled .responsive-nav .menu>.current_page_parent>a',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', $gnav_link_bg_hover_color ),
		// 		sprintf( 'color: %s', self::get( 'gnav_link_hover_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.responsive-nav .sub-menu a',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', self::get( 'gnav_pulldown_bg_color' ) ),
		// 		sprintf( 'color: %s', self::get( 'gnav_pulldown_link_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.responsive-nav .sub-menu a:hover',
		// 		'.responsive-nav .sub-menu a:active',
		// 		'.responsive-nav .sub-menu .current-menu-item a',
		// 		'.responsive-nav .sub-menu .current-menu-ancestor a',
		// 		'.responsive-nav .sub-menu .current-menu-parent a',
		// 		'.responsive-nav .sub-menu .current_page_item a',
		// 		'.responsive-nav .sub-menu .current_page_parent a',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', self::get( 'gnav_pulldown_bg_hover_color' ) ),
		// 		sprintf( 'color: %s', self::get( 'gnav_pulldown_link_hover_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.off-canvas-nav',
		// 	),
		// 	array(
		// 		sprintf( 'font-size: %spx', self::get( 'offcanvas_nav_fontsize' ) ),
		// 	)
		// );
        //
		// $gnav_bg_color = self::get( 'gnav_bg_color' );
		// if ( $this->_hex_to_rgb( $gnav_bg_color ) == $rgb_header_bg_color ) {
		// 	$gnav_bg_color = 'transparent';
		// }
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.responsive-nav',
		// 		'.header--transparency.header--fixed--is_scrolled .responsive-nav',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', $gnav_bg_color ),
		// 	)
		// );
        //
		// $hamburger_btn_bg_color           = self::get( 'hamburger_btn_bg_color' );
		// $hamburger_btn_border_color       = self::get( 'hamburger_btn_border_color' );
		// $hamburger_btn_bg_hover_color     = self::get( 'hamburger_btn_bg_hover_color' );
		// $hamburger_btn_border_hover_color = self::get( 'hamburger_btn_border_hover_color' );
		// if ( $this->_hex_to_rgb( $hamburger_btn_bg_color ) == $rgb_header_bg_color ) {
		// 	$hamburger_btn_bg_color = 'transparent';
		// }
		// if ( $this->_hex_to_rgb( $hamburger_btn_border_color ) == $rgb_header_bg_color ) {
		// 	$hamburger_btn_border_color = 'transparent';
		// }
		// if ( $this->_hex_to_rgb( $hamburger_btn_bg_hover_color ) == $rgb_header_bg_color ) {
		// 	$hamburger_btn_bg_hover_color = 'transparent';
		// }
		// if ( $this->_hex_to_rgb( $hamburger_btn_border_hover_color ) == $rgb_header_bg_color ) {
		// 	$hamburger_btn_border_hover_color = 'transparent';
		// }
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'#responsive-btn',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', $hamburger_btn_bg_color ),
		// 		sprintf( 'border-color: %s', $hamburger_btn_border_color ),
		// 		sprintf( 'color: %s', self::get( 'hamburger_btn_text_color' ) ),
		// 	)
		// );
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'#responsive-btn:hover',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', $hamburger_btn_bg_hover_color ),
		// 		sprintf( 'border-color: %s', $hamburger_btn_border_hover_color ),
		// 		sprintf( 'color: %s', self::get( 'hamburger_btn_text_hover_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.mill-slider__transparent-layer',
		// 	),
		// 	array(
		// 		sprintf(
		// 			'background-color: rgba( %s, %s )',
		// 			implode( ',', $this->_hex_to_rgb( self::get( 'slider_option_overlay_color' ) ) ),
		// 			1 - self::get( 'slider_option_overlay_opacity' ) / 100
		// 		),
		// 	)
		// );
        //
		// if ( self::get( 'slider_option_height' ) ) {
		// 	$this->customizer_framework->register_styles(
		// 		array(
		// 			'.mill-slider',
		// 			'.mill-slider__item',
		// 		),
		// 		array(
		// 			sprintf( 'height: %spx', self::get( 'slider_option_height' ) ),
		// 			'overflow: hidden',
		// 		)
		// 	);
		// }
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.page-header',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', self::get( 'page_header_bg_color' ) ),
		// 		sprintf( 'color: %s', self::get( 'page_header_text_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.pagination>li>a',
		// 	),
		// 	array(
		// 		sprintf( 'color: %s', self::get( 'link_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.pagination>li>span',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', self::get( 'link_color' ) ),
		// 		sprintf( 'border-color: %s', self::get( 'link_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.pagination>li>a:focus',
		// 		'.pagination>li>a:hover',
		// 		'.pagination>li>span:focus',
		// 		'.pagination>li>span:hover',
		// 	),
		// 	array(
		// 		sprintf( 'color: %s', self::get( 'link_hover_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.header',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', self::get( 'header_bg_color' ) ),
		// 	)
		// );

		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.header--transparency.header--fixed--is_scrolled',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s !important', self::get( 'header_bg_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.footer',
		// 	),
		// 	array(
		// 		sprintf( 'background-color: %s', self::get( 'footer_bg_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.footer-widget-area a',
		// 	),
		// 	array(
		// 		sprintf( 'color: %s', self::get( 'footer_link_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.footer-widget-area',
		// 		'.footer-widget-area .widget_calendar #wp-calendar caption',
		// 	),
		// 	array(
		// 		sprintf( 'color: %s', self::get( 'footer_text_color' ) ),
		// 	)
		// );
        //
		// $this->customizer_framework->register_styles(
		// 	array(
		// 		'.footer-widget-area .widget_calendar #wp-calendar',
		// 		'.footer-widget-area .widget_calendar #wp-calendar *',
		// 	),
		// 	array(
		// 		sprintf( 'border-color: %s', self::get( 'footer_text_color' ) ),
		// 	)
		// );
        //
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
        //
		// 	$this->customizer_framework->register_styles(
		// 		array(
		// 			'.off-canvas-nav',
		// 			'#responsive-btn',
		// 		),
		// 		array(
		// 			'display: none !important',
		// 		),
		// 		'',
		// 		$gnav_breakpoint
		// 	);
        //
		// 	$this->customizer_framework->register_styles(
		// 		array(
		// 			'.header--2row',
		// 		),
		// 		array(
		// 			'padding-bottom: 0',
		// 		),
		// 		'',
		// 		$gnav_breakpoint
		// 	);
        //
		// 	$this->customizer_framework->register_styles(
		// 		array(
		// 			'.header--2row .header__col',
		// 			'.header--center .header__col',
		// 		),
		// 		array(
		// 			'display: block',
		// 		),
		// 		'',
		// 		$gnav_breakpoint
		// 	);
        //
		// 	$this->customizer_framework->register_styles(
		// 		array(
		// 			'.header--2row .responsive-nav',
		// 			'.header--center .responsive-nav',
		// 		),
		// 		array(
		// 			'margin-right: -1000px',
		// 			'margin-left: -1000px',
		// 			'padding-right: 1000px',
		// 			'padding-left: 1000px',
		// 		),
		// 		'',
		// 		$gnav_breakpoint
		// 	);
        //
		// 	if ( $gnav_bg_color == 'transparent' && $gnav_link_bg_color == 'transparent' && $gnav_link_bg_hover_color == 'transparent' ) {
		// 		$this->customizer_framework->register_styles(
		// 			array(
		// 				'.header--2row .site-branding',
		// 				'.header--center .site-branding',
		// 			),
		// 			array(
		// 				'padding-bottom: 0',
		// 			),
		// 			'',
		// 			$gnav_breakpoint
		// 		);
		// 	}
        //
		// 	$this->customizer_framework->register_styles(
		// 		array(
		// 			'.header--center .site-branding',
		// 		),
		// 		array(
		// 			'text-align: center',
		// 		),
		// 		'',
		// 		$gnav_breakpoint
		// 	);
		// }
	}
}
