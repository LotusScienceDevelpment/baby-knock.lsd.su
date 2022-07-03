<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patients\AfterScanPatients;
use App\Http\Requests\Patients\GetPatients;
use App\Http\Requests\Patients\ViewPatients;
use App\Http\Utils\Response;
use App\Models\Hearth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class DoctorController extends Controller
{
    use Response;

    /**
     * Получить всех пациентов врача
     *
     * @param GetPatients $request
     * @return JsonResponse
     */
    public function getPatients(GetPatients $request): JsonResponse
    {
        # Создаем модель пациентов врача
        $patients = User::where('account_type', 'mom')
            ->where('doctor_id', auth()->user()->id)
            ->join('hearths', 'hearths.user_id', '=', 'users.id');


        # С какой записи начинать
        if ($request->has('offset')) {
            $patients = $patients->offset($request->offset);
        }

        # Сколько записей выводить
        if ($request->has('limit')) {
            $patients = $patients->limit($request->limit);
        }

        # Выборка пациентов
        if ($request->has('deviations')) {
            $status = $request->deviations;
            # Если пациенты имеют какие-то отклонения
            if ($status == 1) {
                $patients = $patients->where('deviations', true);
            }
            # Если пациенты здоровы
            if ($status == 2) {
                $patients = $patients->where('deviations', false);
            }
        }

        if ($request->has('search')) {
            $search = explode(' ', $request->search);
            foreach ($search as $item) {
                $patients = $patients->orWhere(function (Builder $query) use ($item) {
                    $query->where('first_name', 'ilike', $item)
                        ->orWhere('last_name', 'ilike', $item);
                });
            }
        }


        # Какие поля необходимо получить
        $only = [
            'users.id', 'first_name', 'last_name', 'deviations', 'hearths.created_at'
        ];

        # Получаем и убираем все дубликаты из-за присоединения другой таблицы
        $patients = $patients->get($only);

        # Проходимся по все пациентам
        foreach ($patients as $key => $item) {
            # Создаем дату последней записи сердца пациента
            $patients[$key]['last_hearth'] = Carbon::createFromTimeString($item['created_at'])->format('d.m.Y в H:i');
            # Удаляем когда была сделана
            unset($patients[$key]['created_at']);
        }

        # Восстанавливаем ключи массива
        $patients = $patients->values();


        # Выдаем ответ
        return $this->success()->setMessage('Patients successfully loaded')->setPayload($patients)->send();
    }

    /**
     * Получить информацию по пациенту
     *
     * @param ViewPatients $request
     * @return JsonResponse
     */
    public function viewPatient(ViewPatients $request): JsonResponse
    {
        $hearths = Hearth::where('user_id', $request->id)->get();
        $user = User::where('id', $request->id)->first();

        if (empty($user))
            return $this->error()->setMessage('User not found.')->send();

        $payload = [
            'user'    => $user->toArray(),
            'hearths' => $hearths?->toArray()
        ];

        return $this->success()->setMessage('Patient successfully got')->setPayload($payload)->send();
    }

    /**
     * Добавить пользователя после сканирования
     *
     * @param AfterScanPatients $request
     * @return JsonResponse
     */
    public function afterScan(AfterScanPatients $request): JsonResponse
    {
        # Создаем модель пользователя
        $user = User::where('device_id', $request->device_id);

        # Ищем его ID
        if(!$user->exists())
            return $this->error()->setMessage('User with this device id was not found')->send();

        # Устанавливаем врача к этому пользователю
        $user->update([
            'doctor_id' => auth()->user()->id
        ]);

        # Выдаем результат
        return $this->success()->setMessage('User successfully added.')->setPayload($user->first())->send();
    }
}
