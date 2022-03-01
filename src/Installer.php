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
		self::add_roles();
	}

	/**
	 * Creates the database tables.
	 *
	 * @return void
	 */
	private static function create_tables(): void {
		global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$charset_collate = $wpdb->get_charset_collate();

		$table = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}we_meal_orders` (
			`id` int NOT NULL AUTO_INCREMENT,
			`user_id` int NOT NULL,
			`meal_id` int NOT NULL,
			`price` decimal(10,4) DEFAULT NULL,
			`status` varchar(15) DEFAULT NULL,
			`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			`updated_at` timestamp NULL DEFAULT NULL,
			PRIMARY KEY (`id`)
        	KEY `user_id_created_at` (`user_id`,`created_at`)
		) {$charset_collate};";

		dbDelta( $table );
	}

	/**
	 * Adds the roles.
	 *
	 * @return void
	 */
	private static function add_roles(): void {
		add_role(
			'meal_manager',
			'Meal Manager',
			[
				'read'                   => true,
				'manage_meal'            => true,
				'edit_meals'             => true,
				'edit_others_meals'      => true,
				'delete_meals'           => true,
				'publish_meals'          => true,
				'edit_published_meals'   => true,
				'delete_published_meals' => true,
			],
		);
	}
}
