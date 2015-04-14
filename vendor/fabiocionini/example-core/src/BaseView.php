<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 17:34
 */

namespace FabioCionini\ExampleCore;


/**
 * Class BaseView
 * Provides output views with HTTP statuses
 * @package app\Core
 */
abstract class BaseView {

    /**
     * Basic plain text output
     * @param $output
     * @param int $status
     */
    public static function text($output, $status = 200) {
        http_response_code($status);
        if (!headers_sent()) {
            header('Content-Type: text/plain; charset=UTF-8');
        }
        echo $output;
    }
}