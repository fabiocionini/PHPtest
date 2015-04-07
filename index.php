<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 06/04/15
 * Time: 16:17
 */

use \Example\Core\Router;
use \Example\Config\Routes;

require_once('SplClassLoader.php');
$loader = new SplClassLoader('Example', '.');
$loader->register();



$router = new Router();
$router->setup(Routes::$data);

$router->handle();
