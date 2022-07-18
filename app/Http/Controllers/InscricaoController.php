<?php

namespace App\Http\Controllers;

use App\DataTables\InscritosDataTable;
use App\Models\Inscricao;
use App\Models\Pagamento;
use App\Models\PagamentoOnibus;
use App\Services\EnviarEmailService;
use App\Services\EnviarMsgService;
use App\Services\TimelineService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InscricaoController extends Controller
{

    public function index(InscritosDataTable $dataTable)
    {
        $total_pagamento = 0;
        Pagamento::where('status', 1)->get()->each(function($item) use (&$total_pagamento) {
            $total_pagamento += floatval(str_replace(',', '.', $item->valor));
        });
        $total_pagamento_onibus = 0;
        PagamentoOnibus::where('status', 1)->get()->each(function($item) use (&$total_pagamento_onibus) {
            $total_pagamento_onibus += floatval(str_replace(',', '.', $item->valor));
        });
        $totalizador = [
            'inscritos' => Inscricao::all()->count(),
            'inscritos_confirmados' => Inscricao::where('status', 2)->get()->count(),
            'total_recebido' => $total_pagamento,
            'total_onibus_recebido' => $total_pagamento_onibus
        ];
        return $dataTable->render('admin.inscritos.index', [
            'totalizador' => $totalizador
        ]);
    }

    public function edit(Inscricao $inscrito)
    {
        return view('admin.inscritos.form', [
            'inscrito' => $inscrito
        ]);
    }

    public function update(Inscricao $inscrito, Request $request)
    {
        try {
            $inscrito->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'celular' => $request->celular,
                'federacao' => $request->federacao,
                'igreja' => $request->igreja,
                'onibus' => $request->onibus == 'SIM',
                'tipo_pagamento' => $request->tipo_pagamento,
                'quantidade_parcelas' => $request->tipo_pagamento != 'PIX' ? $request->quantidade_parcelas : null,
                'codigo' => md5($request->email)
            ]);
            return redirect()->route('inscritos.index')->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }

    public function store(Request $request)
    {
        if (Inscricao::where('email', $request->email)->get()->isNotEmpty()){
            return redirect()->back()->withErrors('Este Email já foi utilizado');
        }
        DB::beginTransaction();
        try {
            $inscricao = Inscricao::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'celular' => $request->celular,
                'federacao' => $request->federacao,
                'igreja' => $request->igreja,
                'onibus' => $request->onibus == 'SIM',
                'tipo_pagamento' => $request->tipo_pagamento,
                'quantidade_parcelas' => $request->tipo_pagamento != 'PIX' ? $request->quantidade_parcelas : null,
                'codigo' => md5($request->email),
                'criancas' => $request->criancas,
                'cat1' => $request->cat1,
                'cat2' => $request->cat2,
                'cat3' => $request->cat3,
                'promocao' => $request->promocao ?? null
            ]);
            try{
                Log::info('Enviar Email para  '. $inscricao->email);
                EnviarEmailService::inscricaoRecebida($inscricao);
            }catch(Exception $e) {
                Log::error('Envio de e-mail de inscrição recebida : '.$inscricao->email);
            }
            TimelineService::inscrito($inscricao);
            EnviarMsgService::novaInscricao($inscricao);
            DB::commit();
            return redirect()->route('site.index')->with([
                'mensagem' => true,
                'nome_inscrito' => $inscricao->nome,
                'pagamento_inscrito' => $inscricao->tipo_pagamento . ($inscricao->tipo_pagamento != 'PIX' ? ' - ' . $inscricao->quantidade_parcelas : '')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return redirect()->route('site.index')->with('mensagem', false);
        }
    }

    public function delete(Inscricao $inscrito)
    {
        try {
            $inscrito->delete();
            return redirect()->route('inscritos.index')->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            
            return redirect()->route('inscritos.index')->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }

    public function status(Inscricao $inscrito)
    {
        try {
            $inscrito->update([
                'status' => 2
            ]);
            EnviarEmailService::confirmarInscricao($inscrito);
            return redirect()->back()->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            
            return redirect()->back()->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }

    public function acompanhamento($codigo)
    {
        $inscricao = Inscricao::with('timeline')->where('codigo', $codigo)->first();
        return view('site.acompanhamento', [
            'inscricao' => $inscricao
        ]);
    }
    
}
