Plugin_Name\Includes\Requirements_Checker
===============

Checks whether plugin&#039;s requirements are being met or not




* Class name: Requirements_Checker
* Namespace: Plugin_Name\Includes





Properties
----------


### $min_php_version

    private string $min_php_version = '5.6'

Holds minimum php version for plugin if not defined in `requirements.php`.



* Visibility: **private**


### $min_wp_version

    private string $min_wp_version = '4.8'

Holds minimum wp version for plugin if not defined in `requirements.php`.



* Visibility: **private**


### $is_multisite_compatible

    private boolean $is_multisite_compatible = false

Holds the information whether plugin is compatible with Multisite or not.



* Visibility: **private**


### $required_plugins

    private array $required_plugins = array()

Holds list of required plugins to be installed and active for our plugin to work



* Visibility: **private**


### $errors

    private array $errors = array()

Holds Error messages if dependencies are not met



* Visibility: **private**


Methods
-------


### __construct

    mixed Plugin_Name\Includes\Requirements_Checker::__construct(array $requirements_data)

Constructor



* Visibility: **public**


#### Arguments
* $requirements_data **array** - &lt;p&gt;Requirements Data mentioned in &lt;code&gt;requirements.php&lt;/code&gt;.&lt;/p&gt;



### is_php_version_dependency_met

    boolean Plugin_Name\Includes\Requirements_Checker::is_php_version_dependency_met()

Checks if Installed PHP Version is higher than required PHP Version



* Visibility: **private**




### is_wp_version_dependency_met

    boolean Plugin_Name\Includes\Requirements_Checker::is_wp_version_dependency_met()

Checks if Installed WP Version is higher than required WP Version



* Visibility: **private**




### is_wp_multisite_dependency_met

    boolean Plugin_Name\Includes\Requirements_Checker::is_wp_multisite_dependency_met()

Checks if Multisite Dependencies are met



* Visibility: **private**




### is_plugin_active

    boolean Plugin_Name\Includes\Requirements_Checker::is_plugin_active(string $plugin_name, string $plugin_slug)

Checks whether plugin is active or not



* Visibility: **private**


#### Arguments
* $plugin_name **string** - &lt;p&gt;Name of the plugin.&lt;/p&gt;
* $plugin_slug **string** - &lt;p&gt;Slug of the plugin.&lt;/p&gt;



### get_plugin_version

    string Plugin_Name\Includes\Requirements_Checker::get_plugin_version(string $plugin_slug)

Returns the plugin version of passed plugin



* Visibility: **private**


#### Arguments
* $plugin_slug **string** - &lt;p&gt;Plugin Slug of whose version needs to be retrieved.&lt;/p&gt;



### is_required_plugin_version_active

    boolean Plugin_Name\Includes\Requirements_Checker::is_required_plugin_version_active(string $plugin_name, string $plugin_slug, string $min_plugin_version)

Checks whether required version of plugin is active



* Visibility: **private**


#### Arguments
* $plugin_name **string** - &lt;p&gt;Plugin Name.&lt;/p&gt;
* $plugin_slug **string** - &lt;p&gt;Plugin Slug.&lt;/p&gt;
* $min_plugin_version **string** - &lt;p&gt;Minimum version required of the plugin.&lt;/p&gt;



### are_required_plugins_dependency_met

    boolean Plugin_Name\Includes\Requirements_Checker::are_required_plugins_dependency_met()

Checks whether all required plugins are installed & active with proper versions.



* Visibility: **private**




### add_error_notice

    void Plugin_Name\Includes\Requirements_Checker::add_error_notice(string $error_message, string $supportive_information)

Adds Error message in $errors variable



* Visibility: **private**


#### Arguments
* $error_message **string** - &lt;p&gt;Error Message.&lt;/p&gt;
* $supportive_information **string** - &lt;p&gt;Supportive Information to be displayed along with Error Message in brackets.&lt;/p&gt;



### requirements_met

    boolean Plugin_Name\Includes\Requirements_Checker::requirements_met()

Checks if all plugins requirements are met or not



* Visibility: **public**




### show_requirements_errors

    mixed Plugin_Name\Includes\Requirements_Checker::show_requirements_errors()

Prints an error that the system requirements weren't met.



* Visibility: **public**



