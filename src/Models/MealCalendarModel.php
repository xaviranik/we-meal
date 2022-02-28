<?php

namespace PhpKnight\WeMeal\Models;

class MealCalendarModel {

	/**
	 * @var string
	 */
	protected $date;

	/**
	 * @var int
	 */
	protected $meal_id;

	/**
	 * @return int
	 */
	public function get_meal_id(): int {
		return $this->meal_id;
	}

	/**
	 * @param int $meal_id
	 *
	 * @return MealCalendarModel
	 */
	public function set_meal_id( int $meal_id ): MealCalendarModel {
		$this->meal_id = $meal_id;

		return $this;
	}

	/**
	 * @var string
	 */
	protected $meal_name;

	/**
	 * @return string
	 */
	public function get_date(): string {
		return $this->date;
	}

	/**
	 * @param string $date
	 *
	 * @return MealCalendarModel
	 */
	public function set_date( string $date ): MealCalendarModel {
		$this->date = current_datetime()->modify( $date )->format( 'Y-m-d' );

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_meal_name(): string {
		$this->meal_name = get_the_title( $this->get_meal_id() );
		return $this->meal_name;
	}

	/**
	 * @param string $meal_name
	 *
	 * @return MealCalendarModel
	 */
	public function set_meal_name( string $meal_name ): MealCalendarModel {
		$this->meal_name = $meal_name;

		return $this;
	}
}
