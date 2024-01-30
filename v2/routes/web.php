<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\loginController;
use App\Http\Controllers\contas\pagamentosController;
use App\Http\Controllers\contas\recebimentosController;
use App\Http\Controllers\diarioController;
use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
    return view('home');
});
Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/loginpost', [loginController::class, 'authenticate'])->name('loginpost');

Route::middleware(['auth'])->group(function () {
    Route::get('/pagina-inicial', [homeController::class, 'index'])->name('dashboard');

    Route::get('/meu-perfil', [loginController::class, 'profile'])->name('profile');
    Route::post('/meu-perfil', [loginController::class, 'changePassword'])->name('profilePost');

    Route::get('/pagamentos22', [pagamentosController:: class, 'index22'])->name('pagamentos22');
    Route::get('/pagamentos23', [pagamentosController:: class, 'index23'])->name('pagamentos23');

    Route::post('/pagamentos', [pagamentosController::class, 'store'])->name('pagamentos_store');
    Route::post('/pagamentosUpdate', [pagamentosController::class, 'update'])->name('pagamentos_update');

    Route::get('/remover_pagamento/{id}', [pagamentosController::class, 'delete'])->name('remover_pagamento');
    Route::get('/pagamentos/{id}', [pagamentosController::class, 'search'])->name('search');
    Route::post('/filterPagamentos', [pagamentosController::class, 'accountFilter'])->name('accountFilter');

    Route::get('/recebimentos', [recebimentosController::class, 'index'])->name('recebimentos');
    Route::post('/recebimentos', [recebimentosController::class, 'store'])->name('recebimentos_store');
    Route::get('/recebimento/{id}', [recebimentosController::class, 'search'])->name('search-rec');
    Route::get('/remover_recebimento/{id}', [recebimentosController::class, 'delete'])->name('remover_recebimento');
    Route::post('/updaterec', [recebimentosController::class, 'update'])->name('updaterec');

    Route::get('/download/{filename}', [pagamentosController::class, 'downloadFile'])->name('download');

    Route::get('/emitir-diario', [diarioController::class, 'index'])->name('emitir-diario');
    Route::get('diario', [diarioController::class, 'list'])->name('diario');
    Route::post('/diario', [diarioController::class, 'create'])->name('diarioPost');
    Route::get('/diario/{id}', [diarioController::class, 'find'])->name('findDiario');
    Route::get('/delete/diario/{id}', [diarioController::class, 'delete'])->name('deleteDiario');

    Route::get('pdf', function(){
        return view('diarios.pdf');
    });

    Route::post('/logout', function(){
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});
