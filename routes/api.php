<?php

use App\Http\Controllers\ChatBotController;
use App\Services\EnviarMsgService;
use Illuminate\Http\Request;
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

Route::get('/chatbot', function() {
    $update_response = file_get_contents("php://input");

    $update = json_decode($update_response, true);
    $string = print_r($update, true);
    EnviarMsgService::sendMessage($string);
});
