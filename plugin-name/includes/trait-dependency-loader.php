<?php
namespace Plugin_Name\Includes;

use \Plugin_Name as Plugin_Name;

if ( ! trait_exists( 'Dependency_Loader' ) ) {

	/**
	 * Includes all methods required for loading Plugin Dependencies
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/includes
	 * @author     Your Name <email@example.com>
	 */
	trait Dependency_Loader {

		/**
		 * Loads all Plugin dependencies
		 *
		 * @since    1.0.0
		 */
		public function load_dependencies( $class ) {
			$parts = explode('\\', $class);

			//Run this autoloader for classes related to this plugin only
			if ('Plugin_Name' !== $parts[0]) {
				return;
			}

			//Remove 'Plugin_Name' from parts
			array_shift($parts);

			$parts = array_map(function ($part) {
				return str_replace( '_', '-', strtolower( $part ) );
			}, $parts);

			$class_file_name = '/class-' . array_pop($parts) . '.php';

			$file_path = Plugin_Name::get_plugin_path() . implode('/', $parts) . $class_file_name;
			// if( $class == 'Plugin_Name\Includes\i18n' ){
			// 	print_r($file_path);
			// 	exit;
			// }
			if( \file_exists( $file_path ) ) {
				require_once( $file_path );
				return;
			}

			$trait_file_name = '/trait-' . array_pop($parts) . '.php';

			$file_path = Plugin_Name::get_plugin_path() . implode('/', $parts) . $trait_file_name;

			if( \file_exists( $file_path ) ) {
				require_once( $file_path );
			}

			// if ( false === strpos( $class, 'Plugin_Name' ) ) {
			// 	$classFileName = 'class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';
			// 	$folder        = '/';

			// 	if ( false !== strpos( $class, '_Admin' ) ) {
			// 		$folder .= 'admin/';
			// 	}

			// 	if ( false !== strpos( $class, '_Frontend' ) ) {
			// 		$folder .= 'frontend/';
			// 	}

			// 	if ( false !== strpos( $class, Plugin_Name::CLASS_PREFIX . 'View' ) ) {
			// 		$path = Plugin_Name::get_plugin_path() . 'views' . $folder . $classFileName;
			// 		require_once( $path );
			// 	} elseif ( false !== strpos( $class, Plugin_Name::CLASS_PREFIX . 'Controller' ) ) {
			// 		$path = Plugin_Name::get_plugin_path() . 'controllers' . $folder . $classFileName;
			// 		require_once( $path );
			// 	} elseif ( false !== strpos( $class, Plugin_Name::CLASS_PREFIX . 'Model' ) ) {
			// 		$path = Plugin_Name::get_plugin_path() . 'models' . $folder . $classFileName;
			// 		require_once( $path );
			// 	} else {
			// 		$path = Plugin_Name::get_plugin_path() . 'includes/' . $classFileName;
			// 		require_once( $path );
			// 	}
			// }
		}

		/**
		 * Load All Registry Class Files
		 *
		 * @since    1.0.0
		 * @return void
		 */
		private function load_registries() {
			require_once( self::$plugin_path . 'core/registry/trait-base-registry.php' );
			require_once( self::$plugin_path . 'core/registry/class-controller.php' );
			require_once( self::$plugin_path . 'core/registry/class-model.php' );
		}

		/**
		 * Load Core MVC Classes
		 *
		 * @since    1.0.0
		 * @return void
		 */
		private function load_core() {
			$this->load_registries();
			foreach ( glob( self::$plugin_path . 'core/*.php' ) as $path ) {
				require_once $path;
			}
		}

		/**
		 * Method responsible to call all the dependencies
		 *
		 * @since 1.0.01
		 */
		private function autoload_dependencies() {
			$this->load_core();
			spl_autoload_register( array( $this, 'load_dependencies' ) );
		}
	}

}
