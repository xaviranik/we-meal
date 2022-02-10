<?php

namespace PhpKnight\WeMeal\Admin;

use PhpKnight\WeMeal\Core\Abstracts\Provider;

/**
 * Class AdminProvider.
 *
 * Provides the admin functionality of the plugin.
 *
 * @package PhpKnight\WeMeal\Admin
 */
class AdminProvider extends Provider {

	/**
	 * Register all the necessary services for the admin.
	 * Dependencies are automatically resolved.
	 *
	 * @var string $services
	 */
	protected $services = [
		Menu::class,
	];

	/**
	 * Checks if a service should be registered.
	 *
	 * @return bool
	 */
	protected function can_be_registered(): bool {
		return is_admin();
	}
}
