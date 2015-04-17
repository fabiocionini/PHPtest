<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 07/04/15
 * Time: 23:36
 */


/**
 * Routes configuration
 *
 * returns an associative array containing routes (HTTP method + path) and relative controller->method to be called
 * @return array
 */

return array(
    'GET /address'        => 'AddressController@index',
    'GET /address/:id'    => 'AddressController@show',
    'POST /address'       => 'AddressController@create',
    'PUT /address/:id'    => 'AddressController@update',
    'DELETE /address/:id' => 'AddressController@destroy'
);
