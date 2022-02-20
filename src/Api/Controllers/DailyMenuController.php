<?php

namespace PhpKnight\WeMeal\Api\Controllers;

use WP_Error;
use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use PhpKnight\WeMeal\Api\Api;
use PhpKnight\WeMeal\Models\DailyMenuModel;

class DailyMenuController extends WP_REST_Controller {

	/**
	 * DailyMenuModel instance.
	 *
	 * @var DailyMenuModel
	 */
	protected $daily_menu_model;

	/**
	 * Meal menu controller constructor.
	 *
	 * @return void
	 */
	public function __construct( DailyMenuModel $daily_menu_model ) {
		$this->namespace = Api::$namespace;
		$this->rest_base = 'menu';

		$this->daily_menu_model = $daily_menu_model;
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
					'callback'            => [ $this, 'get_item' ],
					'permission_callback' => [ $this, 'get_item_permissions_check' ],
					'args'                => [],
				],
				[
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'create_item' ],
					'permission_callback' => [ $this, 'create_item_permissions_check' ],
					'args' => [
						'meal_id' => [
							'description'          => __( 'Meal ID(s)', 'we-meal' ),
							'required'             => true,
							'type'                 => 'array',
							'validate_callback'    => [ $this, 'validate_meal_id' ],
							'items'                => [
								'required'          => true,
								'type'              => 'integer',
								'sanitize_callback' => 'absint',
							],
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
		return is_user_logged_in() && current_user_can( 'read' );
	}

	/**
	 * Checks if a given request has access to create items.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return bool|true True if the request has access to create items, WP_Error object otherwise.
	 */
	public function create_item_permissions_check( $request ): bool {
		return current_user_can( 'manage_meal' );
	}

	/**
	 * Validates the meal ID.
	 *
	 * @param $meal_id
	 * @param WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function validate_meal_id( $meal_id, WP_REST_Request $request ): bool {
		return ! empty( $meal_id ) && array_filter( $meal_id, 'is_int' );
	}

	/**
	 * Retrieves one item from the collection.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function get_item( $request ) {
		return rest_ensure_response( $this->daily_menu_model->get() );
	}

	/**
	 * Creates one item from the collection.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function create_item( $request ) {
		$this->daily_menu_model->create( $request->get_param( 'meal_id' ) );

		return rest_ensure_response(
			[
				'status' => 'success',
				'meal_id' => $request->get_param( 'meal_id' ),
			]
		);
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
				'meal_id' => [
					'description' => __( 'Meal ID(s)', 'we-meal' ),
					'required'    => true,
					'type'        => 'array',
					'items'       => [
						'required'          => true,
						'type'              => 'integer',
						'sanitize_callback' => 'absint',
					],
				],
			],
		];

		$this->schema = $schema;

		return $this->add_additional_fields_schema( $this->schema );
	}
}
