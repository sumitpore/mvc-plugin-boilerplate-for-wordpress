<?php

/**
 * Abstract class to define/implement base methods for model classes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/models
 *
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

			if ( ! isset( self::$instances[ $classname ] ) ) {
				self::$instances[ $classname ] = new $classname();
			}
			return self::$instances[ $classname ];

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