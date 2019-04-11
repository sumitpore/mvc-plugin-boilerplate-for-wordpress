<?php
namespace Plugin_Name\App\Models\Frontend;

use \Plugin_Name\Core\Model;

/**
 * Blueprint for Frontend related Models. All Frontend Models should extend this Base_Model
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/Models/Frontend
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Base_Model' ) ) {
	abstract class Base_Model extends Model {

		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		abstract protected function __construct();

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		abstract protected function register_hook_callbacks();

	}
}
