Plugin_Name\Includes\i18n
===============

Define the internationalization functionality

Loads and defines the internationalization files for this plugin
so that it is ready for translation.


* Class name: i18n
* Namespace: Plugin_Name\Includes





Properties
----------


### $domain

    private string $domain

The domain specified for this plugin.



* Visibility: **private**


Methods
-------


### load_plugin_textdomain

    mixed Plugin_Name\Includes\i18n::load_plugin_textdomain()

Load the plugin text domain for translation.



* Visibility: **public**




### set_domain

    mixed Plugin_Name\Includes\i18n::set_domain(string $domain)

Set the domain equal to that of the specified domain.



* Visibility: **public**


#### Arguments
* $domain **string** - &lt;p&gt;The domain that represents the locale of this plugin.&lt;/p&gt;


