# MVC Plugin Boilerplate for WordPress

WordPress being Event driven system, it is difficult to follow MVC Design Pattern while creating a WordPress Plugin.

This project aims to help plugin developers achieve MVC pattern in their coding.

If you are new to the term MVC and have never worked with MVC architecture before, I would highly recommend going through this course: https://www.udemy.com/php-mvc-from-scratch/

## Contents

The MVC WordPress Plugin Boilerplate includes the following files:

* `.gitignore`. Used to exclude certain files from the repository.
* `README.md`. The file that you’re currently reading.
* A `plugin-name` directory that contains the source code - a fully executable WordPress plugin.

## Features

* The Boilerplate is based on the [Plugin API](http://codex.wordpress.org/Plugin_API), [Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards), and [Documentation Standards](http://make.wordpress.org/core/handbook/inline-documentation-standards/php-documentation-standards/).
* All classes, functions, and variables are documented so that you know what you need to be changed.
* The project includes a `.pot` file as a starting point for internationalization.

## Installation

The Boilerplate can be installed directly into your plugins folder "as-is". You will want to rename it and the classes inside of it to fit your needs.

Note that this will activate the source code of the Boilerplate.
The Boilerplate has no real functionality but implements a basic example which adds menu items, registers settings, adds a plugin settings page with a text input box and submit button, it also stores the data introduced into this input.

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

* `plugin-name/includes` is where functionality shared between the models, controllers and views resides
* `plugin-name/models` is for representing data objects, such as settings, values stored on the database, etc...
* `plugin-name/models/admin` represents the admin side of the models.
* `plugin-name/contollers` is for updating the state of the model (e.g. updating a setting), it can also send commands to its associated views to change the view's presentation of the model.
* `plugin-name/contollers/admin` represents the admin side of the controllers.
* `plugin-name/views` is where the output of the model is generated, it uses its controller to get the data from the model and it sends updated values to the controller to be stored by the model.
* `plugin-name/views/admin` represents the admin side of the views


# Credits

The `MVC Plugin Boilerplate for WordPress` is a forked version of the `WordPress Plugin Boilerplate` project started by [Roger Rodrigo](https://ca.linkedin.com/in/rogerrodrigo) which also was a forked version of the `WordPress Plugin Boilerplate` project started in 2011 by [Tom McFarlin](http://twitter.com/tommcfarlin/) and has since included a number of great contributions. In March of 2015 the project was handed over by Tom to Devin Vinson.

This `MVC Plugin Boilerplate for WordPress` was developed and is being maintained by [Sumit Pore](https://twitter.com/sumitpore)
