@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <i class="fa fa-dashboard"></i> Dashboard</div>

                <div class="card-body">
                    @if (session('pendencia'))
                    <div class="alert alert-danger" role="alert">
                        {!! session('pendencia') !!}
                    </div>
                    @else
                    <div class="alert alert-success" role="alert">
                        "Você não possui PENDÊNCIAS para o dia. Seu Relatorio foi entregue!"
                    </div>
                    @endif

                    <div class="row">

                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    RELATÓRIO DO DIA:
                                </div>
                                <div class="card-body">

                                    <h5 class="card-text">ADICIONE O RELATÓRIO:</h5>
                                    <a href="{{route('relatorioManha')}}" class="btn btn-success btn-lg btn-block"> <i
                                            class="fa fa-plus">
                                        </i> MANHÃ</a>
                                    <a href="{{route('relatorioTarde')}}" class="btn btn-success btn-lg btn-block"> <i
                                            class="fa fa-plus">
                                        </i> TARDE</a>

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    LISTAR RELATÓRIOS
                                </div>
                                <div class="card-body">

                                    <h5 class="card-text">RELATÓRIOS ADICIONADOS:</h5>
                                    <a href="{{route('relatorios')}}" class="btn btn-primary btn-lg btn-block"> <i
                                            class="fa fa-eye"> </i>
                                        MEUS RELATÓRIOS
                                    </a>
                                    @if(auth()->user()->admin)
                                    <a href="{{route('funcionarios')}}" class="btn btn-primary btn-lg btn-block"> <i
                                            class="fa fa-user"> </i>
                                        FUNCIONÁRIOS
                                    </a>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                    @if (session('pendencia'))
                    <button type="button" data-toggle="modal" data-target="#modal1"
                        class="btn btn-success btn-lg btn-block">ENVIAR PARA RH</button>
                    <br>
                    @endif
                </div>
            </div>
            <br>
            <center>

                <div class="card col-md-6">
                    <div class="card-body">
                        <div id="hora" onload="time();" class="card-text"></div>


                        <h3>{{date('d/m/Y')}}</h3>
                    </div>


                </div>




            </center>



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

@endsection
@push('script')
<script>
function time() {
    var date = new Date();

    document.getElementById("hora").innerHTML = "<h2> " + date.getHours() +
        ":" + date.getMinutes() + ":" + date.getSeconds(); + " </h2>";

}
window.setInterval("time();", 1000);
</script>
@endpush