<?php namespace FabioCionini\ExampleCore;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 14/05/15
 * Time: 13:50
 */

class BodyParser {
    public function parse($body) {
        $params = [];
        if ($body) {
            // try if body data is json
            $json_decoded = json_decode($body, true); // "true" gets array instead of object
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