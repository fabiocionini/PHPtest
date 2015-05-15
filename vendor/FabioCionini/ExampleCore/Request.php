<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 19/04/15
 * Time: 15:22
 */

namespace FabioCionini\ExampleCore;


/**
 * Class Request
 * an HTTP request to be handled by the Router
 *
 * @package FabioCionini\ExampleCore
 */

class Request implements RequestInterface {

    private $action;
    private $params;

    public function setAction($action) {
        $this->action = $action;
    }

    /**
     * Returns request full action (i.e. method + path + parameter placeholder, such as "GET /address/:id",
     * to match with Routes configuration
     *
     * @return string
     */
    public function getAction() {
        return $this->action;
    }

    public function setParam($key, $value) {
        $this->params[$key] = $value;
        return $this;
    }

    public function setParams(array $params) {
        foreach ($params as $key=>$value) {
            $this->params[$key] = $value;
        }
    }

    public function getParam($key) {
        if (!isset($this->params[$key])) {
            return null;
        }
        return $this->params[$key];
    }

    public function getParams() {
        return $this->params;
    }
}
