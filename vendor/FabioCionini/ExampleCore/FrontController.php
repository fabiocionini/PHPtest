<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 13/05/15
 * Time: 12:44
 */

namespace FabioCionini\ExampleCore;


class FrontController {

    public function __construct(Router $router, Dispatcher $dispatcher) {
        $this->router = $router;
        $this->dispatcher = $dispatcher;
    }

    public function run(RequestInterface $request, ResponseInterface $response) {
        $route = $this->router->route($request);
        $this->dispatcher->dispatch($route, $request, $response);
    }
}