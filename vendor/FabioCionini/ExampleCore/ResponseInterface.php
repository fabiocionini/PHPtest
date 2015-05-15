<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 14/05/15
 * Time: 09:45
 */

namespace FabioCionini\ExampleCore;


interface ResponseInterface {
    public function set($body, $status = null);
    public function send();
}