Plugin_Name\App\Models\Frontend\Base_Model
===============

Blueprint for Frontend related Models. All Frontend Models should extend this Base_Model




* Class name: Base_Model
* Namespace: Plugin_Name\App\Models\Frontend
* This is an **abstract** class
* Parent class: [Plugin_Name\Core\Model](Plugin_Name-Core-Model.md)







Methods
-------


### register_hook_callbacks

    mixed Plugin_Name\App\Models\Frontend\Base_Model::register_hook_callbacks()

Register callbacks for actions and filters. Most of your add_action/add_filter
go into this method.

NOTE: register_hook_callbacks method is not called automatically. You
as a developer have to call this method where you see fit. For Example,
You may want to call this in constructor, if you feel hooks/filters
callbacks should be registered when the new instance of the class
is created.

The purpose of this method is to set the convention that first place to
find add_action/add_filter is register_hook_callbacks method.

This method is not marked abstract because it may not be needed in every
model. Making it abstract would enforce every child class to implement
the method.

If I were you, I would define register_hook_callbacks method in the child
class when it is a 'Model only' route. This is not hard & fast rule, it
is just my opinion when I would define this method.

* Visibility: **protected**




### get_instance

    object Plugin_Name\Core\Model::get_instance()

Provides access to a single instance of a module using the singleton pattern



* Visibility: **public**
* This method is **static**.
* This method is defined by [Plugin_Name\Core\Model](Plugin_Name-Core-Model.md)



