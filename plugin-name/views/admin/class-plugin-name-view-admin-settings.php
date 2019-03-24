<?php

/**
 * View class to load all templates related to Plugin's Admin Settings Page
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/views/admin
 */

if ( ! class_exists( 'Plugin_Name_View_Admin_Settings' ) ) {
	class Plugin_Name_View_Admin_Settings extends Plugin_Name_View {
		public function admin_settings_page( $args = [] ) {
			echo $this->render_template(
				'admin/page-settings/page-settings.php',
				$args
			);
		}

		public function section_headers( $args = [] ) {
			echo $this->render_template(
				'admin/page-settings/page-settings-section-headers.php',
				$args
			);
		}

		public function markup_fields( $args = [] ) {
			echo $this->render_template(
				'admin/page-settings/page-settings-fields.php',
				$args
			);
		}
	}
}
