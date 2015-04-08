<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 17:36
 */

namespace Example\Models;

use Example\Core\BaseModel;

/**
 * Class Address
 * extends base model providing object properties (map 1:1 with DB)
 * @package Example\Models
 */
class Address extends BaseModel {
    public $name;
    public $phone;
    public $address;

}