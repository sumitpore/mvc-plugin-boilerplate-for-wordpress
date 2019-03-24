<?php

if ( ! trait_exists( 'Plugin_Name_Dependency_Loader' ) ) {

	/**
	 * Includes all methods required for loading Plugin Dependencies
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/includes
	 * @author     Your Name <email@example.com>
	 */
	trait Plugin_Name_Dependency_Loader {

		/**
		 * Loads all Plugin dependencies
		 *
		 * @since    1.0.0
		 */
		public function load_dependencies( $class ) {
			if ( false !== strpos( $class, Plugin_Name::CLASS_PREFIX ) ) {
				$classFileName = 'class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';
				$folder        = '/';

				if ( false !== strpos( $class, '_Admin' ) ) {
					$folder .= 'admin/';
				}

				if ( false !== strpos( $class, '_Public' ) ) {
					$folder .= 'public/';
				}

				if ( false !== strpos( $class, Plugin_Name::CLASS_PREFIX . 'View' ) ) {
					$path = Plugin_Name::get_plugin_path() . 'views' . $folder . $classFileName;
					require_once( $path );
				} elseif ( false !== strpos( $class, Plugin_Name::CLASS_PREFIX . 'Controller' ) ) {
					$path = Plugin_Name::get_plugin_path() . 'controllers' . $folder . $classFileName;
					require_once( $path );
				} elseif ( false !== strpos( $class, Plugin_Name::CLASS_PREFIX . 'Model' ) ) {
					$path = Plugin_Name::get_plugin_path() . 'models' . $folder . $classFileName;
					require_once( $path );
				} else {
					$path = Plugin_Name::get_plugin_path() . 'includes/' . $classFileName;
					require_once( $path );
				}
			}
		}

		/**
		 * Load All Registry Class Files
		 *
		 * @since    1.0.0
		 * @return void
		 */
		private function load_registries() {
			require_once( self::$plugin_path . 'core/registry/trait-plugin-name-registry.php' );
			require_once( self::$plugin_path . 'core/registry/class-plugin-name-model-registry.php' );
			require_once( self::$plugin_path . 'core/registry/class-plugin-name-controller-registry.php' );
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
