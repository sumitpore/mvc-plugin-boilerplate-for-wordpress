# MVC Plugin Boilerplate for WordPress

WordPress being Event driven system, it is difficult to follow MVC Design Pattern while creating a WordPress Plugin.

This project aims to help plugin developers achieve MVC pattern in their coding.

If you are new to the term MVC and have never worked with MVC architecture before, I would highly recommend going through this course: https://www.udemy.com/php-mvc-from-scratch/

## Why?
The original [WordPress Plugin Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate) is great starting 
point for creating small plugins. So if your plugin is small, I definitely recommend using that boilerplate. However, as the plugin starts growing & we add more-n-more features to it, it somewhat becomes challenging to decide where a certain piece of code should go OR how/when to separate different functionalities.
When these things are not clear in long term project to the developer, they end up creating GOD classes that try to do everything.

The objective of this boilerplate is to separate concerns. Developer gets a chance to write individual `Model`, `View` & `Controller`. Also, the concern of whether to load a controller/model or not is delegated to `Router`, so that your controller & model can focus only on what they are supposed to do.

> __NOTE: THIS IS NOT MVC FRAMEWORK. IT IS MERELY A BOILERPLATE THAT GIVES THE DEVELOPER ABILITY TO WRITE CODE IN MVC STYLE.__ 

Because this project is meant to be a boilerplate, it has only those features which are required to build plugin in MVC way - No ORM - No Extra Goodies - No Huge Learning Curve 

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

If you don't want to do search & replace manually, you can download the generator script & execute it.
```bash
wget -O boilerplate-generator.sh https://raw.githubusercontent.com/sumitpore/mvc-plugin-boilerplate-for-wordpress/dev/boilerplate-generator.sh && bash boilerplate-generator.sh
```

## Getting Started

We'll try to create a shortcode that prints 10 posts that will help you understand how this boilerplate works. The guide assumes that you have gone through Installation steps and created `Example Me` Plugin.

