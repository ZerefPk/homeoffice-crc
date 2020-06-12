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
    <div class="card-header">

        <div class="row">
            <div class="col-sm-8">
                RELATÓRIO DO DIA - PERIODO DA {{session('periodo')}}
            </div>

            <div class="col-sm-2">
                @if(session('periodo') == "MANHÃ")
                <a class="btn btn-primary" href="{{route('relatorioTarde')}}"> <i
                        class="fa fa-arrow-right"></i>AVANÇA</a>
                @else
                <a class="btn btn-primary" href="{{route('relatorioManha')}}"> <i
                        class="fa fa-arrow-left"></i>ANTERIOR</a>
                @endif
            </div>
        </div>

    </div>

    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif
        @if(isset($info))
        <form action="{{route('upRelatorio', $info->id)}}" method="post" enctype="multipart/form-data">
            @method('put')

            @else
            <form action="{{route('storeRelatorio')}}" method="post" enctype="multipart/form-data">
                @endif
                @csrf
                <div class="form-group">
                    <label for="formGroupExampleInput">DESCREVA AS ATIVIADES DESENPENHADAS</label>
                    @error('descricao')

                    <div class="alert alert-danger" role="alert">
                        <strong>Ops!</strong> DESCREVA SUA ATIVIDADE!!
                    </div>

                    @enderror


                    <textarea id="descricao" name="descricao">

                                @if(isset($info))
                                    {{ $info->descricao }}
                                
                                @else
                                    {{old('descricao')}}
                                @endif
                                


                            </textarea>

                </div>
                @error('curso')

                <div class="alert alert-danger" role="alert">
                    <strong>Ops!</strong> DIGA SE SUA ATIVIADE FOI CURSO
                </div>

                @enderror
                <div class="form-group row">


                    <div class="col">

                        <label for="curso">SUA ATIVIADE FOI CURSO?</label>
                        <select class="form-control" name="curso" id="">

                            @if(isset($info))
                            <option value="{{ $info->curso }}" selected>{{ $info->curso }}</option>


                            @else
                            <option value="" disabled selected>SELECIONE SUA ATIVIDADE</option>
                            @endif





                            <option value="SIM">SIM</option>
                            <option value="NÃO">NÃO</option>
                            <option value="AMBOS">AMBOS</option>
                        </select>
                    </div>
                    <div class="col">

                        <label for="inlineFormInputName2">Anexos:</label>
                        <input type="file" multiple="multiple" value="{{old('anexos')}}" class="form-control"
                            name="anexos[]">
                    </div>


                </div>



                <div class="form-group">
                    <button type="reset" class="btn btn-warning">LIMPAR</button>

                    @if(isset($info))
                    <button type="submit" class="btn btn-success">ATUALZIAR</button>

                    @else
                    <button type="submit" class="btn btn-success">SALVAR</button>
                    @endif
                </div>
            </form>

            @if(isset($info))
            <form action="{{route('destroyRelatorio',$info->id )}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger ">DELETAR</button>

            </form>
            @endif
            @if(isset($info) && count($info->anexos))
            <br>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th colspan="3">ANEXOS</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($info->anexos as $anexo)
                    <tr>
                        <th scope="row">{{$anexo->name}}</th>
                        <td> <a href="{{route('downloadAnexo',$anexo->id)}}" class="btn btn-primary"> <i
                                    class="fa fa-download"></i> </a></td>
                        <td>
                            <form action="{{route('removerAnexo', $anexo->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                            </form>


                    </tr>
                    @endforeach

                </tbody>
            </table>
            @endif

    </div>
</div>

@stop

@section('js')
<script src="{{url('ckeditor/ckeditor.js')}}"></script>
<script>
CKEDITOR.replace('descricao');
</script>
@stop