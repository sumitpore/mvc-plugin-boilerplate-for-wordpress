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

			$this->set_locale();
			$this->register_hook_callbacks();

		}

	}

}
