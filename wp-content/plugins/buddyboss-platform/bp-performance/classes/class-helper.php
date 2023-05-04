<?php
/**
 * BuddyBoss Performance helper.
 *
 * @package BuddyBoss\Performance\Helper
 */

namespace BuddyBoss\Performance;

use BuddyBossApp\Admin\Settings;

/**
 * Cache Helper class.
 */
class Helper {

	/**
	 * Class instance.
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Class instance.
	 *
	 * @return Helper
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			$class_name     = __CLASS__;
			self::$instance = new $class_name();
			self::$instance->initialize(); // run the hooks.
		}

		return self::$instance;
	}

	/**
	 * Intitialization of class.
	 */
	public function initialize() {
	}

	/**
	 * Get the settings.
	 *
	 * @param string $setting_key Key name of settings.
	 * @param string $group       setting groups.
	 *
	 * @return mixed|null
	 */
	public function get_app_settings( $setting_key = null, $group = 'default' ) {

		// Currently we supporting only BuddyBoss App Settings.
		$settings = \BuddyBoss\Performance\Settings::get_settings( $group );

		if ( ! empty( $setting_key ) ) {
			return isset( $settings[ $setting_key ] ) ? $settings[ $setting_key ] : null;
		} else {
			return $settings;
		}
	}

}