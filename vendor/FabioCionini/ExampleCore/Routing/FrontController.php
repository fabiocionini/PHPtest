<?php namespace FabioCionini\ExampleCore\Routing;

/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 13/05/15
 * Time: 12:44
 */

use FabioCionini\ExampleCore\Request\RequestInterface;
use FabioCionini\ExampleCore\Response\ResponseInterface;

/**
 * Class FrontController
 * The front controller is the single point of entry of the application and is responsible for passing the request
 * to the router and then dispatch the obtained route.
 *
 * @package FabioCionini\ExampleCore
 */
class FrontController {

    public function __construct(Router $router, Dispatcher $dispatcher) {
        $this->router = $router;
        $this->dispatcher = $dispatcher;
    }

    public function run(RequestInterface $request, ResponseInterface $response) {
        $route = $this->router->route($request);
        if ($route) {
            $this->dispatcher->dispatch($route, $request, $response);
        }
        else {
            $response->set("Invalid request", 400)->send();
        }
    }
}
