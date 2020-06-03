@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">RELATORIOS</div>

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

                    <form action="{{route('relatoriosBusca')}}" method="get" class="form-inline">

                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> <i class="fa fa-search"></i> </div>
                            </div>
                            <input type="date" required class="form-control" name="busca"
                                placeholder="Pesquisa por data">
                        </div>



                        <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                    </form>
                    <nav class="navbar">
                        <a class="btn btn-primary" href="{{route('home')}}"> <i
                                class="fa fa-dashboard"></i>Dashboard</a>

                    </nav>

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
                                <th scope="row">{{$relatorio->data_referencia}}</th>
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
        </div>
    </div>
</div>
@endsection