### Writing your first Router
Routes can be defined inside `routes.php` file. Here is how a route can be defined for our example
```php

// Full Class Name with Namespace
$router
    ->register_route_of_type( ROUTE_TYPE::FRONTEND )
    ->with_controller( 'Example_Me\App\Controllers\Frontend\Print_Posts_Shortcode@register_shortcode' )
    ->with_model( 'Example_Me\App\Models\Frontend\Print_Posts_Shortcode' );

// ------------- OR --------------------

// Class Names Without specifying Namespaces explicitly. Boilerplate will automatically figure out the class based on the Route Type.
$router
    ->register_route_of_type( ROUTE_TYPE::FRONTEND )
    ->with_controller( 'Print_Posts_Shortcode@register_shortcode' )
    ->with_model( 'Print_Posts_Shortcode' );

```
> It is highly recommended to go through [`routes.php`](https://github.com/sumitpore/wordpress-mvc-plugin-boilerplate/blob/master/plugin-name/routes.php). You will get to know list of all available route types & examples in that file.


### Writing your first Controller
The boilerplate converts Class Name to a file name & loads that file automatically. 

We have passed `Example_Me\App\Controllers\Frontend\Print_Posts_Shortcode` as a controller in our `routes.php`. Boilerplate resolves this class name to file `example-me/app/controllers/frontend/class-print-posts-shortcode.php`

Any controller that is a part of a Routing (Read: added in `routes.php`) __MUST__ extend `Base_Controller` class. 
* If it is Dashboard (admin) related controller, then it should extend
`Plugin_Name\App\Controllers\Admin\Base_Controller`.
* If it is Frontend related controller, then it should extend
`Plugin_Name\App\Controllers\Frontend\Base_Controller`.

Every controller that extends `Base_Controller` __MUST__ have `register_hook_callbacks`
method. This method is defined as `abstract` in `Base_Controller`.

`register_hook_callbacks` method register callbacks for actions and filters. Most of your add_action/add_filter will go into this method.

`register_hook_callbacks` method is not called automatically. You
as a developer have to call this method where you see fit. For Example,
You may want to call this method in the route itself with `@` , if you feel hooks/filters
callbacks should be registered when the new instance of the class
is created. This way, we don't have to pollute constructor with add_action & add_filter.

The purpose of this method is to set the convention that first place to
find add_action/add_filter is register_hook_callbacks method.

<details>
	<summary><b>SHOW CONTROLLER EXAMPLE CODE</b></summary>
	Here is how this file would look for our example

```php
<?php
// file: example-me/app/controllers/frontend/class-print-posts-shortcode.php

namespace Example_Me\App\Controllers\Frontend;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Print_Posts_Shortcode' ) ) {
	/**
	 * Class that handles `example_me_print_posts` shortcode
	 *
	 * @since      1.0.0
	 * @package    Example_Me
	 * @subpackage Example_Me/Controllers/Frontend
	 */
	class Print_Posts_Shortcode extends Base_Controller {

		/**
		 * Registers the `example_me_print_posts` shortcode
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_shortcode() {
			add_shortcode( 'example_me_print_posts', array( $this, 'print_posts_callback' ) );
		}

		/**
		 * @ignore Blank Method
		 */
		protected function register_hook_callbacks(){}

		/**
		 * Callback to handle `example_me_print_posts` shortcode
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function print_posts_callback( $atts ) {
			return 	$this->get_view()->render_template(
				'frontend/print-posts-shortcode.php',
				[
					'fetched_posts'	=>	$this->get_model()->get_posts_for_shortcode( 'example_me_print_posts', $atts )
				]
			);

		}

	}
}

```

</details>

### Writing your first Model

All models should extend `Base_Model` class.

* If it is Dashboard (admin) related model, then it should extend
`Plugin_Name\App\Models\Admin\Base_Model`.
* If it is Frontend related model, then it should extend
`Plugin_Name\App\Models\Frontend\Base_Model`.

You may decide whether to create `register_hook_callbacks` method inside your model or not. It is not an abstract method in `Base_Model` If you want to write any add_action/add_filter, then that should ideally go inside this method. (I would suggest to place all add_action & add_filter calls inside `register_hook_callbacks` of the Controller class. It will show you all add_actions & add_filter in one glance but decision is yours! You should do what fits right in your situation.)

Again `register_hook_callbacks` is not called automatically. If you feel hooks/filters
callbacks should be registered when the new instance of the class
is created, then call this method inside the constructor of your model.

`@` is NOT supported in `with_model` method of Router class, however, `@` is supported in `with_just_model` method of the Router class. If you are confused, what these statements mean? Go through [`routes.php`](https://github.com/sumitpore/wordpress-mvc-plugin-boilerplate/blob/master/plugin-name/routes.php). It contains variety of examples.

<details>
	<summary><b>SHOW MODEL EXAMPLE CODE</b></summary>

Create a file `example-me/app/models/frontend/class-print-posts-shortcode.php` because we have to create `Example_Me\App\Models\Frontend\Print_Posts_Shortcode` class.

Here is how this file would look for our example

```php
<?php
// file: `example-me/app/models/frontend/class-print-posts-shortcode.php`

namespace Example_Me\App\Models\Frontend;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Print_Posts_Shortcode' ) ) {
	/**
	 * Class to handle data related operations of `example_me_print_posts` shortcode
	 *
	 * @since      1.0.0
	 * @package    Example_Me
	 * @subpackage Example_Me/Models/Frontend
	 */
	class Print_Posts_Shortcode extends Base_Model {
		/**
		 * Fetches posts from database
		 *
		 * @param string $shortcode Shortcode for which posts should be fetched
		 * @param array $atts Arguments passed to shortcode
		 * @return \WP_Query WP_Query Object
		 */
		public function get_posts_for_shortcode( $shortcode, $atts ) {
			$atts = shortcode_atts(
				array(
					'number_of_posts' => '10',
				), $atts, $shortcode
			);

			$args = array(
				'post_type' => 'post',
				'posts_per_page' => is_int( $atts['number_of_posts'] ) ? $atts['number_of_posts'] : 10,
			);

			return new \WP_Query( $args );
		}
	}
}

```
</details>

### Writing a View
In our example, we did not have to create a separate View Class (Hint: we did not call `with_view` method in the route.). In the controller itself we are calling a `render_template` method of base `View` class. 

However, if you are going to deal with partial views, it is recommended to create a separate class that extends `View` class & that class will call templates for you.

It gives us another advantage — the controller does not get tied to template file directly & thus allowing us to reduce the coupling.

<details>
	<summary><b>SHOW VIEW EXAMPLE CODE</b></summary>

If we had created a separate class for the view, then it would have looked like this

```php
<?php
// First we would need to change the route.

// file: routes.php
$router
	->register_route_of_type( ROUTE_TYPE::FRONTEND )
	->with_controller( 'Print_Posts_Shortcode@register_shortcode' )
	->with_model( 'Print_Posts_Shortcode' )
	->with_view( 'Print_Posts_Shortcode' );



// file: `example-me/app/views/frontend/class-print-posts-shortcode.php`

namespace Example_Me\App\Views\Frontend;

use \Example_Me\Core\View;
use \Example_Me as Example_Me;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Print_Posts_Shortcode' ) ) {
	/**
	 * Class Responsibile for rendering the view of `example_me_print_posts` shortcode
	 *
	 * @since      1.0.0
	 * @package    Example_Me
	 * @subpackage Example_Me/Views/Frontend
	 */
	class Print_Posts_Shortcode extends View {
		/**
		 * Method that prints html for the `example_me_print_posts` shortcode
		 *
		 * @param array $args Arguments passed by controller's get_posts_for_shortcode method.
		 * @return void
		 */
		public function shortcode_html( $args ){
			return 	$this->render_template(
				'frontend/print-posts-shortcode.php',
				$args
			);
		}

	}
}

```
</details>

### Writing your first template
Templates are the actual files which generate html for the module you are writing. 

A template file can be called by invoking `render_template` method on any `View` class's (parent as well as child) object.

Template files are created inside `app/templates/` folder.

<details>
	<summary><b>SHOW TEMPLATE EXAMPLE CODE</b></summary>

So the complete location of template file in our example is `example-me/app/templates/frontend/print-posts-shortcode.php`

This is how it would look

```php

// file: `example-me/app/templates/frontend/print-posts-shortcode.php`

<?php if ( $fetched_posts->have_posts() ) : ?>

	<!-- the loop -->
	<?php
	while ( $fetched_posts->have_posts() ) : ?>
		<?php $fetched_posts->the_post(); ?>
		<h2><?php the_title(); ?></h2>
	<?php endwhile; ?>
	<!-- end of the loop -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
```
</details>

### Interacting with Settings
While developing the plugin, we sometimes need a way to manually interact with the settings information (Side Note - Settings are saved automatically by WordPress if Settings API is used to create settings page)

`Plugin_Name\App\Models\Settings` provide some helper methods to interact with settings data.

| Method | Description |
| --- | --- |
| `Plugin_Name\App\Models\Settings::get_settings()` | Returns all saved settings |
| `Plugin_Name\App\Models\Settings::get_setting( $setting_name )` | Returns a value of single setting |
| `Plugin_Name\App\Models\Settings::delete_settings()` | Deletes All Settings |
| `Plugin_Name\App\Models\Settings::delete_setting( $setting_name )` | Deletes a particular setting |
| `Plugin_Name\App\Models\Settings::update_settings()` | Updates All Settings |
| `Plugin_Name\App\Models\Settings::update_setting( $setting_name )` | Updates an individual setting |


## Contents

The MVC WordPress Plugin Boilerplate includes the following files:

* `.gitignore`. Used to exclude certain files from the repository.
* `README.md`. The file that you’re currently reading.
* `TODO.md` . Contains list of tasks to be completed in future.
* `plugin-name` directory that contains the source code - a fully executable WordPress plugin.

## Features

* The Boilerplate is based on the [Plugin API](http://codex.wordpress.org/Plugin_API), and [Documentation Standards](http://make.wordpress.org/core/handbook/inline-documentation-standards/php-documentation-standards/).
* All classes, functions, and variables are documented so that you know what you need to be changed.
* The project includes a `.pot` file as a starting point for internationalization.
* Separation of concern between Model, View & Controller.

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
* `plugin-name/app/models` is for representing data objects, such as settings, values stored on the database, etc...
* `plugin-name/app/models/admin` represents the admin side of the models.
* `plugin-name/app/models/frontend` represents the frontend side of the models.
* `plugin-name/app/contollers` is for updating the state of the model, it can also send commands to its associated views to change the view's presentation of the model.
* `plugin-name/app/contollers/admin` represents the admin side of the controllers.
* `plugin-name/app/contollers/frontend` represents the frontend side of the controllers.
* `plugin-name/app/views` calls required templates
* `plugin-name/app/views/admin` calls admin side templates
* `plugin-name/app/views/frontend` calls frontend side templates
* `plugin-name/app/templates` represents html code for the feature
* `plugin-name/app/templates/admin` represents html code for admin side features
* `plugin-name/app/templates/frontend` represents html code for frontend side features 


# Credits

The `MVC Plugin Boilerplate for WordPress` is a forked version of the `WordPress Plugin Boilerplate` project started by [Roger Rodrigo](https://ca.linkedin.com/in/rogerrodrigo) which also was a forked version of the `WordPress Plugin Boilerplate` project started in 2011 by [Tom McFarlin](http://twitter.com/tommcfarlin/) and has since included a number of great contributions. In March of 2015 the project was handed over by Tom to Devin Vinson.

This `MVC Plugin Boilerplate for WordPress` was developed and is being maintained by [Sumit Pore](https://twitter.com/sumitpore)
