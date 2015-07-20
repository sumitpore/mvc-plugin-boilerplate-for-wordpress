<?php

/**
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       MVC WordPress Plugin Boilerplate
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_REQUIRED_PHP_VERSION', '5.3' ); // because of get_called_class()
define( 'PLUGIN_NAME_REQUIRED_WP_VERSION',  '3.0' );
define( 'PLUGIN_NAME_REQUIRED_WP_NETWORK',  false ); // because plugin is not compatible with WordPress multisite

/**
 * Checks if the system requirements are met
 *
 * @since    1.0.0
 * @return bool True if system requirements are met, false if not
 */
function plugin_name_requirements_met() {

	global $wp_version;

	if ( version_compare( PHP_VERSION, PLUGIN_NAME_REQUIRED_PHP_VERSION, '<' ) ) {
		return false;
	}
	if ( version_compare( $wp_version, PLUGIN_NAME_REQUIRED_WP_VERSION, '<' ) ) {
		return false;
	}
	if ( is_multisite() != PLUGIN_NAME_REQUIRED_WP_NETWORK ) {
		return false;
	}

	return true;

}

/**
 * Prints an error that the system requirements weren't met.
 *
 * @since    1.0.0
 */
function plugin_name_requirements_error() {

	global $wp_version;
	require_once( dirname( __FILE__ ) . '/views/admin/errors/requirements-error.php' );

}

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	/**
	 * Check requirements and load main class
	 * The main program needs to be in a separate file that only gets loaded if the plugin requirements are met.
	 * Otherwise older PHP installations could crash when trying to parse it.
	 **/
	if ( plugin_name_requirements_met() ) {

		/**
		 * The core plugin class that is used to define internationalization,
		 * admin-specific hooks, and public-facing site hooks.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name.php';

		/**
		 * Begins execution of the plugin.
		 *
		 * Since everything within the plugin is registered via hooks,
		 * then kicking off the plugin from this point in the file does
		 * not affect the page life cycle.
		 *
		 * @since    1.0.0
		 */
		$plugin = Plugin_Name::get_instance();

	} else {

		add_action( 'admin_notices', 'plugin_name_requirements_error' );
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		deactivate_plugins( plugin_basename( __FILE__ ) );

	}

}
run_plugin_name();