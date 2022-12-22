<?php

namespace App\Http\Controllers\contas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\contasModel;

class pagamentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $contas = contasModel::orderBy('paga', 'asc')->orderBy('vencimento', 'asc')->paginate(10);
        $pendentes = contasModel::where('paga', 0)->sum('valor');
        $pagas = contasModel::where('paga', 1)->sum('valor');

        return view('painel.pagamentos.index',[
            'contas' => $contas,
            'pendentes' => $pendentes,
            'pagas' => $pagas
        ]);
    }
}
