<?php
namespace Plugin_Name\Includes;

if ( ! class_exists( 'Requirements_Checker' ) ) {
	/**
	 * Checks whether plugin's requirements are being met or not
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/Includes
	 */
	class Requirements_Checker {

		/**
		 * Holds minimum php version for plugin if not defined in `requirements.php`.
		 *
		 * @var string
		 * @since 1.0.0
		 */
		private $min_php_version = '5.6';

		/**
		 * Holds minimum wp version for plugin if not defined in `requirements.php`.
		 *
		 * @var string
		 * @since 1.0.0
		 */
		private $min_wp_version = '4.8';

		/**
		 * Holds the information whether plugin is compatible with Multisite or not.
		 *
		 * @var boolean
		 * @since 1.0.0
		 */
		private $is_multisite_compatible = false;

		/**
		 * Holds list of required plugins to be installed and active for our plugin to work
		 *
		 * @var array
		 * @since 1.0.0
		 */
		private $required_plugins = [];

		/**
		 * Holds Error messages if dependencies are not met
		 *
		 * @var array
		 * @since 1.0.0
		 */
		private $errors = [];

		/**
		 * Constructor
		 *
		 * @param array $requirements_data Requirements Data mentioned in `requirements.php`.
		 * @since 1.0.0
		 */
		public function __construct( $requirements_data ) {
			if ( isset( $requirements_data['min_php_version'] ) ) {
				$this->min_php_version = $requirements_data['min_php_version'];
			}

			if ( isset( $requirements_data['min_wp_version'] ) ) {
				$this->min_wp_version = $requirements_data['min_wp_version'];
			}

			if ( isset( $requirements_data['is_multisite_compatible'] ) ) {
				$this->is_multisite_compatible = $requirements_data['is_multisite_compatible'];
			}

			if ( isset( $requirements_data['required_plugins'] ) ) {
				$this->required_plugins = $requirements_data['required_plugins'];
			}
		}

		/**
		 * Checks if Installed PHP Version is higher than required PHP Version
		 *
		 * @return boolean
		 * @since 1.0.0
		 */
		private function is_php_version_dependency_met() {
			$is_required_php_version_installed = version_compare( PHP_VERSION, $this->min_php_version, '>=' );

			if ( 1 == $is_required_php_version_installed ) {
				return true;
			}

			$this->add_error_notice(
				'PHP ' . $this->min_php_version . '+ is required',
				'You\'re running version ' . PHP_VERSION
			);

			return false;
		}

		/**
		 * Checks if Installed WP Version is higher than required WP Version
		 *
		 * @return boolean
		 * @since 1.0.0
		 */
		private function is_wp_version_dependency_met() {
			global $wp_version;
			$is_required_wp_version_installed = version_compare( $wp_version, $this->min_wp_version, '>=' );

			if ( 1 == $is_required_wp_version_installed ) {
				return true;
			}

			$this->add_error_notice(
				'WordPress ' . $this->min_wp_version . '+ is required',
				'You\'re running version ' . $wp_version
			);

			return false;
		}

		/**
		 * Checks if Multisite Dependencies are met
		 *
		 * @return boolean
		 * @since 1.0.0
		 */
		private function is_wp_multisite_dependency_met() {
			$is_wp_multisite_dependency_met = is_multisite() && ( false === $this->is_multisite_compatible ) ? false : true;

			if ( false == $is_wp_multisite_dependency_met ) {
				$this->add_error_notice(
					'Your site is set up as a Network (Multisite)',
					'This plugin is not compatible with multisite environment'
				);
			}

			return $is_wp_multisite_dependency_met;
		}

		/**
		 * Checks whether plugin is active or not
		 *
		 * @param string $plugin_name Name of the plugin.
		 * @param string $plugin_slug Slug of the plugin.
		 * @return boolean
		 * @since 1.0.0
		 */
		private function is_plugin_active( $plugin_name, $plugin_slug ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			if ( is_plugin_active( $plugin_slug ) ) {
				return true;
			}

			$this->add_error_notice(
				$plugin_name . ' is a required plugin.',
				$plugin_name . ' needs to be installed & activated.'
			);

			return false;
		}

		/**
		 * Returns the plugin version of passed plugin
		 *
		 * @param string $plugin_slug Plugin Slug of whose version needs to be retrieved.
		 * @return string Plugin Version
		 * @since 1.0.0
		 */
		private function get_plugin_version( $plugin_slug ) {
			$plugin_file_path = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . $plugin_slug;

			if ( ! file_exists( $plugin_file_path ) ) {
				$plugin_file_path = WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . $plugin_slug;
			}

			$plugin_data = get_plugin_data( $plugin_file_path, false, false );

			if ( empty( $plugin_data['Version'] ) ) {
				return '0.0';
			}

			return $plugin_data['Version'];
		}

		/**
		 * Checks whether required version of plugin is active
		 *
		 * @param string $plugin_name Plugin Name.
		 * @param string $plugin_slug Plugin Slug.
		 * @param string $min_plugin_version Minimum version required of the plugin.
		 * @return boolean
		 * @since 1.0.0
		 */
		private function is_required_plugin_version_active( $plugin_name, $plugin_slug, $min_plugin_version ) {
			$installed_plugin_version = $this->get_plugin_version( $plugin_slug );
			$is_required_plugin_version_active = version_compare( $installed_plugin_version, $min_plugin_version, '>=' );

			if ( 1 == $is_required_plugin_version_active ) {
				return true;
			}

			$this->add_error_notice(
				"{$plugin_name} {$min_plugin_version}+ is required.",
				"{$plugin_name} {$installed_plugin_version} is installed."
			);

			return false;
		}

		/**
		 * Checks whether all required plugins are installed & active with proper versions.
		 *
		 * @return boolean
		 * @since 1.0.0
		 */
		private function are_required_plugins_dependency_met() {
			$plugin_dependency_met = true;

			if ( empty( $this->required_plugins ) ) {
				return true;
			}

			$installed_plugins = array_filter(
				$this->required_plugins,
				function( $required_plugin_data, $required_plugin_name ) {
					return $this->is_plugin_active( $required_plugin_name, $required_plugin_data['plugin_slug'] );
				},
				ARRAY_FILTER_USE_BOTH
			);

			// If All Plugins are not installed, set plugin_dependency_met flag as false.
			if ( count( $installed_plugins ) !== count( $this->required_plugins ) ) {
				$plugin_dependency_met = false;
			}

			$plugins_installed_with_required_version = array_filter(
				$installed_plugins,
				function( $required_plugin_data, $required_plugin_name ) {
					return $this->is_required_plugin_version_active( $required_plugin_name, $required_plugin_data['plugin_slug'], $required_plugin_data['min_plugin_version'] );
				},
				ARRAY_FILTER_USE_BOTH
			);

			// All Plugins did not met minimum version dependency.
			if ( count( $plugins_installed_with_required_version ) !== count( $this->required_plugins ) ) {
				$plugin_dependency_met = false;
			}

			return $plugin_dependency_met;
		}


		/**
		 * Adds Error message in $errors variable
		 *
		 * @param string $error_message Error Message.
		 * @param string $supportive_information Supportive Information to be displayed along with Error Message in brackets.
		 * @return void
		 * @since 1.0.0
		 */
		private function add_error_notice( $error_message, $supportive_information ) {
			$this->errors[] = (object) [
				'error_message' => $error_message,
				'supportive_information' => $supportive_information,
			];
		}

		/**
		 * Checks if all plugins requirements are met or not
		 *
		 * @return boolean
		 * @since 1.0.0
		 */
		public function requirements_met() {
			$requirements_met = true;

			if ( ! $this->is_php_version_dependency_met() ) {
				$requirements_met = false;
			}

			if ( ! $this->is_wp_version_dependency_met() ) {
				$requirements_met = false;
			}

			if ( ! $this->is_wp_multisite_dependency_met() ) {
				$requirements_met = false;
			}

			if ( ! $this->are_required_plugins_dependency_met() ) {
				$requirements_met = false;
			}

			return $requirements_met;
		}

		/**
		 * Prints an error that the system requirements weren't met.
		 *
		 * @since    1.0.0
		 */
		public function show_requirements_errors() {
			$errors = $this->errors;
			require_once( dirname( dirname( __FILE__ ) ) . '/app/templates/admin/errors/requirements-error.php' );
		}
	}
}
