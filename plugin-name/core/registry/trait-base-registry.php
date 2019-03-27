<?php
namespace Plugin_Name\Core\Registry;

if ( ! trait_exists( 'Base_Registry' ) ) {

	trait Base_Registry {

		protected static $stored_objects = [];

		/**
		 * @param string $key
		 * @param mixed  $value
		 *
		 * @return void
		 */
		public static function set( string $key, $value ) {
			static::$stored_objects[ $key ] = $value;
		}

		/**
		 * @param string $key
		 *
		 * @return mixed
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
		 */
		public static function get_all_objects() {
			return static::$stored_objects;
		}
	}

}
