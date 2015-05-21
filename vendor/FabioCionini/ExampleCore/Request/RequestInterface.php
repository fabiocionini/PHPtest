<?php namespace FabioCionini\ExampleCore\Request;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 13/05/15
 * Time: 12:49
 */



interface RequestInterface {
    public function getAction();
    public function getParams();
    public function getParam($key);
}