<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ChangeProfile;
use App\Http\Utils\Response;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use Response;

    /**
     * Получить информацию о профиле
     *
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        # Отдаем успешный ответ с пользователем
        return $this->success()->setMessage('Successfully got profile')->setPayload(
            auth()->user()
        )->send();
    }

    /**
     * Изменяем настройки пользователя
     *
     * @param ChangeProfile $request
     * @return JsonResponse
     */
    public function change(ChangeProfile $request): JsonResponse
    {
        # Получаем пользователя
        $user = auth()->user();

        # Делаем изменения
        auth()->user()->update([
           'first_name' => $request->first_name ?? $user->first_name,
           'last_name' => $request->last_name ?? $user->last_name
        ]);

        # Выдаем успешный ответ с измененными данными
        return $this->success()->setMessage('Profile successfully updated')->setPayload($request->all())->send();
    }
}
