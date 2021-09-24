<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login;
use App\Http\Requests\Auth\Register;
use App\Http\Utils\Response;
use App\Http\Utils\Response\Messages\AuthMessagesConst;
use App\Http\Utils\Response\RequestCodes\AuthRequestCodes;
use App\Models\User;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberFormat;
use Brick\PhoneNumber\PhoneNumberParseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use Response;

    /**
     * Выдать ошибку "Неверный номер телефона или пароль"
     *
     * @return JsonResponse
     */
    private function invalidCredential(): JsonResponse
    {
        return $this->error()
            ->setMessage(AuthMessagesConst::INVALID_CREDENTIAL)
            ->setHttpCode(403)
            ->setRequestCode(AuthRequestCodes::LOGIN_USER)
            ->send();
    }

    /**
     * Создать нового пользователя
     *
     * @param Register $register
     * @return JsonResponse
     * @throws PhoneNumberParseException
     */
    public function register(Register $register): JsonResponse
    {
        # Шифруем пароль пользователя
        $register['password'] = bcrypt($register->password);

        # Форматируем номер телефона
        $number = PhoneNumber::parse($register->phone);
        $register['phone'] = $number->format(PhoneNumberFormat::INTERNATIONAL);

        # Создаем пользователя
        $user = User::create($register->all());

        # Создаем ключ-доступа (AccessToken)
        $accessToken = $user->createToken('authToken')->accessToken;

        # Выдаем ответ
        return $this->success()
            ->setMessage(AuthMessagesConst::SUCCESS_CREATED_ACCOUNT)
            ->setHttpCode(200)
            ->setRequestCode(AuthRequestCodes::CREATE_USER)
            ->setPayload([
                'user' => $user,
                'accessToken' => $accessToken,
            ])->send();
    }

    /**
     * Войти в аккаунт
     *
     * @param Login $login
     * @return JsonResponse
     * @throws PhoneNumberParseException
     */
    public function login(Login $login): JsonResponse
    {
        # Переводим номер телефона в формат по базе и ищем пользователя
        $phone = PhoneNumber::parse($login->phone);
        $phone = $phone->format(PhoneNumberFormat::INTERNATIONAL);
        $user = User::where('phone', $phone)->first();

        # Если не нашли, выдаем ошибку
        if (!$user)
            return $this->invalidCredential();

        # Проверяем, что аккаунт принадлежит роли, по которой производится вход
        if ($user->account_type != $login->account_type)
            return $this->invalidCredential();

        # Проверяем пароль, если неверный, выдаем ошибку
        if (!Hash::check($login->password, $user->password))
            return $this->invalidCredential();

        # Создаем токен авторизации
        $accessToken = $user->createToken('authToken')->accessToken;

        # Сохраняем пользователя
        auth()->setUser($user);

        # Отдаем ответ
        return $this->success()
            ->setMessage(AuthMessagesConst::SUCCESS_AUTHORIZATION)
            ->setHttpCode(200)
            ->setRequestCode(AuthRequestCodes::LOGIN_USER)
            ->setPayload(['user' => auth()->user(), 'accessToken' => $accessToken])
            ->send();
    }
}
