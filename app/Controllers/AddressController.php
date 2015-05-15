<?php namespace app\Controllers;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 17:35
 */

use FabioCionini\ExampleCore\DataMapper;
use FabioCionini\ExampleCore\HTTPStatus;
use FabioCionini\ExampleCore\ControllerInterface;
use FabioCionini\ExampleCore\RequestInterface;
use FabioCionini\ExampleCore\ResponseInterface;

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

    public function setMapper(DataMapper $mapper) {
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
        $params = $request->getParams();
        $new = new Address($params);
        $saved = $this->mapper->insertOrUpdate($new);
        if ($saved === true) {
            $response->set($new, HTTPStatus::CREATED)->send();
        }
        else {
            $response->set($saved, HTTPStatus::INTERNAL_SERVER_ERROR)->send();
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
            $response->set('Item not found.', HTTPStatus::NOT_FOUND)->send();
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
        $params = $request->getParams();
        if (!empty($params['id'])) {
            $address = $this->mapper->find($params['id']);
            if ($address) {
                $address->set($params);
                $saved = $this->mapper->insertOrUpdate($address);
                if ($saved === true) {
                    $response->set($address)->send();
                }
                else {
                    $response->set($saved, HTTPStatus::INTERNAL_SERVER_ERROR)->send();
                }
            }
            else {
                $response->set('Item not found.', HTTPStatus::NOT_FOUND)->send();
            }
        }
        else {
            $response->set('Invalid request: id not specified.', HTTPStatus::BAD_REQUEST)->send();
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
                $response->set('Item not found.', HTTPStatus::NOT_FOUND)->send();
            }
        }
        else {
            $response->set('Invalid request: id not specified.', HTTPStatus::BAD_REQUEST)->send();
        }
    }
}