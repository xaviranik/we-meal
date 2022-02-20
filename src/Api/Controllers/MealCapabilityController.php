<?php

namespace PhpKnight\WeMeal\Api\Controllers;

use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use WP_REST_Controller;
use PhpKnight\WeMeal\Api\Api;

class MealCapabilityController extends WP_REST_Controller {

	/**
	 * Meal capability controller constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->namespace = Api::$namespace;
		$this->rest_base = 'capability';
	}

	/**
	 * Registers the routes for the objects of the controller.
	 *
	 * @return void
	 */
	public function register_routes(): void {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_current_item' ],
					'permission_callback' => [ $this, 'get_item_permissions_check' ],
					'args'                => [],
				],
				'schema' => [ $this, 'get_item_schema' ],
			]
		);

		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/(?P<user_id>\d+)',
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_item' ],
					'permission_callback' => [ $this, 'get_item_permissions_check' ],
					'args'                => [
						'user_id' => [
							'description'       => __( 'Unique identifier for the user.', 'we-meal' ),
							'type'              => 'integer',
							'required'          => false,
							'sanitize_callback' => 'sanitize_text_field',
							'validate_callback' => 'rest_validate_request_arg',
						],
					],
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
	 * Retrieves the item's schema, conforming to JSON Schema.
	 *
	 * @return array Item schema data.
	 */
	public function get_item_schema(): array {
		if ( $this->schema ) {
			return $this->add_additional_fields_schema( $this->schema );
		}

		$schema = [
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			'title'      => 'capability',
			'type'       => 'object',
			'properties' => [
				'user_id' => [
					'description' => __( 'Unique identifier for the user.', 'we-meal' ),
					'type'        => 'integer',
					'required'    => true,
				],
			],
		];

		$this->schema = $schema;

		return $this->add_additional_fields_schema( $this->schema );
	}

	/**
	 * Retrieves a specific item.
	 *
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function get_current_item(): WP_REST_Response {
		if ( ! is_user_logged_in() ) {
			return new WP_Error( 'rest_not_logged_in', __( 'You are not currently logged in.', 'we-meal' ), [ 'status' => 401 ] );
		}

		$user_id         = get_current_user_id();
		$can_manage_meal = user_can( $user_id, 'manage_meal' );

		return new WP_REST_Response(
			[
				'user_id'         => $user_id,
				'can_manage_meal' => $can_manage_meal,
			]
		);
	}

	/**
	 * Retrieves a specific item.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 *
	 * @return WP_REST_Response Response object on success, or WP_Error object on failure.
	 */
	public function get_item( $request ): WP_REST_Response {
		$user_id         = $request->get_param( 'user_id' );
		$can_manage_meal = user_can( $user_id, 'manage_meal' );

		return new WP_REST_Response(
			[
				'user_id'         => $user_id,
				'can_manage_meal' => $can_manage_meal,
			]
        );
	}
}
