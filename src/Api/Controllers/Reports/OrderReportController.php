<?php

namespace PhpKnight\WeMeal\Api\Controllers\Reports;

use WP_REST_Controller;
use PhpKnight\WeMeal\Api\Api;
use WP_REST_Request;
use WP_REST_Server;

class OrderReportController extends WP_REST_Controller {

	/**
	 * Meal menu controller constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->namespace = Api::$namespace;
		$this->rest_base = 'reports';
	}

	/**
	 * Registers the routes for the objects of the controller.
	 *
	 * @return void
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/user/(?P<id>[\d]+)/order',
			[
				'args'   => [],
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_user_order_report' ],
					'permission_callback' => [ $this, 'get_order_report_permissions_check' ],
					'args'                => [
						'id'    => [
							'description'       => __( 'Unique identifier for the user.', 'we-meal' ),
							'required'          => true,
							'type'              => 'integer',
							'sanitize_callback' => 'absint',
						],
					],
				],
				'schema' => [ $this, 'get_public_item_schema' ],
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
	public function get_order_report_permissions_check( WP_REST_Request $request ): bool {
		return is_user_logged_in() && current_user_can( 'manage_meal' );
	}

	/**
	 * Gets user order report.
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function get_user_order_report( WP_REST_Request $request ): \WP_REST_Response {
		return rest_ensure_response( $request->get_params() );
	}
}
