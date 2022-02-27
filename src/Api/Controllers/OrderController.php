<?php

namespace PhpKnight\WeMeal\Api\Controllers;

use WP_Error;
use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use PhpKnight\WeMeal\Api\Api;
use PhpKnight\WeMeal\Models\OrderModel;

class OrderController extends WP_REST_Controller {

	/**
	 * OrderModel instance.
	 *
	 * @var OrderModel $order_model
	 */
	protected $order_model;

	/**
	 * Meal capability controller constructor.
	 *
	 * @return void
	 */
	public function __construct( OrderModel $order_model ) {
		$this->namespace = Api::$namespace;
		$this->rest_base = 'orders';

		$this->order_model = $order_model;
	}

	/**
	 * Registers the routes for the objects of the controller.
	 *
	 * @return void
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/(?P<id>\d+)',
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_item' ],
					'permission_callback' => [ $this, 'get_item_permissions_check' ],
					'args'                => [
						'id' => [
							'description'       => __( 'Unique identifier for the order.', 'we-meal' ),
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

		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			[
				[
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'create_item' ],
					'permission_callback' => [ $this, 'create_item_permissions_check' ],
					'args'                => [
						'meal_id' => [
							'description'       => __( 'Unique identifier for the meal.', 'we-meal' ),
							'type'              => 'integer',
							'required'          => true,
							'sanitize_callback' => 'sanitize_text_field',
							'validate_callback' => 'rest_validate_request_arg',
						],
					],
				],
				'schema' => [ $this, 'get_item_schema' ],
			]
		);

		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/can-place',
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'can_place_order' ],
					'permission_callback' => [ $this, 'get_item_permissions_check' ],
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
	 *
	 * @return bool|true True if the request has access to create items, WP_Error object otherwise.
	 */
	public function create_item_permissions_check( $request ): bool {
		return is_user_logged_in() && current_user_can( 'read' );
	}

	/**
	 * Creates one item from the collection.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function create_item( $request ) {
		$this->order_model
			->set_user_id( get_current_user_id() )
			->set_meal_id( $request->get_param( 'meal_id' ) );

		$response = $this->order_model->save();

		return rest_ensure_response( $response );
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
					'description' => __( 'Unique identifier for the meal.', 'we-meal' ),
					'type'        => 'integer',
					'required'    => true,
				],
			],
		];

		$this->schema = $schema;

		return $this->add_additional_fields_schema( $this->schema );
	}

	/**
	 * Checks if a user can place an order on current day.
	 *
	 * @param $request
	 *
	 * @return WP_Error|\WP_HTTP_Response|WP_REST_Response
	 */
	public function can_place_order( $request ) {
		$this->order_model->set_user_id( get_current_user_id() );

		$response = $this->order_model->can_user_place_order();

		return rest_ensure_response( $response );
	}
}
