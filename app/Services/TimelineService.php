<?php

namespace App\Services;

use App\Mail\COLEmail;
use App\Models\Inscricao;
use App\Models\Pagamento;
use App\Models\PagamentoOnibus;
use App\Models\Timeline;
use Exception;
use Illuminate\Support\Facades\Mail;

class TimelineService
{

    public static function inscrito(Inscricao $inscricao)
    {
        try {
            Timeline::create([
                'inscricao_id' => $inscricao->id,
                'texto' => 'Inscrição Realizada'
            ]);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());            
        }
    }
    public static function pagamentoRecebido(Pagamento $pagamento)
    {
        try {
            Timeline::create([
                'inscricao_id' => $pagamento->inscricao->id,
                'texto' => 'Pagamento de R$' . $pagamento->valor . ' recebido'
            ]);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());            
        }
    }

    public static function aguardandoPagamento(Pagamento $pagamento)
    {
        try {
            Timeline::create([
                'inscricao_id' => $pagamento->inscricao->id,
                'texto' => 'Aguardando pagamento de R$' . $pagamento->valor
            ]);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());            
        }
    }

    public static function pagamentoRecebidoOnibus(PagamentoOnibus $pagamento)
    {
        try {
            Timeline::create([
                'inscricao_id' => $pagamento->inscricao->id,
                'texto' => 'Pagamento de R$' . $pagamento->valor . ' referente ao ônibus recebido'
            ]);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());            
        }
    }

    public static function aguardandoPagamentoOnbius(PagamentoOnibus $pagamento)
    {
        try {
            Timeline::create([
                'inscricao_id' => $pagamento->inscricao->id,
                'texto' => 'Aguardando pagamento de R$' . $pagamento->valor . ' referente ao ônibus'
            ]);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());            
        }
    }


}