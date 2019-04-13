Plugin_Name\Core\Registry\Controller
===============






* Class name: Controller
* Namespace: Plugin_Name\Core\Registry





Properties
----------


### $stored_objects

    protected mixed $stored_objects = array()





* Visibility: **protected**
* This property is **static**.


Methods
-------


### get_key

    mixed Plugin_Name\Core\Registry\Controller::get_key($controller_class_name, $model_class_name, $view_class_name)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $controller_class_name **mixed**
* $model_class_name **mixed**
* $view_class_name **mixed**



### set

    void Plugin_Name\Core\Registry\Controller::set(string $key, mixed $value)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **string**
* $value **mixed**



### get

    mixed Plugin_Name\Core\Registry\Controller::get(string $key)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **string**



### get_all_objects

    array Plugin_Name\Core\Registry\Controller::get_all_objects()

Returns all objects



* Visibility: **public**
* This method is **static**.



