<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mother\DeleteHearthMother;
use App\Http\Requests\Mother\GetHearths;
use App\Http\Requests\Mother\RenameHearthMother;
use App\Http\Utils\Response;
use App\Models\Hearth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class MotherController extends Controller
{
    use Response;

    /**
     * Получить все записи сердечного ритма
     *
     * @param GetHearths $request
     * @return JsonResponse
     */
    public function getHearths(GetHearths $request): JsonResponse
    {
        # Получаем пользователя
        $user = auth()->user();

        # Получаем все возможные сердцебиения
        $hearths = Hearth::where('user_id', $user->id);

        # Если есть поле limit
        if( $request->limit ) {
            # Устанавливаем лимит на кол-во записей
            $hearths = $hearths->limit($request->limit);
        }

        # Если есть поле offset
        if( $request->offset ) {
            # Устанавливаем с какой записи необходимо начинать
            $hearths = $hearths->offset($request->offset);
        }

        $hearths = $hearths->get([
            'id', 'name', 'path', 'seconds', 'graphic', 'deviations',
            'deviations_type', 'created_at', 'updated_at'
        ]);

        # Если не задано имя, то возвращаем дату как имя
        foreach ($hearths as $key => $item) {
            if ($item['name'] == null) {
                $hearths[$key]['name'] = Carbon::createFromTimeString($item['created_at'])->format('d.m.Y');
            }
        }
        # Отправляем данные
        return $this->success()->setMessage('Hearths successfully got')
            ->setPayload($hearths)
            ->send();
    }

    /**
     * Изменить имя записи
     *
     * @param RenameHearthMother $request
     * @return JsonResponse
     */
    public function renameHearth(RenameHearthMother $request): JsonResponse
    {
        # Получаем пользователя
        $user = auth()->user();

        # Изменяем название записи
        $success = Hearth::where('user_id', $user->id)->where('id', $request->hearth_id)->update([
            'name' => $request->name
        ]);

        # Если мы не смогли изменить, то выдаем ошибку
        if (!$success)
            return $this->error()->setMessage('Perhaps the hearth doesn\'t belong to you or doesn\'t exist')->send();

        # Иначе выдаем успешный ответ
        return $this->success()->setMessage('Hearth successfully renamed')->send();
    }

    /**
     * Удалить сердце
     *
     * @param DeleteHearthMother $request
     * @return JsonResponse
     */
    public function deleteHearth(DeleteHearthMother $request): JsonResponse
    {
        # Получаем пользователя
        $user = auth()->user();

        # Удаляем запись (не полностью)
        $success = Hearth::where('user_id', $user->id)->where('id', $request->hearth_id)->delete();

        # Если мы не смогли удалить запись, то выдаем ошибку
        if (!$success)
            return $this->error()->setMessage('Perhaps the hearth doesn\'t belong to you or doesn\'t exist')->send();

        # Иначе выдаем успешный ответ
        return $this->success()->setMessage('Hearth successfully deleted')->send();
    }
}
