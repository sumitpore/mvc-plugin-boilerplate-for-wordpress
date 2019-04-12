<?php
namespace Plugin_Name\App\Controllers\Frontend;

use \Plugin_Name\App\Controllers\Frontend\Base_Controller;
use \Plugin_Name as Plugin_Name;
/**
 * Controller class that implements Plugin frontend side controller class
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Sample_Shortcode' ) ) {

	class Sample_Shortcode extends Base_Controller {

		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		protected function __construct( Model $model, View $view ) {

			// Every constructor must call init method. init method sets model & view properties
			$this->init( $model, $view );

			add_shortcode( 'plugin_name_hello_world', array( $this, 'hello_world_callback' ) );

			$this->register_hook_callbacks();
		}

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		protected function register_hook_callbacks() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}


		/**
		 * Register the stylesheets for the frontend-facing side of the site.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_styles() {

			/**
			 * This function is provided for demonstration purposes only.
			 */

			wp_enqueue_style(
				Plugin_Name::PLUGIN_ID,
				Plugin_Name::get_plugin_url() . 'views/css/' . Plugin_Name::PLUGIN_ID . '.css',
				array(),
				Plugin_Name::PLUGIN_VERSION,
				'all'
			);
		}

		/**
		 * Register the JavaScript for the frontend-facing side of the site.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_scripts() {

			/**
			 * This function is provided for demonstration purposes only.
			 */

			wp_enqueue_script(
				Plugin_Name::PLUGIN_ID,
				Plugin_Name::get_plugin_url() . 'views/js/' . Plugin_Name::PLUGIN_ID . '.js',
				array( 'jquery' ),
				Plugin_Name::PLUGIN_VERSION,
				false
			);
		}


		/**
		 * Hello World Shortcode's Callback
		 *
		 * @param array $atts Arguments Array
		 * @return string
		 */
		public function hello_world_callback( $atts ) {

			$attributes = shortcode_atts(
				array(
					'name' => 'world',
				), $atts
			);

			return $this->view->shortcode_html(
				array(
					'attributes' => $attributes,
				)
			);
		}

	}

}
