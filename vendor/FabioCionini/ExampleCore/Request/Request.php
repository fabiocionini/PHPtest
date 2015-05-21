<?php namespace FabioCionini\ExampleCore\Request;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 19/04/15
 * Time: 15:22
 */


/**
 * Class Request
 * an HTTP request to be handled by the Router
 *
 * @package FabioCionini\ExampleCore
 */
class Request implements RequestInterface {

    private $action;
    private $params;

    public function __construct($method, $uri, $body) {
        // create action and id from HTTP request uri and method
        $path = ltrim($uri, '/');
        $path_elements = explode('/', $path);
        $id = null;
        if (count($path_elements) > 1) {
            // more than one element, last element should be a parameter (id)
            end($path_elements);
            $key = key($path_elements);
            $id = $path_elements[$key];
            $path_elements[$key] = ':id';
        }

        // re-create pattern from path to be matched with routes settings
        $this->action = $method . ' /' . implode('/', $path_elements);

        // parse body request into params
        $this->params = $this->parseBody($body);
        if ($id) $this->params['id'] = $id;
    }

    /**
     * Parses an HTTP Request body into an array of parameters (supports both json and key=value formats)
     *
     * @param string $body
     * @return array
     */
    private function parseBody($body) {
        $params = [];
        if ($body) {
            // try if body data is json
            $json_decoded = json_decode($body, true); // "true" gets an array instead of an object
            if ($json_decoded) {
                $params = $json_decoded;
            }
            else {
                // if not json, parse as key=value
                parse_str($body, $params);
            }
        }

        return $params;
    }

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
