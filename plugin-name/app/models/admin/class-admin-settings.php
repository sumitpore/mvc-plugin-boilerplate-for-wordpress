<?php
namespace Plugin_Name\App\Models\Admin;

use \Plugin_Name\App\Models\Admin\Base_Model;
use \Plugin_Name as Plugin_Name;
/**
 * Model class that implements Plugin Admin Settings
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/models/admin
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Admin_Settings' ) ) {

	class Admin_Settings extends Base_Model {

		protected static $settings;

		const SETTINGS_NAME = Plugin_Name::PLUGIN_ID;


		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		protected function __construct() {
			$this->register_hook_callbacks();
			static::get_settings();
		}

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		protected function register_hook_callbacks() {
			add_action( 'admin_init', array( $this, 'register_settings' ) );
		}

		/**
		 * Register settings
		 *
		 * @since    1.0.0
		 */
		public function register_settings() {

			// The settings container
			register_setting(
				static::SETTINGS_NAME,     // Option group Name
				static::SETTINGS_NAME,     // Option Name
				array( $this, 'sanitize' ) // Sanitize
			);
		}

		/**
		 * Validates submitted setting values before they get saved to the database.
		 *
		 * @since    1.0.0
		 * @param array $settings
		 * @return array
		 */
		public function sanitize( $input ) {
			$new_input = array();
			if ( isset( $input ) && ! empty( $input ) ) {
				$new_input = $input;
			}

			return $new_input;
		}


		/**
		 * Retrieves all of the settings from the database
		 *
		 * @since    1.0.0
		 * @return array
		 */
		public static function get_settings( $setting_name = false ) {
			if ( ! isset( static::$settings ) ) {
				static::$settings = get_option( static::SETTINGS_NAME, array() );
			}

			if ( $setting_name ) {
				return isset( static::$settings[ $setting_name ] ) ? static::$settings[ $setting_name ] : array();
			}

			return static::$settings;
		}

		/**
		 * Helper to update Plugin Settings
		 *
		 * @since    1.0.0
		 * @return boolean
		 */
		protected static function update_settings( $new_value, $setting_name = false ) {
			if ( isset( $new_value ) ) {
				if ( $setting_name ) {
					static::get_settings();
					static::$settings[ $setting_name ] = $new_value;

					$new_value = static::$settings;
				} else {
					static::$settings = $new_value;
				}

				return update_option( static::SETTINGS_NAME, $new_value );
			}

			return false;
		}

		/**
		 * Delete all plugin setings
		 *
		 * @since    1.0.0
		 * @return boolean
		 */
		public static function delete_settings( $setting_name = false ) {
			if ( $setting_name ) {
				static::get_settings();

				unset( static::$settings[ $setting_name ] );

				return static::update_settings( static::$settings );
			}

			return delete_option( static::SETTINGS_NAME );
		}

	}

}
