<?php

namespace PhpKnight\WeMeal\Api;

use WP_REST_Controller;
use PhpKnight\WeMeal\WeMeal;
use PhpKnight\WeMeal\Api\Controllers\OrderController;
use PhpKnight\WeMeal\Api\Controllers\DailyMenuController;
use PhpKnight\WeMeal\Api\Controllers\MealCapabilityController;

class Api {

	/**
	 * Namespace for the REST API.
	 *
	 * @var string
	 */
	public static $namespace = 'wemeal/v1';

	/**
	 * Register all the necessary controllers for APIs.
	 *
	 * @var array
	 */
	protected static $controllers = [
		MealCapabilityController::class,
		DailyMenuController::class,
		OrderController::class,
	];

	/**
	 * Registers services with the container.
	 *
	 * @return void
	 * @throws \ReflectionException
	 */
	public static function register(): void {
		foreach ( self::$controllers as $controller ) {
			if ( ! class_exists( $controller ) ) {
				continue;
			}

			if ( is_subclass_of( $controller, WP_REST_Controller::class ) ) {
				$api_controller = WeMeal::$container->get( $controller );
				$api_controller->register_routes();
			}
		}
	}
}
