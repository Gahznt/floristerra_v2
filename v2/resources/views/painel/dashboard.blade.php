@extends('template.main')

@section('title')
Floristerra - Página Inicial
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="ti-face-sad bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Em atraso</span>
                    <h4>{{$atrasadas}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-pink f-16 icofont icofont-calendar m-r-10"></i>Contas atrasadas
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="ti-time bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Vence Hoje</span>
                    <h4>{{$venchoje}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-yellow f-16 icofont icofont-calendar m-r-10"></i>Contas que vencem hoje!
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="ti-time bg-c-blue card1-icon"></i>
                    <span class="text-c-blue f-w-600">No Prazo</span>
                    <h4>{{$noprazo}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-blue f-16 icofont icofont-calendar m-r-10"></i>Contas no prazo
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="ti-face-smile bg-c-green card1-icon"></i>
                    <span class="text-c-green f-w-600">Pago</span>
                    <h4>{{$pagas}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-green f-16 icofont icofont-calendar m-r-10"></i>Contas pagas
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="icofont icofont icofont icofont-file-document bg-c-green"></i>
                    <div class="d-inline">
                        <h4>Olá, bem vindo de volta!</h4>
                        <span>Sistema floristerra versão 2</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="#">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Página Inicial</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
