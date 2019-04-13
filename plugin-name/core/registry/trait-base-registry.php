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

		protected static $stored_objects = [];

		/**
		 * Add object to registry
		 *
		 * @param string $key Key to be used to map with Object
		 * @param mixed  $value Object to Store
		 * @return void
		 * @since 1.0.0
		 */
		public static function set( string $key, $value ) {
			static::$stored_objects[ $key ] = $value;
		}

		/**
		 * Get object from registry
		 *
		 * @param string $key
		 * @return mixed
		 * @since 1.0.0
		 */
		public static function get( string $key ) {
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
