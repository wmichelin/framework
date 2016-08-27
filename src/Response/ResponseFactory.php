<?php

namespace App\Response;

use App\Request\Request;
use App\Router\RouteCollection;
use App\Router\Route;

use \Exception;

class ResponseFactory
{
    private $request;
    private $routes;
    private $matchingRoute = false;

    public function __construct(Request $request, RouteCollection $routes)
    {
        $this->request = $request;
        $this->routes = $routes;
    }

    public function createErrorResponse()
    {
        return new Response(Response::ERROR_CODE, Response::ERROR_MESSAGE);
    }

    private function isRouteValid(Request $request, Route $route)
    {
        if ($request->getAction() !== $route->getAction()) {
            return false;
        }

        $requestParts = explode('/', $request->getURI());
        $routeParts = explode('/', $route->getURI());

        if (count($requestParts) !== count($routeParts)) {
            return false;
        }

        foreach ($routeParts as $key=>$part) {
            if (!(preg_match('/{(\w+)}/', $part)) // Not capture group
            && $requestParts[$key] !== $part) {
                return false;
            }
        }

        return true;
    }

    private function createResponse()
    {
        $controllerObject = $this->matchingRoute->getControllerObject();
        $handlingMethod = $this->matchingRoute->getMethodName();

        try {
            return new Response(
                Response::SUCCESS_CODE, $controllerObject->{$handlingMethod}()
            );
        } catch (Exception $e) {
            return $this->createErrorResponse();
        }
    }

    public function createFromRequest()
    {
        $request = $this->request;
        $routes = $this->routes->toArray();


        foreach ($routes as $route) { // go for direct matches
            if (($route->getURI() === $request->getURI())
            && (($route->getAction() === $request->getAction()))) {
                return $this->setMatchingRoute($route)
                    ->createResponse();
            }
        }

        foreach ($routes as $route) { //this checks for slugs
            if ($this->isRouteValid($request, $route)) {
                $this->setMatchingRoute($route);
                break;
            }
        }

        if (!$this->matchingRoute) {
            return $this->createNotFoundResponse();
        }

        $parameters = [];
        $requestParts = explode('/', $request->getURI());
        foreach ($this->matchingRoute->getSlugIndices() as $index) {
            array_push($parameters, $requestParts[$index]);
        }

        $controllerObject = $this->matchingRoute->getControllerObject();
        $handlingMethod = $this->matchingRoute->getMethodName();

        try {
            $response = new Response(
                Response::SUCCESS_CODE,
                call_user_func_array(
                    [
                        $controllerObject, $handlingMethod
                    ],
                    $parameters)
            );
        } catch (Exception $e) {
            $response = $this->createErrorResponse();
        }

        return $response;
    }

    private function setMatchingRoute(Route $route)
    {
        $this->matchingRoute = $route;
        return $this;
    }

    public function createNotFoundResponse()
    {
        return new Response(Response::NOT_FOUND_CODE, Response::NOT_FOUND_MESSAGE);
    }
}
