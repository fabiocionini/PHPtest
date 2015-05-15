<?php namespace FabioCionini\ExampleCore\Views;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 15/05/15
 * Time: 01:10
 */

use FabioCionini\ExampleCore\ViewInterface;

class JSONView implements ViewInterface {

    /**
     * Renders the content into a formatted output
     *
     * @param $content
     * @return string
     */
    public function render($content) {
        if (!is_array($content) && !is_object($content)) {
            $content = ['response' => $content];
        }
        return json_encode($content);
    }

    /**
     * Returns appropriate HTTP header for this output
     *
     * @return string
     */
    public function getHeader() {
        return 'Content-Type: application/json; charset=UTF-8';
    }
}