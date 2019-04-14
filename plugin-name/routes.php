<?php

use \Plugin_Name\Core\Route_Type as Route_Type;

/*
|---------------------------------------------------------------------------------------------------------
| Available Route Types
+----------------------------------------------+---------------------------------------------------------+
| ROUTE TYPE                                   | ROUTE DESCRIPTION                                       |
+----------------------------------------------+---------------------------------------------------------+
| ROUTE_TYPE::ANY                              | To be used if model/controller is                       |
|                                              | required on all pages admin as well as frontend         |
+----------------------------------------------+---------------------------------------------------------+
| ROUTE_TYPE::ADMIN                            | To be used if model/controller needs to be loaded on    |
|                                              | on admin pages only                                     |
+----------------------------------------------+---------------------------------------------------------+
| ROUTE_TYPE::ADMIN_WITH_POSSIBLE_AJAX         | To be used if model/controller contains Ajax & needs    |
|                                              | to be loaded on admin pages only                        |
+----------------------------------------------+---------------------------------------------------------+
| ROUTE_TYPE::AJAX                             | To be used if model/controller contains Ajax            |
+----------------------------------------------+---------------------------------------------------------+
| ROUTE_TYPE::CRON                             | To be used if model/controller contains Cron            |
|                                              | functionality                                           |
+----------------------------------------------+---------------------------------------------------------+
| ROUTE_TYPE::FRONTEND                         | To be used if model/controller needs to be loaded on    |
|                                              | frontend pages only                                     |
+----------------------------------------------+---------------------------------------------------------+
| ROUTE_TYPE::FRONTEND_WITH_POSSIBLE_AJAX      | To be used if model/controller contains Ajax & needs    |
|                                              | to be loaded on frontend pages only                     |
+----------------------------------------------+---------------------------------------------------------+
| ROUTE_TYPE::LATE_FRONTEND                    | To be used if model/controller needs to be loaded when  |
|                                              | specific conditions are matched                         |
+----------------------------------------------+---------------------------------------------------------+
| ROUTE_TYPE::LATE_FRONTEND_WITH_POSSIBLE_AJAX | To be used if model/controller contains Ajax & needs    |
|                                              | to be loaded when specific conditions are matched       |
+----------------------------------------------+---------------------------------------------------------+
*
* Possible Routes Combinations :-
*
* 1. $router->register_route_of_type(...)->with_controller(...)->with_model(...)->with_view(...);
* 2. $router->register_route_of_type(...)->with_controller(...)->with_model(...);
* 3. $router->register_route_of_type(...)->with_controller(...)->with_view(...);
* 4. $router->register_route_of_type(...)->with_controller(...);
* 5. $router->register_route_of_type(...)->with_just_model(...);
*
*/

// Route for Settings Page.
$router
	->register_route_of_type( ROUTE_TYPE::ADMIN )
	->with_controller( 'Admin_Settings' ) // Resolvedd by Router to 'Plugin_Name\App\Controllers\Admin\Admin_Settings'.
	->with_model( 'Admin_Settings' ) // Resolvedd by Router to 'Plugin_Name\App\Models\Admin\Admin_Settings'.
	->with_view( 'Admin_Settings' ); // Resolvedd by Router to 'Plugin_Name\App\Views\Admin\Admin_Settings'.


/*
|-------------------------------------------------------------------------------------------
| Routes with Full Class Names Example. Above route could also be written as :-
|-------------------------------------------------------------------------------------------
|	$router
|		->register_route_of_type( ROUTE_TYPE::ADMIN )
|		->with_controller( 'Plugin_Name\App\Controllers\Admin\Admin_Settings' )
|		->with_model( 'Plugin_Name\App\Models\Admin\Admin_Settings' )
|		->with_view( 'Plugin_Name\App\Views\Admin\Admin_Settings' );
|-------------------------------------------------------------------------------------------
*/

/*
|-------------------------------------------------------------------------------------------
| Example of Loading controller if conditions match. Late Frontend Routes are triggerred on
| `wp` hook. Therefore, you should ideally be able to access template related functions
| in the callback passed to `with_controller` method below
|-------------------------------------------------------------------------------------------
|	$router
|		->register_route_of_type( ROUTE_TYPE::LATE_FRONTEND )
|		->with_controller(
|			function() {
|
|				if ( get_the_ID() == '3367' ) {
|					return 'Sample_Shortcode';
|				}
|
|				return false;
|			}
|		)
|		->with_view( 'Sample_Shortcode' );
|-------------------------------------------------------------------------------------------
*/


/*
|-------------------------------------------------------------------------------------------
| If you want to load only model for specific route, you can use with_just_model.
|
| Note: This type of route is referred as `Model Only` route.`Model Only` routes
| don't support Views. This type of route should ideally be used when you have
| to work at data layer but there is nothing to print on the screen.
|-------------------------------------------------------------------------------------------
|	$router
|		->register_route_of_type( ROUTE_TYPE::ADMIN )
|		->with_just_model('Plugin_Name_Model_Admin_Settings');
|-------------------------------------------------------------------------------------------
*/

