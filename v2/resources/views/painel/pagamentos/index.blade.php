@extends('template.main')
@section('title')
Floristerra - Pagamentos
@endsection
@section('content')
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="icofont icofont-table bg-c-blue"></i>
                <div class="d-inline">
                    <h4>Pagamentos</h4>
                    <span>contas à pagar</span>
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
                    <li class="breadcrumb-item">Pagamentos
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5>Lista de pagamentos</h5>
        <button class="btn btn-grd-success btn-sm" id="myBtn"><b>+ Adicionar</b></button>
        <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li><i class="icofont icofont-simple-left "></i></li>
                <li><i class="icofont icofont-maximize full-card"></i></li>
                <li><i class="icofont icofont-minus minimize-card"></i></li>
            </ul>
        </div>
    </div>
    <div class="card-block table-border-style">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Conta</th>
                        <th>Vencimento</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contas as $conta)
                    <tr >
                        <th scope="row">{{$conta['id']}}</th>
                        <td>{{$conta['nomeconta']}}</td>
                        <td>{{date('d/m/Y', strtotime($conta['vencimento']))}}</td>
                        <td>R$ {{number_format($conta['valor'], 2, ',', '.')}}</td>
                        @if ($conta->vencimento < date('Y-m-d') AND $conta->paga == 0)
                            <td class="text-danger"><b>Em atraso</b></td>
                            @elseif ($conta->vencimento > date('Y-m-d') AND $conta->paga == 1)
                            <td><b>Finalizado</b></td>
                            @elseif ($conta->vencimento > date('Y-m-d') AND $conta->paga == 0)
                            <td class="text-success"><b>No prazo</b></td>
                            @elseif ($conta->vencimento = date('Y-m-d') AND $conta->paga == 0)
                            <td class="text-warning"><b>Vence hoje</b></td>
                            @elseif ($conta->vencimento < date('Y-m-d') AND $conta->paga == 1)
                                <td><b>Finalizado</b></td>
                                @elseif ($conta->vencimento == date('Y-m-d') AND $conta->paga == 1)
                                <td><b>Finalizado</b></td>
                            @endif
                        <td><button class="btn btn-grd-info btn-skew btn-sm" id="btn"><b>Abrir</b></button></td>
                        <td><a class="btn btn-grd-danger btn-skew btn-sm"><b>Apagar</b></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade show" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px; background-color: rgba(0,0,0,0.4); /* Black w/ opacity */">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar novo Pagamento</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nome:</label>
                        <input type="text" name="nome" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Vencimento:</label>
                        <input type="date" name="vencimento" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Valor:</label>
                        <input type="number" name="valor" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Boleto:</label>
                        <input type="file" name="boleto" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Observação:</label>
                        <textarea class="form-control" name="observacao" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-skew">Criar</button>
                <button type="button" class="btn btn-danger btn-skew" id="close" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade show" id="modalEditar" tabindex="-1" role="dialog" style="display: none; padding-right: 17px; background-color: rgba(0,0,0,0.4); /* Black w/ opacity */">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar novo Pagamento</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nome:</label>
                        <input type="text" name="nome" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Vencimento:</label>
                        <input type="date" name="vencimento" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Valor:</label>
                        <input type="number" name="valor" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Boleto:</label>
                        <input type="file" name="boleto" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Comprovante:</label>
                        <input type="file" name="comprovante" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Observação:</label>
                        <textarea class="form-control" name="observacao" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-skew">Salvar</button>
                <button type="button" class="btn btn-danger btn-skew" id="closeEdit" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
    var modal = document.getElementById("modal");
    var btn = document.getElementById("myBtn");
    var close = document.getElementById("close");
    btn.onclick = function() {
        modal.style.display = "block";
    }
    close.onclick = function() {
        modal.style.display = "none";
    }
</script>
<script>
    var editar = document.getElementById("btn");
    var modalEditar = document.getElementById("modalEditar");
    var closeEdit = document.getElementById("closeEdit");
    editar.onclick = function() {
        console.log('click');
        modalEditar.style.display = "block";
    }
    closeEdit.onclick = function() {
        modalEditar.style.display = "none";
    }
</script>
@endsection