Plugin_Name\Includes\Dependency_Loader
===============

Includes all methods required for loading Plugin Dependencies




* Class name: Dependency_Loader
* Namespace: Plugin_Name\Includes







Methods
-------


### load_dependencies

    mixed Plugin_Name\Includes\Dependency_Loader::load_dependencies(string $class)

Loads all Plugin dependencies

Converts Class parameter passed to the method into the file path & then
`require_once` that path. It works with Class as well as with Traits.

* Visibility: **public**


#### Arguments
* $class **string** - &lt;p&gt;Class need to be loaded.&lt;/p&gt;



### load_registries

    void Plugin_Name\Includes\Dependency_Loader::load_registries()

Load All Registry Class Files



* Visibility: **protected**




### load_core

    void Plugin_Name\Includes\Dependency_Loader::load_core()

Load Core MVC Classes



* Visibility: **protected**




### autoload_dependencies

    mixed Plugin_Name\Includes\Dependency_Loader::autoload_dependencies()

Method responsible to call all the dependencies



* Visibility: **protected**



