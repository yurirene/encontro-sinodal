<?php

namespace App\Http\Controllers;

use App\Services\EnviarMsgService;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{

    public static function process($request)
    {

        if (!$request['message']) {
            return;
        }

        $message = $request['message'];
        $message_id = $message['message_id'];
        $chat_id = $message['chat']['id'];

        if (!isset($message['text'])) {
            return;
        }

        $function = self::decode($message);

        $parameters = [
            'chat_id' => $chat_id, 
            "text" => self::$$function()
        ];

        self::sendMessage($parameters);

    }

    public static function sendMessage($parameters) 
    {
        $options = array(
            'http' => array(
            'method'  => 'POST',
            'content' => json_encode($parameters),
            'header'=>  "Content-Type: application/json\r\n" .
                        "Accept: application/json\r\n"
            )
        );
        
        $context  = stream_context_create( $options );
        file_get_contents('https://api.telegram.org/bot'. config('app.telegram_token')  .'/sendMessage', false, $context );
    }

    public static function decode($message)
    {
        return 'comando';
        $functions = [
            '/' => 'comando'
        ];
    }

    public static function comando()
    {
        return 'Executou um comando';
    }
}
