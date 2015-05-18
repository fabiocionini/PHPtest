<?php namespace FabioCionini\ExampleCore\Routing;

/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 07/04/15
 * Time: 15:31
 */

use FabioCionini\ExampleCore\Request\RequestInterface;

/**
 * Class Router
 * The router contains all the routes and can perform a match against a request, returning the corresponding route
 *
 * @package FabioCionini\ExampleCore
 */
class Router {

    private $routes = [];

    public function addRoute(RouteInterface $route) {
        $this->routes[] = $route;
    }

    public function addRoutes(array $routes) {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }

    public function route(RequestInterface $request) {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {
                return $route;
            }
        }
        return null;
    }
}