<?php

namespace App\Response;

class Response
{
    const SUCCESS_CODE = 200;
    const NOT_FOUND_CODE = 404;
    const ERROR_CODE = 500;

    const NOT_FOUND_MESSAGE = '404, route not found';
    const ERROR_MESSAGE = 'Internal server error';

    private $responseCode;
    private $content;

    public function __construct($code = self::ERROR_CODE, $content = self::ERROR_MESSAGE)
    {
        $this->responseCode = $code;
        $this->content = $content;
    }

    public function respond()
    {
        http_response_code($this->responseCode);
        echo $this->content;

        return $this;
    }
}
