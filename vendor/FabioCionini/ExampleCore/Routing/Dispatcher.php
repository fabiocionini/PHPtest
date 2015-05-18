<?php namespace FabioCionini\ExampleCore\Routing;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 13/05/15
 * Time: 12:31
 */

use FabioCionini\ExampleCore\Database\DataMapper;
use FabioCionini\ExampleCore\Request\RequestInterface;
use FabioCionini\ExampleCore\Response\ResponseInterface;
use FabioCionini\ExampleCore\Response\Response;

/**
 * Class Dispatcher
 * The Dispatcher is responsible for executing the method on the controller that matched the route
 *
 * @package FabioCionini\ExampleCore
 */
class Dispatcher {

    private $mapper;

    public function __construct(DataMapper $mapper) {
        $this->mapper = $mapper;
    }

    /**
     * Given a route, creates the controller and executes the method on that controller,
     * passing request and response objects
     *
     * @param Route $route
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function dispatch(Route $route, RequestInterface $request, ResponseInterface $response) {
        $controllerClass = $route->getController();
        $method = $route->getMethod();

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $method)) {
                $controller->setMapper($this->mapper);
                $controller->$method($request, $response);
            }
            else {
                $response->set('ERROR: cannot find the requested action for this resource.', Response::BAD_REQUEST)->send();
            }
        }
        else {
            $response->set('ERROR: cannot find the requested resource.', Response::BAD_REQUEST)->send();
        }
    }
}