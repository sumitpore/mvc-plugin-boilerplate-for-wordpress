<?php
namespace Plugin_Name\Core\Registry;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Controller' ) ) {
	/**
	 * Controller Registry
	 *
	 * Maintains the list of all controllers objects
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/Core/Registry
	 * @author     Your Name <email@example.com>
	 */
	class Controller {
		use Base_Registry;

		/**
		 * Returns key used to store a particular Controller Object
		 *
		 * @param string $controller_class_name Controller Class Name.
		 * @param string $model_class_name Model Class Name.
		 * @param string $view_class_name View Class Name.
		 * @return string
		 */
		public static function get_key( $controller_class_name, $model_class_name, $view_class_name ) {
			return "{$controller_class_name}__{$model_class_name}__{$view_class_name}";
		}
	}
}
