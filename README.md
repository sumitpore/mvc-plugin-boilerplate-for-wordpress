# MVC Plugin Boilerplate for WordPress

WordPress being Event driven system, it is difficult to follow MVC Design Pattern while creating a WordPress Plugin.

This project aims to help plugin developers achieve MVC pattern in their coding.

If you are new to the term MVC and have never worked with MVC architecture before, I would highly recommend going through this course: https://www.udemy.com/php-mvc-from-scratch/

## Why?
The original [WordPress Plugin Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate) is great starting 
point for creating small plugins. So if your plugin is small, I definitely recommend using that boilerplate. However, as the plugin starts growing & we add more-n-more features to it, it somewhat becomes challenging to decide where a certain piece of code should go OR how/when to separate different functionalities.
When these things are not clear in long term project to the developer, they end up creating GOD classes that try to do everything.

The objective of this boilerplate is to separate concerns. Developer gets a chance to write individual `Model`, `View` & `Controller`. Also, the concern of whether to load a controller/model or not is delegated to `Router`, so that your controller & model can focus only on what they are supposed to do.

> __NOTE: THIS IS NOT MVC FRAMEWORK. IT IS JUST A BOILERPLATE THAT GIVES THE DEVELOPER ABILITY TO WRITE CODE IN MVC STYLE.__ 

## Architecture
Here is a bird eye's view at the architecture

![MVC Architecture](https://raw.githubusercontent.com/sumitpore/repo-assets/master/mvc-architecture.png)

## Installation

The Boilerplate can be installed directly into your plugins folder "as-is". You will want to rename it and the classes inside of it to fit your needs. For example, if your plugin is named 'example-me' then:

* rename files from `plugin-name` to `example-me`
* change `plugin_name` to `example_me`
* change `plugin-name` to `example-me`
* change `Plugin_Name` to `Example_Me`
* change `PLUGIN_NAME_` to `EXAMPLE_ME_`

It's safe to activate the plugin at this point. Because the Boilerplate has no real functionality there will be no menu items, meta boxes, or custom post types added until you write the code.

In near future, I'll be writing a tool to do that rename & replace task automatically.

## Getting Started

We'll try to create a shortcode that prints 10 posts

### Writing your first Router
Routes can be defined inside `routes.php` file. Here is how a route can be defined for our examples
```php

// Full Class Name with Namespace
$router
    ->register_route_of_type( ROUTE_TYPE::FRONTEND )
    ->with_controller( 'Plugin_Name\App\Controllers\Frontend\Sample_Shortcode' )
    ->with_model( 'Plugin_Name\App\Models\Frontend\Sample_Shortcode' )
    ->with_view( 'Plugin_Name\App\Views\Frontend\Sample_Shortcode' );

// ------------- OR --------------------

// Class Name Without Namespace
$router
    ->register_route_of_type( ROUTE_TYPE::FRONTEND )
    ->with_controller( 'Sample_Shortcode' )
    ->with_model( 'Sample_Shortcode' )
    ->with_view( 'Sample_Shortcode' );

```
> You can get to know list of all available route types in [`routes.php`](https://github.com/sumitpore/wordpress-mvc-plugin-boilerplate/blob/master/plugin-name/routes.php)

### Writing your first Controller
The boilerplate converts Class Name to a file name & loads that file automatically. 

We have passed `Plugin_Name\App\Controllers\Frontend\Sample_Shortcode` as a controller in our `routes.php`. Boilerplate resolves this class name to file `plugin-name\app\controllers\frontend\class-sample-shortcode.php`

Here is how this file would look for our example
```
<?php
namespace Plugin_Name\App\Controllers\Frontend;

use \Plugin_Name\App\Controllers\Frontend\Base_Controller;
use \Plugin_Name as Plugin_Name;

/**
 * Controller class that handles Sample Shortcode
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/controllers
 */

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Sample_Shortcode' ) ) {

	class Sample_Shortcode extends Base_Controller {

		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		protected function __construct( $model_class_name = false, $view_class_name = false ) {
			parent::__construct( $model_class_name, $view_class_name );

            // Register Shortcode
			add_shortcode( 'plugin_name_print_10_posts', array( $this, 'print_10_posts_callback' ) );

			$this->register_hook_callbacks();
		}

		/**
		 * Register callbacks for actions and filters
		 *
		 * @since    1.0.0
		 */
		protected function register_hook_callbacks() {
            // Write all add_action here
			// e.g. - add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		}


		/**
		 * Print 10 Posts Shortcode's Callback
		 *
		 * @param array $atts Arguments Array
		 * @return string
		 */
		public function print_10_posts_callback( $atts ) {
			return $this->view->shortcode_html(
				array(
					'results' => $this->model->get_posts( $atts );
				)
			);
		}

	}

}

```

## Contents

The MVC WordPress Plugin Boilerplate includes the following files:

* `.gitignore`. Used to exclude certain files from the repository.
* `README.md`. The file that you’re currently reading.
* `TODO.md` . Contains list of tasks to be completed in future.
* A `plugin-name` directory that contains the source code - a fully executable WordPress plugin.

## Features

* The Boilerplate is based on the [Plugin API](http://codex.wordpress.org/Plugin_API), [Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards), and [Documentation Standards](http://make.wordpress.org/core/handbook/inline-documentation-standards/php-documentation-standards/).
* All classes, functions, and variables are documented so that you know what you need to be changed.
* The project includes a `.pot` file as a starting point for internationalization.

## Recommended Tools

### i18n Tools

The WordPress Plugin Boilerplate uses a variable to store the text domain used when internationalizing strings throughout the Boilerplate. To take advantage of this method, there are tools that are recommended for providing correct, translatable files:

* [Poedit](http://www.poedit.net/)
* [makepot](http://i18n.svn.wordpress.org/tools/trunk/)
* [i18n](https://github.com/grappler/i18n)

Any of the above tools should provide you with the proper tooling to internationalize the plugin.

## License

MVC Plugin Boilerplate for WordPress is licensed under the GPL v2 or later.

> This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

> You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA

A copy of the license is included in the root of the plugin’s directory. The file is named `LICENSE`.

## Important Notes

### Includes

Note that if you include your own classes, or third-party libraries, there are three locations in which said files may go:

* `plugin-name/app` is where functionality shared between the models, controllers and views resides
* `plugin-name/models` is for representing data objects, such as settings, values stored on the database, etc...
* `plugin-name/models/admin` represents the admin side of the models.
* `plugin-name/contollers` is for updating the state of the model (e.g. updating a setting), it can also send commands to its associated views to change the view's presentation of the model.
* `plugin-name/contollers/admin` represents the admin side of the controllers.
* `plugin-name/views` is where the output of the model is generated, it uses its controller to get the data from the model and it sends updated values to the controller to be stored by the model.
* `plugin-name/views/admin` represents the admin side of the views


# Credits

The `MVC Plugin Boilerplate for WordPress` is a forked version of the `WordPress Plugin Boilerplate` project started by [Roger Rodrigo](https://ca.linkedin.com/in/rogerrodrigo) which also was a forked version of the `WordPress Plugin Boilerplate` project started in 2011 by [Tom McFarlin](http://twitter.com/tommcfarlin/) and has since included a number of great contributions. In March of 2015 the project was handed over by Tom to Devin Vinson.

This `MVC Plugin Boilerplate for WordPress` was developed and is being maintained by [Sumit Pore](https://twitter.com/sumitpore)
