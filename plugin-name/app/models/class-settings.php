<?php
namespace Plugin_Name\App\Models;

use Plugin_Name as Plugin_Name;
use Plugin_Name\Core\Model;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Settings' ) ) {
	/**
	 * Implements operations related to Plugin Settings.
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/Models
	 */
	class Settings extends Model {

		const SETTINGS_NAME = Plugin_Name::PLUGIN_ID;

		/**
		 * Holds all Settings
		 *
		 * @var array
		 * @since 1.0.0
		 */
		protected static $settings;

		/**
		 * Returns the Option name/key saved in the database
		 *
		 * @return string
		 * @since 1.0.0
		 */
		public static function get_plugin_settings_option_key() {
			return Settings::SETTINGS_NAME;
		}

		/**
		 * Helper method that retuns all Saved Settings related to Plugin
		 *
		 * @return array
		 * @since 1.0.0
		 */
		public static function get_settings() {
			if ( ! isset( static::$settings ) ) {
				static::$settings = get_option( static::SETTINGS_NAME, array() );
			}

			return static::$settings;
		}

		/**
		 * Helper method that returns a individual setting
		 *
		 * @param string $setting_name Setting to be retrieved.
		 * @return mixed
		 * @since 1.0.0
		 */
		public static function get_setting( $setting_name ) {
			$all_settings = static::get_settings();

			return isset( $all_settings[ $setting_name ] ) ? $all_settings[ $setting_name ] : array();
		}

		/**
		 * Helper method to delete all settings related to plugin
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public static function delete_settings() {
			static::$settings = [];
			delete_option( static::SETTINGS_NAME );
		}

		/**
		 * Helper method to delete a specific setting
		 *
		 * @param string $setting_name Setting to be Deleted.
		 * @return void
		 * @since 1.0.0
		 */
		public static function delete_setting( $setting_name ) {
			$all_settings = static::get_settings();

			if ( isset( $all_settings[ $setting_name ] ) ) {
				unset( $all_settings[ $setting_name ] );
				static::$settings = $all_settings;
				update_option( static::SETTINGS_NAME, $all_settings );
			}
		}

		/**
		 * Helper method to Update Settings
		 *
		 * @param array $new_settings New Setting Values to store.
		 * @return void
		 * @since 1.0.0
		 */
		public static function update_settings( $new_settings ) {
			$all_settings = static::get_settings();
			$updated_settings = array_merge( $all_settings, $new_settings );
			static::$settings = $updated_settings;
			update_option( static::SETTINGS_NAME, $updated_settings );
		}

		/**
		 * Helper method Update Single Setting
		 *
		 * Similar to update_settings, this function won't by called anywhere automatically.
		 * This is a custom helper function to delete individual setting. You can
		 * delete this method if you don't want this ability.
		 *
		 * @param string $setting_name Setting to be Updated.
		 * @param mixed  $setting_value New value to set for that setting.
		 * @return void
		 * @since 1.0.0
		 */
		public static function update_setting( $setting_name, $setting_value ) {
			static::update_setting( [ $setting_name => $setting_value ] );
		}
	}

}
