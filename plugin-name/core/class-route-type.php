<?php
namespace Plugin_Name\Core;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Route_Type' ) ) {
	/**
	 * Class Responsible for registering Route Types supported by the Application
	 *
	 * @since      1.0.0
	 * @package    Plugin_Name
	 * @subpackage Plugin_Name/Route_Types
	 */
	class Route_Type {

		/**
		 * Use this route type if a controller/model needs to be loaded on every
		 * request
		 *
		 * This route type is registered on `init` hook.
		 *
		 * @since    1.0.0
		 */
		const ANY = 'any';

		/**
		 * Use this route type if a controller/model needs to be loaded only on
		 * admin/dashboard request
		 *
		 * This route type is registered on `init` hook.
		 *
		 * @since    1.0.0
		 */
		const ADMIN = 'admin';

		/**
		 * Use this route type if a controller/model needs to be loaded only on
		 * admin/dashboard & it has ajax support
		 *
		 * This route type is registered on `init` hook.
		 *
		 * @since 1.0.0
		 */
		const ADMIN_WITH_POSSIBLE_AJAX = 'admin_with_possible_ajax';

		/**
		 * Use this route type if a controller/model needs to be loaded only on
		 * Ajax Requests
		 *
		 * This route type is registered on `init` hook.
		 *
		 * @since 1.0.0
		 */
		const AJAX = 'ajax';

		/**
		 * Use this route type if a controller/model needs to be loaded only on
		 * Cron Requests
		 *
		 * This route type is registered on `init` hook.
		 *
		 * @since 1.0.0
		 */
		const CRON = 'cron';

		/**
		 * Use this route type if a controller/model needs to be loaded only on
		 * Frontend
		 *
		 * This route type is registered on `init` hook.
		 *
		 * @since 1.0.0
		 */
		const FRONTEND = 'frontend';

		/**
		 * Use this route type if a controller/model needs to be loaded only on
		 * Frontend & it has ajax support
		 *
		 * This route type is registered on `init` hook.
		 *
		 * @since 1.0.0
		 */
		const FRONTEND_WITH_POSSIBLE_AJAX = 'frontend_with_possible_ajax';

		/**
		 * Use this route type if a controller/model needs to be loaded only on
		 * Frontend when it satisifies conditions you are looking for.
		 *
		 * This route type is registered on `wp` hook. If a callback/function is
		 * passed to `with_controller`, `with_model`,`with_view` or `with_just_model`,
		 * then those callbacks will have access to global `$wp` variable
		 *
		 *
		 * For Example, If you want to load a controller/model only when the current
		 * post id is 3367, then you might want to write below route in the `routes.php`
		 *
		 * <code>
		 * // get_the_ID function won't be accessible below if the route is registered
		 * // with 'frontend' type. get_the_ID function will be accessible only if
		 * // route is registered on Route_Type::LATE_FRONTEND or
		 * // Route_Type::LATE_FRONTEND_WITH_POSSIBLE_AJAX
		 *  $router->
		 *      ->register_route_of_type( Route_Type::LATE_FRONTEND )
		 *      ->with_controller(
		 *          function() {
		 *              if ( get_the_ID() == '3367' ) {
		 *                  return 'Sample_Shortcode';
		 *              }
		 *              return false;
		 *          }
		 *      )
		 *      ->with_view( 'Sample_Shortcode' );
		 * </code>
		 *
		 * @since 1.0.0
		 */
		const LATE_FRONTEND = 'late_frontend';

		/**
		 * Use this route type if a controller/model needs to be loaded only on
		 * Frontend, satisifies conditions you are looking for & has a support
		 * for ajax.
		 *
		 * This route type is registered on `wp` hook. If a callback/function is
		 * passed to `with_controller`, `with_model`,`with_view` or `with_just_model`,
		 * then those callbacks will have access to global `$wp` variable
		 *
		 *
		 * For Example, If you want to load a controller/model only when the current
		 * post id is 3367, then you might want to write below route in the `routes.php`
		 *
		 * <code>
		 * // get_the_ID function won't be accessible below if the route is registered
		 * // with 'frontend' type. get_the_ID function will be accessible only if
		 * // route is registered on Route_Type::LATE_FRONTEND or
		 * // Route_Type::LATE_FRONTEND_WITH_POSSIBLE_AJAX
		 *  $router->
		 *      ->register_route_of_type( Route_Type::LATE_FRONTEND_WITH_POSSIBLE_AJAX )
		 *      ->with_controller(
		 *          function() {
		 *              if ( get_the_ID() == '3367' ) {
		 *                  return 'Sample_Controller';
		 *              }
		 *              return false;
		 *          }
		 *      )
		 *      ->with_view( 'Sample_View' );
		 * </code>
		 *
		 * @since 1.0.0
		 */
		const LATE_FRONTEND_WITH_POSSIBLE_AJAX = 'late_frontend_with_possible_ajax';

	}
}
