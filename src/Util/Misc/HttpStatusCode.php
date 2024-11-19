<?php

namespace App\Util\Misc;

final class HttpStatusCode
{
    public const CREATED = 201;
    public const NOT_FOUND = 404;
    public const OK = 200;
    public const TEAPOT = 418;
    public const UNAUTHORIZED = 401; // Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED
    public const VALIDATION_ERROR = 422;
}
