<?php
namespace Plugin_Name\App\Models\Admin;

use Plugin_Name\Core\Model;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Base_Model' ) ) {
	/**
	 * Blueprint for Admin related Models. All Admin Models should extend this Base_Model
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/Models/Admin
	 */
	abstract class Base_Model extends Model {


		/**
		 * Register callbacks for actions and filters. Most of your add_action/add_filter
		 * go into this method.
		 *
		 * NOTE: register_hook_callbacks method is not called automatically. You
		 * as a developer have to call this method where you see fit. For Example,
		 * You may want to call this in constructor, if you feel hooks/filters
		 * callbacks should be registered when the new instance of the class
		 * is created.
		 *
		 * The purpose of this method is to set the convention that first place to
		 * find add_action/add_filter is register_hook_callbacks method.
		 *
		 * This method is not marked abstract because it may not be needed in every
		 * model. Making it abstract would enforce every child class to implement
		 * the method.
		 *
		 * If I were you, I would define register_hook_callbacks method in the child
		 * class when it is a 'Model only' route. This is not a rule, it
		 * is just my opinion when I would define this method.
		 *
		 * @since    1.0.0
		 */
		protected function register_hook_callbacks(){}

	}

}
