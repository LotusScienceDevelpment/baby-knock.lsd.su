<?php

namespace App\Http\Utils\Response;

class ErrorResponse extends CoreResponse
{
    /**
     * Устанавливаем ошибочный ответ
     */
    public function __construct()
    {
        $this->success = false;
        $this->setHttpCode(400);
    }
}
