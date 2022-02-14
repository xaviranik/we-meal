<?php

namespace PhpKnight\WeMeal;

use PhpKnight\WeMeal\Admin\AdminProvider;
use PhpKnight\WeMeal\Core\Abstracts\Provider;
use PhpKnight\WeMeal\Frontend\FrontendProvider;

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
		add_action( 'init', [ CustomPostType::class, 'register' ] );
		add_action( 'plugins_loaded', [ self::class, 'bootstrap_plugin' ] );
	}

	/**
	 * Bootstraps the plugin.
	 *
	 * @return void
	 */
	public static function bootstrap_plugin(): void {
		self::install();
		self::register_providers();
	}

	/**
	 * Installs the plugin.
	 *
	 * @return void
	 */
	protected static function install(): void {
		// todo: implement installer logic
	}

	/**
	 * Registers providers.
	 *
	 * @return void
	 */
	protected static function register_providers(): void {
		foreach ( self::$providers as $provider ) {
			if ( class_exists( $provider ) && is_subclass_of( $provider, Provider::class ) ) {
				new $provider();
			}
		}
	}
}
