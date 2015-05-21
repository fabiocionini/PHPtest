<?php namespace FabioCionini\ExampleCore\Response;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 14/05/15
 * Time: 09:45
 */




interface ResponseInterface {
    public function set($body, $status = null);
    public function send();
}