<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 07/04/15
 * Time: 14:52
 */

namespace Example\Core;


abstract class RESTView extends BaseView {
    public static function json($output, $status = 200) {
        http_response_code($status);
        echo json_encode($output);
    }

    public static function status($status = 200) {
        http_response_code($status);
        echo '';
    }

    public static function error($status, $message = null) {
        http_response_code($status);
        echo json_encode(['error' => ['code' => $status, 'message' => $message]]);
    }
}