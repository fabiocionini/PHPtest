<?php namespace FabioCionini\ExampleCore;

/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 14/05/15
 * Time: 09:45
 */


/**
 * Class Route
 * The route object contain infos for a request to be routed to a controller.
 *
 * @package FabioCionini\ExampleCore
 */
class Route implements RouteInterface {

    private $action;
    private $controller;
    private $method;

    /**
     * @param string $action
     * @param string $controller
     * @param string $method
     */
    public function __construct($action, $controller, $method) {
        $this->action = $action;
        $this->controller = $controller;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getController() {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function match(RequestInterface $request) {
        return $this->action === $request->getAction();
    }
}