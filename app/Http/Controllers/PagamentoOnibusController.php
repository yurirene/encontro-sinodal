<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;
use App\Models\OnibusConfirmado;
use App\Models\PagamentoOnibus;
use App\Services\EnviarEmailService;
use App\Services\TimelineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PagamentoOnibusController extends Controller
{
    public function index(Inscricao $inscrito)
    {
        $pagamentos = $inscrito->pagamentoOnibus;
        return view('admin.onibus.index', [
            'pagamentos' => $pagamentos,
            'inscrito' => $inscrito
        ]);
    }

    public function create(Inscricao $inscrito)
    {
        return view('admin.onibus.form', [
            'inscrito' => $inscrito
        ]);
    }

    public function store(Inscricao $inscrito, Request $request)
    {
        DB::beginTransaction();
        try {

            $pagamento = PagamentoOnibus::create([
                'inscricao_id' => $inscrito->id,
                'valor' => $request->valor,
                'status' => $request->status == 'PAGO' ? true : false
            ]);
            
            $inscrito->update([
                'status' => 1
            ]);
            
            if ($request->status == 'PAGO') {
                EnviarEmailService::pagamentoOnibusRecebido($pagamento);
                TimelineService::pagamentoRecebidoOnibus($pagamento);
            } else {
                EnviarEmailService::aguardandoPagamentoOnibus($pagamento);
                TimelineService::aguardandoPagamentoOnibus($pagamento);
            }
            
            DB::commit();
            
            return redirect()->route('inscritos.onibus.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error([
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile()
            ]);
            return redirect()->route('inscritos.onibus.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }

    public function delete(Inscricao $inscrito, PagamentoOnibus $pagamento)
    {
        try {
            $pagamento->delete();
            return redirect()->route('inscritos.onibus.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            
            return redirect()->route('inscritos.onibus.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }

    public function status(Inscricao $inscrito, PagamentoOnibus $pagamento)
    {

        try {
            $pagamento->update(
                [
                    'status' => !$pagamento->status
                ]
            );
            if ($pagamento->status == true) {
                EnviarEmailService::pagamentoOnibusRecebido($pagamento);
                TimelineService::pagamentoRecebidoOnibus($pagamento);
            }
            return redirect()->route('inscritos.onibus.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            
            return redirect()->route('inscritos.onibus.index', ['inscrito' => $inscrito->id])->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }

    public function confirmacaoOnibus(Request $request)
    {
        try {
            OnibusConfirmado::updateOrCreate(
                [
                    'inscrito_id' => $request->inscrito_id
                ],[
                'inscrito_id' => $request->inscrito_id
            ]);
            return redirect()->route('inscritos.onibus.index', ['inscrito' => $request->inscrito_id])->with([
                'mensagem' => 'Operação Realizada com Sucesso',
                'status' => true
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('inscritos.onibus.index', ['inscrito' => $request->inscrito_id])->with([
                'mensagem' => 'Erro ao realizar operação',
                'status' => false
            ])->withInput();
        }
    }
}
