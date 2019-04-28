<?php
/**
 * Contains the information about minimum requirements of the plugin.
 *
 * @package Requirements
 */

return [

	'min_php_version' => '7.5', // Minimum PHP Version.

	'min_wp_version' => '5.3',  // Minimum WordPress Version.

	'is_multisite_compatible' => false, // True if our plugin is Multisite Compatible.

	'required_plugins' => [ // Plugins on which our plugin is dependent on.

		'Hello Dolly' => [  // Plugin Name.
			'plugin_slug' => 'hello-dolly/hello.php',
			'min_plugin_version' => '2.1',
		],

	],

];
