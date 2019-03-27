<?php
namespace Plugin_Name\Controllers\Admin;

use \Plugin_Name\Controllers\Admin\Base_Controller;
use \Plugin_Name as Plugin_Name;

/**
 * Controller class that implements Plugin Admin Settings configurations
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers/admin
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Admin_Settings' ) ) {

	class Admin_Settings extends Base_Controller {

		private static $hook_suffix = '';

		const SETTINGS_PAGE_URL = Plugin_Name::PLUGIN_ID;
		const REQUIRED_CAPABILITY = 'manage_options';


		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		protected function __construct( $model_class_name = false, $view_class_name = false ) {
			parent::__construct( $model_class_name, $view_class_name );
			static::$hook_suffix = 'settings_page_' . Plugin_Name::PLUGIN_ID;

			$this->register_hook_callbacks();
		}

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		protected function register_hook_callbacks() {
			add_action( 'admin_menu', array( $this, 'plugin_menu' ) );
			add_action( 'admin_print_scripts-' . static::$hook_suffix, array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_print_styles-' . static::$hook_suffix, array( $this, 'enqueue_styles' ) );
			add_action( 'load-' . static::$hook_suffix, array( $this, 'register_fields' ) );

			add_filter(
				'plugin_action_links_' . Plugin_Name::PLUGIN_ID . '/' . Plugin_Name::PLUGIN_ID . '.php',
				array( $this, 'add_plugin_action_links' )
			);
		}

		/**
		 * Create menu for Plugin inside Settings menu
		 *
		 * @since    1.0.0
		 */
		public function plugin_menu() {
			static::$hook_suffix = add_options_page(
				__( Plugin_Name::PLUGIN_NAME, Plugin_Name::PLUGIN_ID ),        // Page Title
				__( Plugin_Name::PLUGIN_NAME, Plugin_Name::PLUGIN_ID ),        // Menu Title
				static::REQUIRED_CAPABILITY,           // Capability
				static::SETTINGS_PAGE_URL,             // Menu URL
				array( $this, 'markup_settings_page' ) // Callback
			);
		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_scripts( $hook ) {

			/**
			 * This function is provided for demonstration purposes only.
			 */

			wp_enqueue_script(
				Plugin_Name::PLUGIN_ID . '_admin-js',
				Plugin_Name::get_plugin_url() . 'views/admin/js/' . Plugin_Name::PLUGIN_ID . '-admin.js',
				array( 'jquery' ),
				Plugin_Name::PLUGIN_VERSION,
				true
			);
		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_styles( $hook ) {

			/**
			 * This function is provided for demonstration purposes only.
			 */

			wp_enqueue_style(
				Plugin_Name::PLUGIN_ID . '_admin-css',
				Plugin_Name::get_plugin_url() . 'views/admin/css/' . Plugin_Name::PLUGIN_ID . '-admin.css',
				array(),
				Plugin_Name::PLUGIN_VERSION,
				'all'
			);
		}

		/**
		 * Creates the markup for the Settings page
		 *
		 * @since    1.0.0
		 */
		public function markup_settings_page() {
			if ( current_user_can( static::REQUIRED_CAPABILITY ) ) {
				$this->view->admin_settings_page(
					array(
						'page_title'    => Plugin_Name::PLUGIN_NAME,
						'settings_name' => $this->get_model()::SETTINGS_NAME,
					)
				);
			} else {
				wp_die( __( 'Access denied.' ) );
			}
		}

		/**
		 * Registers settings sections and fields
		 *
		 * @since    1.0.0
		 */
		public function register_fields() {

			// Add Settings Page Section
			add_settings_section(
				'plugin_name_section',                    // Section ID
				__( 'Settings', Plugin_Name::PLUGIN_ID ), // Section Title
				array( $this, 'markup_section_headers' ), // Section Callback
				static::SETTINGS_PAGE_URL                 // Page URL
			);

			// Add Settings Page Field
			add_settings_field(
				'plugin_name_field',                                // Field ID
				__( 'Plugin Name Field:', Plugin_Name::PLUGIN_ID ), // Field Title
				array( $this, 'markup_fields' ),                    // Field Callback
				static::SETTINGS_PAGE_URL,                          // Page
				'plugin_name_section',                              // Section ID
				array(                                              // Field args
					'id'        => 'plugin_name_field',
					'label_for' => 'plugin_name_field',
				)
			);
		}

		/**
		 * Adds the section introduction text to the Settings page
		 *
		 * @param array $section
		 *
		 * @since    1.0.0
		 */
		public function markup_section_headers( $section ) {
			$this->view->section_headers(
				array(
					'section'      => $section,
					'text_example' => __( 'This is a text example for section header', Plugin_Name::PLUGIN_ID ),
				)
			);
		}

		/**
		 * Delivers the markup for settings fields
		 *
		 * @param array $args
		 *
		 * @since    1.0.0
		 */
		public function markup_fields( $field_args ) {
			$field_id = $field_args['id'];
			$settings_value = $this->model->get_settings( $field_id );
			$this->view->markup_fields(
				array(
					'field_id'       => esc_attr( $field_id ),
					'settings_name'  => get_class( $this->model )::SETTINGS_NAME,
					'settings_value' => ! empty( $settings_value ) ? esc_attr( $settings_value ) : '',
				)
			);
		}

		/**
		 * Adds links to the plugin's action link section on the Plugins page
		 *
		 * @param array $links The links currently mapped to the plugin
		 * @return array
		 *
		 * @since    1.0.0
		 */
		public function add_plugin_action_links( $links ) {
			$settings_link = '<a href="options-general.php?page=' . static::SETTINGS_PAGE_URL . '">' . __( 'Settings', Plugin_Name::PLUGIN_ID ) . '</a>';
			array_unshift( $links, $settings_link );

			return $links;
		}

	}

}
