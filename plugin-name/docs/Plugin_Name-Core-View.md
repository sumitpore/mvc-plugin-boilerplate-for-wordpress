Plugin_Name\Core\View
===============

Class Responsible for Loading Templates




* Class name: View
* Namespace: Plugin_Name\Core







Methods
-------


### render_template

    void Plugin_Name\Core\View::render_template(mixed $template_name, array $args, string $template_path, string $default_path)

Render Templates



* Visibility: **public**
* This method is **static**.


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


#### Arguments
* $template_name **mixed** - &lt;p&gt;Template file to locate.&lt;/p&gt;
* $template_path **string** - &lt;p&gt;$template_path Directory to search for template.&lt;/p&gt;
* $default_path **string** - &lt;p&gt;Fallback directory to search for template if not found at $template_path.&lt;/p&gt;


