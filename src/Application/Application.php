<?php

namespace App\Application;

use App\Request\Request;
use App\Request\RequestFactory;
use App\Router\Router;

class Application
{

  private $router;

  public function __construct(Router $router)
  {
    $this->router = $router;
  }

  public function start()
  {
    $this->request = RequestFactory::createFromRequest();
    $this->router->handle($this->request);
  }

}
