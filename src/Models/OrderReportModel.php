<?php

namespace PhpKnight\WeMeal\Models;

class OrderReportModel {

	/**
	 * Gets the meal calendar data.
	 *
	 * @param int $user_id
	 * @param string $start_date
	 * @param string $end_date
	 *
	 * @return array
	 */
	public function get_meal_calendar_data_by_user( int $user_id, string $start_date, string $end_date ): array {
		return $this->get_order_data_by_user( $user_id, $start_date, $end_date );
	}

	/**
	 * Gets the order report data.
	 *
	 * @param int $user_id
	 * @param string $start_date
	 * @param string $end_date
	 *
	 * @return array
	 */
	public function get_order_data_by_user( int $user_id, string $start_date, string $end_date ): array {
		global $wpdb;

		$start_date = current_datetime()->modify( $start_date )->format( 'Y-m-d' );
		$end_date   = current_datetime()->modify( $end_date )->format( 'Y-m-d' );

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT *
				FROM
					{$wpdb->prefix}we_meal_orders
				WHERE
					user_id = %d
					AND created_at BETWEEN %s AND %s;",
				$user_id, $start_date, $end_date
			)
		);
	}
}
