<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 17:35
 */

namespace Example\Controllers;

use Example\Core\BaseController;
use Example\Core\HTTPStatus;
use Example\Models\Address;
use Example\Views\AddressView;

/**
 * Class AddressController
 *
 * handles Address requests as mapped in Routes
 *
 * @package Example\Controllers
 */
class AddressController extends BaseController {
    /**
     * Creates a new resource.
     *
     * @param array $params
     * @return Object
     */
    public function create($params)
    {
        $new = new Address($params);
        $saved = $new->save();
        if ($saved === true) {
            AddressView::json($new, HTTPStatus::$CREATED);
        }
        else {
            AddressView::error($saved, HTTPStatus::$INTERNAL_SERVER_ERROR);
        }
    }

    public function index() {
        AddressView::json(Address::findAll());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Object
     */
    public function show($id)
    {
        $address = Address::find($id);
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
            $address = Address::find($id);
            if ($address) {
                $address->set($params);
                $saved = $address->save();
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
        if (Address::delete($id)) {
            AddressView::status(HTTPStatus::$OK, 'Resource successfully deleted.');
        }
        else {
            AddressView::error(HTTPStatus::$NOT_FOUND);
        }
    }

}