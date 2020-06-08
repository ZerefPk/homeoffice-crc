@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">RELATÓRIOS</div>

                <div class="card-body">
                    @if (session('pendencia'))
                    <div class="alert alert-danger" role="alert">
                        {!! session('pendencia') !!}
                    </div>
                    @else
                    <div class="alert alert-success" role="alert">
                        "Você não possui PENDÊNCIAS para o dia. Seu Relatório foi entregue!"
                    </div>
                    @endif
                    <nav class="navbar">
                        <a class="btn btn-primary" href="{{route('home')}}"> <i
                                class="fa fa-dashboard"></i>Dashboard</a>
                        <a class="btn btn-primary" href="{{route('baixar',$relatorio->id)}}"> <i
                                class="fa fa-download"></i>Download</a>

                    </nav>


                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>CODIGO</th>
                                <th>DATA</th>
                                <th>ENTEGUE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{$relatorio->id}}</th>
                                <td>{{$relatorio->data_referencia}}</td>

                                <td> {{ ($relatorio->pendencia) ? "NÃO" : "SIM" }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="col">

                            <div class="card">

                                <div class="card-header">MANHÃ</div>

                                <div class="card-body">
                                    @if(isset($manha))
                                    <div>
                                        {!! $manha->descricao !!}

                                    </div>

                                    <p>CURSO: {{$manha->curso}} </p>

                                    @else
                                    <p>PERIODO NÃO ADICIONADO</p>
                                    @endif


                                </div>
                                @if(isset($manha) && count($manha->anexos))
                                <br>
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="3">ANEXOS</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($manha->anexos as $anexo)
                                        <tr>
                                            <th scope="row">{{$anexo->name}}</th>
                                            <td> <a href="{{route('downloadAnexo',$anexo->id)}}"
                                                    class="btn btn-primary"> <i class="fa fa-download"></i> </a>
                                            </td>


                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                @endif


                            </div>

                        </div>
                        <div class="col">

                            <div class="card">

                                <div class="card-header">TARDE</div>

                                <div class="card-body">
                                    @if(isset($tarde))
                                    <div>
                                        {!! $tarde->descricao !!}

                                    </div>

                                    <p>CURSO: {{$tarde->curso}} </p>
                                    <div>
                                        anecos
                                    </div>

                                    @else
                                    <p>PERIODO NÃO ADICIONADO</p>
                                    @endif

                                    @if(isset($tarde) && count($tarde->anexos))
                                    <br>
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th colspan="3">ANEXOS</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($tarde->anexos as $anexo)
                                            <tr>
                                                <th scope="row">{{$anexo->name}}</th>
                                                <td> <a href="{{route('downloadAnexo',$anexo->id)}}"
                                                        class="btn btn-primary"> <i class="fa fa-download"></i> </a>
                                                </td>


                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    @endif
                                </div>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection