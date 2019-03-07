<?php

/**
 * Class Responsible for Loading Templates
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers
 *
 */

if ( ! class_exists( 'Plugin_Name_View' ) ) {

	class Plugin_Name_View {
		/**
		 * Render a template
		 *
		 * @param  string $default_template_path The path to the template, relative to the plugin's `views` folder
		 * @param  array  $variables             An array of variables to pass into the template's scope, indexed with the variable name so that it can be extract()-ed
		 * @param  string $require               'once' to use require_once() | 'always' to use require()
		 * @return string
		 *
		 * @since    1.0.0
		 */
		public static function render_template( $default_template_path = false, $variables = array(), $require = 'once' ){

			if ( ! $template_path = locate_template( basename( $default_template_path ) ) ) {
				$template_path = Plugin_Name::get_plugin_path() . '/templates/' . $default_template_path;
			}

			if ( is_file( $template_path ) ) {
				extract( $variables );
				ob_start();
				if ( 'always' == $require ) {
					require( $template_path );
				} else {
					require_once( $template_path );
				}
				$template_content = apply_filters( 'plugin_name_template_content', ob_get_clean(), $default_template_path, $template_path, $variables );
			} else {
				$template_content = '';
			}

			return $template_content;
		}

	}

}
