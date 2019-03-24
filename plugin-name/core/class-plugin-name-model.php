<?php

/**
 * Abstract class to define/implement base methods for model classes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/models
 */

if ( ! class_exists( 'Plugin_Name_Model' ) ) {
	abstract class Plugin_Name_Model {

		private static $instances = array();

		/**
		 * Provides access to a single instance of a module using the singleton pattern
		 *
		 * @since    1.0.0
		 * @return object
		 */
		public static function get_instance() {
			$classname = get_called_class();
			$instance = Plugin_Name_Controller_Registry::get( $classname );

			if ( $instance === null ) {
				$instance = new $classname();
				Plugin_Name_Model_Registry::set( $classname, $instance );
			}

			return $instance;
		}

		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		abstract protected function __construct();

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		abstract protected function register_hook_callbacks();

	}

}
