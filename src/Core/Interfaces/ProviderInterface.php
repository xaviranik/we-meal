<?php

namespace PhpKnight\WeMeal\Core\Interfaces;

interface ProviderInterface {

	/**
	 * Registers the services provided by the provider.
	 *
	 * @return void
	 */
	public function register(): void;
}
