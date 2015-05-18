<?php namespace FabioCionini\ExampleCore\Routing;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 14/05/15
 * Time: 13:32
 */

use FabioCionini\ExampleCore\Request\RequestInterface;

interface RouteInterface {
    public function match(RequestInterface $request);
}