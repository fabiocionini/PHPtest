<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 06/04/15
 * Time: 16:17
 */

use \FabioCionini\ExampleCore\Router;
use \FabioCionini\ExampleCore\Database;

// autoload classes (PSR-0)
require_once('SplClassLoader.php');
$vendor_loader = new SplClassLoader('FabioCionini\\ExampleCore', 'vendor');
$vendor_loader->register();
$app_loader = new SplClassLoader('app', '.');
$app_loader->register();


/**
 *
 *
 * @return null|PDO
 */

$dbhProvider = function() {
    $db = null;
    $config = include('app/Config/database.php');
    if (array_key_exists('driver', $config) && array_key_exists($config['driver'], $config['config'])) {
        switch($config['driver']) {
            case 'sqlite':
                $db = new \PDO('sqlite:'.$config['config']['sqlite']['filename']);
                $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                break;
            default:
                break;
        }
    }
    return $db;
};


// initialize router and set up routes
$routes = include('app/Config/routes.php');
$router = new Router();
$router->setup($routes);

// handle current request
$router->handle($_SERVER['REQUEST_METHOD'], $_SERVER['PATH_INFO']);
