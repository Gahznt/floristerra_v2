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
        <i class="icofont icofont-table bg-c-pink"></i>
        <div class="d-inline">
          <h4>Recebimentos</h4>
          <span>contas à receber</span>
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
          <li class="breadcrumb-item">Recebimentos
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
          <span class="text-c-yellow f-w-600">Pendentes de recebimento</span>
          <h4></h4>
          <div>
            <span class="f-left m-t-10 text-muted">
              <i class="text-c-yellow f-16 icofont icofont-money m-r-10"></i>{{$pendentes}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-3">
      <div class="card widget-card-1">
        <div class="card-block-small">
          <i class="ti-face-smile bg-c-green card1-icon"></i>
          <span class="text-c-green f-w-600">Contas Recebidas</span>
          <h4></h4>
          <div>
            <span class="f-left m-t-10 text-muted">
              <i class="text-c-green f-16 icofont icofont-money m-r-10"></i>{{$recebidos}}
            </span>
          </div>
        </div>
      </div>
    </div>
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
            <th>Pagador</th>
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
            <td>{{$conta['pagador']}}</td>
            <td>R$ {{number_format($conta['valor'], 2, ',', '.')}}</td>
            @if ($conta->status_pagamento == 0)
            <td class="text-danger"><b>Não recebido</b></td>
            @elseif ($conta->status_pagamento == 1)
            <td class="text-success"><b>Recebido</b></td>
            @endif
            <td><button class="btn btn-grd-info btn-skew btn-sm" onclick="getData({{$conta->id}})"><b>Abrir</b></button></td>
            <td><a href="{{route('remover_recebimento', $conta->id)}}" class="btn btn-grd-danger btn-skew btn-sm"><b>Apagar</b></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  {{ $contas->links('pagination::simple-bootstrap-4') }}

  <div class="modal fade show" id="modal" tabindex="-1" role="dialog" style="display: none; padding-right: 17px; background-color: rgba(0,0,0,0.4); /* Black w/ opacity */">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Adicionar novo recebimento</h5>
        </div>
        <div class="modal-body">
          <form action="{{route('recebimentos_store')}}" method="post" id="formOne">
            @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Pagador:</label>
              <input type="text" name="pagador" required class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Valor:</label>
              <input name="valor" required class="form-control" id="valor">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Descrição:</label>
              <textarea class="form-control" name="descricao" id="message-text"></textarea>
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

  <div class="modal fade show" id="modalEditar" tabindex="1" role="dialog" style="display: none; padding-right: 17px; background-color: rgba(0,0,0,0.4); /* Black w/ opacity */">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar recebimento</h5>
        </div>
        <form action="{{route('updaterec')}}" method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group" hidden>
              <label for="recipient-name" class="col-form-label">ID:</label>
              <input type="text" name="id" class="form-control" id="edit-id">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nome:</label>
              <input type="text" name="pagador" class="form-control" id="edit-name">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Valor:</label>
              <input readonly name="valorant" class="form-control" id="edit-valorant">
              <input readonly hidden name="valor" class="form-control" id="edit-valor">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Observação:</label>
              <textarea class="form-control" name="desc" id="edit-observacao"></textarea>
            </div>
            <label class="col-form-label mt-6">Recebido:</label>
            <div class="form-group">
              <select class="form-control" name="status_pagamento" required>
                  <option id="option"></option>
                  <option id="secondOption"></option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
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
      var valor = document.getElementById('valor');
      valor.addEventListener('input', function(e) {
        var valorFormatado = e.target.value.replace(/\D/g, '').replace(/(\d{2})$/, ',$1').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        e.target.value = 'R$ ' + valorFormatado;
      });
    }
    window.onload = function() {
      maskValue();
    };

    // ## Transforma o valor do input em number e faz o envio do formulário
    var form = document.getElementById('formOne');
    var valorInput = document.getElementById('valor');
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      var valorSemMascara = valorInput.value.replace(/R\$ /, '');
      valorInput.value = valorSemMascara.replace(".", "").replace(",", ".");
      form.submit();
    });
    // ## fim formulário

    var closeEdit = document.getElementById("closeEdit");
    closeEdit.onclick = function() {
      modalEditar.style.display = "none";
    }


    function getData(id) {
      var modalEditar = document.getElementById("modalEditar");

      // Obtém o token CSRF
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Define as credenciais de autenticação
      const credentials = 'include';

      // Define a URL do endpoint que você deseja chamar
      const url = `/recebimento/${id}`;

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
        .then(data => [
          document.getElementById("edit-id").value = data.id,
          document.getElementById("edit-name").value = data.pagador,
          document.getElementById("edit-valor").value = data.valor,
          document.getElementById("option").value = data.status_pagamento,
          document.getElementById("option").innerHTML = data.status_pagamento == 0 ? "Não recebido" : "Recebido",
          document.getElementById("secondOption").innerHTML = data.status_pagamento == 0 ? "Recebido" : "Não Recebido",
          document.getElementById("secondOption").value = data.status_pagamento == 0 ? 1 : 0,
          document.getElementById("edit-valorant").value = data.valor.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
          }),
          document.getElementById("edit-observacao").value = data.desc,
        ])
        .catch(error => console.error(error));
      modalEditar.style.display = "block";
    }
  </script>

  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 30px;
      height: 17px;
    }

    .switch input {
      display: none;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
      border-radius: 17px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 13px;
      width: 13px;
      left: 2px;
      bottom: 2px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
      border-radius: 50%;
    }

    input:checked+.slider {
      background-color: #2196F3;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(13px);
      -ms-transform: translateX(13px);
      transform: translateX(13px);
    }
  </style>
  @endsection