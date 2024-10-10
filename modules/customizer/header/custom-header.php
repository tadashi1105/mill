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
function mill_custom_header() {
	$src = '';
	if ( get_header_image() ) {
		$src = get_header_image();
	}
	$src = apply_filters( 'mill_page_header_background_image', $src );
	// $src = apply_filters( 'mill_custom_header_image', $src );
	if ( $src ) {
		return sprintf(
			'style="background-image: url( %s )"',
			$src
		);
	}
}

class Mill_Page_Header {

	/**
	 * @var int
	 */
	protected $post_id;

	/**
	 * @param null|int $post_id
	 */
	public function __construct( $post_id = null ) {
		$this->post_id = $post_id;
	}

	/**
	 * Display page header
	 */
	public function display() {
		$classes       = $this->get_classes();
		$style         = $this->get_style();
		$title_classes = $this->get_title_classes();
		$title         = $this->get_title();
		?>
		<div class="site-p-page-header site-u-text-center <?php echo esc_attr( $classes ); ?>" <?php echo $style; ?>>
			<div class="site-c-container">
				<h1 class="site-p-page-header__title <?php echo esc_attr( $title_classes ); ?>">
					<?php echo apply_filters( 'mill_title_in_page_header', esc_html( $title ) ); ?>
				</h1>
				<?php $this->the_excerpt(); ?>
			</div>
		</div><!-- .site-p-page-header -->
		<?php
	}

	/**
	 * Display excerpt
	 */
	protected function the_excerpt() {
		global $post;
		$is_displaying_page_header_lead = Mill::get( 'is_displaying_page_header_lead' );

		if ( is_page() && !empty( $post->post_excerpt ) && $is_displaying_page_header_lead !== 'false' ) {
			?>
			<div class="site-p-page-header__description">
				<?php the_excerpt(); ?>
			</div><!-- .site-p-page-header__description -->
			<?php
		}
	}

	/**
	 * Return the title for current page
	 *
	 * @return string
	 */
	protected function get_title() {
		if ( $this->post_id ) {
			return get_the_title( $this->post_id );
		}

		if ( is_404() ) {
			return __( 'Woops! Page not found.', 'mill' );
		}

		if ( is_search() ) {
			return sprintf( __( 'Search Results for: %s', 'mill' ), get_search_query() );
		}

		$post_type = get_post_type();
		if ( empty( $post_type ) ) {
			global $wp_query;
			$post_type = $wp_query->get( 'post_type' );
		}
		$post_type_object = get_post_type_object( $post_type );
		if ( !empty( $post_type_object->label ) ) {
			return $post_type_object->label;
		}
		if ( !empty( $post_type_object->labels->name ) ) {
			return $post_type_object->labels->name;
		}
	}

	/**
	 * Return style attribute for custom header
	 *
	 * @return string
	 */
	protected function get_style() {
		$src = '';
		if ( get_header_image() ) {
			$src = get_header_image();
		}
		$src = apply_filters( 'mill_page_header_background_image', $src );
		if ( $src ) {
			return sprintf(
				'style="background-image: url( %s )"',
				$src
			);
		}
	}

	/**
	 * Return classes for custom header
	 *
	 * @return string
	 */
	protected function get_classes() {
		if ( get_header_image() ) {
			return 'site-p-page-header--has-background-image';
		}
	}

	/**
	 * Return classes for title
	 */
	protected function get_title_classes() {
		$title_classes = '';
		return apply_filters( 'mill_title_class_in_page_header', $title_classes );
	}
}
