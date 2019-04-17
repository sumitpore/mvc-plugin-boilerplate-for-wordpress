<?php
namespace Plugin_Name\Core;

use Plugin_Name as Plugin_Name;
use Plugin_Name\Core\Route_Type as Route_Type;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Router' ) ) {
	/**
	 * Class Responsible for registering Routes
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/controllers
	 */
	class Router {

		/**
		 * Holds List of Models used for 'Model Only' Routes
		 *
		 * @var array
		 * @since 1.0.0
		 */
		private static $models = [];

		/**
		 * Holds Model, View & Controllers triad for All routes except 'Model Only' Routes
		 *
		 * @var array
		 * @since    1.0.0
		 */
		private static $mvc_components = [];

		/**
		 * This constant is used to register late frontend routes
		 *
		 * @since 1.0.0
		 */
		const REGISTER_LATE_FRONTEND_ROUTES = true;

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$this->register_hook_callbacks();
		}

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		protected function register_hook_callbacks() {
			add_action( 'init', array( $this, 'register_generic_model_only_routes' ) );
			add_action( 'wp', array( $this, 'register_late_frontend_model_only_routes' ) );

			add_action( 'init', array( $this, 'register_generic_routes' ) );
			add_action( 'wp', array( $this, 'register_late_frontend_routes' ) );
		}

		/**
		 * Register Generic `Model Only` Routes
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_generic_model_only_routes() {
			$this->register_model_only_routes();
		}

		/**
		 * Register Late Frontend `Model Only` Routes
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_late_frontend_model_only_routes() {
			$this->register_model_only_routes( self::REGISTER_LATE_FRONTEND_ROUTES );
		}

		/**
		 * Register Generic Routes
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_generic_routes() {
			$this->register_routes();
		}

		/**
		 * Register Late Frontend Routes
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_late_frontend_routes() {
			$this->register_routes( self::REGISTER_LATE_FRONTEND_ROUTES );
		}

		/**
		 * Returns List of commonly/mostly used Route types
		 *
		 * @since 1.0.0
		 * @return array
		 */
		public function generic_route_types() {
			return apply_filters(
				'plugin_name_route_types', [
					Route_Type::ANY,
					Route_Type::ADMIN,
					Route_Type::ADMIN_WITH_POSSIBLE_AJAX,
					Route_Type::AJAX,
					Route_Type::CRON,
					Route_Type::FRONTEND,
					Route_Type::FRONTEND_WITH_POSSIBLE_AJAX,
				]
			);
		}

		/**
		 * Returns list of Route types belonging to Frontend but registered late
		 *
		 * @since 1.0.0
		 * @return array
		 */
		public function late_frontend_route_types() {
			return apply_filters(
				'plugin_name_late_frontend_route_types', [
					Route_Type::LATE_FRONTEND,
					Route_Type::LATE_FRONTEND_WITH_POSSIBLE_AJAX,
				]
			);
		}

		/**
		 * Type of Route to be registered. Every time a new route needs to be
		 * registered, this function should be called first on `$route` object
		 *
		 * @param string $type Type of route to be registered.
		 * @return Router Returns `Router` object.
		 * @since 1.0.0
		 */
		public function register_route_of_type( $type ) {
			if ( in_array( $type, $this->late_frontend_route_types() ) && did_action( 'wp' ) ) {
				trigger_error( __( 'Late Routes can not be registered after `wp` hook is triggered. Register your route before `wp` hook is triggered.', Plugin_Name::PLUGIN_ID ), E_USER_ERROR ); // @codingStandardsIgnoreLine.
			}

			if ( in_array( $type, $this->generic_route_types() ) && did_action( 'init' ) ) {
				trigger_error( __( 'Non-Late Routes can not be registered after `init` hook is triggered. Register your route before `init` hook is triggered.', Plugin_Name::PLUGIN_ID ), E_USER_ERROR ); // @codingStandardsIgnoreLine.
			}

			$this->route_type_to_register = $type;
			return $this;
		}

		/**
		 * Enqueues a model to be associated with the Model only` Route
		 *
		 * @param mixed $model Model to be associated with the Route. Could be String or callback.
		 * @return mixed
		 * @since 1.0.0
		 */
		public function with_just_model( $model ) {
			if ( false === $model ) {
				return $this;
			}
			static::$models[ $this->route_type_to_register ][] = $model;
		}

		/**
		 * Generates a Unique id for each controller
		 *
		 * This unique id is used as an array key inside mvc_components array which
		 * is used while enqueueing models and views to associate them with the
		 * controller.
		 *
		 * @param mixed $controller Controller to be associated with the Route. Could be String or callback.
		 * @return string
		 * @since 1.0.0
		 */
		public function build_controller_unique_id( $controller ) {
			$prefix = mt_rand() . '_';

			if ( is_string( $controller ) ) {
				return $prefix . $controller;
			}

			if ( is_object( $controller ) ) {
				// Closures are currently implemented as objects.
				$controller = array( $controller, '' );
			} else {
				$controller = (array) $controller;
			}

			if ( is_object( $controller[0] ) ) {
				// Object Class Calling.
				return $prefix . spl_object_hash( $controller[0] ) . $controller[1];
			}

			if ( is_string( $controller[0] ) ) {
				// Static Calling.
				return $prefix . $controller[0] . '::' . $controller[1];
			}
		}

		/**
		 * Enqueues a controller to be associated with the Route
		 *
		 * @param mixed $controller Controller to be associated with the Route. Could be String or callback.
		 * @return object Returns Router Object
		 * @since 1.0.0
		 */
		public function with_controller( $controller ) {
			if ( false === $controller ) {
				return $this;
			}

			$this->current_controller = $this->build_controller_unique_id( $controller );

			static::$mvc_components[ $this->route_type_to_register ][ $this->current_controller ] = [ 'controller' => $controller ];

			return $this;
		}

		/**
		 * Enqueues a model to be associated with the Route
		 *
		 * The object of this model is passed to controller.
		 *
		 * @param mixed $model Model to be associated with the Route. Could be String or callback.
		 * @return object Returns Router Object
		 * @since 1.0.0
		 */
		public function with_model( $model ) {
			if ( isset( static::$mvc_components[ $this->route_type_to_register ][ $this->current_controller ]['controller'] ) ) {
				static::$mvc_components[ $this->route_type_to_register ][ $this->current_controller ]['model'] = $model;
			}
			return $this;
		}

		/**
		 * Registers view with the Route. The object of this view is passed to controller
		 *
		 * @param mixed $view View to be associated with the Route. Could be String or callback.
		 * @return object Returns Router Object
		 * @since 1.0.0
		 */
		public function with_view( $view ) {
			if ( isset( static::$mvc_components[ $this->route_type_to_register ][ $this->current_controller ]['controller'] ) ) {
				static::$mvc_components[ $this->route_type_to_register ][ $this->current_controller ]['view'] = $view;
			}
			return $this;
		}

		/**
		 * Registers Enqueued Routes
		 *
		 * @param boolean $register_late_frontend_routes Whether to register late frontend routes.
		 * @return void
		 * @since 1.0.0
		 */
		private function register_routes( $register_late_frontend_routes = false ) {
			if ( $register_late_frontend_routes ) {
				$route_types = $this->late_frontend_route_types();
			} else {
				$route_types = $this->generic_route_types();
			}

			if ( empty( $route_types ) ) {
				return;
			}

			foreach ( $route_types as $route_type ) {
				if ( $this->is_request( $route_type ) && ! empty( static::$mvc_components[ $route_type ] ) ) {
					foreach ( static::$mvc_components[ $route_type ] as $mvc_component ) {
						$this->dispatch( $mvc_component, $route_type );
					}
				}
			}
		}

		/**
		 * Dispatches the route of specified $route_type by creating a controller object
		 *
		 * @param array  $mvc_component Model-View-Controller triads for all registered routes.
		 * @param string $route_type Route Type.
		 * @return void
		 * @since 1.0.0
		 */
		private function dispatch( $mvc_component, $route_type ) {
			$model = false;
			$view = false;

			if ( isset( $mvc_component['controller'] ) && false === $mvc_component['controller'] ) {
				return;
			}

			if ( is_callable( $mvc_component['controller'] ) ) {
				$mvc_component['controller'] = call_user_func( $mvc_component['controller'] );

				if ( false === $mvc_component['controller'] ) {
					return;
				}
			}

			if ( isset( $mvc_component['model'] ) && false !== $mvc_component['model'] ) {
				if ( is_callable( $mvc_component['model'] ) ) {
					$mvc_component['model'] = call_user_func( $mvc_component['model'] );
				}

				$model = $this->get_fully_qualified_class_name( $mvc_component['model'], 'model', $route_type );
			}

			if ( isset( $mvc_component['view'] ) && false !== $mvc_component['view'] ) {
				if ( is_callable( $mvc_component['view'] ) ) {
					$mvc_component['view'] = call_user_func( $mvc_component['view'] );
				}

				$view = $this->get_fully_qualified_class_name( $mvc_component['view'], 'view', $route_type );
			}

			@list($controller, $action) = explode( '@', $mvc_component['controller'] );

			$controller = $this->get_fully_qualified_class_name( $controller, 'controller', $route_type );

			$controller_instance = $controller::get_instance( $model, $view );

			if ( null !== $action ) {
				$controller_instance->$action();
			}
		}

		/**
		 * Registers `Model Only` Enqueued Routes
		 *
		 * @param boolean $register_late_frontend_routes Whether to register late frontend routes.
		 * @return void
		 * @since 1.0.0
		 */
		public function register_model_only_routes( $register_late_frontend_routes = false ) {
			if ( $register_late_frontend_routes && empty( $route_types = $this->late_frontend_route_types() ) ) { // @codingStandardsIgnoreLine.
				return;
			} elseif ( empty( $route_types = $this->generic_route_types() ) ) { // @codingStandardsIgnoreLine.
				return;
			}

			foreach ( $route_types as $route_type ) {
				if ( $this->is_request( $route_type ) && ! empty( static::$models[ $route_type ] ) ) {
					foreach ( static::$models[ $route_type ] as $model ) {
						$this->dispatch_only_model( $model, $route_type );
					}
				}
			}
		}

		/**
		 * Dispatches the model only route by creating a Model object
		 *
		 * @param mixed  $model Model to be associated with the Route. Could be String or callback.
		 * @param string $route_type Route Type.
		 * @return void
		 * @since 1.0.0
		 */
		private function dispatch_only_model( $model, $route_type ) {
			if ( false === $model ) {
				return;
			}

			if ( is_callable( $model ) ) {
				$model = call_user_func( $model );

				if ( false === $model ) {
					return;
				}
			}

			@list($model, $action) = explode( '@', $model );
			$model = $this->get_fully_qualified_class_name( $model, 'model', $route_type );
			$model_instance = $model::get_instance();

			if ( null !== $action ) {
				$model_instance->$action();
			}
		}

		/**
		 * Returns the Full Qualified Class Name for given class name
		 *
		 * @param string $class Class whose FQCN needs to be found out.
		 * @param string $mvc_component_type Could be between 'model', 'view' or 'controller'.
		 * @param string $route_type Could be 'admin' or 'frontend'.
		 * @return string Retuns Full Qualified Class Name.
		 * @since 1.0.0
		 */
		private function get_fully_qualified_class_name( $class, $mvc_component_type, $route_type ) {

			// If route type is admin or frontend.
			if ( \strpos( $route_type, 'admin' ) !== false || \strpos( $route_type, 'frontend' ) !== false ) {
				$fqcn = '\Plugin_Name\App\\';
				$fqcn .= \ucfirst( $mvc_component_type ) . 's\\';
				$fqcn .= \strpos( $route_type, 'admin' ) !== false ? 'Admin\\' : 'Frontend\\';

				if ( class_exists( $fqcn . $class ) ) {
					return $fqcn . $class;
				}
			}

			return $class;
		}

		/**
		 * Identifies Request Type
		 *
		 * @param string $route_type Route Type to identify.
		 * @return boolean
		 * @since 1.0.0
		 */
		private function is_request( $route_type ) {
			switch ( $route_type ) {
				case Route_Type::ANY:
					return true;
				case ROUTE_TYPE::ADMIN:
				case ROUTE_TYPE::ADMIN_WITH_POSSIBLE_AJAX:
					return is_admin();
				case ROUTE_TYPE::AJAX:
					return defined( 'DOING_AJAX' );
				case ROUTE_TYPE::CRON:
					return defined( 'DOING_CRON' );
				case ROUTE_TYPE::FRONTEND:
				case ROUTE_TYPE::FRONTEND_WITH_POSSIBLE_AJAX:
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! defined( 'REST_REQUEST' );
				case ROUTE_TYPE::LATE_FRONTEND:
				case ROUTE_TYPE::LATE_FRONTEND_WITH_POSSIBLE_AJAX:
					return $this->is_request( 'frontend' ) || ( current_action() == 'wp' ) || ( did_action( 'wp' ) === 1 );
			}
		}
	}

}
