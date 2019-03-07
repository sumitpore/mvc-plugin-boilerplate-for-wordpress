<?php
$router
	->register_route_of_type('admin')
	->with_controller('Plugin_Name_Controller_Admin_Settings')
	->with_model('Plugin_Name_Model_Admin_Settings')
	->with_view('Plugin_Name_View_Admin_Settings');

// $router->register_route_of_type('admin')->without_controller_but_with_model('Plugin_Name_Model_Admin_Settings');
