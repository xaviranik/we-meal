<?php

namespace PhpKnight\WeMeal\Admin\CPT\Meal;

use PhpKnight\WeMeal\Core\Abstracts\CustomPostType;
use WP_Post;

/**
 * Class Meal.
 *
 * @package PhpKnight\WeMeal\Admin\CPT\Meal
 */
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
	 * Sets the post type slug.
	 *
	 * @return void
	 */
	protected function set_post_type(): void {
		$this->post_type = 'meal';
	}

	/**
	 * Sets the post type arguments.
	 *
	 * @return void
	 */
	protected function set_args(): void {
		// The $labels describes how the post type appears.
		$labels = [
			'name'                   => __( 'Meals', 'we-meal' ),
			'singular_name'          => __( 'Meal', 'we-meal' ),
			'add_new_item'           => __( 'Add Meal', 'we-meal' ),
			'add_new'                => __( 'Add Meal', 'we-meal' ),
			'edit_item'              => __( 'Edit Meal', 'we-meal' ),
			'featured_image'         => __( 'Meal Image', 'we-meal' ),
			'set_featured_image'     => __( 'Upload Meal Image', 'we-meal' ),
			'remove_featured_image'  => __( 'Remove Meal Images', 'we-meal' ),
			'not_found'              => __( 'No Meals Found', 'we-meal' ),
			'not_found_in_trash'     => __( 'No Meals found in Trash', 'we-meal' ),
			'search_items'           => __( 'Search Meals', 'we-meal' ),
			'view_item'              => __( 'View Meal', 'we-meal' ),
			'view_items'             => __( 'View Meals', 'we-meal' ),
			'item_updated'           => __( 'Meal Updated', 'we-meal' ),
			'item_published'         => __( 'Meal Published', 'we-meal' ),
			'item_reverted_to_draft' => __( 'Meal Reverted to Draft', 'we-meal' ),
			'item_scheduled'         => __( 'Meal Scheduled', 'we-meal' ),
		];

		// The $supports parameter describes what the post type supports
		$supports = [
			'title',
			'editor',
			'thumbnail',
		];

		// The $args parameter holds important parameters for the custom post type
		$this->args = [
			'labels'              => $labels,
			'supports'            => $supports,
			'description'         => 'weMeal',
			'taxonomies'          => [ 'category' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => false,
			'menu_position'       => 5,
			'menu_icon'           => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => false,
			'capability_type'     => 'post',
		];
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
	 * @param WP_Post $post The post object.
	 *
	 * @return void
	 */
	public function render_meta_box_content( WP_Post $post ): void {
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

		if ( ! empty( $price ) ) {
			update_post_meta( $post_id, '_we_meal_price', $price );
		} else {
			delete_post_meta( $post_id, '_we_meal_price' );
		}
	}
}

