<?php
namespace Plugin_Name\Controllers\Frontend;

use \Plugin_Name\Core\Controller;

/**
 * Controller class that implements Plugin frontend side controller class
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/Controllers/Frontend
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Base_Controller' ) ) {
	abstract class Base_Controller extends Controller {
		protected function __construct( $model_class_name = false, $view_class_name = false ) {
			parent::__construct( $model_class_name, $view_class_name );
		}
	}
}
