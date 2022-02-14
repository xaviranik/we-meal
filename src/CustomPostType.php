<?php

namespace PhpKnight\WeMeal;

use PhpKnight\WeMeal\Admin\CPT\Meal\Meal;

class CustomPostType {

	/**
	 * Holds plugin's CPT classes.
	 *
	 * @var string[]
	 */
	protected static $custom_post_types = [
		Meal::class,
	];

	/**
	 * Loops over the $custom_post_type array and
	 * Registers custom post types.
	 *
	 * @throws \ReflectionException
	 *
	 * @return void
	 */
	public static function register(): void {
		foreach ( self::$custom_post_types as $post_type ) {
			if ( class_exists( $post_type ) && is_subclass_of( $post_type, Core\Abstracts\CustomPostType::class ) ) {
				$cpt = WeMeal::$container->get( $post_type );
				$cpt->register_hooks();
			}
		}
	}
}
