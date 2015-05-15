<?php namespace FabioCionini\ExampleCore;
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