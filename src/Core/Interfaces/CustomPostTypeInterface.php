<?php

namespace PhpKnight\WeMeal\Core\Interfaces;

/**
 * Interface CustomPostTypeInterface
 *
 * @package PhpKnight\WeMeal\Core\Interfaces
 */
interface CustomPostTypeInterface {

	/**
	 * Register the custom post type.
	 *
	 * @return void
	 */
	public function register_post_type(): void;
}
