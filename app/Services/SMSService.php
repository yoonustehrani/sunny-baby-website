<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SMSService
{
    const BASE_URL = 'https://edge.ippanel.com/v1/api';
    const CACHE_KEY = 'farazsms-auth-token';
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function sendPattern(string $to, string $pattern, array $data)
    {
        return $this->sendRequest('/send', [
            'sending_type' => 'pattern',
            'from_number' => '+983000505',
            'code' => $pattern,
            'recipients' => [$to],
            'params' => $data
        ]);
    }

    protected function getAuthToken()
    {
        return env('FARAZSMS_API_KEY');
    }

    protected function sendRequest(string $url, array $data = [], $auth = false)
    {
        $http = Http::baseUrl(self::BASE_URL)->acceptJson();
        if (! $auth) {
            // $http->withToken($this->getAuthToken());
            $http->withHeader('Authorization', $this->getAuthToken());
        }
        try {
            $response = $http->post($url, $data);
            return $response->object();
            // switch ($response->status()) {
            //     case 401:
            //         Cache::forget(self::CACHE_KEY);
            //         return $this->sendRequest($url, $data, $auth);
            //     case 422:
            //         throw $response->object();
            //     default:
            //         return $response->object();
            // }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
