@extends('template.main')
@section('title')
Floristerra - Pagamentos
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="row justify-content-center">
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="ti-time bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Contas Pendentes</span>
                    <h4></h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-yellow f-16 icofont icofont-money m-r-10"></i>Contas que vencem hoje!
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="ti-face-smile bg-c-green card1-icon"></i>
                    <span class="text-c-green f-w-600">Contas Pagas</span>
                    <h4></h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-green f-16 icofont icofont-money m-r-10"></i>Contas pagas
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <label class="col-form-label">Filtrar conta</label>
        <form action="{{route('accountFilter')}}" method="post">
            @csrf
            <div class="input-group">
                <input type="text" name="conta" class="form-control mr-1" required placeholder="nome da conta">
                <div class="input-group-append">
                    <button class="btn btn-grd-primary btn-sm ml-1">Buscar</button>
                </div>
            </div>
        </form>
    </div>


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
                    <tr>
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
                                <td><button class="btn btn-grd-info btn-skew btn-sm" onclick="getData({{$conta->id}})"><b>Abrir</b></button></td>
                                <td><a href="{{route('remover_pagamento', $conta->id)}}" class="btn btn-grd-danger btn-skew btn-sm"><b>Apagar</b></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{ $contas->links('pagination::simple-bootstrap-4') }}
