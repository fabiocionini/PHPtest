<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 06/04/15
 * Time: 16:17
 */

use \FabioCionini\ExampleCore\Router;
use \FabioCionini\ExampleCore\Database;
use \FabioCionini\ExampleCore\Request;

// autoload classes (PSR-0)
require_once('SplClassLoader.php');
$vendor_loader = new SplClassLoader('FabioCionini\\ExampleCore', 'vendor');
$vendor_loader->register();
$app_loader = new SplClassLoader('app', '.');
$app_loader->register();

// initialize db connection and data mapper
$db_config = include('app/Config/database.php');
$connection = Database::connection($db_config);

// initialize router and set up routes
$controllersNamespace = "\\app\\Controllers";
$router = new Router($controllersNamespace, $connection); // router handles requests by initializing controllers so we must pass a connection object (dependency injection)
$routes = include('app/Config/routes.php');
$router->setup($routes);



// handle current request
$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO']);

$router->handle($request);
