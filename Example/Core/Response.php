<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 06/04/15
 * Time: 11:37
 */

namespace Example\Core;


class Response {

    public static function json($output, $status = 200) {
        http_response_code($status);
        echo json_encode($output);
    }

    public static function text($output, $status = 200) {
        http_response_code($status);
        echo $output;
    }

    public static function status($status = 200) {
        http_response_code($status);
        echo '';
    }
}