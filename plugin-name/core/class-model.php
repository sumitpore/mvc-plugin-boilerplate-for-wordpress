<?php
namespace Plugin_Name\Core;

use \Plugin_Name\Core\Registry\Model as Model_Registry;

/**
 * Abstract class to define/implement base methods for model classes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/models
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Model' ) ) {
	abstract class Model {

		/**
		 * Provides access to a single instance of a module using the singleton pattern
		 *
		 * @since    1.0.0
		 * @return object
		 */
		public static function get_instance() {
			$classname = get_called_class();
			$instance = Model_Registry::get( $classname );

			if ( $instance === null ) {
				$instance = new $classname();
				Model_Registry::set( $classname, $instance );
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
