<?php namespace FabioCionini\ExampleCore\View;

/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 15/05/15
 * Time: 01:05
 */


interface ViewInterface {
    public function render($content);
    public function getHeader();
}