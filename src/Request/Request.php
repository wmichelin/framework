<?php

namespace App\Request;

class Request
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $action;

    /**
     * @param string $requestURI
     * @param string $action
     */
    public function __construct($requestURI = '', $action = 'GET')
    {
        $this->uri = $requestURI;
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getURI()
    {
        return $this->uri;
    }
}
