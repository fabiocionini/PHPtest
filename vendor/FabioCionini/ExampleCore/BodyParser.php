<?php namespace FabioCionini\ExampleCore;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 14/05/15
 * Time: 13:50
 */

class BodyParser {
    /**
     * Parses an HTTP Request body into an array of parameters (supports both json and key=value formats)
     *
     * @param string $body
     * @return array
     */
    public function parse($body) {
        $params = [];
        if ($body) {
            // try if body data is json
            $json_decoded = json_decode($body, true); // "true" gets an array instead of an object
            if ($json_decoded) {
                $params = $json_decoded;
            }
            else {
                // if not json, parse as key=value
                parse_str($body, $params);
            }
        }

        return $params;
    }
}