Plugin_Name
===============

Includes all methods required for loading Plugin Dependencies




* Class name: Plugin_Name
* Namespace: 
* Parent class: [Plugin_Name\Includes\Dependency_Loader](Plugin_Name-Includes-Dependency_Loader.md)



Constants
----------


### PLUGIN_ID

    const PLUGIN_ID = 'plugin-name'





### PLUGIN_NAME

    const PLUGIN_NAME = 'Plugin Name'





### PLUGIN_VERSION

    const PLUGIN_VERSION = '1.0.0'





Properties
----------


### $instance

    private \Plugin_Name $instance





* Visibility: **private**
* This property is **static**.


### $plugin_path

    private string $plugin_path

Main plugin path /wp-content/plugins/<plugin-folder>/.



* Visibility: **private**
* This property is **static**.


### $plugin_url

    private string $plugin_url

Absolute plugin url <wordpress-root-folder>/wp-content/plugins/<plugin-folder>/.



* Visibility: **private**
* This property is **static**.


Methods
-------


### __construct

    mixed Plugin_Name::__construct($router_class_name, $routes)

Define the core functionality of the plugin.

Load the dependencies, define the locale, and set the hooks for the admin area and
the frontend-facing side of the site.

* Visibility: **public**


#### Arguments
* $router_class_name **mixed**
* $routes **mixed**



### get_plugin_path

    mixed Plugin_Name::get_plugin_path()

Get plugin's absolute path.



* Visibility: **public**
* This method is **static**.




### get_plugin_url

    mixed Plugin_Name::get_plugin_url()

Get plugin's absolute url.



* Visibility: **public**
* This method is **static**.




### set_locale

    mixed Plugin_Name::set_locale()

Define the locale for this plugin for internationalization.

Uses the i18n class in order to set the domain and to register the hook
with WordPress.

* Visibility: **private**




### init_router

    void Plugin_Name::init_router($router_class_name, $routes)

Init Router



* Visibility: **private**


#### Arguments
* $router_class_name **mixed**
* $routes **mixed**



### get_all_controllers

    object Plugin_Name::get_all_controllers()

Returns all controller objects used for current requests



* Visibility: **private**




### get_all_models

    object Plugin_Name::get_all_models()

Returns all model objecs used for current requests



* Visibility: **private**




### get_settings

    array Plugin_Name::get_settings()

Method that retuns all Saved Settings related to Plugin.

Only to be used by third party developers.

* Visibility: **public**
* This method is **static**.




### get_setting

    mixed Plugin_Name::get_setting(string $setting_name)

Method that returns a individual setting

Only to be used by third party developers.

* Visibility: **public**
* This method is **static**.


#### Arguments
* $setting_name **string**



### load_dependencies

    mixed Plugin_Name\Includes\Dependency_Loader::load_dependencies($class)

Loads all Plugin dependencies



* Visibility: **public**
* This method is defined by [Plugin_Name\Includes\Dependency_Loader](Plugin_Name-Includes-Dependency_Loader.md)


#### Arguments
* $class **mixed**



### load_registries

    void Plugin_Name\Includes\Dependency_Loader::load_registries()

Load All Registry Class Files



* Visibility: **protected**
* This method is defined by [Plugin_Name\Includes\Dependency_Loader](Plugin_Name-Includes-Dependency_Loader.md)




### load_core

    void Plugin_Name\Includes\Dependency_Loader::load_core()

Load Core MVC Classes



* Visibility: **protected**
* This method is defined by [Plugin_Name\Includes\Dependency_Loader](Plugin_Name-Includes-Dependency_Loader.md)




### autoload_dependencies

    mixed Plugin_Name\Includes\Dependency_Loader::autoload_dependencies()

Method responsible to call all the dependencies



* Visibility: **protected**
* This method is defined by [Plugin_Name\Includes\Dependency_Loader](Plugin_Name-Includes-Dependency_Loader.md)



