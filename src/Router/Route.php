<?php

namespace App\Router;

class Route
{
  private $uri;
  private $baseURI;
  private $parameter;
  private $handler;
  private $handlerClassName;
  private $handlerMethodName;
  private $hasParameters = false;

  public function __construct($uri, $handler)
  {
    if (preg_match('/{(.*?)}/', $uri, $matches) > 0) {
      $this->hasParameters = true;
      $this->uri = $uri;
      $this->baseURI = explode("/", $uri)[0];
      $this->parameter = explode("/", $uri)[1];
    }

    $this->uri = $uri;
    $this->handler = $handler;
    $this->handlerClassName = explode("::", $handler)[0];
    $this->handlerMethodName = explode("::", $handler)[1];
  }

  public function getURI()
  {
    return $this->uri;
  }

  public function getBaseURI()
  {
    return $this->baseURI;
  }

  public function getControllerObject()
  {
    return new $this->handlerClassName();
  }

  public function getMethodName()
  {
    return $this->handlerMethodName;
  }

  public function hasParameters()
  {
    return $this->hasParameters;
  }
}
