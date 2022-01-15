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
        $updates = $telegram->getWebhookUpdate();

        if(isset($updates['messages'])){
            $text = $updates['messages']['text'];
            $chat_id = $updates['messages']['id'];
            $telegram->sendMessage([
                'chat_id'   => $chat_id,
                'text'      => $text
            ]);
        }else{
            $telegram->sendMessage([
                'chat_id'   => env('CHAT_BOT_GROUP'),
                'text'      => 'gagal'
            ]);
        }
    }
}
