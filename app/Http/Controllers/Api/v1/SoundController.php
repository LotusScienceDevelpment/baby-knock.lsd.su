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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        try {
            $response = $client->get($this->endpoint . '/save', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'json'    => [
                    'user_id' => $userId
                ]
            ]);
        } catch (GuzzleException $e) {
            return $this->error()->setMessage('Something wrong')->setPayload([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ])->setHttpCode(500)->send();
        }

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
        $time = "[SAVE][".date('d.m.Y H:i:s', time()).'] ';
        $log = $time . 'UserID: ' . $userId . "\n";
        $log .= $time . "Content: \n" . json_encode($request->all()) . "\n";

        Storage::disk('public')->put('/save/log.txt', $log);

        return $this->success()->setMessage('Hearth Bit successfully saved')->setPayload($object)->send();
    }

    /**
     * Начать загрузку данных
     *
     * @param StreamSound $request
     * @return JsonResponse
     */
    public function stream(StreamSound $request): JsonResponse
    {
        $user = auth()->user();
        $client = new Client();
        try {
            $response = $client->post($this->endpoint . '/stream', [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'json'    => [
                    'user_id' => $user->id,
                    //                'user_id' => 2,
                    'data'    => $request->all()
                ]
            ]);
            $time = "[STREAM][".date('d.m.Y H:i:s', time()).'] ';
            $log = $time . 'UserID: ' . $user->id . "\n";
            $log .= $time . "Content: \n" . json_encode($request->all()) . "\n";

            Storage::disk('public')->put('/stream/log.txt', $log);
        } catch (GuzzleException $e) {
            return $this->error()->setMessage('Something wrong')->setPayload([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ])->setHttpCode(500)->send();
        }

        return $this->success()->setMessage('Data pushed')->setPayload([
            'user_id' => $user->id,
//            'user_id' => 2
        ])->send();
    }

    public function receivedAudio(Request $request)
    {
        $userId = 2;
//
        $time = "[SAVE][".date('d.m.Y H:i:s', time()).'] ';
        $log = $time . 'UserID: ' . $userId . "\n";
        $log .= $time . "Content: \n" . json_encode($request->all()) . "\n";
//
        Storage::disk('public')->put('/save/log.txt', $log);

//
        $path = $request->file('file')->storeAs('/audio', 'test.wav');


        return json_encode(['success' => true, 'headers' => json_encode($request->header('X-ID'))]);

        //
//        $object = [
//            'path' => $file,
//            'seconds' => 1,
//            'graphic' => 'graphic.png',
//            'deviations' => false,
//            'deviations_type' => 0,
//            'user_id' => $userId
//        ];
//
//        Hearth::create($object);

//        return $this->success()->setMessage('Hearth Bit successfully saved')->setPayload($object)->send();
    }
}
