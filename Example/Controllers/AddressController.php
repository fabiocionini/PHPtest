<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 05/04/15
 * Time: 17:35
 */

namespace Example\Controllers;

use Example\Core\BaseController;
use Example\Core\HTTPStatus;
use Example\Core\Response;
use Example\Models\Address;

class AddressController extends BaseController {
    /**
     * Show the form for creating a new resource.
     *
     * @param array $params
     * @return Object
     */
    public function create($params)
    {
        $new = new Address($params);
        $saved = $new->save();
        if ($saved === true) {
            Response::json($new, HTTPStatus::$CREATED);
        }
        else {
            Response::text($saved, HTTPStatus::$INTERNAL_SERVER_ERROR);
        }
    }

    public function index() {
        Response::json(Address::findAll());
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
            Response::json($address);
        }
        else {
            Response::status(HTTPStatus::$NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param array $params
     * @return Response
     */
    public function update($id, $params)
    {
        if (array_key_exists('id', $params)) {
            Response::status(HTTPStatus::$BAD_REQUEST); // do not try to change record id!
        }
        else {
            $address = Address::find($id);
            if ($address) {
                $address->set($params);
                $saved = $address->save();
                if ($saved === true) {
                    Response::json($address);
                }
                else {
                    Response::text($saved, HTTPStatus::$INTERNAL_SERVER_ERROR);
                }
            }
            else {
                Response::status(HTTPStatus::$NOT_FOUND);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Address::delete($id)) {
            Response::status();
        }
        else {
            Response::status(HTTPStatus::$NOT_FOUND);
        }
    }

}