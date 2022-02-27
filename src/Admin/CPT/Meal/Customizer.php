<?php

namespace PhpKnight\WeMeal\Admin\CPT\Meal;

use PhpKnight\WeMeal\Core\Interfaces\HookableInterface;
use PhpKnight\WeMeal\Helper;

class Customizer implements HookableInterface {

	/**
	 * Registers all hooks for the class.
	 *
	 * @return void
	 */
	public function register_hooks(): void {
		add_filter( 'enter_title_here', [ $this, 'custom_enter_title' ] );
		add_filter( 'manage_meal_posts_columns', [ $this, 'set_custom_columns' ] );
		add_action( 'manage_meal_posts_custom_column', [ $this, 'custom_column_data' ], 10, 2 );
		add_action( 'admin_head', [ $this, 'remove_media_controls' ] );
		add_filter( 'tiny_mce_before_init', [ $this, 'custom_tiny_mce_settings' ] );
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
	 * Sets the custom columns for the Meal post type.
	 *
	 * @param $columns
	 *
	 * @return array
	 */
	public function set_custom_columns( $columns ): array {
		$columns['meal_price'] = __( 'Price', 'we-meal' );
		return $columns;
	}

	/**
	 * Adds the custom columns' data to the Meal post type.
	 *
	 * @param $column
	 * @param $post_id
	 *
	 * @return void
	 */
	public function custom_column_data( $column, $post_id ): void {
		if ( 'meal_price' === $column ) {
			$price = get_post_meta( $post_id, PriceMetaBox::$price_meta_key, true );
			echo esc_html( Helper::format_price( $price ) );
		}
	}

	/**
	 * Removes the media controls from the Meal post type.
	 *
	 * @return void
	 */
	public function remove_media_controls(): void {
		if ( 'meal' === get_post_type() ) {
			remove_action( 'media_buttons', 'media_buttons' );
		}
	}

	/**
	 * Customizes the TinyMCE settings for the Meal post type.
	 *
	 * @param $in
	 *
	 * @return array
	 */
	public function custom_tiny_mce_settings( $in ): array {
		if ( 'meal' === get_post_type() ) {
			$in['toolbar1'] = '';
			$in['toolbar2'] = '';
			$in['toolbar'] = false;
		}

		return $in;
	}

}
