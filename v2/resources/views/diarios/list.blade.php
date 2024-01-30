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
                    <h4>Lista de Diário de Obras</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-block table-border-style">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>n° do relatório</th>
                        <th>Obra</th>
                        <th>Local</th>
                        <th>Data do relatório</th>
                        <th>Contratante</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($diarios as $diario)
                    <tr>
                        <td>{{$diario->id}}</td>
                        <td>{{$diario->obra}}</td>
                        <td>{{$diario->local}}</td>
                        <td>{{date('d/m/Y', strtotime($diario->created_at))}}</td>
                        <td>{{$diario->contratante}}</td>
                        <td><a href="{{ route('findDiario', ['id' => $diario->id]) }}" class="btn btn-grd-info btn-skew btn-sm" target="_blank">Abrir</a></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $diarios->links('pagination::simple-bootstrap-4') }}
        </div>
    </div>
</div>
@endsection