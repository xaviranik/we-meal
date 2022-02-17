<?php

namespace PhpKnight\WeMeal;

/**
 * Activation class.
 *
 * @package PhpKnight\WeMeal
 */
class Activate {

	/**
	 * Activation hook.
	 *
	 * @return void
	 */
	public static function handle(): void {
		Installer::run();
	}
}
