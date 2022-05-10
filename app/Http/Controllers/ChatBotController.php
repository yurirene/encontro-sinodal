<?php

namespace App\Http\Controllers;

use App\Services\EnviarMsgService;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    public function process(Request $request)
    {
        EnviarMsgService::sendMessage('Respondendo Solicitacao: '. implode(', ', $request->all()));
    }
}
