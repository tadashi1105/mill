<?php
/**
 *
 *
 * @since Mill 1.0.0
 */

/**
 * Set up
 *
 * @since Mill 1.0.0
 */
function mill_parent_theme_setup() {
	if ( ! class_exists( 'Mill' ) ) {
		/**
		 *
		 *
		 * @since Mill 1.0.0
		 */
		class Mill extends Mill_Base_Configuration {

			/**
			 *
			 *
			 * @since Mill 1.0.0
			 */
			public function __construct() {
				parent::__construct();

				// add_theme_support( 'jetpack-responsive-videos' );

				// Action hooks
				// @link actions.php
				add_action( 'widgets_init', [ $this, 'register_widget' ] );

				// Filter hooks
				// @link filters.php
				// remove_filter('the_content', 'wpautop');
				// remove_filter('the_excerpt', 'wpautop');

			}

			/**
			 * Register widget
			 *
			 * @since Mill 1.0.0
			 */
			public function register_widget() {

				// Theme widgets
				register_widget( 'Mill_Widget_Related_Posts' );
				register_widget( 'Mill_Widget_Tab' );
				register_widget( 'Mill_Widget_Author_Box' );
			}
		}
	}
	$Mill = new Mill();
}
add_action( 'after_setup_theme', 'mill_parent_theme_setup', 99999 );

if ( ! class_exists( 'Mill_Base_Configuration' ) ) :
/**
 *
 *
 * @since Mill 1.0.0
 */
class Mill_Base_Configuration {

	/**
	 * __construct
	 *
	 * @since Mill 1.0.0
	 */
	public function __construct() {
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = apply_filters( 'mill_content_width', 1140 );
		}

		load_theme_textdomain( 'mill', get_template_directory() . '/languages' );

