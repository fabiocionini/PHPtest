<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 15/05/15
 * Time: 01:05
 */

namespace FabioCionini\ExampleCore;


interface ViewInterface {
    public function render($content);
    public function getHeader();
}