<?php
if ( ! class_exists( 'Plugin_Name_Controller_Registry' ) ) {
	class Plugin_Name_Controller_Registry {
		use Plugin_Name_Registry;

		public static function get_key( $controller_class_name, $model_class_name, $view_class_name ) {
			return "{$controller_class_name}__{$model_class_name}__{$view_class_name}";
		}
	}
}
