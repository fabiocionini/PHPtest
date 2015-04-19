<?php
/**
 * Created by PhpStorm.
 * User: fabio
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
class Request {

    private $method;
    private $id;
    private $action;
    private $data;

    /**
     * Creates a new Request object with HTTP method (GET,POST etc.) and request path as parameters
     *
     * @param $method
     * @param $request
     */
    public function __construct($method, $request) {
        // extract request info from request path and method
        $this->method = $method;
        $this->path = ltrim($request, '/');
        $path_elements = explode('/', $this->path);
        if (count($path_elements) > 1) {
            // more than one element, last element should be a parameter
            end($path_elements);
            $key = key($path_elements);
            $this->id = $path_elements[$key];
            $path_elements[$key] = ':id';
        }
        else {
            $this->id = null;
        }

        // re-create pattern from path to see if it matches with one of the routes
        $this->action = $this->method.' /'.implode('/', $path_elements);

        // parse body
        $body = @file_get_contents('php://input');
        if ($body) {
            // try if body data is json
            $json = json_decode($body);
            if ($json) {
                $this->data = $json;
            }
            else {
                // if not json, parse as key=value
                parse_str($body, $this->data);
            }
        }
        else {
            $this->data = null;
        }
    }

    /**
     * Returns request HTTP method
     *
     * @return string
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * Returns request full action (i.e. method + path + parameter placeholder, such as "GET /address/:id", to match with Routes configuration
     *
     * @return string
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * Returns request URL parameter (= object id)
     *
     * @return int|null
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns request data found in request body (JSON or URL-encoded) as associative array
     *
     * @return array|null
     */
    public function getData() {
        return $this->data;
    }
}