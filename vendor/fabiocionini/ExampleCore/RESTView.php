<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 07/04/15
 * Time: 14:52
 */

namespace FabioCionini\ExampleCore;


/**
 * Class RESTView
 * REST API specific views, returns output, statuses and errors in JSON format
 * @package FabioCionini\ExampleCore
 */
abstract class RESTView extends BaseView {
    /**
     * Returns object(s) as JSON together with a customizable HTTP status
     * @param string $output
     * @param int $status
     */
    public static function json($output, $status = 200) {
        http_response_code($status);
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=UTF-8');
        }
        echo json_encode($output);
    }

    /**
     * Returns an HTTP status with a custom message as a JSON object
     * @param int $status
     * @param string $message
     */
    public static function status($status = 200, $message = null) {
        http_response_code($status);
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=UTF-8');
        }
        echo json_encode(['status' => ['code' => $status, 'description' => $message]]);
    }

    /**
     * Returns an HTTP error with a custom message as a JSON object
     * @param int $status
     * @param string $message
     */
    public static function error($status, $message = null) {
        http_response_code($status);
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=UTF-8');
        }
        echo json_encode(['error' => ['code' => $status, 'message' => $message]]);
    }
}