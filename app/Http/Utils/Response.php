<?php

namespace App\Http\Utils;

use App\Http\Utils\Response\ErrorResponse;
use App\Http\Utils\Response\SuccessResponse;

trait Response
{
    /**
     * Выдать успешный ответ
     *
     * @return SuccessResponse
     */
    public function success(): SuccessResponse
    {
        return new SuccessResponse();
    }

    /**
     * Выдать ошибку
     *
     * @return ErrorResponse
     */
    public function error(): ErrorResponse
    {
        return new ErrorResponse();
    }
}
