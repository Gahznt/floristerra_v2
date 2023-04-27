<?php

namespace App\Http\Controllers\contas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\contasModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class pagamentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contas = contasModel::orderBy('paga', 'asc')->orderBy('vencimento', 'asc')->paginate(20);
        $pendentes = contasModel::where('paga', 0)->sum('valor');
        $pagas = contasModel::where('paga', 1)->sum('valor');

        return view('painel.pagamentos.index', [
            'contas' => $contas,
            'pendentes' => $pendentes,
            'pagas' => $pagas
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'nome' => ['required', 'string'],
            'vencimento' => ['required', 'date'],
            'valor' => ['required', function ($attribute, $value, $fail) {
                if (!is_numeric($value) && !is_string($value)) {
                    $fail($attribute . ' deve ser um número ou uma string numérica.');
                }
            }],
        ];
        $data = $request->only(['nome', 'vencimento', 'valor', 'observacao', 'boleto']);
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                toastr()->error($message, 'Ops!');
            }

            return back()->withErrors($validator);
        }

        if ($request->hasFile('boleto')) {
            $timestamp = \Carbon\Carbon::now()->format('YmdHis');
            $filename = $timestamp . '_' . $request->file('boleto')->getClientOriginalName();
            $path = Storage::disk('s3')->putFileAs('uploads', $request->file('boleto'), $filename);
        } else {
            $filename = null;
        }

        $conta = new contasModel();
        $conta->nomeconta = $data['nome'];
        $conta->vencimento = $data['vencimento'];
        $conta->valor = $data['valor'];
        $conta->boleto = $filename;
        $conta->observacao = $data['observacao'];
        $conta->save();

        return back()->with('success', 'Conta criada com sucesso!');
    }

    public function delete($id)
    {
        $conta = contasModel::find($id);
        if ($conta) {
            $conta->delete();
            return redirect()->route('pagamentos')->with('warning', 'Conta deletada com sucesso!');
        } else {
            return redirect()->route('pagamentos')->with('error', 'Conta não encontrada!');
        }
    }

    public function search($id)
    {
        return contasModel::find($id);
    }

    public function update(Request $request)
    {
        $data = $request->only("id", "nomeconta", "vencimento", "valor", "observacao", "paga", "comprovante");
        $conta = contasModel::find($data['id']);

        if ($request->hasFile('comprovante')) {
            $timestamp = \Carbon\Carbon::now()->format('YmdHis');
            $filename = $timestamp . '_' . $request->file('comprovante')->getClientOriginalName();
            $path = Storage::disk('s3')->putFileAs('uploads', $request->file('comprovante'), $filename);
        } else {
            $filename = null;
        }
        if ($conta) {
            $conta->comprovante = $filename;
            $contaArray = $conta->toArray();
            $contaArray = array_replace($contaArray, $data);
            $conta->update($contaArray);
            return redirect()->route('pagamentos')->with('success', 'Conta atualizada com sucesso!');
        } else {
            return back()->with('error', 'Conta não encontrada!');
        }
    }

    public function downloadFile($filename)
    {
        try {
            return Storage::disk('s3')->response('uploads/' . $filename);
        } catch (\Throwable $th) {
            return redirect()->route('pagamentos')->with('error', 'Não há boleto anexado para esta conta.');
        }
    }

    public function accountFilter(Request $request)
    {
        if ($request->conta) {
            $contas = DB::table('contas')
                ->where('nomeconta', 'like', '%' . $request->conta . '%')->paginate(20);

            return view('painel.pagamentos.busca', [
                'contas' => $contas,
            ]);
        }
    }
}
