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
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=UTF-8');
        }
        echo json_encode($output);
    }

    public static function status($status = 200, $message = null) {
        http_response_code($status);
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=UTF-8');
        }
        echo json_encode(['status' => ['code' => $status, 'description' => $message]]);
    }

    public static function error($status, $message = null) {
        http_response_code($status);
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=UTF-8');
        }
        echo json_encode(['error' => ['code' => $status, 'message' => $message]]);
    }
}