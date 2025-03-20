<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\HttpClient;
use Log;

// class BirthdayNotification extends Command
// {
//     protected $signature = 'birthday:notification';
//     protected $description = 'Doğum günü bildirimi gönderir.';

//     public function handle()
//     {

//         $token = User::first()->accessToken;
//         $response = Http::withToken($token)->withHeaders([
//             'language' => 'tr',
//             'version' => 'panel',
//         ])->post(env('APP_API') . 'notifications/birthday', [
//             'gift' => 20,
//             'message' => 'Doğum günün kutlu olsun 🎉🎂 WeeScooter ailesi olarak size özel bir hediye gönderdik! Hesabınıza 20 TL bakiye ekledik, keyifle kullanmanızı dileriz.'
//         ]);

//         if ($response->successful()) {
//             Log::info('Doğum günü bildirimi gönderildi.');
//             return 0;
//         } else {
//             Log::error('Doğum günü bildirimi gönderilemedi bir hata oluştu.');
//         }
//     }
// }
