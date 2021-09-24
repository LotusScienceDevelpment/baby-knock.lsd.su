<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'payload' => ['logged' => false],
                'request_code' => -401
            ], 401)
            : redirect()->guest(route('login'));
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  Request  $request
     * @param ValidationException $exception
     * @return JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $exception->getMessage(),
            'payload'  => $this->transformErrors($exception),
            'request_code' => -400
        ], $exception->status);
    }

    private function transformErrors(ValidationException $exception): array
    {
        $errors = [];

        foreach ($exception->errors() as $field => $message) {
            $errors[] = [
                'field' => $field,
                'message' => $message[0],
            ];
        }

        return $errors;
    }
}
