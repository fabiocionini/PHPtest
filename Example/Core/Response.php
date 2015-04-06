<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 06/04/15
 * Time: 11:37
 */

namespace Example\Core;


class Response {

    public $status;
    public $message;
    public $output;

    public function __construct($status = null, $message = null, $output = null) {
        $this->status = $status;
        $this->message = $message;
        $this->output = $output;
    }

    public function json() {
        return json_encode($this->output);
    }

}