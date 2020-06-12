<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RELATÓRIO</title>
    <style>
    .t {
        width: 116.6px;
        padding: 10px;
    }

    .i {
        width: 60px;
        padding: 10px;
    }

    table {
        border: solid;
    }

    td {
        border: solid;
    }

    p,
    table {
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
    <table align="center" border="1" cellpadding="2" cellspacing="1" style="width:700px">
        <thead>
            <tr>
                <th colspan="2" scope="col">CONSELHO REGIONAL DE CONTABILIDADE DE ROND&Ocirc;NIA</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>RELATÓRIO SIMPLIFICADO DE TELETRABALHO</td>
                <td>PERIODO: {{$inicio}} a {{$final}}</td>
            </tr>
            <tr>
                <td>TOTAL DE FUNCIONÁRIOS: {{$countFunc}}</td>
                <td>OCORR&Ecirc;NCIAS: 0</td>
            </tr>
        </tbody>
    </table>

    <h1 style="text-align:center">SEM OCORR&Ecirc;NCIAS PARA O PER&Iacute;ODO</h1>

</body>

</html>