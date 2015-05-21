<?php namespace FabioCionini\ExampleCore\Model;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 15/05/15
 * Time: 02:23
 */




interface ModelInterface {
    /**
     * Returns validation data for model properties
     *
     * @return array
     */
    public static function validation();
}