<div class="modal fade show" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; padding-right: 17px; background-color: rgba(0,0,0,0.4); /* Black w/ opacity */">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar novo pagamento</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('pagamentos_store')}}" enctype="multipart/form-data" method="POST" id="form">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nome:</label>
                        <input type="text" name="nome" required class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Vencimento:</label>
                        <input type="date" name="vencimento" required class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Valor:</label>
                        <input name="valor" required class="form-control" id="valorOne">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Boleto:</label>
                        <input type="file" name="boleto" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Observação:</label>
                        <textarea class="form-control" name="observacao" id="message-text"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-skew">Criar</button>
                <button type="button" class="btn btn-danger btn-skew" id="close" data-dismiss="modal">Fechar</button>
            </div>
            </form>
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
                <form action="{{route('pagamentos_update')}}" method="POST" id="form-edit" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" hidden>
                        <label for="recipient-name" class="col-form-label">ID:</label>
                        <input type="text" name="id" class="form-control" id="edit-id">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nome:</label>
                        <input type="text" name="nomeconta" class="form-control" id="edit-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Vencimento:</label>
                        <input type="date" name="vencimento" class="form-control" id="edit-vencimento">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Valor:</label>
                        <input name="valor" required class="form-control" id="edit-valor">
                    </div>
                    <input type="hidden" hidden id="fileName">
                    <div class="form-group">
                        <a class="btn btn-sm btn-primary text-light" onclick="downloadFile()" id="download-link" type="none"><i class="ti-wallet"></i>Download boleto</a>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" id="comprovante-label" class="col-form-label">Comprovante:</label>
                        <input type="file" name="comprovante" class="form-control" id="comprovante">
                    </div>
                    <label class="col-form-label mt-6">Pago:</label>
                    <div class="form-group">
                        <select class="form-control" name="paga" required>
                            <option id="option"></option>
                            <option id="secondOption"></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Observação:</label>
                        <textarea class="form-control" name="observacao" id="edit-observacao"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-primary btn-skew">Salvar</button> -->
                <button type="submit" class="btn btn-primary btn-skew">Salvar</button>
                <button type="button" class="btn btn-danger btn-skew" id="closeEdit" data-dismiss="modal">Fechar</button>
            </div>
            </form>
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

    function maskValue() {
        var valor = document.getElementById('valorOne');
        valor.addEventListener('input', function(e) {
            var valorFormatado = e.target.value.replace(/\D/g, '').replace(/(\d{2})$/, ',$1').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            e.target.value = 'R$ ' + valorFormatado;
        });
    }

    function maskValue2() {
        var valor = document.getElementById('edit-valor');
        valor.addEventListener('input', function(e) {
            var valorFormatado = e.target.value.replace(/\D/g, '').replace(/(\d{2})$/, ',$1').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            e.target.value = 'R$ ' + valorFormatado;
        });
    }
    window.onload = function() {
        maskValue();
        maskValue2();
    };

    // ## Transforma o valor do input em number e faz o envio do formulário
    var form = document.getElementById('form');
    var valorInput1 = document.getElementById('valorOne');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var valorSemMascara = valorInput1.value.replace("R$", '');
        valorInput1.value = valorSemMascara.replace(".", "").replace(",", ".");
        form.submit();
    });
    // ## fim formulário

    // ## Transforma o valor do input em number e faz o envio do formulário
    var form2 = document.getElementById('form-edit');
    var valorInput2 = document.getElementById('edit-valor');
    form2.addEventListener('submit', function(e) {
        e.preventDefault();
        var valorSemMascara = valorInput2.value.replace("R$", '');
        valorInput2.value = valorSemMascara.replace(".", "").replace(",", ".");
        form2.submit();
    });
    // ## fim formulário

    var closeEdit = document.getElementById("closeEdit");
    closeEdit.onclick = function() {
        modalEditar.style.display = "none";
    }

    function downloadFile() {
        var filename = document.getElementById("fileName").value;
        // Adiciona o valor do campo como parâmetro na URL do href
        const downloadLink = document.querySelector('#download-link');
        downloadLink.href = "{{ route('download', ['filename' => ':nomeArquivo']) }}".replace(':nomeArquivo', filename);
    }

    function getData(id) {
        var modalEditar = document.getElementById("modalEditar");

        // Obtém o token CSRF
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Define as credenciais de autenticação
        const credentials = 'include';

        // Define a URL do endpoint que você deseja chamar
        const url = `/pagamentos/${id}`;

        // Define as opções da solicitação
        const options = {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
            credentials: credentials
        };

        // Faz a chamada para o endpoint usando fetch()
        fetch(url, options)
            .then(response => response.json())
            .then(data => {
                document.getElementById("edit-id").value = data.id;
                document.getElementById("edit-name").value = data.nomeconta;
                document.getElementById("edit-vencimento").value = data.vencimento;
                document.getElementById("fileName").value = data.boleto;
                document.getElementById("option").value = data.paga;
                document.getElementById("option").innerHTML = data.paga == 0 ? "Não Pago" : "Pago";
                document.getElementById("secondOption").innerHTML = data.paga == 0 ? "Pago" : "Não Pago";
                document.getElementById("secondOption").value = data.paga == 0 ? 1 : 0;
                document.getElementById("edit-valor").value = data.valor.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
                document.getElementById("edit-observacao").value = data.observacao;
                console.log(data.comprovante == "");

                if (data.comprovante !== null && data.comprovante !== "") {
                    document.getElementById("comprovante-label").style.display = "none";
                    const newLink = document.createElement("a");
                    newLink.className = "btn btn-sm btn-primary";
                    newLink.id = "comprovante";
                    newLink.innerHTML = "Visualizar comprovante";
                    newLink.href = "{{ route('download', ['filename' => ':nomeArquivo']) }}".replace(':nomeArquivo', data.comprovante);
                    newLink.target = "_blank"; // adiciona o atributo target="_blank" para abrir o link em uma nova aba
                    const fileInput = document.getElementById("comprovante");
                    fileInput.replaceWith(newLink);
                } else {
                    console.log("else")
                    document.getElementById("comprovante-label").style.display = "block";
                    const fileInput = document.getElementById("comprovante");
                    const newInput = document.createElement("input");
                    newInput.type = "file";
                    newInput.name = "comprovante";
                    newInput.className = "form-control";
                    newInput.id = "comprovante";
                    fileInput.replaceWith(newInput);
                }
            })
            .catch(error => console.error(error));
        modalEditar.style.display = "block";
    }
</script>
@endsection