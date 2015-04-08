<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 06/04/15
 * Time: 16:17
 */

use \Example\Core\Router;
use \Example\Config\Routes;

// autoload classes (PSR-0)
require_once('SplClassLoader.php');
$loader = new SplClassLoader('Example', '.');
$loader->register();


// initialize router and set up routes
$router = new Router();
$router->setup(Routes::$data);

// handle current request
$router->handle($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO']);
