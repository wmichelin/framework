<?php

namespace App\Request;

class Request
{
    private $uri;
    private $action;

    public function __construct($requestURI = "", $action = 'GET')
    {
        $this->uri = $requestURI;
        $this->action = $action;
    }

    public function getURI()
    {
        return $this->uri;
    }
}
