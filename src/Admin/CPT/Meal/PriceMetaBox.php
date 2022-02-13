<?php

namespace PhpKnight\WeMeal\Admin\CPT\Meal;

use WP_Post;
use PhpKnight\WeMeal\Core\Abstracts\MetaBox;

class PriceMetaBox extends MetaBox {

	/**
	 * Registers all hooks for the class.
	 *
	 * @return void
	 */
	public function register_hooks(): void {
		add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
		add_action( 'save_post_meal', [ $this, 'save_meta_box' ] );
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
