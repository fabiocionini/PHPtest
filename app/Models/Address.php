<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 17:36
 */

namespace Example\Models;

use FabioCionini\ExampleCore\BaseModel;

/**
 * Class Address
 * extends base model providing object properties (map 1:1 with DB)
 * @package app\Models
 */
class Address extends BaseModel {
    public $name;
    public $phone;
    public $street;

}