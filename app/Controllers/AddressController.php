<?php namespace app\Controllers;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 17:35
 */

use FabioCionini\ExampleCore\Persistence\MapperInterface;
use FabioCionini\ExampleCore\Response\Response;
use FabioCionini\ExampleCore\Controller\ControllerInterface;
use FabioCionini\ExampleCore\Request\RequestInterface;
use FabioCionini\ExampleCore\Response\ResponseInterface;
use FabioCionini\ExampleCore\Validation\Validator;

use app\Models\Address;

/**
 * Class AddressController
 *
 * handles Address requests as mapped in Routes
 *
 * @package app\Controllers
 */
class AddressController implements ControllerInterface {

    private $mapper;

    /**
     * Sets the data mapper and customizes it
     *
     * @param MapperInterface $mapper
     */
    public function setMapper(MapperInterface $mapper) {
        $this->mapper = $mapper;
        $this->mapper->setModel("\\app\\Models\\Address");
        $this->mapper->setPrimaryKey("id");
    }

    /**
     * Creates a new resource.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return Object
     */
    public function create(RequestInterface $request, ResponseInterface $response)
    {
        $address = new Address();
        $validator = new Validator($address);
        $params = $request->getParams();
        if ($validator->validate($params)) {
            $address->set($params);
            $saved = $this->mapper->insertOrUpdate($address);
            if ($saved === true) {
                $response->set($address, Response::CREATED)->send();
            }
            else {
                $response->set($saved, Response::INTERNAL_SERVER_ERROR)->send();
            }
        }
        else {
            $response->set(['Errors'=>$validator->getErrors()], Response::BAD_REQUEST)->send();
        }
    }

    public function index(RequestInterface $request, ResponseInterface $response) {
        $response->set($this->mapper->findAll())->send();
    }

    /**
     * Display the specified resource.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return Object
     */
    public function show(RequestInterface $request, ResponseInterface $response)
    {
        $params = $request->getParams();
        $id = $params['id'];
        $address = $this->mapper->find($id);
        if ($address) {
            $response->set($address)->send();
        }
        else {
            $response->set('Item not found.', Response::NOT_FOUND)->send();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return Object
     */
    public function update(RequestInterface $request, ResponseInterface $response)
    {
        $address = new Address();
        $validator = new Validator($address);
        $params = $request->getParams();
        if (!empty($params['id'])) {
            $address = $this->mapper->find($params['id']);
            if ($address) {
                if ($validator->validate($params, false)) {
                    $address->set($params);
                    $saved = $this->mapper->insertOrUpdate($address);
                    if ($saved === true) {
                        $response->set($address)->send();
                    } else {
                        $response->set($saved, Response::INTERNAL_SERVER_ERROR)->send();
                    }
                }
                else {
                    $response->set(['Errors'=>$validator->getErrors()], Response::BAD_REQUEST)->send();
                }
            }
            else {
                $response->set('Item not found.', Response::NOT_FOUND)->send();
            }
        }
        else {
            $response->set('Invalid request: id not specified.', Response::BAD_REQUEST)->send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return Object
     */
    public function destroy(RequestInterface $request, ResponseInterface $response)
    {
        $params = $request->getParams();

        if (!empty($params['id'])) {
            if ($this->mapper->delete($params['id'])) {
                $response->set('Resource successfully deleted.')->send();
            } else {
                $response->set('Item not found.', Response::NOT_FOUND)->send();
            }
        }
        else {
            $response->set('Invalid request: id not specified.', Response::BAD_REQUEST)->send();
        }
    }
}