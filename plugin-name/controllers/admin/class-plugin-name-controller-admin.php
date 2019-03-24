<?php

/**
 * Defines/implements base methods for admin controller classes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers/admin
 */

if ( ! class_exists( 'Plugin_Name_Controller_Admin' ) ) {
	abstract class Plugin_Name_Controller_Admin extends Plugin_Name_Controller {
		protected function __construct( $model_class_name = false, $view_class_name = false ) {
			parent::__construct( $model_class_name, $view_class_name );
		}
	}

}
