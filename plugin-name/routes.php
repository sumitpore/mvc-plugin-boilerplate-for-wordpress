<?php

use \Plugin_Name\Core\Route_Type as Route_Type;
/*
|-------------------------------------------------------------------------------------------
| Route Types
|-------------------------------------------------------------------------------------------
| ROUTE_TYPE::ANY - To be used if model/controller is required on all pages admin
|                   as well as frontend
|
| ROUTE_TYPE::ADMIN - To be used if model/controller needs to be loaded on admin
|                     pages only
|
| ROUTE_TYPE::ADMIN_WITH_POSSIBLE_AJAX - To be used if model/controller contains
|                                        Ajax & needs to be loaded on admin pages only
|
| ROUTE_TYPE::AJAX - To be used if model/controller contains Ajax
|
| ROUTE_TYPE::CRON - To be used if model/controller contains Cron functionality
|
| ROUTE_TYPE::FRONTEND - To be used if model/controller needs to be loaded on
|                        frontend pages only
|
| ROUTE_TYPE::FRONTEND_WITH_POSSIBLE_AJAX - To be used if model/controller contains
|                                           Ajax & needs to be loaded on frontend pages only
|
| ROUTE_TYPE::LATE_FRONTEND - To be used if model/controller needs to be loaded
|                             when specific conditions are matched
|
| ROUTE_TYPE::LATE_FRONTEND_WITH_POSSIBLE_AJAX - To be used if model/controller
|                                                contains Ajax & needs to be loaded when
|                                                specific conditions are matched
|
*/

$router
	->register_route_of_type( ROUTE_TYPE::ADMIN )
	->with_controller( 'Admin_Settings' )
	->with_model( 'Admin_Settings' )
	->with_view( 'Admin_Settings' );


/*
|-------------------------------------------------------------------------------------------
| Routes with Full Class Names Example
|-------------------------------------------------------------------------------------------
*/
// $router
// 	->register_route_of_type( ROUTE_TYPE::ADMIN )
// 	->with_controller( 'Plugin_Name\App\Controllers\Admin\Admin_Settings' )
// 	->with_model( 'Plugin_Name\App\Models\Admin\Admin_Settings' )
// 	->with_view( 'Plugin_Name\App\Views\Admin\Admin_Settings' );


/*
|-------------------------------------------------------------------------------------------
| Load controller if conditions match. Late Frontend Routes are triggerred on `wp`
| hook. Therefore, you should ideally be able to access template related functions
| in the callback passed to `with_controller` method below
|-------------------------------------------------------------------------------------------
*/
// $router
// 	->register_route_of_type( ROUTE_TYPE::LATE_FRONTEND )
// 	->with_controller(
// 		function() {
// 			if ( get_the_ID() == '3367' ) {
// 				  return 'Sample_Shortcode';
// 			}
// 			return false;
// 		}
// 	)
// 	->with_view( 'Sample_Shortcode' );


/*
|-------------------------------------------------------------------------------------------
| Load controller if conditions match with full class names
|-------------------------------------------------------------------------------------------
*/
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


/*
|-------------------------------------------------------------------------------------------
| If you want to load only model for specific route, you can use with_just_model
|-------------------------------------------------------------------------------------------
*/
// $router->register_route_of_type( ROUTE_TYPE::ADMIN )->with_just_model('Plugin_Name_Model_Admin_Settings');
