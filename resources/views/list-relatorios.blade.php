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
<div class="card">
    <div class="card-header">Meus Relatórios</div>

    <div class="card-body">
        <form action="{{route('relatoriosBusca')}}" method="get" class="form-inline">

            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-search"></i> </div>
                </div>
                <input type="date" required class="form-control" name="busca" placeholder="Pesquisa por data">
            </div>



            <button type="submit" class="btn btn-primary mb-2">Buscar</button>
        </form>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>DIA</th>
                    <th>ENVIADO</th>
                    <th>VER</th>
                </tr>
            </thead>
            @foreach($relatorios as $relatorio)
            <tbody>
                <tr>
                    <th scope="row">{{ \Carbon\Carbon::parse($relatorio->data_referencia)->format('d/m/Y')}}</th>
                    @if($relatorio->pendencia)
                    <td>NÃO</td>

                    @else
                    <td>SIM</td>
                    @endif

                    <td>
                        <a href="{{route('detalhe', $relatorio->id)}}" class="btn btn-primary">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>

        {{$relatorios->appends(['busca' => isset($busca) ? $busca : ''])->links() }}

    </div>
</div>

@stop