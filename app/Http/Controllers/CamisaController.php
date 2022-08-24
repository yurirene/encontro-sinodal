<?php

namespace App\Http\Controllers;

use App\DataTables\CamisaDataTable;
use App\Models\Camisa;
use App\Services\EnviarMsgService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CamisaController extends Controller
{

    public function site()
    {
        return view('site.camisa');
    }


    public function index(CamisaDataTable $dataTable)
    {
        $total_confirmado = Camisa::where('status', 1)->get()->count();
        
        return $dataTable->render('admin.camisas.index', [
            'total_confirmado' => $total_confirmado,
        ]);
    }

    public function store(Request $request)
    {
        if (Camisa::where('celular', $request->celular)->get()->isNotEmpty()){
            return redirect()->back()->withErrors('Você já solicitou uma camisa');
        }
        DB::beginTransaction();
        try {
            $camisa = Camisa::create([
                'nome' => $request->nome,
                'celular' => $request->celular,
                'federacao' => $request->federacao,
                'igreja' => $request->igreja,
                'quantidade' => $request->quantidade,
                'tamanho' => $request->tamanho
            ]);
            EnviarMsgService::novaCamisa($camisa);
            DB::commit();
            return redirect()->route('site.camisa')->with([
                'mensagem' => true,
                'nome_inscrito' => $request->nome,
                'quantidade' => $request->quantidade
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return redirect()->route('site.camisa')->with('mensagem', false);
        }
    }

    public function delete(Camisa $inscrito)
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

    public function status(Camisa $camisa)
    {
        try {
            $camisa->update([
                'status' => !$camisa->status
            ]);
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

    
}
