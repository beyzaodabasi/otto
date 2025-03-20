<?php

namespace App\Http;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class HttpClient {

    public static function get($url, $headers = []) {
        $headers['language'] = 'tr';
        $headers['version'] = 'panel';
        $response = Http::withHeaders($headers)->withToken(Auth::user()->accessToken)->get(env('APP_API') . $url);
        if ($response->ok()) {
            return $response->object();
        }
        return collect([]);
    }

    public static function send($method, $url, $data, $headers = []) {
        $headers['language'] = 'tr';
        $headers['version'] = 'panel';
        $response = Http::withHeaders($headers)->withToken(Auth::user()->accessToken)->$method(env('APP_API') . $url, $data);
        // dd($response->object(), $method, $url, $data);
        if ($response->ok()) {
            return $response->object();
        }
        return collect([]);
    }
}
