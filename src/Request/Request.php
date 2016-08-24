<?php

namespace App\Request;

class Request
{
  private $uri;
  private $action;

  public function __construct($requestURI, $action = "GET")
  {
    $this->uri = $requestURI;
    $this->action = $action;
  }

  public function getURI()
  {
    return $this->uri;
  }

  public function getBaseURI()
  {
    return explode('/', $this->uri)[0];
  }

  public function getParameterValue()
  {
    return explode('/', $this->uri)[1];
  }

}
