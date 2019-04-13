<?php
namespace Plugin_Name\Core\Registry;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Model' ) ) {
	/**
	 * Model Registry
	 *
	 * Maintains the list of all models objects
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/Core/Registry
	 * @author     Your Name <email@example.com>
	 */
	class Model {
		use Base_Registry;
	}
}
