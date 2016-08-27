<?php

namespace App\Router;

use App\Request\Request;
use App\Response\ResponseFactory;
use Exception;

class Router
{
    private $routes;
    private $request;
    private $response;

    public function __construct()
    {
        $this->registerRoutes();
    }

    private function registerRoutes()
    {
        $this->routes = new RouteCollection([
            new Route('{foo}/{bar}', 'App\Controllers\TestController::fooBar',
                [
                    'action' => 'GET'
                ]
            ),
            new Route('test', 'App\Controllers\TestController::test',
                [
                    'action' => 'GET'
                ]
            ),
            new Route('test/world', 'App\Controllers\TestController::testWorld',
                [
                    'action' => 'GET'
                ]
            ),
            new Route('', 'App\Controllers\TestController::index',
                [
                    'action' => 'GET'
                ]
            )
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
        $this->response = (new ResponseFactory($this->request, $this->routes))
            ->createFromRequest();

        return $this;
    }

    private function respond()
    {
        $this->response->respond();
        return $this;
    }

    private function setRequest(Request $req)
    {
        $this->request = $req;
        return $this;
    }
}
