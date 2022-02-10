<?php

namespace PhpKnight\WeMeal\Core\Abstracts;

use PhpKnight\WeMeal\WeMeal;
use PhpKnight\WeMeal\Core\Interfaces\HookableInterface;

/**
 * Handles instantiation of services.
 *
 * @package PhpKnight\WeMeal
 */
abstract class Provider {

	/**
	 * Holds classes that should be instantiated.
	 *
	 * @var array
	 */
	protected $services = [];

	/**
	 * Service provider.
	 *
	 * @param array $services
	 *
	 * @throws \ReflectionException
	 */
	public function __construct( array $services = [] ) {
		if ( ! empty( $services ) ) {
			$this->services = $services;
		}

		$this->register();
	}

	/**
	 * Checks if a providers' service should be registered.
	 *
	 * @return bool
	 */
	abstract protected function can_be_registered(): bool;

	/**
	 * Registers services with the container.
	 *
	 * @throws \ReflectionException
	 */
	public function register(): void {
		foreach ( $this->services as $service ) {
			if ( ! class_exists( $service ) || ! $this->can_be_registered() ) {
				continue;
			}

			$service = WeMeal::$container->get( $service );

			if ( $service instanceof HookableInterface ) {
				$service->register_hooks();
			}
		}
	}
}
