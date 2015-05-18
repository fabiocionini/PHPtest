<?php namespace FabioCionini\ExampleCore\Controller;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 14/05/15
 * Time: 14:45
 */

use FabioCionini\ExampleCore\Database\DataMapper;

/**
 * Interface ControllerInterface
 *
 * @package FabioCionini\ExampleCore\Controller
 */
interface ControllerInterface {
    public function setMapper(DataMapper $mapper);
}