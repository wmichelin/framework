<?php

namespace App\Router;

class RouteCollection
{
    private $routes;
    private $cachedRoute = false;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function hasMatch($uri)
    {
        return (bool) $this->getRoute($uri);
    }

    public function getRoute($uri)
    {
        foreach ($this->routes as $route) {
            if ($uri === $route->getURI()) {
                return $route;
            }
        }

        return false;
    }

    public function toArray()
    {
        return $this->routes;
    }
}
