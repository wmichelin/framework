<?php

namespace App\Application;

use App\Request\Request;
use App\Request\RequestFactory;
use App\Router\Router;

class Application
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Router $router
     * @param Request $request
     */
    public function __construct(Router $router, Request $request)
    {
        $this->router = $router;
        $this->request = $request;
    }

    /**
     * Start the app
     */
    public function start()
    {
        $this->router->handle($this->request);
    }
}
