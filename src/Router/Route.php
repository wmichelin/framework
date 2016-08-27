<?php

namespace App\Router;

class Route
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $handler;

    /**
     * @var string
     */
    private $handlerClassName;

    /**
     * @var string
     */
    private $handlerMethodName;

    /**
     * @param string $uri
     * @param string $handler
     */
    public function __construct($uri, $handler, $options)
    {
        $this->uri = $uri;
        $this->handler = $handler;
        $this->action = $options['action'] ?: "GET";
        $this->handlerClassName = explode('::', $handler)[0];
        $this->handlerMethodName = explode('::', $handler)[1];
    }

    /**
     * @return array
     */
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

    /**
     * @return string
     */
    public function getURI()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    public function getControllerObject()
    {
        return new $this->handlerClassName();
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->handlerClassName;
    }

    /**
     * @return mixed
     */
    public function getMethodName()
    {
        return $this->handlerMethodName;
    }
}
