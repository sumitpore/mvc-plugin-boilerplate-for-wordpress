<?php

/**
 * The core plugin class.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 *
 */

if ( ! class_exists( 'Plugin_Name' ) ) {

	class Plugin_Name {

		use Plugin_Name_Dependency_Loader;

		/**
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      Plugin_Name    $instance    Instance of this class.
		 */
		private static $instance;

		/**
		 * The modules variable holds all modules of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      object    $modules    Maintains all modules of the plugin.
		 */
		private static $modules = array();

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
		const PLUGIN_ID 		= 'plugin-name';

		/**
		 * The name identifier of this plugin.
		 *
		 * @since    1.0.0
		 */
		const PLUGIN_NAME 		= 'Plugin Name';


		/**
		 * The current version of the plugin.
		 *
		 * @since    1.0.0
		 */
		const PLUGIN_VERSION 	= '1.0.0';

		/**
		 * The plugin prefix to referenciate classes inside the plugin
		 *
		 * @since    1.0.0
		 */
		const CLASS_PREFIX 		= 'Plugin_Name_';

		/**
		 * The plugin prefix to referenciate files and prefixes inside the plugin
		 *
		 * @since    1.0.0
		 */
		const PLUGIN_PREFIX 	= 'plugin-name-';

		/**
		 * Define the core functionality of the plugin.
		 *
		 * Load the dependencies, define the locale, and set the hooks for the admin area and
		 * the public-facing side of the site.
		 *
		 * @since    1.0.0
		 */
		public function __construct($router_class_name, $routes) {

			if( !class_exists( $router_class_name ) ){
				throw new \InvalidArgumentException( "Could not load {$router_class_name} class!");
			}

			if( !file_exists( $routes ) ){
				throw new \InvalidArgumentException( "Routes file {$routes} not found! Please pass a valid file.");
			}

			spl_autoload_register( array( $this, 'load_dependencies' ) );

			self::$plugin_path = plugin_dir_path( dirname( __FILE__ ) );
			self::$plugin_url  = plugin_dir_url( dirname( __FILE__ ) );

			require_once( self::$plugin_path . 'includes/class-' . self::PLUGIN_PREFIX . 'loader.php' );

			$router = Plugin_Name_Router::get_instance();

			Plugin_Name_Loader::get_instance();
			Plugin_Name_Actions_Filters::init_actions_filters();

			$this->set_locale();
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

	}

}
