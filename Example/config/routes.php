<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 07/04/15
 * Time: 23:36
 */

namespace Example\Config;


class Routes {
    public static $data = [
        'GET /address'             => 'AddressController@index',
        'GET /address/:id'         => 'AddressController@show',
        'POST /address'            => 'AddressController@create',
        'PUT /address/:id'         => 'AddressController@update',
        'DELETE /address/:id'      => 'AddressController@destroy',
    ];
}