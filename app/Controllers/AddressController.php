<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 17:35
 */

namespace app\Controllers;

use FabioCionini\ExampleCore\BaseController;
use FabioCionini\ExampleCore\HTTPStatus;
use app\Models\Address;
use app\Views\AddressView;
use app\Mappers\AddressMapper;

/**
 * Class AddressController
 *
 * handles Address requests as mapped in Routes
 *
 * @package app\Controllers
 */
class AddressController extends BaseController {

    /**
     * Initializes the controller and creates a mapper object using the provided db connection
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo) {
        $this->mapper = new AddressMapper($pdo);
    }

    /**
     * Creates a new resource.
     *
     * @param array $params
     * @return Object
     */

    public function create($params)
    {
        $new = new Address($params);
        $saved = $this->mapper->insertOrUpdate($new);
        if ($saved === true) {
            AddressView::json($new, HTTPStatus::$CREATED);
        }
        else {
            AddressView::error($saved, HTTPStatus::$INTERNAL_SERVER_ERROR);
        }
    }

    public function index() {
        AddressView::json($this->mapper->findAll());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Object
     */
    public function show($id)
    {
        $address = $this->mapper->find($id);
        if ($address) {
            AddressView::json($address);
        }
        else {
            AddressView::error(HTTPStatus::$NOT_FOUND, 'Item not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param array $params
     * @return Object
     */
    public function update($id, $params)
    {
        if (array_key_exists('id', $params)) {
            AddressView::status(HTTPStatus::$BAD_REQUEST); // do not try to change record id when updating!
        }
        else {
            $address = $this->mapper->find($id);
            if ($address) {
                $address->set($params);
                $saved = $this->mapper->insertOrUpdate($address);
                if ($saved === true) {
                    AddressView::json($address);
                }
                else {
                    AddressView::error(HTTPStatus::$INTERNAL_SERVER_ERROR, $saved);
                }
            }
            else {
                AddressView::error(HTTPStatus::$NOT_FOUND);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Object
     */
    public function destroy($id)
    {
        if ($id) {
            if ($this->mapper->delete($id)) {
                AddressView::status(HTTPStatus::$OK, 'Resource successfully deleted.');
            } else {
                AddressView::error(HTTPStatus::$NOT_FOUND);
            }
        }
        else {
            AddressView::error(HTTPStatus::$BAD_REQUEST);
        }
    }

}