<?php

namespace PhpKnight\WeMeal\Models;

use PhpKnight\WeMeal\Admin\CPT\Meal\PriceMetaBox;
use PhpKnight\WeMeal\Helper;
use WP_Error;

class OrderModel {

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var int
	 */
	protected $user_id;

	/**
	 * @var int
	 */
	protected $meal_id;

	/**
	 * @var float
	 */
	protected $price;

	/**
	 * @var string
	 */
	protected $formatted_price;

	/**
	 * @var string
	 */
	protected $status;

	/**
	 * @var string
	 */
	protected $created_at;

	/**
	 * @var string
	 */
	protected $updated_at;

	/**
	 * @return int
	 */
	public function get_id(): int {
		return $this->id;
	}

	/**
	 * @param int $id
	 *
	 * @return OrderModel
	 */
	public function set_id( int $id ): OrderModel {
		$this->id = $id;

		return $this;
	}

	/**
	 * @return int
	 */
	public function get_user_id(): int {
		return $this->user_id;
	}

	/**
	 * @param int $user_id
	 *
	 * @return OrderModel
	 */
	public function set_user_id( int $user_id ): OrderModel {
		$this->user_id = $user_id;

		return $this;
	}

	/**
	 * @return int
	 */
	public function get_meal_id(): int {
		return $this->meal_id;
	}

	/**
	 * @param int $meal_id
	 *
	 * @return OrderModel
	 */
	public function set_meal_id( int $meal_id ): OrderModel {
		$this->meal_id = $meal_id;

		return $this;
	}

	/**
	 * @return float
	 */
	public function get_price(): float {
		$this->price = $this->price ?? floatval( get_post_meta( $this->get_meal_id(), PriceMetaBox::$price_meta_key, true ) );
		return $this->price;
	}

	/**
	 * @param float $price
	 *
	 * @return OrderModel
	 */
	public function set_price( float $price ): OrderModel {
		$this->price = $price;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_formatted_price(): string {
		return $this->formatted_price = Helper::format_price( $this->get_price() );
	}

	/**
	 * @param string $formatted_price
	 *
	 * @return OrderModel
	 */
	public function set_formatted_price( string $formatted_price ): OrderModel {
		$this->formatted_price = $formatted_price;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_status(): string {
		return $this->status;
	}

	/**
	 * @param string $status
	 *
	 * @return OrderModel
	 */
	public function set_status( string $status ): OrderModel {
		$this->status = $status;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_created_at(): string {
		return $this->created_at;
	}

	/**
	 * @param string $created_at
	 *
	 * @return OrderModel
	 */
	public function set_created_at( string $created_at ): OrderModel {
		$this->created_at = $created_at;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_updated_at(): string {
		return $this->updated_at;
	}

	/**
	 * @param string $updated_at
	 *
	 * @return OrderModel
	 */
	public function set_updated_at( string $updated_at  ): OrderModel {
		$this->updated_at = $updated_at ?? '';

		return $this;
	}

	/**
	 * @return array
	 */
	public function get_orders(): array {
		global $wpdb;

		$orders = [];

		$results = $wpdb->get_results(
			"SELECT *
			FROM {$wpdb->prefix}we_meal_orders"
        );

		foreach ( $results as $result ) {
			$this->set_id( $result->id )
				->set_user_id( $result->user_id )
				->set_meal_id( $result->meal_id )
				->set_price( $result->price )
				->set_status( $result->status )
				->set_created_at( $result->created_at )
				->set_updated_at( $result->updated_at ?? '' );

			$meal = new MealModel();
			$meal->set_id( $this->get_meal_id() );

			$orders[] = [
				'id'              => $this->get_id(),
				'user_id'         => $this->get_user_id(),
				'user_name'       => get_userdata( $this->get_user_id() )->display_name,
				'meal_id'         => $this->get_meal_id(),
				'meal_name'       => $meal->get_name(),
				'price'           => $this->get_price(),
				'formatted_price' => $this->get_formatted_price(),
				'status'          => $this->get_status(),
				'created_at'      => $this->get_created_at(),
				'updated_at'      => $this->get_updated_at(),
			];
		}

		return $orders;
	}

	/**
	 * Save the order to the database.
	 *
	 * @return string[]|WP_Error
	 */
	public function save(): array {
		if ( ! $this->can_user_place_order() ) {
			return [
				'success' => false,
				'message' => __( 'You have already ordered today.', 'we-meal' ),
			];
		}

		return $this->insert_oder();
	}

	/**
	 * Insert the order to the database.
	 *
	 * @return array|WP_Error
	 */
	private function insert_oder(): array {
		global $wpdb;

		$created = $wpdb->insert(
			$wpdb->prefix . 'we_meal_orders',
			[
				'user_id' => $this->get_user_id(),
				'meal_id' => $this->get_meal_id(),
				'price'   => $this->get_price(),
			]
		);

		if ( ! $created ) {
			return new WP_Error(
				'rest_wemeal_order_creation_failed',
				__( 'Cannot create a comment with that type.', 'we-meal' ),
				[ 'status' => 400 ]
			);
		}

		return [
			'success' => true,
			'message' => __( 'Order created successfully', 'we-meal' ),
		];
	}

	/**
	 * Gets the count of orders for current user for current day.
	 *
	 * @return bool
	 */
	public function can_user_place_order(): bool {
		global $wpdb;

		$count = (int) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*)
					FROM {$wpdb->prefix}we_meal_orders
					WHERE user_id = %d AND DATE(created_at) = CURDATE()",
				$this->get_user_id()
			)
		);

		return $count === 0;
	}
}
