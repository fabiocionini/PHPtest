<?php namespace app\Models;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 17:36
 */



use FabioCionini\ExampleCore\Model;

/**
 * Class Address
 * extends base model providing object properties (map 1:1 with DB)
 * @package app\Models
 */
class Address extends Model {
    public $name;
    public $phone;
    public $street;

}