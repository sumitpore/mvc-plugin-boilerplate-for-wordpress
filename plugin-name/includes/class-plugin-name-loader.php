<?php

/**
 * Loader class that includes and loads dependencies and implements activation and desactivation methods
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 *
 */

if ( ! class_exists( 'Plugin_Name_Loader' ) ) {

	class Plugin_Name_Loader {

		/**
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      Plugin_Name_Loader    $instance    Instance of this class.
		 */
		private static $instance;

		/**
		 * Provides access to a single instance of a module using the singleton pattern
		 *
		 * @since    1.0.0
		 * @return object
		 */
		public static function get_instance() {

			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;

		}

		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		protected function __construct() {

			spl_autoload_register( array( $this, 'load_dependencies' ) );

			$this->set_locale();
			$this->register_hook_callbacks();

		}

		/**
		 * Loads all Plugin dependencies
		 *
		 * @since    1.0.0
		 */
		private function load_dependencies( $class ) {

			if ( false !== strpos( $class, Plugin_Name::CLASS_PREFIX ) ) {

				$classFileName = 'class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';
				$folder        = '/';

				if ( false !== strpos( $class, '_Admin' ) ) {
					$folder .= 'admin/';
				}

				if ( false !== strpos( $class, Plugin_Name::CLASS_PREFIX . 'Controller' ) ) {
					$path = Plugin_Name::get_plugin_path() . 'controllers' . $folder . $classFileName;
					require_once( $path );
				} elseif ( false !== strpos( $class, Plugin_Name::CLASS_PREFIX . 'Model' ) ) {
					$path = Plugin_Name::get_plugin_path() . 'models' . $folder . $classFileName;
					require_once( $path );
				} else {
					$path = Plugin_Name::get_plugin_path() . 'includes/' . $classFileName;
					require_once( $path );
				}

			}

		}

		/**
		 * Define the locale for this plugin for internationalization.
		 *
		 * Uses the Plugin_Name_i18n class in order to set the domain and to register the hook
		 * with WordPress.
		 *
		 * @since    1.0.0.0
		 */
		private function set_locale() {

			$plugin_i18n = new Plugin_Name_i18n();
			$plugin_i18n->set_domain( Plugin_Name::PLUGIN_ID );

			Plugin_Name_Actions_Filters::add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

		}

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0.0
		 */
		public function register_hook_callbacks() {

			register_activation_hook(   Plugin_Name::get_plugin_path() . Plugin_Name::PLUGIN_ID . '.php', array( $this, 'activate' ) );
			register_deactivation_hook( Plugin_Name::get_plugin_path() . Plugin_Name::PLUGIN_ID . '.php', array( $this, 'deactivate' ) );

		}

		/**
		 * Prepares sites to use the plugin during single or network-wide activation
		 *
		 * @since    1.0.0
		 * @param bool $network_wide
		 */
		public function activate( $network_wide ) {

		}


		/**
		 * Rolls back activation procedures when de-activating the plugin
		 *
		 * @since    1.0.0
		 */
		public function deactivate() {

			Plugin_Name_Model_Admin_Notices::remove_admin_notices();

		}

		/**
		 * Fired when user uninstalls the plugin, called in unisntall.php file
		 *
		 * @since    1.0.0
		 */
		public static function uninstall_plugin() {

			require_once dirname( plugin_dir_path( __FILE__ ) ) . '/includes/class-plugin-name.php';
			require_once dirname( plugin_dir_path( __FILE__ ) ) . '/models/class-plugin-name-model.php';
			require_once dirname( plugin_dir_path( __FILE__ ) ) . '/models/admin/class-plugin-name-model-admin.php';
			require_once dirname( plugin_dir_path( __FILE__ ) ) . '/models/admin/class-plugin-name-model-admin-settings.php';
			
			Plugin_Name_Model_Admin_Settings::delete_settings();

		}

	}

}