<?php
/**
 * Widget
 *
 * @package WordPress
 * @since Mill 1.0.0
 */

/**
 * @since Mill 1.0.0
 */
class Mill_Widget_Tab extends WP_Widget {
	private $defaults = [];

	/**
	 *
	 */
	public function __construct() {
		$this->defaults = [
			'title'  => '',
			'number' => 6,
			'tab_name_1' => __( 'Random', 'mill' ),
			'tab_name_2' => __( 'Popular', 'mill' ),
			'tab_name_3' => __( 'Recent', 'mill' ),
			'tab_content_1' => 'rand',
			'tab_content_2' => 'comment_count',
			'tab_content_3' => 'date',
		];

		$widget_ops = [
			'classname'   => 'mill_widget_tab',
			'description' => __('Display tab content', 'mill')
		];

		parent::__construct( 'mill_tab', __( 'Mill: Tab', 'mill' ), $widget_ops );
		$this->alt_option_name = 'mill_widget_tab';
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 6;
		if ( ! $number )
			$number = 6;

		$tabs = [];
		$tabs['1']['name'] = ( ! empty( $instance['tab_name_1'] ) ) ? $instance['tab_name_1'] : '';
		$tabs['2']['name'] = ( ! empty( $instance['tab_name_2'] ) ) ? $instance['tab_name_2'] : '';
		$tabs['3']['name'] = ( ! empty( $instance['tab_name_3'] ) ) ? $instance['tab_name_3'] : '';

		$tabs['1']['content'] = ( ! empty( $instance['tab_content_1'] ) ) ? $instance['tab_content_1'] : 'rand';
		$tabs['2']['content'] = ( ! empty( $instance['tab_content_2'] ) ) ? $instance['tab_content_2'] : 'comment_count';
		$tabs['3']['content'] = ( ! empty( $instance['tab_content_3'] ) ) ? $instance['tab_content_3'] : 'date';

		foreach ( $tabs as $key => $value ) {
			$tabs[$key]['id'] = esc_attr( $args['widget_id'] . '-' . $value['content'] . '-' . $key );
		}

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( isset( $args['before_content'] ) ) {
			echo $args['before_content'];
		}

		require get_template_directory() . '/modules/tab/tab-template.php';

		if ( isset( $args['after_content'] ) ) {
			echo $args['after_content'];
		}
		echo $args['after_widget'];
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array $instance
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['tab_name_1'] = strip_tags( $new_instance['tab_name_1'] );
		$instance['tab_name_2'] = strip_tags( $new_instance['tab_name_2'] );
		$instance['tab_name_3'] = strip_tags( $new_instance['tab_name_3'] );
		$instance['tab_content_1'] = strip_tags( $new_instance['tab_content_1'] );
		$instance['tab_content_2'] = strip_tags( $new_instance['tab_content_2'] );
		$instance['tab_content_3'] = strip_tags( $new_instance['tab_content_3'] );

		return $instance;
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 6;
		$tab_name_1 = isset( $instance['tab_name_1'] ) ? esc_attr( $instance['tab_name_1'] ) : '';
		$tab_name_2 = isset( $instance['tab_name_2'] ) ? esc_attr( $instance['tab_name_2'] ) : '';
		$tab_name_3 = isset( $instance['tab_name_3'] ) ? esc_attr( $instance['tab_name_3'] ) : '';
		$tab_content_1 = isset( $instance['tab_content_1'] ) ? esc_attr( $instance['tab_content_1'] ) : 'rand';
		$tab_content_2 = isset( $instance['tab_content_2'] ) ? esc_attr( $instance['tab_content_2'] ) : 'comment_count';
		$tab_content_3 = isset( $instance['tab_content_3'] ) ? esc_attr( $instance['tab_content_3'] ) : 'date';

		?>
		<!-- title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mill' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<!-- number -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'mill' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>

		<!-- tab_name_1 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab_name_1' ); ?>"><?php _e( 'Tab name 1:', 'mill' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab_name_1' ); ?>" name="<?php echo $this->get_field_name( 'tab_name_1' ); ?>" type="text" value="<?php echo $tab_name_1; ?>" />
		</p>

		<!-- tab_content_1 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab_content_1' ); ?>"><?php _e( 'Tab content 1:','mill' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'tab_content_1' ); ?>" name="<?php echo $this->get_field_name( 'tab_content_1' ); ?>">
				<option value="rand" <?php selected( $tab_content_1, 'rand' ); ?>><?php _e( 'Random', 'mill' ) ?></option>
				<option value="comment_count" <?php selected( $tab_content_1, 'comment_count' ); ?>><?php _e( 'Popular', 'mill' ) ?></option>
				<option value="date" <?php selected( $tab_content_1, 'date' ); ?>><?php _e( 'Recent', 'mill' ) ?></option>
				<option value="category" <?php selected( $tab_content_1, 'category' ); ?>><?php _e( 'Categories', 'mill' ) ?></option>
				<option value="post_tag" <?php selected( $tab_content_1, 'post_tag' ); ?>><?php _e( 'Tags', 'mill' ) ?></option>
			</select>
		</p>

