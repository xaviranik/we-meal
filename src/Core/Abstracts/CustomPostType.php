<?php

namespace PhpKnight\WeMeal\Core\Abstracts;

use PhpKnight\WeMeal\Core\Interfaces\HookableInterface;
use PhpKnight\WeMeal\Core\Interfaces\CustomPostTypeInterface;

/**
 * Class CPT
 *
 * @package PhpKnight\WeMeal\Core\Abstracts
 */
abstract class CustomPostType implements CustomPostTypeInterface, HookableInterface {

	/**
	 * @var string
	 */
	protected $post_type;

	/**
	 * @var array
	 */
	protected $args = [];

	/**
	 *  Custom Post Constructor.
	 */
	public function __construct() {
		$this->set_post_type();
		$this->set_args();
		$this->register_post_type();
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 */
	public function register_post_type(): void {
		if ( ! $this->post_type || empty( $this->args ) ) {
			return;
		}
		register_post_type( $this->post_type, $this->args );
	}

	/**
	 * Sets the post type slug.
	 *
	 * @return void
	 */
	abstract protected function set_post_type(): void;

	/**
	 * Sets the post type arguments.
	 *
	 * @return void
	 */
	abstract protected function set_args(): void;

}
