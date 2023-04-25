@extends('template.main')
@section('title')
Floristerra - Diário de Obra
@endsection
@section('content')
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont-file-code bg-c-blue"></i>
                <div class="d-inline">
                    <h4>Diário de Obra</h4>
                    <span>Emissão de diário</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Página inicial</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-right">
                        <i class="icofont icofont-spinner-alt-5"></i>
                    </div>
                    <div class="card-block">
                        <h4 class="sub-title">Formulário</h4>
                        <form action="" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Obra</label>
                                <div class="col-sm-10">
                                    <input type="text" name="obra" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Local</label>
                                <div class="col-sm-10">
                                    <input type="text" name="local" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Contratante</label>
                                <div class="col-sm-10">
                                    <input type="text" name="contratante" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Contato</label>
                                <div class="col-sm-10">
                                    <input type="text" name="contratado" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Prazo Contratual</label>
                                <div class="col-sm-10">
                                    <input type="text" name="prazo_contratual"class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Prazo Decorrido</label>
                                <div class="col-sm-10">
                                    <input type="text" name="prazo_decorrido" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Condição Climática (Manhã)</label>
                                <div class="col-sm-10">
                                    <input type="text" name="condicao_climatica_manha" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Praticável? (Manhã)</label>
                                <div class="col-sm-10">
                                    <select name="praticavel_manha" class="form-control">
                                        <option value="1">Praticável</option>
                                        <option value="0">Não Praticável</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Condição Climática (Tarde)</label>
                                <div class="col-sm-10">
                                    <input type="text" name="condicao_climatica_tarde" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Praticável? (Tarde)</label>
                                <div class="col-sm-10">
                                    <select name="praticavel_tarde" class="form-control">
                                        <option value="1">Praticável</option>
                                        <option value="0">Não Praticável</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mão de obra (qtd. funcionários)</label>
                                <div class="col-sm-10">
                                    <input type="number" name="qtd_funcionarios" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Equipamentos</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="equipamentos" rows="10"> </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Detalhes das atividades</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="detalhes_atividades" rows="10"> </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Anexo de imagens</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" multiple>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection