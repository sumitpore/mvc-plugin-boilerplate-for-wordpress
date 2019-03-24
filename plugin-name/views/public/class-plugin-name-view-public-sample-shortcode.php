<?php

/**
 * View class to load Shortcode HTML
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/views/public
 */

if ( ! class_exists( 'Plugin_Name_View_Public_Sample_Shortcode' ) ) {
	class Plugin_Name_View_Public_Sample_Shortcode extends Plugin_Name_View {
		public function shortcode_html( $args = [] ) {
			return $this->render_template(
				'public/hello-world-shortocde.php',
				$args
			);
		}
	}
}
