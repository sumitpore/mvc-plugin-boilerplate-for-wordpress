<?php

/**
 * Controller class that implements Plugin public side controller class
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers
 */

if ( ! class_exists( 'Plugin_Name_Controller_Public' ) ) {
	abstract class Plugin_Name_Controller_Public extends Plugin_Name_Controller {
		protected function __construct( $model_class_name = false, $view_class_name = false ) {
			parent::__construct( $model_class_name, $view_class_name );
		}
	}
}
