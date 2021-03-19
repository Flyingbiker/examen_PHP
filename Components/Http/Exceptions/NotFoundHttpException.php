<?php

namespace Components\Http\Exceptions;


class NotFoundHttpException extends HttpException
{
    public function __construct()
    {
        parent::__construct('Not Found', 404);
    }
}