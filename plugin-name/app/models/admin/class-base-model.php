<?php
namespace Plugin_Name\App\Models\Admin;

use \Plugin_Name\Core\Model;

/**
 * Blueprint for Admin related Models. All Admin Models should extend this Base_Model
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/Models/Admin
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
