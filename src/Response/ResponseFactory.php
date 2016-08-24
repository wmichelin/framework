<?php

namespace App\Response;

class ResponseFactory
{
    public static function createErrorResponse()
    {
        return new Response(Response::ERROR_CODE, Response::ERROR_MESSAGE);
    }

    public static function createSuccessResponse($content)
    {
        return new Response(Response::SUCCESS_CODE, $content);
    }

    public static function createNotFoundResponse()
    {
        return new Response(Response::NOT_FOUND_CODE, Response::NOT_FOUND_MESSAGE);
    }
}
