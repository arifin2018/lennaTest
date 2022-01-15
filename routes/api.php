<?php

use Illuminate\Http\Request;
use Telegram\Bot\Traits\Telegram;
use App\Http\Controllers\TelegramBot;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('5025800924:AAG6ghT_u5HOqtghJaLcaODTOPn0RjP8rWk/webhook', [TelegramBot::class, 'testing']);
Route::post('send-message', [TelegramBot::class, 'index']);

// Route::post('5025800924:AAG6ghT_u5HOqtghJaLcaODTOPn0RjP8rWk/webhook', function () {
//     Telegram::getWebhookUpdates();

//     return 'ok';
// });
// Route::post('test/webhook', function () { $update = Telegram::commandsHandler(true); return 'salam in revale'; });
