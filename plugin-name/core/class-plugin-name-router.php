<?php

/**
 * Class Responsible for registering Routes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers
 *
 */

if ( ! class_exists( 'Plugin_Name_Router' ) ) {

	class Plugin_Name_Router {
		private static $instance;

		private static $mvc_components = [];

		private static $models = [];

		public static function get_instance()
		{
			if (null === static::$instance) {
				static::$instance = new static();
			}
			return static::$instance;
		}

		private function __construct(){
			$this->register_hook_callbacks();
		}

		protected function register_hook_callbacks(){
			Plugin_Name_Actions_Filters::add_action( 'init', $this, 'register_model_only_routes' );
			Plugin_Name_Actions_Filters::add_action( 'wp', $this, 'register_late_model_only_routes' );

			Plugin_Name_Actions_Filters::add_action( 'init', $this, 'register_defined_routes' );
			Plugin_Name_Actions_Filters::add_action( 'wp', $this, 'register_late_frontend_routes' );
		}

		public function route_types(){
			return apply_filters('plugin_name_route_types', [
				'any',
				'admin',
				'admin_with_possible_ajax',
				'ajax',
				'cron',
				'frontend',
				'frontend_with_possible_ajax',
			]);
		}

		public function late_frontend_route_types(){
			return apply_filters('plugin_name_late_frontend_route_types', [
				'late_frontend',
				'late_frontend_with_possible_ajax'
			]);
		}

		public function register_route_of_type($type){
			$this->route_type_to_register = $type;
			return $this;
		}

		public function without_controller_but_with_model($model){
			if( $model === false ){
				return $this;
			}
			static::$models[$this->route_type_to_register][] = $model;
		}

		public function with_controller($controller){

			$this->current_controller = $controller;

			if( $controller === false ){
				return $this;
			}

			static::$mvc_components[$this->route_type_to_register][] = ['controller' => $controller];
			$this->route_index = static::$mvc_components[$this->route_type_to_register][count(static::$mvc_components[$this->route_type_to_register]) - 1];

			return $this;
		}

		public function with_model($model){
			if( static::$mvc_components[$this->route_type_to_register][$this->route_index]['controller'] == $this->current_controller) {
				static::$mvc_components[$this->route_type_to_register][$this->route_index]['model'] = $model;
			}
			return $this;
		}


		public function with_view($view){
			if( static::$mvc_components[$this->route_type_to_register][$this->route_index]['controller'] == $this->current_controller) {
				static::$mvc_components[$this->route_type_to_register][$this->route_index]['view'] = $view;
			}
			return $this;
		}

		private function register_routes( $load_late_frontend_routes = false ){

			if( $load_late_frontend_routes && empty( $route_types = $this->late_frontend_route_types() ) ){
				return;
			}
			elseif( empty( $route_types =  $this->route_types() ) ) {
				return;
			}

			foreach( $route_types as $route_type ) {
				if( $this->is_request( $route_type ) && !empty( static::$mvc_components[ $route_type ] ) ) {
					foreach( static::$mvc_components[ $route_type ] as $mvc_component ) {
						$this->dispatch($mvc_component);
					}
				}
			}
		}

		private function register_model_routes( $load_late_frontend_routes = false ){

			if( $load_late_frontend_routes && empty( $route_types = $this->late_frontend_route_types() ) ){
				return;
			}
			elseif( empty( $route_types =  $this->route_types() ) ) {
				return;
			}

			foreach( $route_types as $route_type ) {
				if( $this->is_request( $route_type ) && !empty( static::$models[ $route_type ] ) ) {
					foreach( static::$models[ $route_type ] as $model ) {
						$this->dispatch_only_model($model);
					}
				}
			}
		}

		private function dispatch($mvc_component){

			if( $mvc_component['controller'] === false ){
				return;
			}

			if( $mvc_component['model'] !== false ){
				$model = $mvc_component['model']::get_instance();
			}

			if( $mvc_component['view'] !== false ){
				$view = new $mvc_component['view'];
			}

			$mvc_component['controller']::get_instance($model, $view);

		}

		private function dispatch_only_model($model){

			if($model === false){
				return;
			}

			$model::get_instance();

		}

		public function register_model_only_routes(){
			$this->register_model_routes();
		}

		public function register_late_model_only_routes(){
			$load_late_frontend_routes = true;
			$this->register_model_routes($load_late_frontend_routes);
		}

		public function register_defined_routes(){
			$this->register_routes();
		}

		public function register_late_frontend_routes(){
			$load_late_frontend_routes = true;
			$this->register_routes($load_late_frontend_routes);
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
				return $this->is_request('frontend') || ( current_action() == 'wp' ) || ( did_action( 'wp' ) === 1 );
			}
		}
	}

}
