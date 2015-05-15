<?php namespace app\Models;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 17:36
 */



use FabioCionini\ExampleCore\Model;
use FabioCionini\ExampleCore\ModelInterface;

/**
 * Class Address
 * extends base model providing object properties (map 1:1 with DB)
 * @package app\Models
 */
class Address extends Model implements ModelInterface {
    public $name;
    public $phone;
    public $street;

    /**
     * Returns validation data for model properties
     *
     * @return array
     */
    public static function validation() {
        return [
            'name' => ['type' => 'string', 'required' => 'true', 'min_length' => 2, 'max_length' => 100],
            'street' => ['type' => 'string', 'required' => 'true', 'min_length' => 3, 'max_length' => 100],
            'phone' => ['type' => 'string', 'required' => 'true', 'min_length' => 5, 'max_length' => 20]
        ];
    }
}