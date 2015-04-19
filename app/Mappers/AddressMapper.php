<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 19/04/15
 * Time: 11:38
 */

namespace app\Mappers;


use FabioCionini\ExampleCore\DataMapper;

/**
 * Class AddressMapper
 *
 * @package app\Mappers
 */
class AddressMapper extends DataMapper {
    public function __construct($pdo) {
        parent::__construct($pdo, 'Address', 'id', 'app\\Models');
    }
}