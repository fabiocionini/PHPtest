<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 06/04/15
 * Time: 11:48
 */

namespace FabioCionini\ExampleCore;

/**
 * Abstract Class HTTPStatus
 * Contains common HTTP statuses as constants, mimics an enum
 * @package FabioCionini\ExampleCore
 */
abstract class HTTPStatus {
    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const FOUND = 302;
    const NOT_MODIFIED = 304;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const INTERNAL_SERVER_ERROR = 500;
    const BAD_GATEWAY = 502;
    const SERVICE_UNAVAILABLE = 503;
    const GATEWAY_TIMEOUT = 504;
}