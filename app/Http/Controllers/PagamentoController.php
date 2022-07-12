<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;
use App\Models\Pagamento;
use App\Services\EnviarEmailService;
use App\Services\TimelineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PagamentoController extends Controller
{
    public function index(Inscricao $inscrito)
    {
        $pagamentos = $inscrito->pagamentos;
        return view('admin.pagamentos.index', [
            'pagamentos' => $pagamentos,
            'inscrito' => $inscrito
        ]);
    }

    public function create(Inscricao $inscrito)
    {
        return view('admin.pagamentos.form', [
            'inscrito' => $inscrito
        ]);
    }

    public function store(Inscricao $inscrito, Request $request)
    {
        DB::beginTransaction();
        try {

            $pagamento = Pagamento::create([
                'inscricao_id' => $inscrito->id,
                'valor' => $request->valor,
                'status' => $request->status == 'PAGO' ? true : false
            ]);
            
            $inscrito->update([
                'status' => 1
            ]);
            
            if ($request->status == 'PAGO') {
                EnviarEmailService::pagamentoRecebido($pagamento);
                TimelineService::pagamentoRecebido($pagamento);
            } else {
                EnviarEmailService::aguardandoPagamento($pagamento);
                TimelineService::aguardandoPagamento($pagamento);
            }
            
            DB::commit();
            
            return redirect()->route('inscritos.pagamentos.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error([
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine()
            ]);
            return redirect()->route('inscritos.pagamentos.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }

    public function delete(Inscricao $inscrito, Pagamento $pagamento)
    {
        try {
            $pagamento->delete();
            return redirect()->route('inscritos.pagamentos.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            
            return redirect()->route('inscritos.pagamentos.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }


    public function edit(Inscricao $inscrito, Pagamento $pagamento)
    {
        return view('admin.pagamentos.form', [
            'inscrito' => $inscrito,
            'pagamento' => $pagamento
        ]);
    }

    public function update(Inscricao $inscrito, Pagamento $pagamento, array $request)
    {

        try {
            $pagamento->update(
                [
                    'valor' => $request['valor']
                ]
            );
            if ($pagamento->status == true) {
                EnviarEmailService::pagamentoRecebido($pagamento);
                TimelineService::pagamentoRecebido($pagamento);
            }
            return redirect()->route('inscritos.pagamentos.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            
            return redirect()->route('inscritos.pagamentos.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }

    public function status(Inscricao $inscrito, Pagamento $pagamento)
    {

        try {
            $pagamento->update(
                [
                    'status' => !$pagamento->status
                ]
            );
            if ($pagamento->status == true) {
                EnviarEmailService::pagamentoRecebido($pagamento);
                TimelineService::pagamentoRecebido($pagamento);
            }
            return redirect()->route('inscritos.pagamentos.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            
            return redirect()->route('inscritos.pagamentos.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }
}
