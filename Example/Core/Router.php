<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 07/04/15
 * Time: 15:31
 */

namespace Example\Core;

use Example\Core\RESTView;

class Router {

    private $routes = [];
    private $method;
    private $path;
    private $id;
    private $data;

    public function setup($routes) {
        $this->routes = $routes;
    }

    public function handle() {
        $this->path = ltrim($_SERVER['PATH_INFO'], '/');
        $path_elements = explode('/', $this->path);
        if (count($path_elements) > 1) {
            // more than one element, last element should be a parameter
            end($path_elements);
            $key = key($path_elements);
            $this->id = $path_elements[$key];
            $path_elements[$key] = ':id';
        }

        $this->method = $_SERVER['REQUEST_METHOD'];
        $pattern = $this->method.' /'.implode('/', $path_elements);

        if (array_key_exists($pattern, $this->routes)) {

            // call controller@method with id and parameters
            list($controllerName, $methodName) = explode('@', $this->routes[$pattern]);
            $controllerName = '\\Example\\Controllers\\'.$controllerName;
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    if ($this->method === 'POST' || $this->method === 'PUT') {
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

                        if ($this->id) {
                            // PUT
                            $controller->$methodName($this->id, $this->data);
                        }
                        else {
                            // POST
                            $controller->$methodName($this->data);
                        }
                    }
                    else {
                        // GET & DELETE
                        $controller->$methodName($this->id);
                    }
                }
                else {
                    RESTView::error(HTTPStatus::$BAD_REQUEST);
                }
            }
            else {
                RESTView::error(HTTPStatus::$BAD_REQUEST, 'Resource '.$controllerName.' does not exist');
            }
        }
   }


//    private $routes = [
//        'get' => [],
//        'post' => [],
//        'put' => [],
//        'delete' => []
//    ];
//
//    public function get($pattern, callable $handler) {
//        $this->routes['get'][$pattern] = $handler;
//        return $this;
//    }
//
//    public function post($pattern, callable $handler) {
//        $this->routes['post'][$pattern] = $handler;
//        return $this;
//    }
//
//    public function put($pattern, callable $handler) {
//        $this->routes['put'][$pattern] = $handler;
//        return $this;
//    }
//
//    public function delete($pattern, callable $handler) {
//        $this->routes['delete'][$pattern] = $handler;
//        return $this;
//    }
//
//    public function match(Request $request) {
//        $method = strtolower($request->getMethod());
//        if (!array_key_exists($method, $this->routes)) {
//            return false;
//        }
//
//        $path = $request->getPath();
//        foreach ($this->routes[$method] as $pattern => $handler) {
//            if ($pattern === $path) {
//                return $handler;
//            }
//        }
//
//        return false;
//    }



}