<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\loginController;
use App\Http\Controllers\contas\pagamentosController;
use App\Http\Controllers\contas\recebimentosController;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/pagina-inicial', function(){
        return view('painel.dashboard');
    })->name('dashboard');

    Route::get('/pagamentos', [pagamentosController:: class, 'index'])->name('pagamentos');
    Route::get('/recebimentos', [recebimentosController:: class, 'index'])->name('recebimentos');


    Route::get('pdf', function(){
        return view('diarios.pdf');
    });
});
