Plugin_Name\Core\Registry\Controller
===============

Controller Registry

Maintains the list of all controllers objects


* Class name: Controller
* Namespace: Plugin_Name\Core\Registry





Properties
----------


### $stored_objects

    protected array $stored_objects = array()

Variable that holds all objects in registry.



* Visibility: **protected**
* This property is **static**.


Methods
-------


### get_key

    string Plugin_Name\Core\Registry\Controller::get_key(string $controller_class_name, string $model_class_name, string $view_class_name)

Returns key used to store a particular Controller Object



* Visibility: **public**
* This method is **static**.


#### Arguments
* $controller_class_name **string** - &lt;p&gt;Controller Class Name.&lt;/p&gt;
* $model_class_name **string** - &lt;p&gt;Model Class Name.&lt;/p&gt;
* $view_class_name **string** - &lt;p&gt;View Class Name.&lt;/p&gt;



### set

    void Plugin_Name\Core\Registry\Controller::set(string $key, mixed $value)

Add object to registry



* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **string** - &lt;p&gt;Key to be used to map with Object.&lt;/p&gt;
* $value **mixed** - &lt;p&gt;Object to Store.&lt;/p&gt;



### get

    mixed Plugin_Name\Core\Registry\Controller::get(string $key)

Get object from registry



* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **string** - &lt;p&gt;Key of the object to restore.&lt;/p&gt;



### get_all_objects

    array Plugin_Name\Core\Registry\Controller::get_all_objects()

Returns all objects



* Visibility: **public**
* This method is **static**.