		<!-- tab_name_2 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab_name_2' ); ?>"><?php _e( 'Tab name 2:', 'mill' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab_name_2' ); ?>" name="<?php echo $this->get_field_name( 'tab_name_2' ); ?>" type="text" value="<?php echo $tab_name_2; ?>" />
		</p>

		<!-- tab_content_2 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab_content_2' ); ?>"><?php _e( 'Tab content 2:','mill' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'tab_content_2' ); ?>" name="<?php echo $this->get_field_name( 'tab_content_2' ); ?>">
				<option value="rand" <?php selected( $tab_content_2, 'rand' ); ?>><?php _e( 'Random', 'mill' ) ?></option>
				<option value="comment_count" <?php selected( $tab_content_2, 'comment_count' ); ?>><?php _e( 'Popular', 'mill' ) ?></option>
				<option value="date" <?php selected( $tab_content_2, 'date' ); ?>><?php _e( 'Recent', 'mill' ) ?></option>
				<option value="category" <?php selected( $tab_content_2, 'category' ); ?>><?php _e( 'Categories', 'mill' ) ?></option>
				<option value="post_tag" <?php selected( $tab_content_2, 'post_tag' ); ?>><?php _e( 'Tags', 'mill' ) ?></option>
			</select>
		</p>

		<!-- tab_name_3 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab_name_3' ); ?>"><?php _e( 'Tab name 3:', 'mill' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab_name_3' ); ?>" name="<?php echo $this->get_field_name( 'tab_name_3' ); ?>" type="text" value="<?php echo $tab_name_3; ?>" />
		</p>

		<!-- tab_content_3 -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab_content_3' ); ?>"><?php _e( 'Tab content 3:','mill' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'tab_content_3' ); ?>" name="<?php echo $this->get_field_name( 'tab_content_3' ); ?>">
				<option value="rand" <?php selected( $tab_content_3, 'rand' ); ?>><?php _e( 'Random', 'mill' ) ?></option>
				<option value="comment_count" <?php selected( $tab_content_3, 'comment_count' ); ?>><?php _e( 'Popular', 'mill' ) ?></option>
				<option value="date" <?php selected( $tab_content_3, 'date' ); ?>><?php _e( 'Recent', 'mill' ) ?></option>
				<option value="category" <?php selected( $tab_content_3, 'category' ); ?>><?php _e( 'Categories', 'mill' ) ?></option>
				<option value="post_tag" <?php selected( $tab_content_3, 'post_tag' ); ?>><?php _e( 'Tags', 'mill' ) ?></option>
			</select>
		</p>
		<?php
	}

	/**
	 * カテゴリー,タグ一覧表示表示
	 *
	 * @since Mill 1.0.0
	 */
	private function term_list( $taxonomy = 'category' ) {
		$terms = get_terms( $taxonomy, [
			'fields' => 'all'
		] );

		if ( ! empty( $terms ) ) {
			$class = 'site-c-btn site-c-btn--secondary site-c-btn--sm site-u-pull-xs-left';
			$link = '';
			foreach( $terms as $term ) {
				$link .= '<a href="' . esc_url( get_term_link( $term ) ) . '" class="' . $class . '">';
				$link .= esc_html( $term->name );
				$link .= ' <span>(' . esc_html( $term->count ) . ')</span>';
				$link .= '</a>';
			};
			echo $link;
		}
	}

	private function show_posts( array $args = [], $template = 'list' ) {
		global $post, $wp_query;
		$defaults = [
			'posts_per_page' => 6,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
		];

		if (
			! is_404()
			&&
			isset( $args['orderby'] )
			&&
			$args['orderby'] === 'rand'
			&&
			isset( $post->ID )
		) {
			$defaults['post__not_in'] = [ $post->ID ];
		}

		$args = wp_parse_args( $args, $defaults );

		$posts = get_posts( $args );
		if ( empty( $posts ) ) {
			return;
		}

		$default_query = clone $wp_query;
		set_query_var( 'is_tab_posts', true );
		foreach ( $posts as $post ) {
			setup_postdata( $post );
			get_template_part( 'modules/tab/entry', $template );
		}
		wp_reset_postdata();
		$wp_query = $default_query;
	}
}
