<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use Illuminate\Http\Request;
use Telegram\Bot\Traits\Telegram;

class TelegramBot extends Controller
{

    public function index()
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $response = $telegram->sendMessage([
            'chat_id' => env('CHAT_BOT_GROUP'),
            'text' => 'Hello world!'
        ]);
        return response()->json([
            'data' => $response,
        ],200);
    }

    public function testing()
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        // $updates = $telegram->setWebHook("https://tesbotlenna.herokuapp.com");
        $updates = $telegram->getWebhookUpdate();
        if(isset($updates['message'])){
            $text = $updates['message']['text'];
            $chat_id = $updates['message']['chat']['id'];

            if ($text == '/start') {
                $telegram->sendMessage([
                    'chat_id'   => $chat_id,
                    'text' => 'anda berhasil masuk'
                ]);
                $telegram->sendMessage([
                    'chat_id'   => $chat_id,
                    'text' => 'silahkan masukan angka 1 - 10'
                ]);
                if ($text == 1) {
                    $telegram->sendMessage([
                        'chat_id'   => $chat_id,
                        'text' => 'saya ganteng'
                    ]);
                }
            }else{
                $telegram->sendMessage([
                    'chat_id'   => $chat_id,
                    'text' => 'start dulu'
                ]);
            }
        }else{
            $telegram->sendMessage([
                'chat_id'   => env('CHAT_BOT_GROUP'),
                'text'      => 'gagal'
            ]);
        }
    }
}
