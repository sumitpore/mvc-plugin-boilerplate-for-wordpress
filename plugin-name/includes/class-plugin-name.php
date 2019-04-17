<?php
use Plugin_Name\Includes\i18n;
use Plugin_Name\Includes\Dependency_Loader;
use Plugin_Name\Core\Registry\Controller as Controller_Registry;
use Plugin_Name\Core\Registry\Controller as Model_Registry;
use Plugin_Name\App\Models\Settings;

require_once plugin_dir_path( __FILE__ ) . '/class-dependency-loader.php';


if ( ! class_exists( 'Plugin_Name' ) ) {

	/**
	 * The main plugin class
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/includes
	 */
	class Plugin_Name extends  Dependency_Loader {

		/**
		 * Holds instance of this class
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      Plugin_Name    $instance    Instance of this class.
		 */
		private static $instance;

		/**
		 * Main plugin path /wp-content/plugins/<plugin-folder>/.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      string    $plugin_path    Main path.
		 */
		private static $plugin_path;

		/**
		 * Absolute plugin url <wordpress-root-folder>/wp-content/plugins/<plugin-folder>/.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      string    $plugin_url    Main path.
		 */
		private static $plugin_url;


		/**
		 * The unique identifier of this plugin.
		 *
		 * @since    1.0.0
		 */
		const PLUGIN_ID         = 'plugin-name';

		/**
		 * The name identifier of this plugin.
		 *
		 * @since    1.0.0
		 */
		const PLUGIN_NAME       = 'Plugin Name';


		/**
		 * The current version of the plugin.
		 *
		 * @since    1.0.0
		 */
		const PLUGIN_VERSION    = '1.0.0';

		/**
		 * Define the core functionality of the plugin.
		 *
		 * Load the dependencies, define the locale, and bootstraps Router.
		 *
		 * @param mixed $router_class_name Name of the Router class to load. Otherwise false.
		 * @param mixed $routes File that contains list of all routes. Otherwise false.
		 * @since    1.0.0
		 */
		public function __construct( $router_class_name = false, $routes = false ) {
			self::$plugin_path = plugin_dir_path( dirname( __FILE__ ) );
			self::$plugin_url  = plugin_dir_url( dirname( __FILE__ ) );

			$this->autoload_dependencies();
			$this->set_locale();

			if ( false !== $router_class_name && false !== $routes ) {
				$this->init_router( $router_class_name, $routes );
			}

			$this->controllers = $this->get_all_controllers();
			$this->models = $this->get_all_models();
		}

		/**
		 * Get plugin's absolute path.
		 *
		 * @since    1.0.0
		 */
		public static function get_plugin_path() {
			return isset( self::$plugin_path ) ? self::$plugin_path : plugin_dir_path( dirname( __FILE__ ) );
		}

		/**
		 * Get plugin's absolute url.
		 *
		 * @since    1.0.0
		 */
		public static function get_plugin_url() {
			return isset( self::$plugin_url ) ? self::$plugin_url : plugin_dir_url( dirname( __FILE__ ) );
		}

		/**
		 * Define the locale for this plugin for internationalization.
		 *
		 * Uses the i18n class in order to set the domain and to register the hook
		 * with WordPress.
		 *
		 * @since    1.0.0.0
		 */
		private function set_locale() {
			$plugin_i18n = new i18n();
			$plugin_i18n->set_domain( Plugin_Name::PLUGIN_ID );

			add_action( 'plugins_loaded', array( $plugin_i18n, 'load_plugin_textdomain' ) );
		}

		/**
		 * Init Router
		 *
		 * @param mixed $router_class_name Name of the Router class to load.
		 * @param mixed $routes File that contains list of all routes.
		 * @throws \InvalidArgumentException If Router class or Routes file is not found.
		 * @since 1.0.0
		 * @return void
		 */
		private function init_router( $router_class_name, $routes ) {
			if ( ! class_exists( $router_class_name ) ) {
				throw new \InvalidArgumentException( "Could not load {$router_class_name} class!" );
			}

			if ( ! file_exists( $routes ) ) {
				throw new \InvalidArgumentException( "Routes file {$routes} not found! Please pass a valid file." );
			}

			$this->router = $router = new $router_class_name(); // @codingStandardsIgnoreLine.
			add_action(
				'plugins_loaded', function() use ( $router, $routes ) {
					include_once( $routes );
				}
			);
		}

		/**
		 * Returns all controller objects used for current requests
		 *
		 * @since    1.0.0
		 * @return object
		 */
		private function get_all_controllers() {
			return (object) Controller_Registry::get_all_objects();
		}

		/**
		 * Returns all model objecs used for current requests
		 *
		 * @since   1.0.0
		 * @return object
		 */
		private function get_all_models() {
			return (object) Model_Registry::get_all_objects();
		}

		/**
		 * Method that retuns all Saved Settings related to Plugin.
		 *
		 * Only to be used by third party developers.
		 *
		 * @return array
		 * @since 1.0.0
		 */
		public static function get_settings() {
			return Settings::get_settings();
		}

		/**
		 * Method that returns a individual setting
		 *
		 * Only to be used by third party developers.
		 *
		 * @param string $setting_name Setting to be retrieved.
		 * @return mixed
		 * @since 1.0.0
		 */
		public static function get_setting( $setting_name ) {
			return Settings::get_setting( $setting_name );
		}
	}

}
