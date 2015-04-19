<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 06/04/15
 * Time: 11:48
 */

namespace FabioCionini\ExampleCore;

/**
 * Class HTTPStatus
 * Contains common HTTP statuses as static properties
 * @package FabioCionini\ExampleCore
 */
class HTTPStatus {
    public static $OK = 200;
    public static $CREATED = 201;
    public static $ACCEPTED = 202;
    public static $FOUND = 302;
    public static $NOT_MODIFIED = 304;
    public static $BAD_REQUEST = 400;
    public static $UNAUTHORIZED = 401;
    public static $FORBIDDEN = 403;
    public static $NOT_FOUND = 404;
    public static $INTERNAL_SERVER_ERROR = 500;
    public static $BAD_GATEWAY = 502;
    public static $SERVICE_UNAVAILABLE = 503;
    public static $GATEWAY_TIMEOUT = 504;
}