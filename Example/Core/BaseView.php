<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 05/04/15
 * Time: 17:34
 */

namespace Example\Core;


abstract class BaseView {

    public static function text($output, $status = 200) {
        http_response_code($status);
        if (!headers_sent()) {
            header('Content-Type: text/plain; charset=UTF-8');
        }
        echo $output;
    }
}