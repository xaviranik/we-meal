<?php

namespace PhpKnight\WeMeal;

use PhpKnight\WeMeal\Api\Api;
use PhpKnight\WeMeal\Admin\AdminProvider;
use PhpKnight\WeMeal\Frontend\FrontendProvider;
use PhpKnight\WeMeal\Core\Interfaces\ProviderInterface;

/**
 * Class Bootstrap
 *
 * Handles the plugin's bootstrap process.
 *
 * @package PhpKnight\WeMeal
 */
class Bootstrap {

	/**
	 * Holds plugin's provider classes.
	 *
	 * @var string[]
	 */
	protected static $providers = [
		AdminProvider::class,
		FrontendProvider::class,
	];

	/**
	 * Runs plugin bootstrap.
	 *
	 * @return void
	 */
	public static function run(): void {
		add_action( 'init', [ CPT::class, 'register' ] );
		add_action( 'rest_api_init', [ Api::class, 'register' ] );
		add_action( 'plugins_loaded', [ self::class, 'init' ] );
	}

	/**
	 * Bootstraps the plugin. Load all necessary providers.
	 *
	 * @return void
	 */
	public static function init(): void {
		self::register_providers();
	}

	/**
	 * Registers providers.
	 *
	 * @return void
	 */
	protected static function register_providers(): void {
		foreach ( self::$providers as $provider ) {
			if ( class_exists( $provider ) && is_subclass_of( $provider, ProviderInterface::class ) ) {
				new $provider();
			}
		}
	}
}
