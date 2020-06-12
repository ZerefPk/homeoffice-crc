@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="card-header">RELATÓRIOS</div>
<nav class="navbar">
    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal1"> <i
            class="fa fa-dashboard"></i>SIMPLIFICADO</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal2"> <i
            class="fa fa-dashboard"></i>COMPLETO</button>


</nav>


@stop

@section('content')
<div class="card">
    <div class="card-header">FUNCIONARIOS {{isset($busca) ? "|BUSCA: $busca" : ""}}</div>

    <div class="card-body">

        <form action="{{route('funcionariosBusca')}}" method="get" class="form-inline">

            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-search"></i> </div>
                </div>
                <input type="text" required class="form-control" name="busca" placeholder="Pesquisa por data">
            </div>



            <button type="submit" class="btn btn-primary mb-2">Buscar</button>
        </form>

        @if(isset($busca) && count($funcionarios) ==0)
        <table class="table">
            <thead class="thead-light">
                <tr clospan="3">
                    <th>BUSCA POR {{$busca}} NÃO RETORNOU DADOS</th>

                </tr>
            </thead>
            <table></table>

            @else
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>CÓDIGO</th>
                        <th>NOME</th>
                        <th>VER</th>
                    </tr>
                </thead>
                @foreach($funcionarios as $funcionario)
                <tbody>
                    <tr>
                        <th scope="row">{{$funcionario->id}}</th>
                        <th>{{$funcionario->name}}</th>


                        <td>
                            <a href="{{route('detalheFuncionario', $funcionario->id)}}" class="btn btn-primary">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            @endif

            {{$funcionarios->appends(['busca' => isset($busca) ? $busca : ''])->links() }}



    </div>
</div>

<div class="modal" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">GERAR RELATÓRIO SIMPLIFICADO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>SELECIONE O PERIODO</p>

                <form action="{{route('simplificado')}}" method="post">
                    @csrf
                    <label for="">Data Inicial</label>
                    <input class="form-control" type="date" name="inicio" required>
                    <label for="">Data Final</label>
                    <input class="form-control" type="date" name="final" required>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                <button type="submit" class="btn btn-success"> <i class="fa fa-download"></i> BAIXAR</button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">GERAR RELATÓRIO COMPLETO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>SELECIONE O PERIODO</p>

                <form action="{{route('completo')}}" method="post">
                    @csrf
                    <label for="">Data Inicial</label>
                    <input class="form-control" type="date" name="inicio" required>
                    <label for="">Data Final</label>
                    <input class="form-control" type="date" name="final" required>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                <button type="submit" class="btn btn-success"> <i class="fa fa-download"></i> BAIXAR</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection