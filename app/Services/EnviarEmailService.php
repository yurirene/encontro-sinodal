<?php

namespace App\Services;

use App\Mail\COLEmail;
use App\Models\Inscricao;
use Illuminate\Support\Facades\Mail;

class EnviarEmailService
{

    public static function inscricaoRecebida(Inscricao $inscricao)
    {
        $mensagem = 'Recebemos sua inscrição e estamos ansiosos para ver você no Encontro Sinodal de Mocidades Setentrional. Aguardamos seu pagamento para a confirmação da sua inscrição.';
        return Mail::to($inscricao->email)->send(new COLEmail($inscricao, $mensagem));
    }


}