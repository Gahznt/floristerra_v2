<?php

namespace App\Http\Controllers;

use App\Models\Diario;
use App\Models\DiarioUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class diarioController extends Controller
{
    public function index()
    {
        return view('diarios.index');
    }

    public function create(Request $request)
    {
        // dd($request->all());

        $diario = new Diario();
        $diario->obra = $request->obra;
        $diario->local = $request->local;
        $diario->contratante = $request->contratante;
        $diario->contratado = $request->contratado;
        $diario->prazo_contratual = $request->prazo_contratual;
        $diario->prazo_decorrido = $request->prazo_decorrido;
        $diario->condicao_climatica_manha = $request->condicao_climatica_manha;
        $diario->praticavel_manha = $request->praticavel_manha;
        $diario->condicao_climatica_tarde = $request->condicao_climatica_tarde;
        $diario->praticavel_tarde = $request->praticavel_tarde;
        $diario->qtd_funcionarios = $request->qtd_funcionarios;
        $diario->equipamentos = $request->equipamentos;
        $diario->detalhes_atividades = $request->detalhes_atividades;
        $diario->save();

        // Verifica se há fotos enviadas
        $fotos = $request->fotos;

        if (count($fotos) > 0) {
            // Lógica para processar e salvar as fotos no S3
            foreach ($fotos as $foto) {
                // Implemente a lógica de salvamento no S3 aqui
                $filename = "diario_" . \Carbon\Carbon::now()->format('YmdHis') . "." . $foto->extension();
                Storage::disk('s3')->putFileAs('diarios/diario_' . $diario->id, $foto, $filename);

                $url = Storage::disk('s3')->url('diarios/diario_' . $diario->id . "/" . $filename);

                $diarioUpload = new DiarioUploads();
                $diarioUpload->diario_id = $diario->id;
                $diarioUpload->file = $filename;
                $diarioUpload->url = $url;
                $diarioUpload->save();
            }
        }

        return back()->with('success', 'Cadastro de diário realizado');
    }

    public function find($id){
        $diario = Diario::where('id', $id)->with('diariosUploads')->first();

        return view('diarios.pdf', [
            "diario" => $diario
        ]);
    }

    public function delete($id){
        $diario = Diario::find($id);

        if($diario){
            $uploads = DiarioUploads::where('diario_id', $id)->get();
            if($uploads){
                foreach($uploads as $upload){
                    $upload->delete();
                }
            }
            $diario->delete();
        }

        return back()->with('success', 'Registro apagado com sucesso');
    }

    public function list(){
        $diarios = Diario::orderBy('created_at', 'desc')->with('diariosUploads')->paginate(10);

        return view('diarios.list', [
            "diarios" => $diarios
        ]);
    }
}