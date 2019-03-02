<?php

/**
 * Controller class that implements Plugin public side controller class
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers
 *
 */

if ( ! class_exists( 'Plugin_Name_Controller_Public' ) ) {

	class Plugin_Name_Controller_Public extends Plugin_Name_Controller {

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

			Plugin_Name_Actions_Filters::add_action( 'wp_enqueue_scripts', $this, 'enqueue_styles' );
			Plugin_Name_Actions_Filters::add_action( 'wp_enqueue_scripts', $this, 'enqueue_scripts' );

		}


		/**
		 * Register the stylesheets for the public-facing side of the site.
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
		 * Register the JavaScript for the public-facing side of the site.
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

	}

}