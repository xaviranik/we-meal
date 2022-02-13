<?php

namespace PhpKnight\WeMeal\Core\Abstracts;

use PhpKnight\WeMeal\Core\Interfaces\HookableInterface;
use PhpKnight\WeMeal\Core\Interfaces\CustomPostTypeInterface;

/**
 * Class CustomPostType
 *
 * @package PhpKnight\WeMeal\Core\Abstracts
 */
abstract class CustomPostType implements CustomPostTypeInterface, HookableInterface {

	/**
	 *  Custom Post Constructor.
	 */
	public function __construct() {
		$this->register_post_type();
	}
}
