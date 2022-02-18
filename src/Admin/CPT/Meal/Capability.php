<?php

namespace PhpKnight\WeMeal\Admin\CPT\Meal;

use PhpKnight\WeMeal\Core\Interfaces\HookableInterface;

class Capability implements HookableInterface {

	/**
	 * Registers all hooks for the class.
	 *
	 * @return void
	 */
	public function register_hooks(): void {
		add_action( 'init', [ $this, 'add_meal_manager_capabilities' ], 11 );
	}

	/**
	 * Adds meal manager capabilities for admin.
	 *
	 * @return void
	 */
	public function add_meal_manager_capabilities(): void {
		$role = get_role( 'administrator' );
		$role->add_cap( 'manage_meal', true );
		$role->add_cap( 'edit_meals', true );
		$role->add_cap( 'edit_others_meals', true );
		$role->add_cap( 'delete_meals', true );
		$role->add_cap( 'publish_meals', true );
		$role->add_cap( 'edit_published_meals', true );
		$role->add_cap( 'delete_published_meals', true );
	}
}
