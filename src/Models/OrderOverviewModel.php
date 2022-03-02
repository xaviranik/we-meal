<?php

namespace PhpKnight\WeMeal\Models;

class OrderOverviewModel {

	/**
	 * @var int
	 */
	protected $meal_id;

	/**
	 * @var string
	 */
	protected $meal_name;

	/**
	 * @var int
	 */
	protected $order_count;

	/**
	 * @return int
	 */
	public function get_meal_id(): int {
		return $this->meal_id;
	}

	/**
	 * @param int $meal_id
	 *
	 * @return OrderOverviewModel
	 */
	public function set_meal_id( int $meal_id ): OrderOverviewModel {
		$this->meal_id = $meal_id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_meal_name(): string {
		$this->meal_name = get_the_title( $this->meal_id );
		return $this->meal_name;
	}

	/**
	 * @param string $meal_name
	 *
	 * @return OrderOverviewModel
	 */
	public function set_meal_name( string $meal_name ): OrderOverviewModel {
		$this->meal_name = $meal_name;

		return $this;
	}

	/**
	 * @return int
	 */
	public function get_order_count(): int {
		return $this->order_count;
	}

	/**
	 * @param int $order_count
	 *
	 * @return OrderOverviewModel
	 */
	public function set_order_count( int $order_count ): OrderOverviewModel {
		$this->order_count = $order_count;

		return $this;
	}
}
