<?php

namespace App\Router;

class Route
{
    private $uri;
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

    public function getSlugIndices()
    {
        $indexArray = [];
        foreach (explode('/', $this->uri) as $key => $part) {
            if (preg_match('/{(\w+)}/', $part)) {
                array_push($indexArray, $key);
            }
        }

        return $indexArray;
    }

    public function getURI()
    {
        return $this->uri;
    }


    public function getControllerObject()
    {
        return new $this->handlerClassName();
    }

    public function getControllerName()
    {
        return $this->handlerClassName;
    }

    public function getMethodName()
    {
        return $this->handlerMethodName;
    }
}
