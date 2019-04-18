<?php
namespace Plugin_Name\App\Models\Admin;

use Plugin_Name\App\Models\Settings as Settings_Model;
use Plugin_Name\App\Models\Admin\Base_Model;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Admin_Settings' ) ) {
	/**
	 * Model class that implements Plugin Admin Settings
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/models/admin
	 */
	class Admin_Settings extends Base_Model {

		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		protected function __construct() {
			$this->register_hook_callbacks();
		}

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		protected function register_hook_callbacks() {
			/**
			 * If you think all model related add_actions & filters should be in
			 * the model class only, then this this the place where you can place
			 * them.
			 *
			 * You can remove this method if you are not going to use it.
			 */
		}

		/**
		 * Register settings
		 *
		 * @since    1.0.0
		 */
		public function register_settings() {

			// The settings container.
			register_setting(
				Settings_Model::SETTINGS_NAME,     // Option group Name.
				Settings_Model::SETTINGS_NAME,     // Option Name.
				array( $this, 'sanitize' ) // Sanitize.
			);
		}

		/**
		 * Validates submitted setting values before they get saved to the database.
		 *
		 * @param array $input Settings Being Saved.
		 * @since    1.0.0
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
		 * Returns the option key used to store the settings in database
		 *
		 * @since 1.0.0
		 * @return string
		 */
		public function get_plugin_settings_option_key() {
			return Settings_Model::get_plugin_settings_option_key();
		}

		/**
		 * Retrieves all of the settings from the database
		 *
		 * @param string $setting_name Setting to be retrieved.
		 * @since    1.0.0
		 * @return array
		 */
		public function get_setting( $setting_name ) {
			return Settings_Model::get_setting( $setting_name );
		}

	}

}
