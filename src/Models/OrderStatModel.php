<?php

namespace PhpKnight\WeMeal\Models;

use PhpKnight\WeMeal\Helper;

class OrderStatModel {

	/**
	 * @var int
	 */
	protected $user_id;

	/**
	 * @var int
	 */
	protected $total_orders;

	/**
	 * @var string
	 */
	protected $total_price;

	/**
	 * @return int
	 */
	public function get_user_id(): int {
		return $this->user_id;
	}

	/**
	 * @param int $user_id
	 *
	 * @return OrderStatModel
	 */
	public function set_user_id( int $user_id ): OrderStatModel {
		$this->user_id = $user_id;

		return $this;
	}

	/**
	 * @return int
	 */
	public function get_total_orders(): int {
		return $this->total_orders;
	}

	/**
	 * @param int $total_orders
	 *
	 * @return OrderStatModel
	 */
	public function set_total_orders( int $total_orders ): OrderStatModel {
		$this->total_orders = $total_orders;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_total_price(): string {
		$this->total_price = Helper::format_price( $this->total_price );
		return $this->total_price;
	}

	/**
	 * @param float $total_price
	 *
	 * @return OrderStatModel
	 */
	public function set_total_price( float $total_price ): OrderStatModel {
		$this->total_price = $total_price;

		return $this;
	}



}
