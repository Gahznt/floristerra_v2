<?php

namespace App\Http\Controllers\contas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class recebimentosController extends Controller
{
    public function index(){
        return view('painel.recebimentos.index');
    }
}
