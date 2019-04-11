<?php
namespace Plugin_Name\Core;

use \Plugin_Name\Core\Registry\Controller as Controller_Registry;

/**
 * Abstract class to define/implement base methods for all controller classes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Controller' ) ) {
	abstract class Controller {

		/**
		 * Holds Model object
		 *
		 * @var Object
		 * @since 1.0.0
		 */
		protected $model;

		/**
		 * Holds View Object
		 *
		 * @var Object
		 * @since 1.0.0
		 */
		protected $view;

		/**
		 * Provides access to a single instance of a module using the singleton pattern
		 *
		 * @return object
		 * @since    1.0.0
		 */
		public static function get_instance( $model_class_name = false, $view_class_name = false ) {
			$classname = get_called_class();
			$key_in_registry = Controller_Registry::get_key( $classname, $model_class_name, $view_class_name );

			$instance = Controller_Registry::get( $key_in_registry );

			if ( $instance === null ) {
				$instance = new $classname( $model_class_name, $view_class_name );
				Controller_Registry::set( $key_in_registry, $instance );
			}

			return $instance;
		}

		/**
		 * Get model.
		 *
		 * In most of the cases, the model will be set as per routes in defined in routes.php.
		 * So if you are not sure which model class is currently being used, search for the
		 * current controller class name in the routes.php
		 *
		 * @return object
		 * @since    1.0.0
		 */
		protected function get_model() {
			return $this->model;
		}

		/**
		 * Get view
		 *
		 * In most of the cases, the view will be set as per routes in defined in routes.php.
		 * So if you are not sure which view class is currently being used, search for the
		 * current controller class name in the routes.php
		 *
		 * @return object
		 * @since    1.0.0
		 */
		protected function get_view() {
			return $this->view;
		}

		/**
		 * Constructor
		 */
		protected function __construct( $model_class_name = false, $view_class_name = false ) {
			if ( $model_class_name != false ) {
				$this->model = $model_class_name::get_instance();
			}

			if ( $view_class_name != false ) {
				$this->view = new $view_class_name();
			}
		}

	}

}
