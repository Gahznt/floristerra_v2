@extends('template.main')
@section('title')
Floristerra - Meu Perfil
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont-table bg-c-blue"></i>
                <div class="d-inline">
                    <h4>Perfil de usuário</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard')}}">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Página Inicial</a>
                    </li>
                    <li class="breadcrumb-item">Meu Perfil
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="signup-card card-block auth-body mr-auto ml-auto">
    <form class="md-float-material"  action="{{route('profilePost')}}" method="POST">
        @csrf
        <div class="auth-box">
            <div class="row m-b-20">
                <div class="col-md-12">
                    <h3 class="text-center txt-primary">Alteração de senha</h3>
                </div>
            </div>
            <hr />
            <div class="input-group">
                <input type="password" class="form-control" name="new_password" placeholder="Sua nova senha">
                <span class="md-line"></span>
            </div>
            <div class="input-group">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirme a nova senha">
                <span class="md-line"></span>
            </div>
            <hr/>
            <div class="input-group">
                <input type="password" class="form-control" name="password" placeholder="Sua senha atual">
                <span class="md-line"></span>
            </div>
            <hr/>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Salvar</button>
                </div>
            </div>
            <hr/>
        </div>
    </form>
</div>

@endsection