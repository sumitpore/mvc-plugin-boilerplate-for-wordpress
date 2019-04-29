Plugin_Name\App\Controllers\Admin\Admin_Settings
===============

Controller class that implements Plugin Admin Settings configurations




* Class name: Admin_Settings
* Namespace: Plugin_Name\App\Controllers\Admin
* Parent class: [Plugin_Name\App\Controllers\Admin\Base_Controller](Plugin_Name-App-Controllers-Admin-Base_Controller.md)



Constants
----------


### SETTINGS_PAGE_SLUG

    const SETTINGS_PAGE_SLUG = \Plugin_Name::PLUGIN_ID





### REQUIRED_CAPABILITY

    const REQUIRED_CAPABILITY = 'manage_options'





Properties
----------


### $hook_suffix

    private string $hook_suffix = 'settings_page_' . \Plugin_Name::PLUGIN_ID

Holds suffix for dynamic add_action called on settings page.



* Visibility: **private**
* This property is **static**.


### $model

    protected Object $model

Holds Model object



* Visibility: **protected**


### $view

    protected Object $view

Holds View Object



* Visibility: **protected**


Methods
-------


### register_hook_callbacks

    mixed Plugin_Name\App\Controllers\Admin\Base_Controller::register_hook_callbacks()

Register callbacks for actions and filters. Most of your add_action/add_filter
go into this method.

NOTE: register_hook_callbacks method is not called automatically. You
as a developer have to call this method where you see fit. For Example,
You may want to call this in constructor, if you feel hooks/filters
callbacks should be registered when the new instance of the class
is created.

The purpose of this method is to set the convention that first place to
find add_action/add_filter is register_hook_callbacks method.

* Visibility: **protected**
* This method is **abstract**.
* This method is defined by [Plugin_Name\App\Controllers\Admin\Base_Controller](Plugin_Name-App-Controllers-Admin-Base_Controller.md)




### plugin_menu

    mixed Plugin_Name\App\Controllers\Admin\Admin_Settings::plugin_menu()

Create menu for Plugin inside Settings menu



* Visibility: **public**




### enqueue_scripts

    mixed Plugin_Name\App\Controllers\Admin\Admin_Settings::enqueue_scripts()

Register the JavaScript for the admin area.



* Visibility: **public**




### enqueue_styles

    mixed Plugin_Name\App\Controllers\Admin\Admin_Settings::enqueue_styles()

Register the JavaScript for the admin area.



* Visibility: **public**




### markup_settings_page

    mixed Plugin_Name\App\Controllers\Admin\Admin_Settings::markup_settings_page()

Creates the markup for the Settings page



* Visibility: **public**




### register_fields

    mixed Plugin_Name\App\Controllers\Admin\Admin_Settings::register_fields()

Registers settings sections and fields



* Visibility: **public**




### markup_section_headers

    mixed Plugin_Name\App\Controllers\Admin\Admin_Settings::markup_section_headers(array $section)

Adds the section introduction text to the Settings page



* Visibility: **public**


#### Arguments
* $section **array** - &lt;p&gt;Array containing information Section Id, Section
                      Title &amp; Section Callback.&lt;/p&gt;



### markup_fields

    mixed Plugin_Name\App\Controllers\Admin\Admin_Settings::markup_fields(array $field_args)

Delivers the markup for settings fields



* Visibility: **public**


#### Arguments
* $field_args **array** - &lt;p&gt;Field arguments passed in &lt;code&gt;add_settings_field&lt;/code&gt;
function.&lt;/p&gt;



### add_plugin_action_links

    array Plugin_Name\App\Controllers\Admin\Admin_Settings::add_plugin_action_links(array $links)

Adds links to the plugin's action link section on the Plugins page



* Visibility: **public**


#### Arguments
* $links **array** - &lt;p&gt;The links currently mapped to the plugin.&lt;/p&gt;



### get_instance

    object Plugin_Name\Core\Controller::get_instance(mixed $model_class_name, mixed $view_class_name)

Provides access to a single instance of a module using the singleton pattern



* Visibility: **public**
* This method is **static**.
* This method is defined by [Plugin_Name\Core\Controller](Plugin_Name-Core-Controller.md)


#### Arguments
* $model_class_name **mixed** - &lt;p&gt;Model Class to be associated with the controller.&lt;/p&gt;
* $view_class_name **mixed** - &lt;p&gt;View Class to be associated with the controller.&lt;/p&gt;



### get_model

    object Plugin_Name\Core\Controller::get_model()

Get model.

In most of the cases, the model will be set as per routes in defined in routes.php.
So if you are not sure which model class is currently being used, search for the
current controller class name in the routes.php

* Visibility: **protected**
* This method is defined by [Plugin_Name\Core\Controller](Plugin_Name-Core-Controller.md)




### get_view

    object Plugin_Name\Core\Controller::get_view()

Get view

In most of the cases, the view will be set as per routes in defined in routes.php.
So if you are not sure which view class is currently being used, search for the
current controller class name in the routes.php

* Visibility: **protected**
* This method is defined by [Plugin_Name\Core\Controller](Plugin_Name-Core-Controller.md)




### set_model

    void Plugin_Name\Core\Controller::set_model(\Plugin_Name\Core\Model $model)

Sets the model to be used



* Visibility: **protected**
* This method is defined by [Plugin_Name\Core\Controller](Plugin_Name-Core-Controller.md)


#### Arguments
* $model **[Plugin_Name\Core\Model](Plugin_Name-Core-Model.md)** - &lt;p&gt;Model object to be associated with the current controller object.&lt;/p&gt;



### set_view

    void Plugin_Name\Core\Controller::set_view(\Plugin_Name\Core\View $view)

Sets the view to be used



* Visibility: **protected**
* This method is defined by [Plugin_Name\Core\Controller](Plugin_Name-Core-Controller.md)


#### Arguments
* $view **[Plugin_Name\Core\View](Plugin_Name-Core-View.md)** - &lt;p&gt;View object to be associated with the current controller object.&lt;/p&gt;



### __construct

    mixed Plugin_Name\Core\Controller::__construct(\Plugin_Name\Core\Model $model, mixed $view)

Constructor



* Visibility: **protected**
* This method is defined by [Plugin_Name\Core\Controller](Plugin_Name-Core-Controller.md)


#### Arguments
* $model **[Plugin_Name\Core\Model](Plugin_Name-Core-Model.md)** - &lt;p&gt;Model object to be used with current controller object.&lt;/p&gt;
* $view **mixed** - &lt;p&gt;View object to be used with current controller object. Otherwise false.&lt;/p&gt;



### init

    void Plugin_Name\Core\Controller::init(\Plugin_Name\Core\Model $model, mixed $view)

Sets Model & View to be used with current controller



* Visibility: **protected**
* This method is defined by [Plugin_Name\Core\Controller](Plugin_Name-Core-Controller.md)


#### Arguments
* $model **[Plugin_Name\Core\Model](Plugin_Name-Core-Model.md)** - &lt;p&gt;Model to be associated with this controller.&lt;/p&gt;
* $view **mixed** - &lt;p&gt;Either View/its child class object or False.&lt;/p&gt;


