<?php

namespace App\Http\Utils\Response;

use App\Http\Utils\Response\Messages\AuthMessagesConst;
use Illuminate\Http\JsonResponse;

class CoreResponse
{
    /**
     * Статус ответа
     *
     * @var bool
     */
    protected bool $success = true;

    /**
     * Ответ
     *
     * @var string
     */
    protected string $message = '';

    /**
     * HTTP Код ответа
     *
     * @var int
     */
    protected int $httpCode = 200;

    /**
     * Код-запроса
     *
     * @var int
     */
    protected int $requestCode = 0;

    /**
     * Тело ответа
     *
     * @var mixed
     */
    protected mixed $payload = [];

    /**
     * Устанавливаем сообщение
     * ответа
     *
     * @param string $string
     * @return CoreResponse
     */
    public function setMessage(string $string): CoreResponse
    {
        $this->message = $string;
        return $this;
    }

    /**
     * Установка кода ответ
     *
     * @param int $httpCode
     * @return CoreResponse
     */
    public function setHttpCode(int $httpCode = 200): CoreResponse
    {
        $this->httpCode = $httpCode;
        return $this;
    }

    /**
     * Установить тело ответа
     *
     * @param mixed $payload
     * @return CoreResponse
     */
    public function setPayload(mixed $payload): CoreResponse
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * Установить код запроса
     *
     * @param int $requestCode
     * @return $this
     */
    public function setRequestCode(int $requestCode): CoreResponse
    {
        $this->requestCode = $requestCode;
        return $this;
    }

    /**
     * Отправить ответ JSON
     *
     * @return JsonResponse
     */
    public function send(): JsonResponse
    {
        return response()->json([
            'success' => $this->success,
            'message' => $this->message,
            'payload' => $this->payload,
            'request_code' => $this->requestCode,
        ], $this->httpCode);
    }
}
