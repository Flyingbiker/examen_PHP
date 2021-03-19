<?php


namespace Components\Http\Exceptions;


class MethodNotAllowedHttpException extends HttpException
{
    public function __construct()
    {
        parent::__construct('Method Not Allowed', 405);
    }
}