<?php

namespace PhpKnight\WeMeal;

use PhpKnight\WeMeal\Admin\AdminProvider;
use PhpKnight\WeMeal\Core\Abstracts\Provider;
use PhpKnight\WeMeal\Frontend\FrontendProvider;
use PhpKnight\WeMeal\Core\Abstracts\CustomPostType;

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
	 * Holds plugin's CPT classes.
	 *
	 * @var string[]
	 */
	protected static $custom_post_types = [];

	/**
	 * Runs plugin bootstrap.
	 *
	 * @return void
	 */
	public static function run(): void {
		add_action( 'init', [ self::class, 'register_custom_post_type' ] );
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
	protected static function install() {
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

	/**
	 * Loops over the $custom_post_type array and
	 * Registers custom post types.
	 *
	 * @throws \ReflectionException
	 */
	public static function register_custom_post_type(): void {
		foreach ( self::$custom_post_types as $post_type ) {
			if ( class_exists( $post_type ) && is_subclass_of( $post_type, CustomPostType::class ) ) {
				$cpt = WeMeal::$container->get( $post_type );
				$cpt->register_post_type();
			}
		}
	}
}
