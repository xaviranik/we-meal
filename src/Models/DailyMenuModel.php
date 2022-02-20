<?php

namespace PhpKnight\WeMeal\Models;

class DailyMenuModel {

	/**
	 * Daily menu items.
	 *
	 * @var array
	 */
	protected $menus;

	/**
	 * Daily menu meta key.
	 *
	 * @var string
	 */
	public static $daily_menu_meta_key = '_we_meal_daily_menu';

	/**
	 * @return array
	 */
	public function get_menus(): array {
		return $this->menus;
	}

	/**
	 * @param array $menus
	 */
	public function set_menus( array $menus ): void {
		$this->menus = $menus;
	}

	/**
	 * Creates daily menu.
	 *
	 * @param array $meal_ids
	 *
	 * @return void
	 */
	public function create( array $meal_ids ): void {
		$this->set_menus( $meal_ids );
		update_option(
            self::$daily_menu_meta_key, [
				'daily_menu' => $this->get_menus(),
			]
        );
	}

	/**
	 * Gets daily menu.
	 *
	 * @return array
	 */
	public function get(): array {
		return get_option( self::$daily_menu_meta_key, [] );
	}
}
