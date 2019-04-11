<?php
namespace Plugin_Name\App\Controllers\Admin;

use \Plugin_Name\Core\Controller;

/**
 * Defines/implements base methods for admin controller classes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers/admin
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Base_Controller' ) ) {
	abstract class Base_Controller extends Controller {
		protected function __construct( $model_class_name = false, $view_class_name = false ) {
			parent::__construct( $model_class_name, $view_class_name );
		}

		/**
		 * Register callbacks for actions and filters
		 */
		abstract protected function register_hook_callbacks();
	}

}
