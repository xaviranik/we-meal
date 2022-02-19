<?php

namespace PhpKnight\WeMeal\Api\Controllers;

use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use WP_REST_Controller;

class MealCapabilityController extends WP_REST_Controller {

	/**
	 * Meal capability controller constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->namespace = 'wemeal/v1';
		$this->rest_base = 'capability';
	}

	/**
	 * Registers the routes for the objects of the controller.
	 *
	 * @return void
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/(?P<user_id>\d+)',
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_item' ],
					'permission_callback' => [ $this, 'get_item_permissions_check' ],
					'args'                => [],
				],
				'schema' => [ $this, 'get_item_schema' ],
			]
		);
	}

	/**
	 * Checks if a given request has access to get item.
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function get_item_permissions_check( $request ): bool {
		return current_user_can( 'manage_meal' );
	}

	/**
	 * Retrieves a specific taxonomy.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function get_item( $request ) {
		// todo: get capability for user
		return $request->get_param( 'user_id' );
	}
}
