<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 07/04/15
 * Time: 23:36
 */

// TODO: make it a config array not a class

namespace Example\Config;


/**
 * Class Routes
 *
 * static class that contains routes configuration
 *
 * @package app\Config
 */
class Routes {
    public static $data = [
        'GET /address'             => 'AddressController@index',
        'GET /address/:id'         => 'AddressController@show',
        'POST /address'            => 'AddressController@create',
        'PUT /address/:id'         => 'AddressController@update',
        'DELETE /address/:id'      => 'AddressController@destroy',
    ];
}