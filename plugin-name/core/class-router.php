<?php
namespace Plugin_Name\Core;

use \Plugin_Name as Plugin_Name;
/**
 * Class Responsible for registering Routes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Router' ) ) {

	class Router {
		private static $instance;

		private static $mvc_components = [];

		private static $models = [];

		public function __construct() {
			$this->register_hook_callbacks();
		}

		protected function register_hook_callbacks() {
			add_action( 'init', array( $this, 'register_model_only_routes' ) );
			add_action( 'wp', array( $this, 'register_late_model_only_routes' ) );

			add_action( 'init', array( $this, 'register_defined_routes' ) );
			add_action( 'wp', array( $this, 'register_late_frontend_routes' ) );
		}

		public function route_types() {
			return apply_filters(
				'plugin_name_route_types', [
					'any',
					'admin',
					'admin_with_possible_ajax',
					'ajax',
					'cron',
					'frontend',
					'frontend_with_possible_ajax',
				]
			);
		}

		public function late_frontend_route_types() {
			return apply_filters(
				'plugin_name_late_frontend_route_types', [
					'late_frontend',
					'late_frontend_with_possible_ajax',
				]
			);
		}

		public function register_route_of_type( $type ) {
			if ( in_array( $type, $this->late_frontend_route_types() ) && did_action( 'wp' ) ) {
				trigger_error( __( 'Late Routes can not be registered after `wp` hook is triggered. Register your route before `wp` hook is triggered.', Plugin_Name::PLUGIN_ID ), E_USER_ERROR );
			}

			if ( in_array( $type, $this->route_types() ) && did_action( 'init' ) ) {
				trigger_error( __( 'Non-Late Routes can not be registered after `init` hook is triggered. Register your route before `init` hook is triggered.', Plugin_Name::PLUGIN_ID ), E_USER_ERROR );
			}

			$this->route_type_to_register = $type;
			return $this;
		}

		public function with_just_model( $model ) {
			if ( $model === false ) {
				return $this;
			}
			static::$models[ $this->route_type_to_register ][] = $model;
		}

		public function build_controller_unique_id( $controller ) {
			$prefix = mt_rand() . '_';

			if ( is_string( $controller ) ) {
				return $prefix . $controller;
			}

			if ( is_object( $controller ) ) {
				// Closures are currently implemented as objects
				$controller = array( $controller, '' );
			} else {
				$controller = (array) $controller;
			}

			if ( is_object( $controller[0] ) ) {
				// Object Class Calling
				return $prefix . spl_object_hash( $controller[0] ) . $controller[1];
			}

			if ( is_string( $controller[0] ) ) {
				// Static Calling
				return $prefix . $controller[0] . '::' . $controller[1];
			}
		}

		public function with_controller( $controller ) {
			if ( $controller === false ) {
				return $this;
			}
			$this->current_controller = $this->build_controller_unique_id( $controller );

			static::$mvc_components[ $this->route_type_to_register ][ $this->current_controller ] = [ 'controller' => $controller ];

			return $this;
		}

		public function with_model( $model ) {
			if ( isset( static::$mvc_components[ $this->route_type_to_register ][ $this->current_controller ]['controller'] ) ) {
				static::$mvc_components[ $this->route_type_to_register ][ $this->current_controller ]['model'] = $model;
			}
			return $this;
		}

		public function with_view( $view ) {
			if ( isset( static::$mvc_components[ $this->route_type_to_register ][ $this->current_controller ]['controller'] ) ) {
				static::$mvc_components[ $this->route_type_to_register ][ $this->current_controller ]['view'] = $view;
			}
			return $this;
		}

		private function register_routes( $load_late_frontend_routes = false ) {
			if ( $load_late_frontend_routes ) {
				$route_types = $this->late_frontend_route_types();
			} else {
				$route_types = $this->route_types();
			}

			if ( empty( $route_types ) ) {
				return;
			}

			foreach ( $route_types as $route_type ) {
				if ( $this->is_request( $route_type ) && ! empty( static::$mvc_components[ $route_type ] ) ) {
					foreach ( static::$mvc_components[ $route_type ] as $mvc_component ) {
						$this->dispatch( $mvc_component );
					}
				}
			}
		}

		private function register_model_routes( $load_late_frontend_routes = false ) {
			if ( $load_late_frontend_routes && empty( $route_types = $this->late_frontend_route_types() ) ) {
				return;
			} elseif ( empty( $route_types = $this->route_types() ) ) {
				return;
			}

			foreach ( $route_types as $route_type ) {
				if ( $this->is_request( $route_type ) && ! empty( static::$models[ $route_type ] ) ) {
					foreach ( static::$models[ $route_type ] as $model ) {
						$this->dispatch_only_model( $model );
					}
				}
			}
		}

		private function dispatch( $mvc_component ) {
			$model = $view = false;

			if ( isset( $mvc_component['controller'] ) && $mvc_component['controller'] === false ) {
				return;
			}

			if ( is_callable( $mvc_component['controller'] ) ) {
				$mvc_component['controller'] = call_user_func( $mvc_component['controller'] );

				if ( $mvc_component['controller'] === false ) {
					return;
				}
			}

			if ( isset( $mvc_component['model'] ) && $mvc_component['model'] !== false ) {
				if ( is_callable( $mvc_component['model'] ) ) {
					$mvc_component['model'] = call_user_func( $mvc_component['model'] );
				}

				$model = $mvc_component['model'];
			}

			if ( isset( $mvc_component['view'] ) && $mvc_component['view'] !== false ) {
				if ( is_callable( $mvc_component['view'] ) ) {
					$mvc_component['view'] = call_user_func( $mvc_component['view'] );
				}

				$view = $mvc_component['view'];
			}

			$mvc_component['controller']::get_instance( $model, $view );
		}

		private function dispatch_only_model( $model ) {
			if ( $model === false ) {
				return;
			}

			if ( is_callable( $model ) ) {
				$model = call_user_func( $model );

				if ( $model === false ) {
					return;
				}
			}

			$model::get_instance();
		}

		public function register_model_only_routes() {
			$this->register_model_routes();
		}

		public function register_late_model_only_routes() {
			$load_late_frontend_routes = true;
			$this->register_model_routes( $load_late_frontend_routes );
		}

		public function register_defined_routes() {
			$this->register_routes();
		}

		public function register_late_frontend_routes() {
			$load_late_frontend_routes = true;
			$this->register_routes( $load_late_frontend_routes );
		}

		private function is_request( $route_type ) {
			switch ( $route_type ) {
				case 'any':
					return true;
				case 'admin':
				case 'admin_with_possible_ajax':
					return is_admin();
				case 'ajax':
					return defined( 'DOING_AJAX' );
				case 'cron':
					return defined( 'DOING_CRON' );
				case 'frontend':
				case 'frontend_with_possible_ajax':
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! defined( 'REST_REQUEST' );
				case 'late_frontend':
				case 'late_frontend_with_possible_ajax':
					return $this->is_request( 'frontend' ) || ( current_action() == 'wp' ) || ( did_action( 'wp' ) === 1 );
			}
		}
	}

}
