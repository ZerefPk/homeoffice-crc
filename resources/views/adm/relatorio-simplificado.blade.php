<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RELATORIO SIMPLIFICADO</title>

    <style>
    .t{
        width: 116.6px;
        padding: 10px;
    }
    .i{
        width: 60px;
        padding: 10px;
    }
    table {
        border: solid;
    }

    td {
        border: solid;
    }

    p, table {
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
                <td>TOTAL DE FUNCIONARIOS: {{$countFunc}}&nbsp;</td>
                <td>OCORR&Ecirc;NCIAS: {{$countOc}} </td>
            </tr>
        </tbody>
    </table>

    <p>&nbsp;</p>
    @foreach($list as $key => $item )
    <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:700px">
        <thead>
            <tr>
                <th colspan="2" scope="col" style="text-align: left;">NOME: {{$item['name']}} </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>OCORR&Ecirc;NCIAS: {{$item['ocorrencias']}}
                </td>
                <td>CODIGO: {{$item['id']}}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center"><strong>RELAT&Oacute;RIO SIMPLIFICADO</strong></td>
            </tr>
        </tbody>
    </table>
    
    @foreach($item['objects'] as $object)
    <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:700px">
        <tbody>
            <tr>
                <td><strong>CODIGO</strong></td>
                <td><strong>DATA</strong></td>
                <td><strong>MANH&Atilde;</strong></td>
                <td><strong>TARDE</strong></td>
                <td><strong>ENVIADO</strong></td>
            </tr>
            <tr>
                <td class="i">{{$object->id}}</td>
                <td class="t">{{date('d/m/Y', strtotime($object->data_referencia))}}</td>
                <td class="t">  
                    @php echo ($object->detalhes()->where('periodo','MANHÃ')->first()) ? "PRESENTE" : "AUSENTE"  @endphp    
                </td>
                <td class="t">  
                    @php echo ($object->detalhes()->where('periodo','TARDE')->first()) ? "PRESENTE" : "AUSENTE"  @endphp    
                </td>
                <td class="t">{{($object->pendencia)? "NÃO": "SIM" }}</td>
            </tr>
    
        </tbody>
    </table>

    
    @endforeach
    <br>
    <br>
    @endforeach

    <center>
        <div class="footer">
            <p>GERADO ON-LINE EM: {{date('d-m-Y  H:i:s')}}</p>
            <P>USUÁRIO:{{ auth()->user()->name }} </P>

            <P>SISTEMA DE SIMPLIFICAÇÃO DE RELATÓRIOS DIARIOS</P>
            <P>DESENVOLVIDO POR: EZEQUIEL NASCIMENTO DA SILVA</P>

        </div>

    </center>

</body>

</html>