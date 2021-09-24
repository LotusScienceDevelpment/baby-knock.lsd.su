<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sound\SaveSound;
use App\Http\Requests\Sound\StreamSound;
use App\Http\Utils\Response;
use App\Models\Hearth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class SoundController extends Controller
{
    use Response;

    private string $url;
    private string $endpoint;

    public function __construct()
    {
        $this->url = env('PYTHON_API');
        $this->endpoint = $this->url . '/api/v1/sound';
    }

    public function save(SaveSound $request)
    {
        $userId = 2;
        $client = new Client();
        $response = $client->get($this->endpoint.'/save', [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'json' => [
                'user_id' => $userId
            ]
        ]);

        $file = json_decode($response->getBody()->getContents(), true);

        $object = [
            'path' => $file['file_path'],
            'seconds' => round($file['duration'], 1),
            'graphic' => 'graphic.png',
            'deviations' => false,
            'deviations_type' => 0,
            'user_id' => $userId
        ];

        Hearth::create($object);

        return $this->success()->setMessage('Hearth Bit successfully saved')->setPayload($object)->send();
    }

    /**
     * Начать загрузку данных
     *
     * @param StreamSound $request
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function stream(StreamSound $request): JsonResponse
    {
//        $user = auth()->user();
        $client = new Client();
        $response = $client->post($this->endpoint.'/stream', [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'json' => [
//                'user_id' => $user->id,
                'user_id' => 2,
                'data' => $request->all()
            ]
        ]);

        return $this->success()->setMessage('Data pushed')->setPayload([
//            'user_id' => $user->id,
            'user_id' => 2
        ])->send();
    }
}
