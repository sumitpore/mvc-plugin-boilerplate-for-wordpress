<?php
namespace Plugin_Name\Core\Registry;

if ( ! trait_exists( 'Base_Registry' ) ) {
	/**
	 * Base Registry Trait
	 *
	 * Controller Registry and Model Registry use this trait to deal with all
	 * objects.
	 *
	 * This trait provides methods to store & retrieve objects in Registry
	 *
	 * If you have not heard about the term Registry before, think of hashmaps.
	 * So creating registry means creating hashmaps to store objects.
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/Core/Registry
	 * @author     Your Name <email@example.com>
	 */
	trait Base_Registry {

		/**
		 * Variable that holds all objects in registry.
		 *
		 * @var array
		 */
		protected static $stored_objects = [];

		/**
		 * Add object to registry
		 *
		 * @param string $key Key to be used to map with Object.
		 * @param mixed  $value Object to Store.
		 * @return void
		 * @since 1.0.0
		 */
		public static function set( $key, $value ) {
			if ( ! is_string( $key ) ) {
				trigger_error( __( 'Key passed to `set` method must be key', Plugin_Name::PLUGIN_ID ), E_USER_ERROR ); // @codingStandardsIgnoreLine.
			}
			static::$stored_objects[ $key ] = $value;
		}

		/**
		 * Get object from registry
		 *
		 * @param string $key Key of the object to restore.
		 * @return mixed
		 * @since 1.0.0
		 */
		public static function get( $key ) {
			if ( ! is_string( $key ) ) {
				trigger_error( __( 'Key passed to `get` method must be key', Plugin_Name::PLUGIN_ID ), E_USER_ERROR ); // @codingStandardsIgnoreLine.
			}

			if ( ! isset( static::$stored_objects[ $key ] ) ) {
				return null;
			}

			return static::$stored_objects[ $key ];
		}

		/**
		 * Returns all objects
		 *
		 * @return array
		 * @since 1.0.0
		 */
		public static function get_all_objects() {
			return static::$stored_objects;
		}
	}

}
