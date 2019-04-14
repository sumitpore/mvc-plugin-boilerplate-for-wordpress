Plugin_Name\App\Views\Admin\Admin_Settings
===============

View class to load all templates related to Plugin&#039;s Admin Settings Page




* Class name: Admin_Settings
* Namespace: Plugin_Name\App\Views\Admin
* Parent class: [Plugin_Name\Core\View](Plugin_Name-Core-View.md)







Methods
-------


### admin_settings_page

    void Plugin_Name\App\Views\Admin\Admin_Settings::admin_settings_page(array $args)

Prints Settings Page.



* Visibility: **public**


#### Arguments
* $args **array** - &lt;p&gt;Arguments passed by &lt;code&gt;markup_settings_page&lt;/code&gt; method from &lt;code&gt;Plugin_Name\App\Controllers\Admin\Admin_Settings&lt;/code&gt; controller.&lt;/p&gt;



### section_headers

    void Plugin_Name\App\Views\Admin\Admin_Settings::section_headers(array $args)

Prints Section's Description.



* Visibility: **public**


#### Arguments
* $args **array** - &lt;p&gt;Arguments passed by &lt;code&gt;markup_section_headers&lt;/code&gt; method from  &lt;code&gt;Plugin_Name\App\Controllers\Admin\Admin_Settings&lt;/code&gt; controller.&lt;/p&gt;



### markup_fields

    void Plugin_Name\App\Views\Admin\Admin_Settings::markup_fields(array $args)

Prints text field



* Visibility: **public**


#### Arguments
* $args **array** - &lt;p&gt;Arguments passed by &lt;code&gt;markup_fields&lt;/code&gt; method from &lt;code&gt;Plugin_Name\App\Controllers\Admin\Admin_Settings&lt;/code&gt; controller.&lt;/p&gt;



### render_template

    void Plugin_Name\Core\View::render_template(mixed $template_name, array $args, string $template_path, string $default_path)

Render Templates



* Visibility: **public**
* This method is **static**.
* This method is defined by [Plugin_Name\Core\View](Plugin_Name-Core-View.md)


#### Arguments
* $template_name **mixed** - &lt;p&gt;Template file to render.&lt;/p&gt;
* $args **array** - &lt;p&gt;Variables to make available inside template file.&lt;/p&gt;
* $template_path **string** - &lt;p&gt;Directory to search for template.&lt;/p&gt;
* $default_path **string** - &lt;p&gt;Fallback directory to search for template if not found at $template_path.&lt;/p&gt;



### locate_template

    string Plugin_Name\Core\View::locate_template(mixed $template_name, string $template_path, string $default_path)

Locate a template and return the path for inclusion.

This is the load order:

     yourtheme       /   $template_path  /   $template_name
     yourtheme       /   $template_name
     $default_path   /   $template_name

* Visibility: **public**
* This method is **static**.
* This method is defined by [Plugin_Name\Core\View](Plugin_Name-Core-View.md)


#### Arguments
* $template_name **mixed** - &lt;p&gt;Template file to locate.&lt;/p&gt;
* $template_path **string** - &lt;p&gt;$template_path Directory to search for template.&lt;/p&gt;
* $default_path **string** - &lt;p&gt;Fallback directory to search for template if not found at $template_path.&lt;/p&gt;


