<?php

namespace App\Services;

use App\Models\Inscricao;
use TelegramBot\Api\BotApi;


class EnviarMsgService
{
    
    /**
     * Método Responsável poor enviar a mensagem
     * @param string $message
     * @return boolean
     */
    public static function sendMessage($message)
    {
        $obBotApi = new BotApi(config('app.telegram_token'));
        return $obBotApi->sendMessage(config('app.telegram_chat_id'), $message);
    }

    public static function novaInscricao(Inscricao $inscricao)
    {
        $mensagem = '';
        $mensagem .= 'Nova Inscrição' . PHP_EOL . PHP_EOL;
        $mensagem .= 'Nome: ' . $inscricao->nome . PHP_EOL;
        $mensagem .= 'Celular: ' . $inscricao->celular . PHP_EOL;
        $mensagem .= 'Federação: ' . $inscricao->federacao . PHP_EOL; 
        $mensagem .= 'Igreja: ' . $inscricao->igreja . PHP_EOL; 
        $mensagem .= 'Pagamento: ' . $inscricao->tipo_pagamento . PHP_EOL;
        if ($inscricao->tipo_pagamento != 'PIX') {
            $mensagem .= 'Parcelas: ' . $inscricao->quantidade_parcelas . PHP_EOL; 
        }
        $mensagem .= 'Ônibus: ' . ($inscricao->onibus==1 ? 'Sim' : 'Não') . PHP_EOL;
        
        self::sendMessage($mensagem);

    }
    
}