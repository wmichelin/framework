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
    return (bool)$this->getRoute($uri);
  }

  public function getRoute($uri)
  {
    foreach ($this->routes as $route) {
      if ($uri === $route->getURI()) {
        return $route;
      }
    }

    $routesWithParams = array_filter($this->routes, function ($route) {
      return $route->hasParameters();
    });

    $baseURI = explode('/', $uri)[0];
    $parameterValue = explode('/', $uri)[1];

    foreach ($routesWithParams as $route) {
      if ($baseURI === $route->getBaseURI()) {
        return $route;
      }
    }
    //this means no match, try parameters?

    return false;
  }

}
