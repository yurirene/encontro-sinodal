<?php

use App\Http\Controllers\InscricaoController;
use App\Mail\COLEmail;
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
    return view('site.index');
})->name('site.index');

Auth::routes();

Route::post('/inscricao', [InscricaoController::class, 'store'])->name('inscricao.store');
Route::get('email', function() {
    return ;
});

Route::group(['middlware' => 'auth', 'prefix' => 'admin'], function() {
    Route::resource('/inscritos', InscricaoController::class)->names('inscritos')->except(['show', 'destroy']);
    Route::get('inscritos/{inscrito}/delete', [InscricaoController::class, 'delete'])->name('inscritos.delete');
    Route::get('inscritos/{inscrito}/pagamentos', [InscricaoController::class, 'pagamentos'])->name('inscritos.pagamentos');
    Route::get('inscritos/{inscrito}/onibus', [InscricaoController::class, 'onibus'])->name('inscritos.onibus');
});