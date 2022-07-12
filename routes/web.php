<?php

use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\PagamentoOnibusController;
use App\Mail\COLEmail;
use App\Models\Inscricao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $onibus = Inscricao::where('federacao', '!=', 'FMRR')->where('onibus', true)->get()->count();
    return view('site.index', [
        'onibus' => $onibus
    ]);
})->name('site.index');

Auth::routes();

Route::post('/inscricao', [InscricaoController::class, 'store'])->name('inscricao.store');
Route::get('/acompanhamento/{inscricao}', [InscricaoController::class, 'acompanhamento'])->name('inscricao.acompanhamento');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    Route::resource('/inscritos', InscricaoController::class)->names('inscritos')->except(['show', 'destroy']);
    Route::get('inscritos/{inscrito}/delete', [InscricaoController::class, 'delete'])->name('inscritos.delete');
    Route::get('inscritos/{inscrito}/onibus', [InscricaoController::class, 'onibus'])->name('inscritos.onibus');
    Route::get('inscritos/{inscrito}/status', [InscricaoController::class, 'status'])->name('inscritos.status');

    Route::get('inscritos/{inscrito}/pagamentos', [PagamentoController::class, 'index'])->name('inscritos.pagamentos.index');
    Route::get('inscritos/{inscrito}/pagamentos/create', [PagamentoController::class, 'create'])->name('inscritos.pagamentos.create');
    Route::get('inscritos/{inscrito}/pagamentos/{pagamento}/status', [PagamentoController::class, 'status'])->name('inscritos.pagamentos.status');
    Route::get('inscritos/{inscrito}/pagamentos/{pagamento}/edit', [PagamentoController::class, 'edit'])->name('inscritos.pagamentos.edit');
    Route::put('inscritos/{inscrito}/pagamentos/{pagamento}/update', [PagamentoController::class, 'update'])->name('inscritos.pagamentos.update');
    Route::get('inscritos/{inscrito}/pagamentos/{pagamento}/delete', [PagamentoController::class, 'delete'])->name('inscritos.pagamentos.delete');
    Route::post('inscritos/{inscrito}/pagamentos/store', [PagamentoController::class, 'store'])->name('inscritos.pagamentos.store');

    Route::get('inscritos/{inscrito}/onibus', [PagamentoOnibusController::class, 'index'])->name('inscritos.onibus.index');
    Route::get('inscritos/{inscrito}/onibus/create', [PagamentoOnibusController::class, 'create'])->name('inscritos.onibus.create');
    Route::get('inscritos/{inscrito}/onibus/{pagamento}/delete', [PagamentoOnibusController::class, 'delete'])->name('inscritos.onibus.delete');
    Route::post('inscritos/{inscrito}/onibus/store', [PagamentoOnibusController::class, 'store'])->name('inscritos.onibus.store');
});