<?php

namespace App\Http\Controllers\contas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\contasModel;
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
            $path = $request->file('boleto')->store('public/uploads');
            $caminhoArquivo = Storage::url($path);
            $filename = explode("/", $caminhoArquivo)[3];
          }else{
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
        if($conta){
            $conta->delete();
            return back()->with('warning', 'Conta deletada com sucesso!');
        }else{
            return back()->with('error', 'Conta não encontrada!');
        }
    }

    public function search($id){
        return contasModel::find($id);
    }

    public function update(Request $request){
        $data = $request->only("id", "nomeconta", "vencimento", "valor", "observacao");
        $conta = contasModel::find($data['id']);
        if($conta){
            $contaArray = $conta->toArray();
            $contaArray = array_replace($contaArray, $data);
            $conta->update($contaArray);
            return back()->with('success', 'Conta atualizada com sucesso!');
        }else{
            return back()->with('error', 'Conta não encontrada!');
        }
    }

    public function downloadFile($filename){
        $path = storage_path('app/public/uploads/' . $filename);
        if (!File::exists($path)) {
            return redirect()->route('recebimentos')->with('error', 'Não há boleto anexado para esta conta.');
        }
        return response()->download($path);
    }

}
