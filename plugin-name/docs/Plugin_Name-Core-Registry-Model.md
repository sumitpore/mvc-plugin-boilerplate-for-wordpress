Plugin_Name\Core\Registry\Model
===============

Model Registry

Maintains the list of all models objects


* Class name: Model
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


### set

    void Plugin_Name\Core\Registry\Model::set(string $key, mixed $value)

Add object to registry



* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **string** - &lt;p&gt;Key to be used to map with Object.&lt;/p&gt;
* $value **mixed** - &lt;p&gt;Object to Store.&lt;/p&gt;



### get

    mixed Plugin_Name\Core\Registry\Model::get(string $key)

Get object from registry



* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **string** - &lt;p&gt;Key of the object to restore.&lt;/p&gt;



### get_all_objects

    array Plugin_Name\Core\Registry\Model::get_all_objects()

Returns all objects



* Visibility: **public**
* This method is **static**.



