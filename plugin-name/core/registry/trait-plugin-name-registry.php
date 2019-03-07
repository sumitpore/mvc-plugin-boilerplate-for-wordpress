<?php

if ( ! trait_exists( 'Plugin_Name_Registry' ) ) {

	trait Plugin_Name_Registry {

		protected static $stored_objects = [];

		/**
		 * @param string $key
		 * @param mixed  $value
		 *
		 * @return void
		 */
		public static function set(string $key, $value)
		{
			static::$stored_objects[$key] = $value;
		}

		/**
		 * @param string $key
		 *
		 * @return mixed
		 */
		public static function get(string $key)
		{
			if (!isset(static::$stored_objects[$key])) {
				throw new \InvalidArgumentException('Invalid key given');
			}

			return static::$stored_objects[$key];
		}
	}

}
