<?php
namespace Plugin_Name\Core;

use Plugin_Name\Core\Registry\Controller as Controller_Registry;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Controller' ) ) {
	/**
	 * Abstract class to define/implement base methods for all controller classes
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/controllers
	 */
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
		 * @param mixed $model_class_name Model Class to be associated with the controller.
		 * @param mixed $view_class_name View Class to be associated with the controller.
		 * @return object
		 * @since    1.0.0
		 */
		public static function get_instance( $model_class_name = false, $view_class_name = false ) {
			$classname = get_called_class();
			$key_in_registry = Controller_Registry::get_key( $classname, $model_class_name, $view_class_name );

			$instance = Controller_Registry::get( $key_in_registry );

			// Create a object if no object is found.
			if ( null === $instance ) {

				// Decide model to be passed to the constructor.
				if ( false != $model_class_name ) {
					$model = $model_class_name::get_instance();
				} else {
					$model = new Model();
				}

				// Decide view to be passed to the constructor.
				if ( false != $view_class_name ) {
					$view = new $view_class_name();
				} else {
					$view = new View();
				}

				$instance = new $classname( $model, $view );

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
		 * Sets the model to be used
		 *
		 * @param Model $model Model object to be associated with the current controller object.
		 * @return void
		 * @since 1.0.0
		 */
		protected function set_model( Model $model ) {
			$this->model = $model;
		}

		/**
		 * Sets the view to be used
		 *
		 * @param View $view View object to be associated with the current controller object.
		 * @return void
		 * @since 1.0.0
		 */
		protected function set_view( View $view ) {
			$this->view = $view;
		}

		/**
		 * Constructor
		 *
		 * @param Model $model Model object to be used with current controller object.
		 * @param mixed $view View object to be used with current controller object. Otherwise false.
		 */
		protected function __construct( Model $model, $view = false ) {
			$this->init( $model, $view );
		}

		/**
		 * Sets Model & View to be used with current controller
		 *
		 * @param Model $model Model to be associated with this controller.
		 * @param mixed $view Either View/its child class object or False.
		 * @return void
		 */
		final protected function init( Model $model, $view = false ) {
			$this->set_model( $model );

			if ( false === $view ) {
				$view = new View();
			}

			$this->set_view( $view );
		}
	}

}
