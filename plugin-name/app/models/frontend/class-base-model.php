<?php
namespace Plugin_Name\App\Models\Frontend;

use \Plugin_Name\Core\Model;

/**
 * Defines/implements base methods for Frontend model classes
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/Models/Frontend
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Base_Model' ) ) {
	abstract class Base_Model extends Model {

	}
}
