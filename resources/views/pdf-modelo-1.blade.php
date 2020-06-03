<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RELATÓRIO - {{$nome}}</title>
    <style>
    table {
        width: 100%;
    }
    table{
        border: solid;
    }
    td{
        border: solid;
    }
    
    p{
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
    
    <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:700px">
        <tbody>
            <tr>
                <td colspan="2">
                    <p style="margin-left:24px; text-align:center"><span style="font-size:10pt"><span
                                style="font-family:&quot;Times New Roman&quot;,serif"><strong><span
                                        style="font-size:12.0pt"><span
                                            style="font-family:&quot;Arial Narrow&quot;,sans-serif">TELETRABALHO</span></span>
                                </strong>
                            </span>
                        </span>
                    </p>

                    <p style="margin-left:24px; text-align:center"><strong><span style="font-size:12.0pt"><span
                                    style="font-family:&quot;Arial Narrow&quot;,sans-serif">Per&iacute;odo da Pandemia
                                    Coronav&iacute;rus</span></span></strong></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">NOME: {{$nome}}</td>
            </tr>
            <tr>
                <td>DATA: {{$relatorio->data_referencia}}</td>
                <td>ENVIADO: {{ ($relatorio->pendencia) ? "NÃO" : "SIM" }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center"><strong><span style="font-size:12.0pt"><span
                                style="font-family:&quot;Arial Narrow&quot;,sans-serif">OBJETIVO</span></span></strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center">
                    <p style="text-align:justify"><span style="font-size:10pt"><span
                                style="font-family:&quot;Times New Roman&quot;,serif"><span
                                    style="font-size:12.0pt"><span
                                        style="font-family:&quot;Arial Narrow&quot;,sans-serif">O Presidente do Conselho
                                        Regional de Contabilidade instituiu por meio da Portaria CRC n&ordm; 20/2020 de
                                        23 de mar&ccedil;o de 2020, a qual institui medidas de combate e
                                        preven&ccedil;&atilde;o ao cont&aacute;gio do Coronav&iacute;rus no Conselho
                                        Regional de Contabilidade.</span></span>
                            </span>
                        </span>
                    </p>

                    <p style="text-align:justify"><span style="font-size:10pt"><span
                                style="font-family:&quot;Times New Roman&quot;,serif"><span
                                    style="font-size:12.0pt"><span
                                        style="font-family:&quot;Arial Narrow&quot;,sans-serif">Diante disso,
                                        considerando a necessidade de redu&ccedil;&atilde;o das possibilidades de
                                        cont&aacute;gio do Coronav&iacute;rus no ambiente de trabalho e a
                                        manuten&ccedil;&atilde;o das atividades do CFC, os recursos de tecnologia da
                                        informa&ccedil;&atilde;o e a possibilidade de realiza&ccedil;&atilde;o de
                                        servi&ccedil;o mediante teletrabalho (home office) e a minha
                                        condi&ccedil;&atilde;o enquadrada no art. 4&ordm; da referida Portaria,
                                        apresento relat&oacute;rio di&aacute;rio das atividades por mim
                                        desenvolvidas</span></span><strong><span
                                        style="font-size:13.5pt">.</span></strong></span>
                        </span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <table align="center" border="1" cellpadding="1" cellspacing="1" style="width:700px">
        <tbody>
            <tr>
                <td style="text-align:center"><strong><span style="font-size:12.0pt"><span
                                style="font-family:&quot;Arial Narrow&quot;,sans-serif">RELAT&Oacute;RIO</span></span></strong>
                </td>
            </tr>
            <tr>
                <td class="m">
                    MANH&Atilde;
                    @if(isset($manha))
                   
                        {!! $manha->descricao !!}
    


                    
                        <p>CURSO: {{$manha->curso}}</p>
                        <p>ANEXOS:</p>
                        @forelse($manha->anexos as $anexo)
                        <a href="{{route('consultarAnexo', [$anexo->id, $anexo->name])}}" style="color: black;">{{$anexo->name}}</a>
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
                <td class="m">
                   TARDE:
                    @if(isset($tarde))
                   
                        {!! $tarde->descricao !!}
                    


                
                        <p>CURSO: {{$tarde->curso}}</p>
                        <p>ANEXOS:</p>
                        @forelse($tarde->anexos as $anexo)
                        <a href="{{route('consultarAnexo', [$anexo->id, $anexo->name])}}" style="color: black;">{{$anexo->name}}</a>
                        <br>
                        @empty
                        NÃO HOUVE
                        @endforelse
                    
                    @else
                   
                        <p>PERÍODO NÃO ADICIONADO</p>
                        
                
                    @endif
                </td>
            </tr>
        </tbody>
    </table>


    <center>
        <div class="footer">
            <p>GERADO ON-LINE EM: {{date('d-m-Y  H:i:s')}}</p>
            <P>CÓDIGO VERIFICADOR: {{$relatorio->id}}</P>
            <P>USUÁRIO:{{ auth()->user()->name }} </P>

            <P>SISTEMA DE SIMPLIFICAÇÃO DE RELATÓRIOS DIARIOS</P>
            <P>DESENVOLVIDO POR: EZEQUIEL NASCIMENTO DA SILVA</P>

        </div>

    </center>

</body>

</html>