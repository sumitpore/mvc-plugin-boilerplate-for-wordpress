<?php
namespace Plugin_Name\Models\Admin;

use \Plugin_Name\Core\Model;

/**
 * Defines/implements base methods for admin model classes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/models/admin
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Base_Model' ) ) {
	abstract class Base_Model extends Model {

	}

}
