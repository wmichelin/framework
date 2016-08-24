<?php

namespace App\Controllers;
use \Exception;

class TestController
{
  public function test()
  {
    return "hello from controller";
  }

  public function index($parameter = "")
  {
    return "index page " . $parameter;
  }

  public function testWorld()
  {
    return "hello test world";
  }
}
