<?php

namespace PhpKnight\WeMeal\Api\Controllers\Reports;

use PhpKnight\WeMeal\Models\OrderReportModel;
use WP_REST_Controller;
use PhpKnight\WeMeal\Api\Api;
use WP_REST_Request;
use WP_REST_Server;

class OrderReportController extends WP_REST_Controller {

	/**
	 * @var OrderReportModel
	 */
	protected $order_report_model;

	/**
	 * Meal menu controller constructor.
	 *
	 * @return void
	 */
	public function __construct( OrderReportModel $order_report_model ) {
		$this->namespace = Api::$namespace;
		$this->rest_base = 'reports';

		$this->order_report_model = $order_report_model;
	}

	/**
	 * Registers the routes for the objects of the controller.
	 *
	 * @return void
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/user/meal-calendar',
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_meal_calendar_data' ],
					'permission_callback' => [ $this, 'get_order_report_permissions_check' ],
					'args'                => [
						'user_id' => [
							'description'       => __( 'Unique identifier for the user.', 'we-meal' ),
							'required'          => false,
							'type'              => 'integer',
							'sanitize_callback' => 'absint',
						],
						'start_date' => [
							'description'       => __( 'Start date for the report.', 'we-meal' ),
							'required'          => true,
							'type'              => 'string',
							'sanitize_callback' => 'sanitize_text_field',
						],
						'end_date' => [
							'description'       => __( 'End date for the report.', 'we-meal' ),
							'required'          => true,
							'type'              => 'string',
							'sanitize_callback' => 'sanitize_text_field',
						],
					],
				],
				'schema' => [ $this, 'get_public_item_schema' ],
			]
		);

		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base . '/user/order/stat',
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_order_stat' ],
					'permission_callback' => [ $this, 'get_order_report_permissions_check' ],
					'args'                => [
						'user_id' => [
							'description'       => __( 'Unique identifier for the user.', 'we-meal' ),
							'required'          => false,
							'type'              => 'integer',
							'sanitize_callback' => 'absint',
						],
						'start_date' => [
							'description'       => __( 'Start date for the report.', 'we-meal' ),
							'required'          => true,
							'type'              => 'string',
							'sanitize_callback' => 'sanitize_text_field',
						],
						'end_date' => [
							'description'       => __( 'End date for the report.', 'we-meal' ),
							'required'          => true,
							'type'              => 'string',
							'sanitize_callback' => 'sanitize_text_field',
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
		if ( ! is_user_logged_in() ) {
			return false;
		}

		if ( current_user_can( 'manage_meal' ) ) {
			return true;
		}

		if ( get_current_user_id() !== (int) $request->get_param( 'id' ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Gets user order report.
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function get_user_order_report( WP_REST_Request $request ): \WP_REST_Response {
		return rest_ensure_response( $request->get_param( 'id' ) );
	}


	/**
	 * Gets meal calendar data.
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public function get_meal_calendar_data( WP_REST_Request $request ) {
		$user_id = $request->get_param( 'user_id' ) ?? get_current_user_id();

		$this->order_report_model
			->set_user_id( $user_id )
			->set_start_date( $request->get_param( 'start_date' ) )
			->set_end_date( $request->get_param( 'end_date' ) );

		$calendar_data = $this->order_report_model->get_meal_calendar_data_by_user();

		return rest_ensure_response( $calendar_data );
	}

	/**
	 * Gets meal calendar data.
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public function get_order_stat( WP_REST_Request $request ) {
		$user_id = $request->get_param( 'user_id' ) ?? get_current_user_id();

		$this->order_report_model
			->set_user_id( $user_id )
			->set_start_date( $request->get_param( 'start_date' ) )
			->set_end_date( $request->get_param( 'end_date' ) );

		$order_stat = $this->order_report_model->get_order_stat_by_user();

		return rest_ensure_response( $order_stat );
	}
}
