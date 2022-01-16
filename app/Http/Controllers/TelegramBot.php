<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use App\Conversations\ExampleConversation;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Drivers\DriverManager;

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
         // Load the driver(s) you want to use
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

        $config = [
            // Your driver-specific configuration
            "telegram" => [
                "token" => env('TELEGRAM_BOT_TOKEN')
            ]
        ];

        $botman = BotManFactory::create($config, new LaravelCache());

        $botman->hears('/start|start|mulai', function (BotMan $bot) {
            $user = $bot->getUser();
            $bot->reply('Assalamualaikum '.$user->getFirstName().', Selamat datang di Hadits Telegram Bot!. ');
            $bot->startConversation(new ExampleConversation());
        })->stopsConversation();


        // $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        // // $updates = $telegram->setWebHook("https://tesbotlenna.herokuapp.com");
        // $updates = $telegram->getWebhookUpdate();
        // if(isset($updates['message'])){
        //     $text = $updates['message']['text'];
        //     $chat_id = $updates['message']['chat']['id'];

        //     if ($text == '/start') {
        //         $telegram->sendMessage([
        //             'chat_id'   => $chat_id,
        //             'text' => 'anda berhasil masuk'
        //         ]);
        //         $telegram->sendMessage([
        //             'chat_id'   => $chat_id,
        //             'text' => 'silahkan masukan angka 1 - 10'
        //         ]);
        //         if ($text == 1) {
        //             $telegram->sendMessage([
        //                 'chat_id'   => $chat_id,
        //                 'text' => 'saya ganteng'
        //             ]);
        //         }
        //     }else{
        //         $telegram->sendMessage([
        //             'chat_id'   => $chat_id,
        //             'text' => 'start dulu'
        //         ]);
        //     }
        // }else{
        //     $telegram->sendMessage([
        //         'chat_id'   => env('CHAT_BOT_GROUP'),
        //         'text'      => 'gagal'
        //     ]);
        // }
    }
}
