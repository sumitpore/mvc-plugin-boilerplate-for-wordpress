Plugin_Name\Core\Controller
===============






* Class name: Controller
* Namespace: Plugin_Name\Core
* This is an **abstract** class





Properties
----------


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


### get_instance

    object Plugin_Name\Core\Controller::get_instance($model_class_name, $view_class_name)

Provides access to a single instance of a module using the singleton pattern



* Visibility: **public**
* This method is **static**.


#### Arguments
* $model_class_name **mixed**
* $view_class_name **mixed**



### get_model

    object Plugin_Name\Core\Controller::get_model()

Get model.

In most of the cases, the model will be set as per routes in defined in routes.php.
So if you are not sure which model class is currently being used, search for the
current controller class name in the routes.php

* Visibility: **protected**




### get_view

    object Plugin_Name\Core\Controller::get_view()

Get view

In most of the cases, the view will be set as per routes in defined in routes.php.
So if you are not sure which view class is currently being used, search for the
current controller class name in the routes.php

* Visibility: **protected**




### set_model

    void Plugin_Name\Core\Controller::set_model(\Plugin_Name\Core\Model $model)

Sets the model to be used



* Visibility: **protected**


#### Arguments
* $model **[Plugin_Name\Core\Model](Plugin_Name-Core-Model.md)**



### set_view

    void Plugin_Name\Core\Controller::set_view(\Plugin_Name\Core\View $view)

Sets the view to be used



* Visibility: **protected**


#### Arguments
* $view **[Plugin_Name\Core\View](Plugin_Name-Core-View.md)**



### __construct

    mixed Plugin_Name\Core\Controller::__construct(\Plugin_Name\Core\Model $model, $view)

Constructor



* Visibility: **protected**


#### Arguments
* $model **[Plugin_Name\Core\Model](Plugin_Name-Core-Model.md)**
* $view **mixed**



### init

    void Plugin_Name\Core\Controller::init(\Plugin_Name\Core\Model $model, mixed $view)

Sets Model & View to be used with current controller



* Visibility: **protected**


#### Arguments
* $model **[Plugin_Name\Core\Model](Plugin_Name-Core-Model.md)** - &lt;p&gt;Model to be associated with this controller&lt;/p&gt;
* $view **mixed** - &lt;p&gt;Either View/its child class object or False&lt;/p&gt;


