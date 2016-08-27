<?php

namespace App\Router;

use App\Request\Request;
use App\Response\Response;
use App\Response\ResponseFactory;
use Exception;

class Router
{
    /**
     * @var RouteCollection
     */
    private $routes;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->registerRoutes();
    }

    /**
     * @return Router
     */
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

    /**
     * @param Request $req
     */
    public function handle(Request $req)
    {
        $this->setRequest($req)
            ->setResponse()
            ->respond();
    }

    /**
     * @return Router
     */
    private function setResponse()
    {
        $this->response = (new ResponseFactory($this->request, $this->routes))
            ->createFromRequest();

        return $this;
    }

    /**
     * @return Router
     */
    private function respond()
    {
        $this->response->respond();
        return $this;
    }

    /**
     * @param Request $req
     * @return Router
     */
    private function setRequest(Request $req)
    {
        $this->request = $req;
        return $this;
    }
}
