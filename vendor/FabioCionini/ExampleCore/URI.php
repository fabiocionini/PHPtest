<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 14/05/15
 * Time: 14:12
 */

namespace FabioCionini\ExampleCore;


/**
 * Class URI
 *
 * Parses the incoming URI request into HTTP method (GET, POST, etc.), action (to match a route) and item id if present
 * @package FabioCionini\ExampleCore
 */
class URI {
    private $uri;
    private $method;
    private $id;
    private $action;

    public function __construct($method, $uri) {
        $this->uri = $uri;
        $this->method = $method;

        // create action and id from HTTP request uri and method
        $this->method = $method;
        $path = ltrim($uri, '/');
        $path_elements = explode('/', $path);
        if (count($path_elements) > 1) {
            // more than one element, last element should be a parameter
            end($path_elements);
            $key = key($path_elements);
            $this->id = $path_elements[$key];
            $path_elements[$key] = ':id';
        } else {
            $this->id = null;
        }

        // re-create pattern from path to be matched with routes settings
        $this->action = $this->method . ' /' . implode('/', $path_elements);
    }

    public function getId() {
        return $this->id;
    }

    public function getURI() {
        return $this->uri;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getAction() {
        return $this->action;
    }

}