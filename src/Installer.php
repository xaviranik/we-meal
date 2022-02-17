<?php

namespace PhpKnight\WeMeal;

/**
 * Class Installer
 *
 * @package PhpKnight\WeMeal
 */
class Installer {

	/**
	 * Runs the installer.
	 *
	 * @return void
	 */
	public static function run(): void {
		self::create_tables();
	}

	/**
	 * Creates the database tables.
	 *
	 * @return void
	 */
	private static function create_tables(): void {
		global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$collate = $wpdb->get_charset_collate();

		$table = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}we_meal_order` (
		  `id` int NOT NULL AUTO_INCREMENT,
		  `user_id` int NOT NULL,
		  `meal_id` int NOT NULL,
		  `price` decimal(10,4) DEFAULT NULL,
		  `status` tinyint(1) DEFAULT '1',
		  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
		  `updated_at` timestamp NULL DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB {$collate};";

		dbDelta( $table );
	}
}
