<?php

namespace App\Router;

use App\Request\Request;
use App\Response\ResponseFactory;
use Exception;

class Router
{
    private $routes;
    private $response;
    private $controller;

    public function __construct()
    {
        $this->registerRoutes();
    }

    private function registerRoutes()
    {
        $this->routes = new RouteCollection([
            new Route('', "App\Controllers\TestController::index"),
            new Route('test', "App\Controllers\TestController::test"),
            new Route('test/world', "App\Controllers\TestController::testWorld"),
        ]);

        return $this;
    }

    public function handle(Request $req)
    {
        $this->setRequest($req)
            ->setResponse()
            ->respond();
    }

    private function setResponse()
    {
        $uri = $this->request->getURI();
        $parameter = false;
        if ($this->routes->hasMatch($uri)) {
            try {
                $route = $this->routes->getRoute($this->request->getURI());
                $this->response = ResponseFactory::createResponse($route);
            } catch (Exception $e) {
                $this->response = ResponseFactory::createErrorResponse();
            }
        } else {
            $this->response = ResponseFactory::createNotFoundResponse();
        }

        return $this;
    }

    private function getControllerObject($controllerString)
    {
        $className = explode('::', $controllerString)[0];

        return new $className();
    }

    private function getControllerAction($controllerString)
    {
        return $controllerString = explode('::', $controllerString)[1];
    }

    private function respond()
    {
        $this->response->respond();

        return $this;
    }

    private function setRequest($req = false)
    {
        $this->request = $req;

        return $this;
    }
}
