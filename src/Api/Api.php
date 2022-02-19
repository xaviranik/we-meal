<?php

namespace PhpKnight\WeMeal\Api;

use WP_REST_Controller;
use PhpKnight\WeMeal\Api\Controllers\MealCapabilityController;

class Api {

	/**
	 * Register all the necessary controllers for APIs.
	 *
	 * @var array
	 */
	protected static $controllers = [
		MealCapabilityController::class,
	];

	/**
	 * Registers services with the container.
	 *
	 * @return void
	 */
	public static function register(): void {
		foreach ( self::$controllers as $controller ) {
			if ( ! class_exists( $controller ) ) {
				continue;
			}

			if ( is_subclass_of( $controller, WP_REST_Controller::class ) ) {
				$api_controller = new $controller();
				$api_controller->register_routes();
			}
		}
	}
}
