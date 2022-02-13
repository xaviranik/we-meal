<?php

namespace PhpKnight\WeMeal\Admin\CPT;

use PhpKnight\WeMeal\Core\Abstracts\CustomPostType;

class Meal extends CustomPostType {

	/**
	 * Registers all hooks for the class.
	 *
	 * @return void
	 */
	public function register_hooks(): void {
		add_filter( 'enter_title_here', [ $this, 'custom_enter_title' ] );
		add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
		add_action( 'save_post_meal', [ $this, 'save_meta_box' ] );
	}

	/**
	 * Returns the post type.
	 *
	 * @return void
	 */
	public function register_post_type(): void {
		/*
		* The $labels describes how the post type appears.
		*/
		$labels = [
			'name'                  => __( 'Meals', 'we-meal' ),
			'singular_name'         => __( 'Meal', 'we-meal' ),
			'add_new_item'          => __( 'Add Meal', 'we-meal' ),
			'add_new'               => __( 'Add Meal', 'we-meal' ),
			'edit_item'             => __( 'Edit Meal', 'we-meal' ),
			'featured_image'        => __( 'Meal Image', 'we-meal' ),
			'set_featured_image'    => __( 'Upload Meal Image', 'we-meal' ),
			'remove_featured_image' => __( 'Remove Meal Images', 'we-meal' ),
			'not_found'             => __( 'No Meals Found', 'we-meal' ),
			'not_found_in_trash'    => __( 'No Meals found in Trash', 'we-meal' ),
		];

		/*
		 * The $supports parameter describes what the post type supports
		 */
		$supports = [
			'title',
			'editor',
			'thumbnail',
		];

		/*
		 * The $args parameter holds important parameters for the custom post type
		 */
		$args = [
			'labels'              => $labels,
			'description'         => 'weMeal', // Description
			'supports'            => $supports,
			'taxonomies'          => [ 'category' ], // Allowed taxonomies
			'hierarchical'        => false, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page
			'public'              => true,  // Makes the post type public
			'show_ui'             => true,  // Displays an interface for this post type
			'show_in_menu'        => false,  // Displays in the Admin Menu (the left panel)
			'show_in_nav_menus'   => false,  // Displays in Appearance -> Menus
			'show_in_admin_bar'   => false,  // Displays in the black admin bar
			'menu_position'       => 5,     // The position number in the left menu
			'menu_icon'           => false,  // The URL for the icon used for this post type
			'can_export'          => true,  // Allows content export using Tools -> Export
			'has_archive'         => false,  // Enables post type archive (by month, date, or year)
			'exclude_from_search' => false, // Exclude posts of this type in the front-end search result page if set to true, include them if set to false
			'publicly_queryable'  => false,  // Allow queries to be performed on the front-end part if set to true
			'capability_type'     => 'post', // Allows read, edit, delete like “Post”
		];

		register_post_type( 'meal', $args );
	}

	/**
	 * Custom enter title text for custom post type.
	 *
	 * @param $title
	 *
	 * @return string
	 */
	public function custom_enter_title( $title ): string {
		if ( 'meal' === get_post_type() ) {
			$title = __( 'Enter the name of the meal', 'we-meal' );
		}
		return $title;
	}

	/**
	 * Adds the meta box container.
	 *
	 * @param $post_type
	 *
	 * @return void
	 */
	public function add_meta_box( $post_type ): void {
		$post_types = [ 'meal' ];

		if ( in_array( $post_type, $post_types, true ) ) {
			add_meta_box(
				'we-meal-price-meta-box',
				__( 'Meal Price', 'we-meal' ),
				[ $this, 'render_meta_box_content' ],
				$post_type,
				'side',
				'high'
			);
		}
	}


	/**
	 * Render Meta Box content.
	 *
	 * @param \WP_Post $post The post object.
	 *
	 * @return void
	 */
	public function render_meta_box_content( \WP_Post $post ): void {
		wp_nonce_field( 'we_meal_price_meta_box', 'we_meal_price_meta_box_nonce' );

		$price = get_post_meta( $post->ID, '_we_meal_price', true );

		?>
		<label for="we_meal_price_field">
			<input placeholder="Meal price" name="we_meal_price" type="number" step="0.01" value="<?php echo esc_attr( $price ); ?>" class="form-control" style="width: 100%;" >
		</label>
		<?php
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param $post_id
	 *
	 * @return void
	 */
	public function save_meta_box( $post_id ): void {
		if ( ! isset( $_POST['we_meal_price_meta_box_nonce'] ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options', $post_id ) ) {
			return;
		}

		$nonce = sanitize_key( wp_unslash( $_POST['we_meal_price_meta_box_nonce'] ) );

		if ( ! wp_verify_nonce( $nonce, 'we_meal_price_meta_box' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['we_meal_price'] ) ) {
			return;
		}

		$price = sanitize_text_field( wp_unslash( $_POST['we_meal_price'] ) );

		update_post_meta( $post_id, '_we_meal_price', $price );
	}
}
