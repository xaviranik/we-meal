<?php

namespace PhpKnight\WeMeal\Admin;

use PhpKnight\WeMeal\WeMeal;
use PhpKnight\WeMeal\Admin\CPT\Meal\Capability;
use PhpKnight\WeMeal\Core\Interfaces\HookableInterface;

/**
 * Admin menu class.
 *
 * @since 1.0.0
 */
class Menu implements HookableInterface {

	/**
	 * Menu page title.
	 *
	 * @var string
	 */
	protected $page_title;

	/**
	 * Menu page title.
	 *
	 * @var string
	 */
	protected $menu_title;

	/**
	 * Menu page base capability.
	 *
	 * @var string
	 */
	protected $base_capability;

	/**
	 * Menu page base capability.
	 *
	 * @var string
	 */
	protected $capability;

	/**
	 * Menu page slug.
	 *
	 * @var string
	 */
	protected $menu_slug;

	/**
	 * Menu page icon url.
	 *
	 * @var string
	 */
	protected $icon;

	/**
	 * Menu page position.
	 *
	 * @var int
	 */
	protected $position;

	/**
	 * Submenu pages.
	 *
	 * @var array
	 */
	protected $submenus;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( Capability $capability ) {
		$capability->register_hooks();

		$this->page_title      = __( 'weMeal', 'we-meal' );
		$this->menu_title      = __( 'weMeal', 'we-meal' );
		$this->base_capability = 'read';
		$this->capability      = 'manage_meal';
		$this->menu_slug       = 'we-meal';
		$this->icon            = 'dashicons-food';
		$this->position        = 57;
		$this->submenus        = [
			[
				'title'      => __( 'Dashboard', 'we-meal' ),
				'capability' => $this->base_capability,
				'url'        => 'admin.php?page=' . $this->menu_slug . '#/dashboard',
			],
			[
				'title'      => __( 'Orders', 'we-meal' ),
				'capability' => $this->capability,
				'url'        => 'admin.php?page=' . $this->menu_slug . '#/orders',
			],
			[
				'title'      => __( 'Reports', 'we-meal' ),
				'capability' => $this->capability,
				'url'        => 'admin.php?page=' . $this->menu_slug . '#/reports',
			],
			[
				'title'      => __( 'All Meals', 'we-meal' ),
				'capability' => $this->capability,
				'url'        => 'edit.php?post_type=meal',
			],
			[
				'title'      => __( 'Add Meal', 'we-meal' ),
				'capability' => $this->capability,
				'url'        => 'post-new.php?post_type=meal',
			],
		];
	}

	/**
	 * Registers all hooks for the class.
	 *
	 * @return void
	 */
	public function register_hooks(): void {
		add_action( 'admin_menu', [ $this, 'register_menu' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );
		add_action( 'admin_head', [ $this, 'cleanup_admin_notices' ], 1 );
	}

	/**
	 * Register admin menu.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function register_menu(): void {
		global $submenu;

		add_menu_page(
			$this->page_title,
			$this->menu_title,
			$this->base_capability,
			$this->menu_slug,
			[ $this, 'render_menu_page' ],
			$this->icon,
			$this->position,
		);

		foreach ( $this->submenus as $item ) {
			$submenu[ $this->menu_slug ][] = [ $item['title'], $item['capability'], $item['url'] ]; // phpcs:ignore
		}
	}

	/**
	 * Register admin scripts.
	 *
	 * @return void
	 */
	public function register_scripts(): void {
		$asset = require_once WP_PLUGIN_STARTER_PLUGIN_DIR . '/build/main.asset.php';

		wp_register_script(
			'we-meal-main-script',
			WeMeal::$build_url . '/main.js',
			$asset['dependencies'],
			$asset['version'],
			false
		);

		wp_register_style(
			'we-meal-main-style',
			WeMeal::$build_url . '/main.css',
			[],
			$asset['version'],
			false
		);
	}


	/**
	 * Renders the admin page.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function render_menu_page(): void {
		wp_enqueue_script( 'we-meal-main-script' );
		wp_enqueue_style( 'we-meal-main-style' );
		echo '<div id="we-meal-app"></div>';
	}

	/**
	 * Cleans admin notice for we-meal page.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function cleanup_admin_notices(): void {
		if ( 'toplevel_page_we-meal' === get_current_screen()->id ) {
			remove_all_actions( 'admin_notices' );
		}
	}
}

