<?php

namespace App\Http\Controllers;

use App\DataTables\InscritosDataTable;
use App\Models\Inscricao;
use App\Services\EnviarEmailService;
use App\Services\EnviarMsgService;
use App\Services\TimelineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InscricaoController extends Controller
{

    public function index(InscritosDataTable $dataTable)
    {
        return $dataTable->render('admin.inscritos.index');
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
                'codigo' => md5($request->email)
            ]);
            EnviarEmailService::inscricaoRecebida($inscricao);
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