# PHPtest Example
## Version 1.0.3

## Description
This application is a RESTful HTTP API based on example files (provided in /original directory).
The original files set up a basic HTTP GET service to retrieve "address" records from a CSV file.
This application achieves the same functionality but it has been designed and developed as a full MVC, RESTful HTTP API.

## Main features
- Model-View-Controller class structure
- Namespaces
- PSR-0 class autoloading
- Base abstract classes for models, views, controller
- SQLite backed storage for maximum portability
- Domain-Model-Mapper pattern for data objects
- Front Controller -> Router -> Dispatcher pattern
- Full REST CRUD API (makes use of GET, POST, PUT, DELETE HTTP methods)
- Architecture was designed for expandability and as a starting point for a bigger API application
- Not using any external framework or library except for the included SplClassLoader.php (recommended PSR-0 autoload handler)
- Vendor-like structure for core classes


## Requirements
PHP 5.5.x or better
SQLite3 (included with PHP >= 5.4.x)


## Installation and usage
Should be compatible with major web servers.
Developed and tested on Apache/2.4.9.

Please run **setup.php** once to create the SQLite database and fill it with initial data.

## API specifications

APIs are accessible via **http://[hostname]/PHPtest/index.php/[API call]**

### GET /address/:id
Retrieves address record specified by :id.

**Returns:** a JSON object or **Error 404** if record was not found

### GET /address
Retrieves an array of all addresses.

**Returns:** an array of JSON objects

### POST /address
Creates a new address.

**Parameters:** 
- string *name* 
- string *address*
- string *phone*

All fields are currently required.
**name** must be a string between 2 and 100 characters.
**address** must be a string between 3 and 100 characters.
**phone** must be a string between 5 and 20 characters.
The validation settings are customizable in the Address model file.

Parameters in the POST body request can be provided in URI encoded format or JSON.

**Returns:** the newly created address object or **400 Bad Request** if parameters are not valid.

### PUT /address/:id
Updates an existing address specified by :id.

**Parameters:** 
- string *name* 
- string *address*
- string *phone*

Parameters in the PUT body request can be provided in URI encoded format or JSON.

**Returns:** the updated object, **400 Bad Request** if parameters are not valid, **404 Not found** if record was not found.

### DELETE /address/:id
Retrieves address record specified by :id.

**Returns:** a **200 OK** status or a **404 Not found** if record was not found.


## Version history

### 1.0.3
- Refactored namespaces grouping classes by function
- Compacted logic of old URI and BodyParser classes into Request class
- HTTPStatus constants moved into the Response class
- removed "ghost" vendor subfolder
- Better SOLID compliance

### 1.0.2
- Refactored most of the code using interfaces and trying to implement SOLID principles.
- Classes are now light, low coupled and have single responsibility.
- Router is now responsible only for finding the route for the request, then the route is handled by the Dispatcher
- added Front Controller pattern for a single point of entry of the application.
- added Dispatcher, Response, Route objects and related design patterns.
- added a Validator that checks for required fields, data types and size against a config array provided by the model.
- added other light objects to parse incoming requests (BodyParser and URI)
- removed old and unused classes

### 1.0.1
- Add vendor-like structure for core classes
- Database and routes configuration now are php arrays
- Offloaded some logic from the Router: created a Request object that parses its own data
- Added a Data Mapper object removing DB access from the model classes
- hardcoded namespace paths inside core classes

### 1.0
- Initial release
- MVC structure
- Base abstract classes for models, views, controller
- Active Record pattern for models
- Configurable router class handling incoming requests and forwarding them to a controller class


## Possible improvements
- Unit Tests!
- Response Content-Type based on request Accept header
- Support for PUT and DELETE through POST and GET alternative routes (for clients that do not support PUT/DELETE requests)
