Plugin_Name\Core\Router
===============

Class Responsible for registering Routes




* Class name: Router
* Namespace: Plugin_Name\Core



Constants
----------


### REGISTER_LATE_FRONTEND_ROUTES

    const REGISTER_LATE_FRONTEND_ROUTES = true





Properties
----------


### $models

    private array $models = array()

Holds List of Models used for 'Model Only' Routes



* Visibility: **private**
* This property is **static**.


### $mvc_components

    private array $mvc_components = array()

Holds Model, View & Controllers triad for All routes except 'Model Only' Routes



* Visibility: **private**
* This property is **static**.


Methods
-------


### __construct

    mixed Plugin_Name\Core\Router::__construct()

Constructor



* Visibility: **public**




### register_hook_callbacks

    mixed Plugin_Name\Core\Router::register_hook_callbacks()

Register callbacks for actions and filters



* Visibility: **protected**




### register_generic_model_only_routes

    void Plugin_Name\Core\Router::register_generic_model_only_routes()

Register Generic `Model Only` Routes



* Visibility: **public**




### register_late_frontend_model_only_routes

    void Plugin_Name\Core\Router::register_late_frontend_model_only_routes()

Register Late Frontend `Model Only` Routes



* Visibility: **public**




### register_generic_routes

    void Plugin_Name\Core\Router::register_generic_routes()

Register Generic Routes



* Visibility: **public**




### register_late_frontend_routes

    void Plugin_Name\Core\Router::register_late_frontend_routes()

Register Late Frontend Routes



* Visibility: **public**




### generic_route_types

    array Plugin_Name\Core\Router::generic_route_types()

Returns List of commonly/mostly used Route types



* Visibility: **public**




### late_frontend_route_types

    array Plugin_Name\Core\Router::late_frontend_route_types()

Returns list of Route types belonging to Frontend but registered late



* Visibility: **public**




### register_route_of_type

    \Plugin_Name\Core\Router Plugin_Name\Core\Router::register_route_of_type(string $type)

Type of Route to be registered. Every time a new route needs to be
registered, this function should be called first on `$route` object



* Visibility: **public**


#### Arguments
* $type **string** - &lt;p&gt;Type of route to be registered.&lt;/p&gt;



### with_just_model

    mixed Plugin_Name\Core\Router::with_just_model(mixed $model)

Enqueues a model to be associated with the Model only` Route



* Visibility: **public**


#### Arguments
* $model **mixed** - &lt;p&gt;Model to be associated with the Route. Could be String or callback.&lt;/p&gt;



### build_controller_unique_id

    string Plugin_Name\Core\Router::build_controller_unique_id(mixed $controller)

Generates a Unique id for each controller

This unique id is used as an array key inside mvc_components array which
is used while enqueueing models and views to associate them with the
controller.

* Visibility: **public**


#### Arguments
* $controller **mixed** - &lt;p&gt;Controller to be associated with the Route. Could be String or callback.&lt;/p&gt;



### with_controller

    object Plugin_Name\Core\Router::with_controller(mixed $controller)

Enqueues a controller to be associated with the Route



* Visibility: **public**


#### Arguments
* $controller **mixed** - &lt;p&gt;Controller to be associated with the Route. Could be String or callback.&lt;/p&gt;



### with_model

    object Plugin_Name\Core\Router::with_model(mixed $model)

Enqueues a model to be associated with the Route

The object of this model is passed to controller.

* Visibility: **public**


#### Arguments
* $model **mixed** - &lt;p&gt;Model to be associated with the Route. Could be String or callback.&lt;/p&gt;



### with_view

    object Plugin_Name\Core\Router::with_view(mixed $view)

Registers view with the Route. The object of this view is passed to controller



* Visibility: **public**


#### Arguments
* $view **mixed** - &lt;p&gt;View to be associated with the Route. Could be String or callback.&lt;/p&gt;



### register_routes

    void Plugin_Name\Core\Router::register_routes(boolean $register_late_frontend_routes)

Registers Enqueued Routes



* Visibility: **private**


#### Arguments
* $register_late_frontend_routes **boolean** - &lt;p&gt;Whether to register late frontend routes.&lt;/p&gt;



### dispatch

    void Plugin_Name\Core\Router::dispatch(array $mvc_component, string $route_type)

Dispatches the route of specified $route_type by creating a controller object



* Visibility: **private**


#### Arguments
* $mvc_component **array** - &lt;p&gt;Model-View-Controller triads for all registered routes.&lt;/p&gt;
* $route_type **string** - &lt;p&gt;Route Type.&lt;/p&gt;



### register_model_only_routes

    void Plugin_Name\Core\Router::register_model_only_routes(boolean $register_late_frontend_routes)

Registers `Model Only` Enqueued Routes



* Visibility: **public**


#### Arguments
* $register_late_frontend_routes **boolean** - &lt;p&gt;Whether to register late frontend routes.&lt;/p&gt;



### dispatch_only_model

    void Plugin_Name\Core\Router::dispatch_only_model(mixed $model, string $route_type)

Dispatches the model only route by creating a Model object



* Visibility: **private**


#### Arguments
* $model **mixed** - &lt;p&gt;Model to be associated with the Route. Could be String or callback.&lt;/p&gt;
* $route_type **string** - &lt;p&gt;Route Type.&lt;/p&gt;



### get_fully_qualified_class_name

    string Plugin_Name\Core\Router::get_fully_qualified_class_name(string $class, string $mvc_component_type, string $route_type)

Returns the Full Qualified Class Name for given class name



* Visibility: **private**


#### Arguments
* $class **string** - &lt;p&gt;Class whose FQCN needs to be found out.&lt;/p&gt;
* $mvc_component_type **string** - &lt;p&gt;Could be between &#039;model&#039;, &#039;view&#039; or &#039;controller&#039;.&lt;/p&gt;
* $route_type **string** - &lt;p&gt;Could be &#039;admin&#039; or &#039;frontend&#039;.&lt;/p&gt;



### is_request

    boolean Plugin_Name\Core\Router::is_request(string $route_type)

Identifies Request Type



* Visibility: **private**


#### Arguments
* $route_type **string** - &lt;p&gt;Route Type to identify.&lt;/p&gt;


