<?php

namespace App\Response;

use \Exception;

class ResponseFactory
{
    public static function createErrorResponse()
    {
        return new Response(Response::ERROR_CODE, Response::ERROR_MESSAGE);
    }

    public static function createResponse($content)
    {
        try {
            $response = new Response(Response::SUCCESS_CODE, $content);
        } catch (Exception $e) {
            $response = self::createErrorResponse();
        }

        return $response;
    }

    public static function createNotFoundResponse()
    {
        return new Response(Response::NOT_FOUND_CODE, Response::NOT_FOUND_MESSAGE);
    }
}
