<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 06/04/15
 * Time: 16:17
 */

use \FabioCionini\ExampleCore\FrontController;
use \FabioCionini\ExampleCore\Router;
use \FabioCionini\ExampleCore\Route;
use \FabioCionini\ExampleCore\Dispatcher;
use \FabioCionini\ExampleCore\DataMapper;
use \FabioCionini\ExampleCore\Database;
use \FabioCionini\ExampleCore\Request;
use \FabioCionini\ExampleCore\Response;
use \FabioCionini\ExampleCore\BodyParser;
use \FabioCionini\ExampleCore\URI;
use \FabioCionini\ExampleCore\Views\JSONView;


// autoload classes (PSR-0)
require_once('SplClassLoader.php');
$vendor_loader = new SplClassLoader('FabioCionini\\ExampleCore', 'vendor');
$vendor_loader->register();
$app_loader = new SplClassLoader('app', '.');
$app_loader->register();


// create request object from received data (method, path, body)
$body = @file_get_contents('php://input');
$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO'], $body);

// create response object and set its view
$response = new Response();
$view = new JSONView();
$response->setView($view);
$response->addHeader($view->getHeader());


// initialize router and set up routes
$controllersNamespace = "\\app\\Controllers";
$routesConfig = include('app/Config/routes.php');
$router = new Router();
foreach($routesConfig as $action=>$call) {
    list($controller, $method) = explode('@', $call);
    $route = new Route($action, $controllersNamespace."\\".$controller, $method);
    $router->addRoute($route);
}


// initialize db connection and data mapper
$dbConfig = include('app/Config/database.php');
$connection = Database::connection($dbConfig);
$dataMapper = new DataMapper($connection);


// the dispatcher takes the route returned from the router and delivers it to the matching controller
// it needs the data mapper to pass it to the controller
$dispatcher = new Dispatcher($dataMapper);


// create and run the front controller
$frontController = new FrontController($router, $dispatcher);
$frontController->run($request, $response);

