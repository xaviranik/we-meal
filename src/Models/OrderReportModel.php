<?php

namespace PhpKnight\WeMeal\Models;

class OrderReportModel {

	/**
	 * @var int
	 */
	protected $user_id;

	/**
	 * @var string
	 */
	protected $start_date;

	/**
	 * @var string
	 */
	protected $end_date;

	/**
	 * @var OrderStatModel
	 */
	protected $order_stat_model;

	public function __construct( OrderStatModel $order_stat_model ) {
		$this->order_stat_model = $order_stat_model;
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
	 * @return OrderReportModel
	 */
	public function set_user_id( int $user_id ): OrderReportModel {
		$this->user_id = $user_id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_start_date(): string {
		return $this->start_date;
	}

	/**
	 * @param string $start_date
	 *
	 * @return OrderReportModel
	 */
	public function set_start_date( string $start_date ): OrderReportModel {
		$this->start_date = current_datetime()->modify( $start_date )->format( 'Y-m-d' );

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_end_date(): string {
		return $this->end_date;
	}

	/**
	 * @param string $end_date
	 *
	 * @return OrderReportModel
	 */
	public function set_end_date( string $end_date ): OrderReportModel {
		$this->end_date = current_datetime()->modify( $end_date )->format( 'Y-m-d' );

		return $this;
	}

	/**
	 * Gets the meal calendar data.
	 *
	 * @return array
	 */
	public function get_meal_calendar_data_by_user(): array {
		$calendar_data = [];

		$orders = $this->get_order_data_by_user();

		foreach ( $orders as $order ) {
			$calendar = new MealCalendarModel();
			$calendar->set_date( $order->created_at )
					->set_meal_id( $order->meal_id );

			$calendar_data[] = [
				'event' => $calendar->get_meal_name(),
				'date'  => $calendar->get_date(),
			];
		}

		return $calendar_data;
	}

	/**
	 * Gets the order report data.
	 *
	 * @return array
	 */
	public function get_order_data_by_user(): array {
		global $wpdb;

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT *
				FROM
					{$wpdb->prefix}we_meal_orders
				WHERE
					(user_id = %d
					AND created_at BETWEEN %s AND %s);",
				$this->get_user_id(),
				$this->get_start_date(),
				$this->get_end_date()
			)
		);
	}

	/**
	 * Gets the order statistics.
	 *
	 * @return array
	 */
	public function get_order_stat_by_user(): array {
		global $wpdb;

		$result = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT SUM(price) AS total_price, COUNT(*) as total_orders
				FROM
					{$wpdb->prefix}we_meal_orders
				WHERE
					(user_id = %d
					AND created_at BETWEEN %s AND %s);",
				$this->get_user_id(),
				$this->get_start_date(),
				$this->get_end_date()
			)
		);

		$this->order_stat_model->set_user_id( $this->get_user_id() )
		    ->set_total_price( $result->total_price )
		    ->set_total_orders( $result->total_orders );

		return [
			'user_id'      => $this->order_stat_model->get_user_id(),
			'total_price'  => $this->order_stat_model->get_total_price(),
			'total_orders' => $this->order_stat_model->get_total_orders(),
		];
	}

	/**
	 * Gets order overview data.
	 *
	 * @return array
	 */
	public function get_order_overview(): array {
		global $wpdb;

		return $wpdb->get_results(
			$wpdb->prepare(
				'SELECT
				meal_id, COUNT(*) as order_count
			FROM
				wp_we_meal_orders
			WHERE
				created_at >= CURDATE()
				AND created_at < CURDATE() + INTERVAL 1 DAY
			GROUP BY
				meal_id;'
			)
		);
	}
}
