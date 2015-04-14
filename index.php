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
$vendor_loader = new SplClassLoader('vendor', '.');
$vendor_loader->register();
$app_loader = new SplClassLoader('app', '.');
$app_loader->register();


// initialize router and set up routes
$router = new Router();
$router->setup(Routes::$data);

// handle current request
$router->handle($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO']);
