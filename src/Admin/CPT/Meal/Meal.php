<?php

namespace PhpKnight\WeMeal\Admin\CPT\Meal;

use PhpKnight\WeMeal\Core\Abstracts\CustomPostType;

/**
 * Class Meal.
 *
 * @package PhpKnight\WeMeal\Admin\CPT\Meal
 */
class Meal extends CustomPostType {

	/**
	 * Meal CPT constructor.
	 *
	 * @param PriceMetaBox $price_meta_box
	 * @param Customizer $customizer
	 */
	public function __construct( PriceMetaBox $price_meta_box, Customizer $customizer ) {
		parent::__construct();

		$price_meta_box->register_hooks();
		$customizer->register_hooks();
	}

	/**
	 * Registers all hooks for the class.
	 *
	 * @return void
	 */
	public function register_hooks(): void {
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
			'add_item'               => __( 'Add Meal', 'we-meal' ),
			'new_item'               => __( 'New Meal', 'we-meal' ),
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
			'capability_type' => 'meal', //custom capability type
			'map_meta_cap'    => true, //map_meta_cap must be true
		];
	}
}

