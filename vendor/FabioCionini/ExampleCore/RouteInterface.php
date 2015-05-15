<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 14/05/15
 * Time: 13:32
 */

namespace FabioCionini\ExampleCore;


interface RouteInterface {
    public function match(RequestInterface $request);
}