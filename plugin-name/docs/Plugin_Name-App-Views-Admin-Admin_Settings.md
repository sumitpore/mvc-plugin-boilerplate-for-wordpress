Plugin_Name\App\Views\Admin\Admin_Settings
===============

Class Responsible for Loading Templates




* Class name: Admin_Settings
* Namespace: Plugin_Name\App\Views\Admin
* Parent class: [Plugin_Name\Core\View](Plugin_Name-Core-View.md)







Methods
-------


### admin_settings_page

    mixed Plugin_Name\App\Views\Admin\Admin_Settings::admin_settings_page($args)





* Visibility: **public**


#### Arguments
* $args **mixed**



### section_headers

    mixed Plugin_Name\App\Views\Admin\Admin_Settings::section_headers($args)





* Visibility: **public**


#### Arguments
* $args **mixed**



### markup_fields

    mixed Plugin_Name\App\Views\Admin\Admin_Settings::markup_fields($args)





* Visibility: **public**


#### Arguments
* $args **mixed**



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


