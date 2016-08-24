<?php

namespace App\Request;

class RequestFactory
{
    /**
     * @return Request
     */
    public function createFromRequest()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $request = new Request($uri, $_SERVER['REQUEST_METHOD']);

        return $request;
    }
}
