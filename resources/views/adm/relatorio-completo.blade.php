<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RELATORIO COMPLETO</title>
    <style>
    table {
        width: 100%;
    }

    table {
        border: solid;
    }

    td {
        border: solid;
    }

    p {
        font-family: "Arial 12";
    }

    .footer>p {
        text-align: left;
    }

    .m {
        padding: 10px;
    }
    </style>
</head>

<body>

    <center>

        <img src="{{url('img/CRCRO.png')}}" alt="LOGO CRCRO" width="300px">



    </center>
    <br>

    <table align="center" border="1" cellpadding="2" cellspacing="1" style="width:700px">
        <thead>
            <tr>
                <th colspan="2" scope="col">CONSELHO REGIONAL DE CONTABILIDADE DE ROND&Ocirc;NIA</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>RELATORIO SIMPLIFICADO DE TELETRABALHO</td>
                <td>PERIODO: {{$inicio}} a {{$final}}</td>
            </tr>
            <tr>
                <td>TOTAL DE FUNCIONARIOS: {{$countFunc}}</td>
                <td>OCORR&Ecirc;NCIAS: {{$countOc}}</td>
            </tr>
        </tbody>
    </table>

    <p>&nbsp;</p>
    @foreach($list as $key => $item )
    <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:700px">
        <thead>
            <tr>
                <th colspan="2" scope="col">RELAT&Oacute;RIO COMPLETO</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">NOME: {{$item['name']}}</td>
            </tr>
            <tr>
                <td>OCORRENCIAS: {{$item['ocorrencias']}}</td>
                <td>CÓDIGO: {{$item['id']}}</td>
            </tr>
        </tbody>
    </table>
    @foreach($item['objects'] as $object)
    <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:700px">
        <tbody>
            <tr>
                <td>DATA: {{$object->data_referencia}}</td>
                <td>C&Oacute;DIGO: {{$object->id}}</td>
                <td>ENVIADA: {{($object->pendencia)? "NÃO": "SIM" }}</td>
            </tr>
            @php

            $manha = $object->detalhes()->where('periodo','MANHÃ')->first();
            $tarde = $object->detalhes()->where('periodo','TARDE')->first();

            @endphp
            <tr>

                <td colspan="3" class="m">
                    MANHÃ:
                    @if(isset($manha))


                    {!! $manha->descricao !!}




                    <p>CURSO: {{$manha->curso}}</p>
                    <p>ANEXOS:</p>
                    @forelse($manha->anexos as $anexo)
                    <a href="{{route('consultarAnexo', [$anexo->id, $anexo->name])}}"
                        style="color: black;">{{$anexo->name}}</a>
                    <br>
                    @empty
                    NÃO HOUVE
                    @endforelse

                    @else

                    <p>PERIODO NÃO ADICIONADO</p>


                    @endif
                </td>

            </tr>
            <tr>

                <td colspan="3" class="m">
                    TARDE:
                    @if(isset($tarde))

                    {!! $tarde->descricao !!}




                    <p>CURSO: {{$tarde->curso}}</p>
                    <p>ANEXOS:</p>
                    @forelse($tarde->anexos as $anexo)
                    <a href="{{route('consultarAnexo', [$anexo->id, $anexo->name])}}"
                        style="color: black;">{{$anexo->name}}</a>
                    <br>
                    @empty
                    NÃO HOUVE
                    @endforelse

                    @else

                    <p>PERIODO NÃO ADICIONADO</p>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>


    <p>&nbsp;</p>
    @endforeach
    <p>&nbsp;</p>
    @endforeach







</body>

</html>