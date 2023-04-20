<?php

namespace App\Http\Controllers;

use App\Models\contasModel;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $hoje = date('Y-m-d');
        $atrasadas = contasModel::where('vencimento', '<', $hoje)->where('paga', '=', "'0'")->count();
        $noprazo = contasModel::where('vencimento', '>=', $hoje)->where('paga', '=', "'0'")->count();
        $venchoje = contasModel::where('vencimento', '=', $hoje)->where('paga', '=', "'0'")->count();
        $pagas = contasModel::where('paga', '=', '1')->count();

        return view('painel.dashboard', [
            'atrasadas' => $atrasadas,
            'noprazo' => $noprazo,
            'venchoje' => $venchoje,
            'pagas' => $pagas
        ]);
    }
}
