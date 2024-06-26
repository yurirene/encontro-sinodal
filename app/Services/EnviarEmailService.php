<?php

namespace App\Services;

use App\Mail\COLEmail;
use App\Models\Inscricao;
use App\Models\Pagamento;
use App\Models\PagamentoOnibus;
use Illuminate\Support\Facades\Mail;

class EnviarEmailService
{

    public static function inscricaoRecebida(Inscricao $inscricao)
    {
        $mensagem = "Olá, {$inscricao->nome}. Inscrição para o ENCONTRO SINODAL recebida. Efetue o pagamento para a confirmação.";
        return EnviarMsgService::sendSMS($inscricao, $mensagem);
        // return Mail::to($inscricao->email)->send(new COLEmail($inscricao, $mensagem, 'Inscrição Recebida'));
    }

    public static function pagamentoRecebido(Pagamento $pagamento)
    {
        $mensagem = "Recebemos seu pagamento no valor de R$ {$pagamento->valor}";
        return EnviarMsgService::sendSMS($pagamento->inscricao, $mensagem);
        // return Mail::to($pagamento->inscricao->email)->send(new COLEmail($pagamento->inscricao, $mensagem, 'Pagamento Recebido'));
    }


    public static function aguardandoPagamento(Pagamento $pagamento)
    {
        $mensagem = "Estamos aguardando seu pagamento no valor de R$ {$pagamento->valor}";
        return EnviarMsgService::sendSMS($pagamento->inscricao, $mensagem);
        // return Mail::to($pagamento->inscricao->email)->send(new COLEmail($pagamento->inscricao, $mensagem, 'Aguardando Pagamento'));
    }

    public static function pagamentoOnibusRecebido(PagamentoOnibus $pagamento)
    {
        $mensagem = "Recebemos seu pagamento no valor de R$ {$pagamento->valor} referente ao ônibus";
        return EnviarMsgService::sendSMS($pagamento->inscricao, $mensagem);
        // return Mail::to($pagamento->inscricao->email)->send(new COLEmail($pagamento->inscricao, $mensagem, 'Pagamento do Ônibus Recebido'));
    }


    public static function aguardandoPagamentoOnibus(PagamentoOnibus $pagamento)
    {
        $mensagem = "Estamos aguardando seu pagamento no valor de R$ {$pagamento->valor} referente ao ônibus";
        return EnviarMsgService::sendSMS($pagamento->inscricao, $mensagem);
        // return Mail::to($pagamento->inscricao->email)->send(new COLEmail($pagamento->inscricao, $mensagem, 'Aguardando Pagamento do Ônibus'));
    }

    public static function confirmarInscricao(Inscricao $inscricao)
    {
        $mensagem = "Sua inscrição foi confirmada. Estamos ansiosos para desfrutarmos desse momento ímpar junto com você. Nos vemos lá!";
        return EnviarMsgService::sendSMS($inscricao, $mensagem);
        // return Mail::to($inscricao->email)->send(new COLEmail($inscricao, $mensagem, 'Inscrição Recebida'));
    }




}