		// add_editor_style( './assets/css/editor-style.min.css' );
		add_editor_style();
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 736, 414 );
		add_image_size( 'entry-image', 128, 128, true );

		add_theme_support( 'title-tag' );

		add_theme_support( 'html5', [
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption'
		] );

		add_theme_support( 'post-formats', [
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat'
		] );

		$custom_background_defaults = [];
		add_theme_support(
			'custom-background',
			apply_filters( 'mill_custom_background_defaults', $custom_background_defaults )
		);

		$custom_header_defaults = [
			'width'          => 1366,
			'height'         => 768,
			'flex-height'    => false,
			'flex-width'     => false,
			'uploads'        => true,
			'random-default' => true,
			'header-text'    => false,
		];
		add_theme_support(
			'custom-header',
			apply_filters( 'mill_custom_header_defaults', $custom_header_defaults )
		);

		add_post_type_support( 'page', 'excerpt' );

		$this->customizer();
		$this->register_nav_menus();

		add_action( 'widgets_init', [ $this, 'register_sidebar' ] );
		// add_action( 'widgets_init', [ $this, 'register_widget' ] );
		// add_action( 'widgets_init', [ $this, 'unregister_widget' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );
		add_filter( 'tiny_mce_before_init', [ $this, 'tiny_mce_before_init' ] );
		// add_filter( 'body_class', array( $this, 'body_class' ) );

	}

	/**
	 * 管理画面の wysiwyg エディタに class を追加
	 *
	 * @since Mill 1.0.0
	 * @param array $init
	 * @return array
	 */
	public function tiny_mce_before_init( $init ){
		$init['body_class'] = 'entry-content';
		return $init;
	}

	/**
	 * カスタマイザーに設定を追加
	 *
	 * @since Mill 1.0.0
	 */
	protected function customizer() {
		$customizer = new Mill_Customizer();
		add_action( 'wp_head', [ $customizer, 'register_styles' ] );
		add_action( 'customize_register', [ $customizer, 'customize_register' ] );
	}

	/**
	 * Register navigation menus
	 *
	 * @since Mill 1.0.0
	 */
	protected function register_nav_menus() {
		add_theme_support( 'menu' );
		register_nav_menus( [
			'drawer-nav' => __( 'Drawer Navigation', 'mill' ),
			'main-nav'   => __( 'Main Navigation',    'mill' ),
			'footer-nav' => __( 'Footer Navigation', 'mill' ),
		] );
	}

	/**
	 * Register widget area
	 *
	 * @since Mill 1.0.0
	 */
	public function register_sidebar() {

		register_sidebar( [
			'name'          => __( 'Sidebar Widget', 'mill' ),
			'id'            => 'sidebar-widget',
			'description'   => __( 'Main sidebar that appears on the right.', 'mill' ),
			'before_widget' => '<aside id="%1$s" class="site-p-widget site-c-card widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="site-c-card__header"><h3 class="site-p-widget__title widget-title">',
			'after_title'   => '</h3></div>',
		] );

		register_sidebar( [
			'name'          => __( 'Main Bottom Widget', 'mill' ),
			'id'            => 'main-widget',
			'description'   => __( 'Main bottom sidebar that appears on the bottom.', 'mill' ),
			'before_widget' => '<aside id="%1$s" class="site-p-widget site-c-card widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="site-c-card__header"><h3 class="site-p-widget__title widget-title">',
			'after_title'   => '</h3></div>',
		] );

		register_sidebar( [
			'name'          => __( 'Footer Widget One', 'mill' ),
			'id'            => 'footer-widget-one',
			'description'   => __( 'Appears in the footer section of the site.', 'mill' ),
			'before_widget' => '<aside id="%1$s" class="site-p-widget site-p-widget--footer widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="site-p-widget__title widget-title">',
			'after_title'   => '</h3>',
		] );

		register_sidebar( [
			'name'          => __( 'Footer Widget Two', 'mill' ),
			'id'            => 'footer-widget-two',
			'description'   => __( 'Appears in the footer section of the site.', 'mill' ),
			'before_widget' => '<aside id="%1$s" class="site-p-widget site-p-widget--footer widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="site-p-widget__title widget-title">',
			'after_title'   => '</h3>',
		] );

		register_sidebar( [
			'name'          => __( 'Footer Widget Three', 'mill' ),
			'id'            => 'footer-widget-three',
			'description'   => __( 'Appears in the footer section of the site.', 'mill' ),
			'before_widget' => '<aside id="%1$s" class="site-p-widget site-p-widget--footer widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="site-p-widget__title widget-title">',
			'after_title'   => '</h3>',
		] );

	}

	/**
	 * Register widget
	 *
	 * @since Mill 1.0.0
	 */
	public function register_widget() {
		// register_widget( 'Mill_Ad_Widget' );
	}

	/**
	 * Unregister widget
	 *
	 * @since Mill 1.0.0
	 */
	public function unregister_widget() {
		// unregister_widget( 'WP_Widget_Pages' );
	}

	/**
	 * Display comments
	 *
	 * @since Mill 1.0.0
	 * @param object $comment
	 * @param array $args
	 * @param int $depth
	 */
	public static function the_comments( $comment, $args, $depth ) {
		?>
		<?php
	}

	/**
	 * Enqueue CSS and JavaScript
	 *
	 * @since Mill 1.0.0
	 */
	public function wp_enqueue_scripts() {
		if ( is_admin() ) {
			return;
		}

		$url     = get_template_directory_uri();
		$version = wp_get_theme()->get( 'Version' );
		$min     = '.min';

		if ( ( defined( 'WP_DEBUG' ) && WP_DEBUG === true ) ) {
			$min = '';
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// wp_enqueue_style(
		// 	'bootstrap-cdn',
		// 	'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css',
		// 	[],
		// 	$version,
		// 	'all'
		// );

		wp_enqueue_style(
			'font-roboto',
			'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900',
			[],
			$version,
			'all'
		);

		wp_enqueue_style(
			'font-awesome',
			'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
			[],
			$version,
			'all'
		);

		wp_enqueue_style(
			'icomoon',
			$url . '/assets/fonts/icomoon/style' . $min . '.css',
			[],
			$version,
			'all'
		);

		// drawer
		wp_enqueue_style(
			'drawer',
			'https://cdnjs.cloudflare.com/ajax/libs/drawer/3.1.0/css/drawer.min.css',
			[],
			$version,
			'all'
		);
		wp_enqueue_script(
			'iScroll',
			'https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js',
			[ 'jquery' ],
			$version,
			true
		);
		wp_enqueue_script(
			'drawer',
			'https://cdnjs.cloudflare.com/ajax/libs/drawer/3.1.0/js/drawer.min.js',
			[ 'jquery' ],
			$version,
			true
		);

		wp_enqueue_style(
			'mill-style',
			$url . '/assets/css/style' . $min . '.css',
			[],
			$version,
			'all'
		);

		wp_enqueue_script(
			'tether',
			'https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js',
			[ 'jquery' ],
			$version,
			true
		);

		// wp_enqueue_script(
		// 	'bootstrap-cdn',
		// 	'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js',
		// 	[ 'jquery', 'tether' ],
		// 	$version,
		// 	true
		// );

		wp_enqueue_script(
			'mill-script',
			$url . '/assets/js/home.bundle' . $min . '.js',
			[ 'jquery' ],
			$version,
			true
		);
	}
}
endif;
