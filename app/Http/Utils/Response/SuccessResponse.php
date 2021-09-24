<?php

namespace App\Http\Utils\Response;

class SuccessResponse extends CoreResponse
{
    /**
     * Устанавливаем успешный ответ
     */
    public function __construct()
    {
        $this->success = true;
        $this->setHttpCode(200);
    }
}
