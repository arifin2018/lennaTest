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
}
