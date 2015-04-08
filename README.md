# PHPtest Example

## Description
This application is a RESTful HTTP API based on example files (provided in /original directory).
The original files set up a basic HTTP GET service to retrieve "address" records from a CSV file.
This application achieves the same functionality but it has been designed and developed as a full MVC, RESTful HTTP API.

Added features are:

- Model-View-Controller class structure
- Namespaces
- PSR-0 class autoloading
- Base abstract classes for models, views, controller
- SQLite backed storage for maximum portability
- Active Record pattern for models
- Configurable router class handling incoming requests and forwarding them to a controller class
- Full REST CRUD API (makes use of GET, POST, PUT, DELETE HTTP methods)
- Architecture was designed for expandability and as a starting point for a bigger API application

## Requirements
PHP 5.5.x or better
SQlite3 (included with PHP >= 5.4.x)

## Installation and usage
Should be compatible with major web servers.
Developed and tested on Apache/2.4.9.

Please run **setup.php** once to create the SQLite database and fill it with initial data.
Routes are accessible via http://[hostname]/PHPtest/index.php/[route]

## API specifications

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

Parameters in the POST body request can be provided in URI encoded format or JSON.

**Returns:** the newly created address object.

### PUT /address/:id
Updates an existing address specified by :id.

**Parameters:** 
- string *name* 
- string *address*
- string *phone*

Parameters in the PUT body request can be provided in URI encoded format or JSON.

**Returns:** the updated object or **404 Not found** if record was not found.

### DELETE /address/:id
Retrieves address record specified by :id.

**Returns:** a **200 OK** status or a **404 Not found** if record was not found.


## Possible improvements
- Unit Tests!
- More flexible Router URL parsing 
- Support for PUT and DELETE through POST and GET alternative routes (for clients that do not support PUT/DELETE requests)
- Better error and edge cases handling
- Data validation in model