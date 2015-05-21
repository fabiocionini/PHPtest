<?php namespace FabioCionini\ExampleCore\Validation;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 15/05/15
 * Time: 02:23
 */



/**
 * Interface Validatable
 *
 * a model that can be validated using a Validator object
 *
 * @package FabioCionini\ExampleCore\Model
 */

interface Validatable {
    /**
     * Returns validation data for model properties
     *
     * @return array
     */
    public function validation();
}