<?php

/**
 * Controller class that implements Plugin Admin Settings configurations
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers/admin
 *
 */

if ( ! class_exists( 'Plugin_Name_Controller_Admin_Settings' ) ) {

	class Plugin_Name_Controller_Admin_Settings extends Plugin_Name_Controller_Admin {

		private static $hook_suffix = '';

		const SETTINGS_PAGE_URL = Plugin_Name::PLUGIN_ID;
		const REQUIRED_CAPABILITY = 'manage_options';


		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		protected function __construct() {

			static::$hook_suffix = 'settings_page_' . Plugin_Name::PLUGIN_ID;

			$this->register_hook_callbacks();
			$this->model = Plugin_Name_Model_Admin_Settings::get_instance();

		}

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		protected function register_hook_callbacks() {

			Plugin_Name_Actions_Filters::add_action( 'admin_menu',                                  $this, 'plugin_menu' );
			Plugin_Name_Actions_Filters::add_action( 'admin_print_scripts-' . static::$hook_suffix, $this, 'enqueue_scripts' );
			Plugin_Name_Actions_Filters::add_action( 'admin_print_styles-' . static::$hook_suffix,  $this, 'enqueue_styles' );
			Plugin_Name_Actions_Filters::add_action( 'load-' . static::$hook_suffix,                $this, 'register_fields' );

			Plugin_Name_Actions_Filters::add_filter(
				'plugin_action_links_' . Plugin_Name::PLUGIN_ID . '/' . Plugin_Name::PLUGIN_ID . '.php',
				$this,
				'add_plugin_action_links'
			);

		}

		/** 
		 * Create menu for Plugin inside Settings menu
		 *
		 * @since    1.0.0
		 */
		public function plugin_menu() {

			static::$hook_suffix = add_options_page(
				__( Plugin_Name::PLUGIN_NAME ),        // Page Title
				__( Plugin_Name::PLUGIN_NAME ),        // Menu Title
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
			 *
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
			 *
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

				echo static::render_template(
					'page-settings/page-settings.php',
					array(
						'page_title' 	=> Plugin_Name::PLUGIN_NAME,
						'settings_name' => Plugin_Name_Model_Admin_Settings::SETTINGS_NAME
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
				__( 'Settings' ),                         // Section Title
				array( $this, 'markup_section_headers' ), // Section Callback
				static::SETTINGS_PAGE_URL                 // Page URL
			);

			// Add Settings Page Field
			add_settings_field(
				'plugin_name_field',                        // Field ID
				__( 'Plugin Name Field:' ),                 // Field Title 
				array( $this, 'markup_fields' ),            // Field Callback
				static::SETTINGS_PAGE_URL,                  // Page
				'plugin_name_section',                      // Section ID
				array(                                      // Field args
					'id'        => 'plugin_name_field',
					'label_for' => 'plugin_name_field'
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

			echo static::render_template(
				'page-settings/page-settings-section-headers.php',
				array(
					'section'      => $section,
					'text_example' => __( 'This is a text example for section header' )
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
			$settings_value = static::get_model()->get_settings( $field_id );

			echo static::render_template(
				'page-settings/page-settings-fields.php',
				array(
					'field_id'       => esc_attr( $field_id ),
					'settings_name'  => Plugin_Name_Model_Admin_Settings::SETTINGS_NAME,
					'settings_value' => ! empty( $settings_value ) ? esc_attr( $settings_value ) : ''
				),
				'always'
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

			$settings_link = '<a href="options-general.php?page=' . static::SETTINGS_PAGE_URL . '">' . __( 'Settings' ) . '</a>';
			array_unshift( $links, $settings_link );

			return $links;

		}

	}

}