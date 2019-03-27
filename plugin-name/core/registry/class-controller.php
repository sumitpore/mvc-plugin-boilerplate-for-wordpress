<?php
namespace Plugin_Name\Core\Registry;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Controller' ) ) {
	class Controller {
		use Base_Registry;

		public static function get_key( $controller_class_name, $model_class_name, $view_class_name ) {
			return "{$controller_class_name}__{$model_class_name}__{$view_class_name}";
		}
	}
}
