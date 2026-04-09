<?php

namespace App\Http\Controllers\contas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\contasModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class pagamentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index22()
    {
        $contas = contasModel::where('vencimento', '>=', '2022-01-01')
            ->where('vencimento', '<=', '2022-12-31')
            ->orderBy('paga', 'asc')
            ->orderBy('vencimento', 'asc')
            ->paginate(35);
        $pendentes = contasModel::where('paga', 0)
            ->where('vencimento', '>=', '2022-01-01')
            ->where('vencimento', '<=', '2022-12-31')
            ->sum('valor');
        $pendentesCount = contasModel::where('paga', 0)
            ->where('vencimento', '>=', '2022-01-01')
            ->where('vencimento', '<=', '2022-12-31')
            ->count();

        return view('painel.pagamentos.index', [
            'contas' => $contas,
            'pendentes' => $pendentes,
            'pendentesCount' => $pendentesCount
        ]);
    }

    public function index23()
    {
        $contas = contasModel::where('vencimento', '>=', '2026-01-01')
            ->orderBy('paga', 'asc')
            ->orderBy('vencimento', 'asc')
            ->paginate(35);

        $pendentes = contasModel::where('paga', 0)
            ->where('vencimento', '<', Carbon::today())
            ->sum('valor');
        $pendentesCount = contasModel::where('paga', 0)
            ->where('vencimento', '<', Carbon::today())
            ->count();

        $noprazo = contasModel::where('paga', 0)
            ->where('vencimento', '>=', Carbon::today())
            ->sum('valor');
        $noprazoCount = contasModel::where('paga', 0)
            ->where('vencimento', '>=', Carbon::today())
            ->count();

        return view('painel.pagamentos.index', [
            'contas' => $contas,
            'pendentes' => $pendentes,
            'pendentesCount' => $pendentesCount,
            'noprazo' => $noprazo,
            'noprazoCount' => $noprazoCount,
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
            try {
                $timestamp = \Carbon\Carbon::now()->format('YmdHis');
                $filename = $timestamp . '_' . $request->file('boleto')->getClientOriginalName();
                Storage::disk('s3')->putFileAs('uploads', $request->file('boleto'), $filename);
            } catch (\Throwable $th) {
                toastr()->error("Erro ao tentar salvar seu arquivo, por gentileza tente novamente", 'Ops!');
            }

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
            return redirect()->route('pagamentos23')->with('warning', 'Conta deletada com sucesso!');
        } else {
            return redirect()->route('pagamentos23')->with('error', 'Conta não encontrada!');
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
            return redirect()->route('pagamentos23')->with('success', 'Conta atualizada com sucesso!');
        } else {
            return back()->with('error', 'Conta não encontrada!');
        }
    }

    public function downloadFile($filename)
    {
        try {
            return Storage::disk('s3')->response('uploads/' . $filename);
        } catch (\Throwable $th) {
            return redirect()->route('pagamentos23')->with('error', 'Não há boleto anexado para esta conta.');
        }
    }

    public function accountFilter(Request $request)
    {
        $dateInit = $request->dateinit ?: null;
        $dateEnd = $request->dateend ?: null;

        $query = DB::table('contas');

        if ($request->conta) {
            $query->where('nomeconta', 'like', '%' . $request->conta . '%');
        }

        if ($request->status) {
            switch ($request->status) {
                case 'pago':
                    $query->where('paga', 1);
                    break;
                case 'nao_pago':
                    $query->where('paga', 0);
                    break;
                case 'em_atraso':
                    $query->where('paga', 0)->where('vencimento', '<', Carbon::today());
                    break;
                case 'no_prazo':
                    $query->where('paga', 0)->where('vencimento', '>', Carbon::today());
                    break;
                case 'vence_hoje':
                    $query->where('paga', 0)->where('vencimento', Carbon::today());
                    break;
                default:
                    if ($request->status === '1' || $request->status === 1) {
                        $query->where('paga', 1);
                    } elseif ($request->status === '0' || $request->status === 0) {
                        $query->where('paga', 0);
                    }
                    break;
            }
        }

        if ($dateInit && $dateEnd) {
            $query->whereBetween('vencimento', [$dateInit, $dateEnd]);
        } elseif ($dateInit) {
            $query->where('vencimento', '>=', $dateInit);
        } elseif ($dateEnd) {
            $query->where('vencimento', '<=', $dateEnd);
        }

        $contas = $query->orderBy('paga', 'asc')->orderBy('vencimento', 'asc')->get();

        return view('painel.pagamentos.busca', [
            'contas' => $contas,
        ]);
    }
}
