<?php

namespace App\Router;

class Route
{
    private $uri;
    private $baseURI;
    private $parameter;
    private $handler;
    private $handlerClassName;
    private $handlerMethodName;

    public function __construct($uri, $handler)
    {
        $this->uri = $uri;
        $this->handler = $handler;
        $this->handlerClassName = explode('::', $handler)[0];
        $this->handlerMethodName = explode('::', $handler)[1];
    }

    public function getURI()
    {
        return $this->uri;
    }

    public function getBaseURI()
    {
        return $this->baseURI;
    }

    public function getControllerObject()
    {
        return new $this->handlerClassName();
    }

    public function getMethodName()
    {
        return $this->handlerMethodName;
    }

}
