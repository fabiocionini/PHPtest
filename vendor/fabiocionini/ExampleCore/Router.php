<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 07/04/15
 * Time: 15:31
 */

namespace FabioCionini\ExampleCore;


/**
 * Class Router
 * @package FabioCionini\ExampleCore
 */
class Router {

    private $routes = [];
    private $connection;
    private $controllersNamespace;

    public function __construct($namespace, \PDO $connection) {
        $this->controllersNamespace = $namespace;
        $this->connection = $connection;
    }

    /**
     * Sets routes
     * Format is e.g. [ ["GET /item/:id" => "ItemController@show"], ...]
     * @param array $routes
     */
    public function setup(array $routes = []) {
        $this->routes = $routes;
    }

    /**
     * Handles a Request
     *
     * @param Request $request
     */
    public function handle(Request $request) {

        $action = $request->getAction();

        if (array_key_exists($action, $this->routes)) {

            // the route exists, call related controller@method with id and parameters
            list($controllerName, $methodName) = explode('@', $this->routes[$action]);

            $controllerName = $this->controllersNamespace.'\\'.$controllerName;
            if (class_exists($controllerName)) {
                $controller = new $controllerName($this->connection); // creates a new controller passing the db connection (dependency injection)
                if (method_exists($controller, $methodName)) {
                    $id = $request->getId();
                    $data = $request->getData();

                    if ($data) {
                        if ($id) {
                            // PUT
                            $controller->$methodName($id, $data);
                        }
                        else {
                            // POST
                            $controller->$methodName($data);
                        }
                    }
                    else {
                        // GET & DELETE
                        $controller->$methodName($id);
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
        else {
            RESTView::error(HTTPStatus::$BAD_REQUEST, 'Your request cannot be routed.');
        }
   }

}