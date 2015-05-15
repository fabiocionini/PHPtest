<?php namespace FabioCionini\ExampleCore;
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 12/05/15
 * Time: 11:59
 */


/**
 * Class Response
 * This class deals with the HTTP response and browser/client output
 *
 * @package FabioCionini\ExampleCore
 */
class Response implements ResponseInterface {
    private $headers;
    private $body;
    private $status;
    private $view;

    public function setView(ViewInterface $view) {
        $this->view = $view;
    }

    public function addHeader($header) {
        $this->headers[] = $header;
        return $this;
    }

    public function addHeaders(array $headers) {
        foreach ($headers as $header) {
            $this->addHeader($header);
        }
        return $this;
    }

    public function set($body, $status = null) {
        if ($status === null) $status = 200;
        $this->status = $status;
        $this->body = $body;
        return $this;
    }

    public function send() {
        http_response_code($this->status);
        if (!headers_sent()) {
            foreach ($this->headers as $header) {
                header($header, true);
            }
        }
        if ($this->view) {
            echo $this->view->render($this->body);
        }
        else {
            echo $this->body;
        }
    }
}