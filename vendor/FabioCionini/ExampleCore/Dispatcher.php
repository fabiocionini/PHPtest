<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 13/05/15
 * Time: 12:31
 */

namespace FabioCionini\ExampleCore;


class Dispatcher {

    private $mapper;

    public function __construct(DataMapper $mapper) {
        $this->mapper = $mapper;
    }

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

            }
        }
        else {

        }
    }
}