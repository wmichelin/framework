<?php

namespace App\Request;

class RequestFactory
{
    public function createFromRequest()
    {
        $uri = rtrim(ltrim($_SERVER['REQUEST_URI'], '/'), '/');
        $request = new Request($uri, $_SERVER['REQUEST_METHOD']);

        return $request;
    }
}
