<?php

use \Plugin_Name\Core\Route_Type as Route_Type;
/**
 * Types of Possible route types:
 * any - To be used if model/controller is required on all pages admin as well as frontend
 * admin - To be used if model/controller needs to be loaded on admin pages only
 * admin_with_possible_ajax - To be used if model/controller contains Ajax & needs to be loaded on admin pages only
 * ajax - To be used if model/controller contains Ajax
 * cron - To be used if model/controller contains Cron functionality
 * frontend - To be used if model/controller needs to be loaded on frontend pages only
 * frontend_with_possible_ajax - To be used if model/controller contains Ajax & needs to be loaded on frontend pages only
 * late_frontend - To be used if model/controller needs to be loaded when specific conditions are matched
 * late_frontend_with_possible_ajax - To be used if model/controller contains Ajax & needs to be loaded when specific conditions are matched
 */

$router
	->register_route_of_type( ROUTE_TYPE::ADMIN )
	->with_controller( 'Admin_Settings' )
	->with_model( 'Admin_Settings' )
	->with_view( 'Admin_Settings' );

// Loading Route with full class names
// $router
// 	->register_route_of_type( ROUTE_TYPE::ADMIN )
// 	->with_controller( 'Plugin_Name\App\Controllers\Admin\Admin_Settings' )
// 	->with_model( 'Plugin_Name\App\Models\Admin\Admin_Settings' )
// 	->with_view( 'Plugin_Name\App\Views\Admin\Admin_Settings' );

// Load controller if conditions match
$router
	->register_route_of_type( ROUTE_TYPE::LATE_FRONTEND )
	->with_controller(
		function() {
			if ( get_the_ID() == '3367' ) {
				  return 'Sample_Shortcode';
			}
			return false;
		}
	)
	->with_view( 'Sample_Shortcode' );

// Load controller if conditions match with full class names
// $router
// 	->register_route_of_type( ROUTE_TYPE::LATE_FRONTEND )
// 	->with_controller(
// 		function() {
// 				// Load controller only if current post id is 3367
// 			if ( get_the_ID() == '3367' ) {
// 				  return 'Plugin_Name\App\Controllers\Frontend\Sample_Shortcode';
// 			}
// 			return false;
// 		}
// 	)
// 	->with_view( 'Plugin_Name\App\Views\Frontend\Sample_Shortcode' );

// If you want to load only model for specific route, you can use with_just_model
// $router->register_route_of_type( ROUTE_TYPE::ADMIN )->with_just_model('Plugin_Name_Model_Admin_Settings');
