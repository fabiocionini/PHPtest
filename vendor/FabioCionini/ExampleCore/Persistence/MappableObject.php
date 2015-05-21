<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 21/05/15
 * Time: 16:22
 */

namespace FabioCionini\ExampleCore\Persistence;


/**
 * Interface MappableObject
 *
 * a model that can be mapped using a DataMapper object
 *
 * @package FabioCionini\ExampleCore\Model
 */
interface MappableObject {

    /**
     * Returns id and other public properties defined by model class
     * @return array
     */
    public function get_model_vars();

    /**
     * Sets model instance properties
     * @param $data
     */
    public function set(array $data);
}