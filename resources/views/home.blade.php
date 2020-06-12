@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@if (session('pendencia'))
<div class="alert alert-danger" role="alert">
    {!! session('pendencia') !!}
</div>
@else
<div class="alert alert-success" role="alert">
    "Você não possui PENDÊNCIAS para o dia. Seu Relatório foi entregue!"
</div>
@endif

@stop

@section('content')
<div class="shadow-lg  p-3 mb-5 bg-white rounded">
    <div class="card">
        <div class="card-body">

            <h5 class="card-text">ADICIONE O RELATÓRIO:</h5>
            <div class="row">

                <div class="col-sm-5 m-4">
                    <a href="{{route('relatorioManha')}}" class="btn btn-success btn-lg btn-block">
                        <i class="fa fa-plus">
                        </i> MANHÃ</a>
                </div>
                <div class="col-sm-5 m-4">
                    <a href="{{route('relatorioTarde')}}" class="btn btn-success btn-lg btn-block">
                        <i class="fa fa-plus">
                        </i> TARDE</a>
                </div>
            </div>

        </div>

    </div>
    <div class="m-2">
        <div class="container col-sm-5">
            @if (session('pendencia'))
            <button type="button" data-toggle="modal" data-target="#modal1"
                class="btn btn-success btn-lg btn-block">ENVIAR
                PARA
                RH</button>
            @endif
        </div>
    </div>

    <di class="row">
        <div class="card col-md-6">
            <div class="card-body">
                <div class="container">
                    <div id="hora" onload="time();" class="card-text"></div>
                </div >

            </div>
        </div>
        <div class="card col-md-6">
            <div class="card-body">
                <div class="card-text">
                    <h3> Relatóio do dia: {{date('d/m/Y')}}</h3>

                </div>
            </div>
        </div>
</div>

</div>



<!-- Modal -->
<div class="modal" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmar envio?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Não é possivel editar após o envio!</h3>
                @if (session('pendencia'))
                <div class="alert alert-danger" role="alert">
                    {!! session('pendencia') !!}
                </div>
                @else
                <div class="alert alert-success" role="alert">
                    "Você não possui PENDÊNCIAS para o dia. Seu Relatorio foi entregue!"
                </div>
                @endif


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <form action="{{route('efetivar')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success">ENVIAR</button>
                </form>

            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
function time() {
    var date = new Date();

    document.getElementById("hora").innerHTML = "<h2> " + date.getHours() +
        ":" + date.getMinutes() + ":" + date.getSeconds(); + " </h2>";

}
window.setInterval("time();", 1000);
</script>
@stop