<?php

namespace App\Http\Controllers\contas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\contasModel;
use App\Models\recebimentosModel;
use Illuminate\Support\Facades\Validator;

class recebimentosController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contas = recebimentosModel::orderBy('status_pagamento', 'asc')->orderBy('created_at', 'asc')->paginate(20);
        $recebidos = recebimentosModel::where('status_pagamento', 1)->count();
        $pendentes = recebimentosModel::where('status_pagamento', 0)->count();
        return view('painel.recebimentos.index', [
            "contas" => $contas,
            "recebidos" => $recebidos,
            "pendentes" => $pendentes
        ]);
    }

    public function search($id)
    {
        return recebimentosModel::find($id);
    }

    public function store(Request $request)
    {
        $rules = [
            'pagador' => ['required', 'string'],
            'valor' => ['required', function ($attribute, $value, $fail) {
                if (!is_numeric($value) && !is_string($value)) {
                    $fail($attribute . ' deve ser um número ou uma string numérica.');
                }
            }],
            'descricao' => ['required', 'string']
        ];

        $data = $request->only(['pagador', 'valor', 'descricao']);
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                toastr()->error($message, 'Ops!');
            }

            return back()->withErrors($validator);
        }
        $conta = new recebimentosModel();
        $conta->pagador = $data['pagador'];
        $conta->valor = $data['valor'];
        $conta->desc = $data['descricao'];
        $conta->save();

        return back()->with('success', 'Novo recebimento criado com sucesso!');
    }

    public function delete($id)
    {
        $conta = recebimentosModel::find($id);
        if ($conta) {
            $conta->delete();
            return back()->with('warning', 'Recebimento deletado com sucesso!');
        } else {
            return back()->with('error', 'Recebimento não encontrado!');
        }
    }

    public function update(Request $request)
    {
        $data = $request->only(["id", "pagador", "valor", "desc", "status_pagamento"]);
        $conta = recebimentosModel::find($data['id']);
        if($conta){
            $contaArray = $conta->toArray();
            $contaArray = array_replace($contaArray, $data);
            $conta->update($contaArray);
            return back()->with('success', 'Recebimento atualizado com sucesso!');
        }
        return back()->with('danger', 'Recebimento não encontrado!');
    }
}
