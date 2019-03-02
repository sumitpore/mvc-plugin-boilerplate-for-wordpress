<?php

/**
 * Controller class that implements Plugin Admin Notices messages
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers/admin
 *
 */

if ( ! class_exists( 'Plugin_Name_Controller_Admin_Notices' ) ) {

	class Plugin_Name_Controller_Admin_Notices extends Plugin_Name_Controller_Admin_Settings {

		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		protected function __construct() {

			$this->register_hook_callbacks();
			$this->model = Plugin_Name_Model_Admin_Notices::get_instance();

		}

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		protected function register_hook_callbacks() {

			Plugin_Name_Actions_Filters::add_action( 'admin_notices', $this, 'show_admin_notices' );

		}

		/**
		 * Show admin notices
		 *
		 * @since    1.0.0
		 */
		public function show_admin_notices() {

			return static::get_model()->show_admin_notices();

		}

		/**
		 * Add admin notices
		 *
		 * @since    1.0.0
		 */
		public static function add_admin_notice( $notice_text ) {

			$notice = static::render_template(
				'admin/errors/admin-notice.php',
				array(
					'admin_notice' => esc_attr( $notice_text )
				)
			);

			return static::get_model()->add_admin_notice( $notice );

		}
	
	}

}