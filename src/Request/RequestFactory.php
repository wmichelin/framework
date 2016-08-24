<?php

namespace App\Request;

use App\Request\Request;

class RequestFactory
{
  public static function createFromRequest()
  {
    $uri = rtrim(ltrim($_SERVER['REQUEST_URI'], '/'), '/');
    $request = new Request($uri, $_SERVER['REQUEST_METHOD']);
    return $request;
  }
}
