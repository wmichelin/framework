<?php

namespace App\Router;

class RouteCollection
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @var bool
     */
    private $cachedRoute = false;

    /**
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param string $uri
     * @return bool
     */
    public function hasMatch($uri)
    {
        return (bool) $this->getRoute($uri);
    }

    /**
     * @param string $uri
     * @return bool|mixed
     */
    public function getRoute($uri)
    {
        foreach ($this->routes as $route) {
            if ($uri === $route->getURI()) {
                return $route;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->routes;
    }
}
