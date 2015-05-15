<?php namespace FabioCionini\ExampleCore;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 14/05/15
 * Time: 14:45
 */


/**
 * Interface ControllerInterface
 *
 * @package FabioCionini\ExampleCore
 */
interface ControllerInterface {
    public function setMapper(DataMapper $mapper);
}