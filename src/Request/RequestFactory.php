<?php

namespace App\Request;

class RequestFactory
{
    /**
     * @return Request
     */
    public function createFromRequest(array $request)
    {
        $uri = trim($request['REQUEST_URI'], '/');
        $request = new Request($uri, $request['REQUEST_METHOD']);

        return $request;
    }
}
