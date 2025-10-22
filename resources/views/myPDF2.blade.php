<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h6>SIBAE: Sistema de Gestión de Balance de Energía</h6>
    <h5>Registro de información: ALTA TENSIÓN</h5>
    <h5>Periodo de consulta: [{{ $fecha_1->fecha }}] - [{{ $fecha_2->fecha }}]</h5>
    <BR></BR>
    <h4>Energía recibida</h4>
    <p>Energía total recibida (KWh): {{ number_format($total1, 0, '.', ',') }}</p>
    <br>
    <table class="table_pdf">
        <thead>
            <td class="titulo">ID</td>
            <td class="titulo">CIPE</td>
            <td class="titulo">Punto</td>
            <td class="titulo">Fecha</td>
            <td class="titulo">Energía (KWh)</td>
        </thead>
        @foreach ($data1 as $data)
            <tr>
                <td> {{ $data->idr }} </td>
                <td> {{ $data->cipe }} </td>
                <td> {{ $data->nombre }} </td>
                <td> {{ $data->fecha }} </td>
                <td> {{ number_format($data->energia, 0, '.', ',') }} </td>
            </tr>
        @endforeach
    </table>
    <BR></BR>
    <h4>Energía entregada</h4>
    <p>Energía total entregada (KWh): {{ number_format($total2, 0, '.', ',') }}</p>
    <br>
    <table class="table_pdf">
        <thead>
            <td class="titulo">ID</td>
            <td class="titulo">CIPE</td>
            <td class="titulo">Punto</td>
            <td class="titulo">Fecha</td>
            <td class="titulo">Energía (KWh)</td>
        </thead>
        @foreach ($data2 as $data)
            <tr>
                <td> {{ $data->ide }} </td>
                <td> {{ $data->cipe }} </td>
                <td> {{ $data->nombre }} </td>
                <td> {{ $data->fecha }} </td>
                <td> {{ number_format($data->energia, 0, '.', ',') }} </td>
            </tr>
        @endforeach
    </table>
</body>

</html>


<style>
    .table_pdf table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid rgb(0, 0, 0);
        overflow-x: auto;
    }

    .table_pdf td {
        text-align: left;
        padding: 8px;
        border: 1px solid rgb(0, 0, 0);
    }

    .table_pdf thead {
        border: 1px solid white;
    }

    .titulo {
        color: white;
        background-color: #2C2C2C;
        width: auto;
        height: 60px;
    }

    @media only screen and (max-width: 600px) {

        .table_pdf th,
        .table_pdf td {
            width: auto;
            display: block;
            white-space: nowrap;
        }

        .table_pdf th:nth-of-type(1),
        .table_pdf td:nth-of-type(1) {
            display: none;
        }
    }
</style>
