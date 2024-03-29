<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">

        {{-- PRIMEIRA PARTE --}}
        <div class="row">
            <div class="col col-6 border">
                <h3 align="center">Floristerra Engenharia e Terraplenagem Ltda.</h3>
            </div>
            <div class="col col-2 border">
                <div class="row border" style="background-color: rgb(163, 163, 163)" align="center">
                    <b> Relatório n° </b>
                </div>
                <div class="row border" style="background-color: rgb(163, 163, 163)" align="center">
                    <b> Contratado </b>
                </div>
                <div class="row border" style="background-color: rgb(163, 163, 163)" align="center">
                    <b> Prazo contratual </b>
                </div>
            </div>
            <div class="col col-4 border border">
                <div class="row border">
                    <label align="center"># {{$diario->id}}<label>
                </div>
                <div class="row border" align="center">
                    <label align="center">{{$diario->contratado}}<label>
                </div>
                <div class="row border" align="center">
                    <label align="center">{{$diario->prazo_contratual}} dias<label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-6 border" align="center">
                <h6 class="p-0">Relatório Diário de Obra</h6>
            </div>
            <div class="col col-2 border" align="center" style="background-color: rgb(163, 163, 163)">
                <b> Prazo decorrido </b>
            </div>
            <div class="col col-4 border" align="center">
                <label align="center">{{$diario->prazo_decorrido}} dias<label>
            </div>
        </div>
        <div class="row">
            <div class="col col-2 border" style="background-color: rgb(163, 163, 163)" align="center">
                <b>Obra</b>
            </div>
            <div class="col col-2 border">
                {{$diario->obra}}
            </div>
            <div class="col col-2 border">
                <!--2 of 3 -->
            </div>
            <div class="col col-2 border" style="background-color: rgb(163, 163, 163)" align="center">
                <!-- <b> Prazo a vencer </b> -->
                <b> - </b>
            </div>
            <div class="col col-4 border" align="center">
                <!-- <label align="center">10 dias<label> -->
                <b> - </b>
            </div>
        </div>
        <div class="row">
            <div class="col col-2 border" align="center" style="background-color: rgb(163, 163, 163)">
                <b>Local</b>
            </div>
            <div class="col col-2 border">
                {{$diario->local}}
            </div>
            <div class="col col-2 border">
                <!--2 of 3 -->
            </div>
            <div class="col col-2 border" style="background-color: rgb(163, 163, 163)" align="center">
                <b> Data do Relatório </b>
            </div>
            <div class="col col-4 border" align="center">
                <label align="center">{{date('d/m/Y', strtotime($diario->created_at))}}<label>
            </div>
        </div>
        <div class="row">
            <div class="col col-2 border" align="center" style="background-color: rgb(163, 163, 163)">
                <b>Contratante</b>
            </div>
            <div class="col col-2 border">
                {{$diario->contratante}}
            </div>
            <div class="col col-2 border">
                <!--2 of 3 -->
            </div>
            <div class="col col-2 border" style="background-color: rgb(163, 163, 163)" align="center">
                <b> Dia da Semana </b>
            </div>
            @php
            setlocale(LC_TIME, 'pt_BR.utf-8');
            $diaSemana = strftime('%A', strtotime($diario->created_at));

            switch($diaSemana) {
            case 'Monday':
            $diaSemana = 'Segunda-feira';
            break;
            case 'Tuesday':
            $diaSemana = 'Terça-feira';
            break;
            case 'Wednesday':
            $diaSemana = 'Quarta-feira';
            break;
            case 'Thursday':
            $diaSemana = 'Quinta-feira';
            break;
            case 'Friday':
            $diaSemana = 'Sexta-feira';
            break;
            case 'Saturday':
            $diaSemana = 'Sábado';
            break;
            case 'Sunday':
            $diaSemana = 'Domingo';
            break;
            }
            @endphp
            <div class="col col-4 border" align="center">
                <label align="center">{{ $diaSemana }}<label>
            </div>
        </div>

        {{-- SEGUNDA PARTE --}}
        <div>
            <div class="row mt-3">
                <div class="col col-4 border" style="background-color: rgb(163, 163, 163)" align="center">
                    <b>Condição climática</b>
                </div>
                <div class="col col-4 border" style="background-color: rgb(163, 163, 163)" align="center">
                    <b>Tempo</b>
                </div>
                <div class="col col-4 border" style="background-color: rgb(163, 163, 163)" align="center">
                    <b>Práticavel?</b>
                </div>
            </div>
            <div class="row">
                <div class="col col-4 border" style="background-color: rgb(195, 195, 195)" align="center">
                    Manhã
                </div>
                <div class="col col-4 border" align="center">
                    {{$diario->condicao_climatica_manha}}
                </div>
                <div class="col col-4 border" align="center">
                    {{$diario->praticavel_manha == true ? "Sim" : "Não"}}
                </div>
            </div>
            <div class="row">
                <div class="col col-4 border" style="background-color: rgb(195, 195, 195)" align="center">
                    Tarde
                </div>
                <div class="col col-4 border" align="center">
                    {{$diario->condicao_climatica_tarde}}
                </div>
                <div class="col col-4 border" align="center">
                    {{$diario->praticavel_tarde == true ? "Sim" : "Não"}}
                </div>
            </div>
        </div>

        <div>
            <div class="row mt-3">
                <div class="col col-12 border" style="background-color: rgb(163, 163, 163)" align="center">
                    <b>Mão de obra</b>
                </div>
            </div>
            <div class="row">
                <div class="col col-12 border" align="center">
                    {{$diario->qtd_funcionarios}}
                </div>
            </div>
        </div>

        <div>
            <div class="row mt-3">
                <div class="col col-12 border" style="background-color: rgb(163, 163, 163)" align="center">
                    <b>Equipamento</b>
                </div>
            </div>
            <div class="row">
                <div class="col col-12 border" align="center">
                    {{$diario->equipamentos}}
                </div>
            </div>
        </div>

        <div>
            <div class="row mt-3">
                <div class="col col-12 border" style="background-color: rgb(163, 163, 163)" align="center">
                    <b>Detalhe das atividades</b>
                </div>
            </div>
            <div class="row">
                <div class="col col-12 border py-5">
                    {{$diario->detalhes_atividades}}
                </div>
            </div>
        </div>

        <div>
            <div class="row mt-3">
                <div class="col col-12 border" style="background-color: rgb(163, 163, 163)" align="center">
                    <b>Galeria de fotos</b>
                </div>
            </div>

            @foreach($diario->diariosUploads as $photo)
            <div class="row">
                <div class="col-md-12 border d-flex justify-content-center">
                    <img src="{{$photo['url']}}" width="500" height="500">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>