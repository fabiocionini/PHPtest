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


    /**
     * This sets the render view for the response output. If not set, the response body will be sent out as-is.
     *
     * @param ViewInterface $view
     */
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

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * This sets both body and status in a single call (useful for one-line response outputs).
     * Returns the response object itself (so it could be chained with send()).
     *
     * @param $body
     * @param null $status
     * @return $this
     */
    public function set($body, $status = null) {
        if ($status === null) $status = 200;
        $this->status = $status;
        $this->body = $body;
        return $this;
    }

    /**
     * Sends out the response to the client.
     * If set, it passes the body to the view to be rendered.
     */
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