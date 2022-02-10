<?php
/**
 * Plugin Name: WeMeal
 * Description: Meal planning and ordering made easy.
 * URI: https://zabiranik.com
 * Author: Zabir Anik
 * Author URI: https://zabiranik.com
 * Version: 1.0.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: we-meal
 */

namespace PhpKnight\WeMeal;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( WeMeal::class ) && is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

if ( ! defined( 'WP_PLUGIN_STARTER_PLUGIN_FILE' ) ) {
	define( 'WP_PLUGIN_STARTER_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'WP_PLUGIN_STARTER_DIR' ) ) {
	define( 'WP_PLUGIN_STARTER_PLUGIN_DIR', __DIR__ );
}

class_exists( WeMeal::class ) && WeMeal::instance();
