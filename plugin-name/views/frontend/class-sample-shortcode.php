<?php
namespace Plugin_Name\Views\Frontend;

use \Plugin_Name\Core\View;
use \Plugin_Name as Plugin_Name;

/**
 * View class to load Shortcode HTML
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/views/frontend
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Sample_Shortcode' ) ) {
	class Sample_Shortcode extends View {
		public function shortcode_html( $args = [] ) {
			return $this->render_template(
				'frontend/hello-world-shortocde.php',
				$args
			);
		}
	}
}
