<?php
/**
 * Types of Possible route types:
 * any - To be used if model/controller is required on all pages admin as well as public
 * admin - To be used if model/controller needs to be loaded on admin pages only
 * admin_with_possible_ajax - To be used if model/controller contains Ajax & needs to be loaded on admin pages only
 * ajax - To be used if model/controller contains Ajax
 * cron - To be used if model/controller contains Cron functionality
 * public - To be used if model/controller needs to be loaded on public pages only
 * public_with_possible_ajax - To be used if model/controller contains Ajax & needs to be loaded on public pages only
 * late_public - To be used if model/controller needs to be loaded when specific conditions are matched
 * late_public_with_possible_ajax - To be used if model/controller contains Ajax & needs to be loaded when specific conditions are matched
 *
 */
$router
	->register_route_of_type( 'late_public' )
	->with_controller(
		function() {
				// Load controller only if current post id is 3367
			if ( get_the_ID() == '3367' ) {
				  return 'Plugin_Name_Controller_Public_Sample_Shortcode';
			}
			return false;
		}
	)
	->with_view( 'Plugin_Name_View_Public_Sample_Shortcode' );

$router
	->register_route_of_type( 'admin' )
	->with_controller( 'Plugin_Name_Controller_Admin_Settings' )
	->with_model( 'Plugin_Name_Model_Admin_Settings' )
	->with_view( 'Plugin_Name_View_Admin_Settings' );


// If you want to load only model for specific route, you can use with_just_model
// $router->register_route_of_type('admin')->with_just_model('Plugin_Name_Model_Admin_Settings');
