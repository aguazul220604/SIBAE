@extends('adminlte::page')

@section('title', 'SIBAE')

@section('content_header')
    <h6>SIBAE: Sistema de Gestión de Balance de Energía</h6>
    <h1>Registros históricos</h1>
@stop

@section('content')
    @if ($usuarioActivo->privilegios == 1)
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="panel1-tab" data-toggle="tab" href="#panel1" role="tab" aria-controls="panel1"
                    aria-selected="true">Reportes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="panel4-tab" data-toggle="tab" href="#panel4" role="tab" aria-controls="panel4"
                    aria-selected="false">Datos anuales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="panel2-tab" data-toggle="tab" href="#panel2" role="tab" aria-controls="panel2"
                    aria-selected="false">Gráficos anuales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="panel3-tab" data-toggle="tab" href="#panel3" role="tab" aria-controls="panel3"
                    aria-selected="false">Gráficos totales</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="panel1" role="tabpanel" aria-labelledby="panel1-tab">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <table id="table4" class="display">
                            <tr>
                                <td rowspan="5">
                                    <form id="fechaForm" method="GET" action="{{ route('panel.historial') }}">
                                        <label>DESDE</label>
                                        <br>
                                        <select name="mes1" id="" style="width: 100px">
                                            @foreach ($meses as $mes)
                                                <option value="{{ $mes->id }}">{{ $mes->mes }}</option>
                                            @endforeach
                                        </select>
                                        <select name="year1" id="" style="width: 100px">
                                            @foreach ($years as $year)
                                                <option value="{{ $year->id }}">{{ $year->year }}</option>
                                            @endforeach
                                        </select>
                                        <BR></BR>
                                        <label>HASTA</label>
                                        <br>
                                        <select name="mes2" id="" style="width: 100px">
                                            @foreach ($meses as $mes)
                                                <option value="{{ $mes->id }}">{{ $mes->mes }}</option>
                                            @endforeach
                                        </select>
                                        <select name="year2" id="" style="width: 100px">
                                            @foreach ($years as $year)
                                                <option value="{{ $year->id }}">{{ $year->year }}</option>
                                            @endforeach
                                        </select>
                                        <br><br>
                                        <button type="submit">Consultar</button>
                                        <br><br>
                                    </form>
                                    <table>
                                        <tr>
                                            <td colspan="2" style="text-align: center">
                                                <h4>Fecha de selección</h4>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center"><b>DESDE</b> {{ $fecha1->fecha }} </td>
                                            <td style="text-align: center"><b>HASTA</b> {{ $fecha2->fecha }} </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="titulo">Ventas</td>
                                <td><a href="{{ route('generate1.pdf', ['fecha1' => $fecha1->id, 'fecha2' => $fecha2->id]) }}"
                                        class="btn btn-primary">Generar PDF</a>
                                    <a href="{{ route('generate1.xlsx', ['fecha1' => $fecha1->id, 'fecha2' => $fecha2->id]) }}"
                                        class="btn btn-primary">Generar EXCEL</a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="titulo">Alta tensión</td>
                                <td><a href="{{ route('generate2.pdf', ['fecha1' => $fecha1->id, 'fecha2' => $fecha2->id]) }}"
                                        class="btn btn-primary">Generar PDF</a>
                                    <a href="{{ route('generate2.xlsx', ['fecha1' => $fecha1->id, 'fecha2' => $fecha2->id]) }}"
                                        class="btn btn-primary">Generar EXCEL</a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="titulo">Media tensión</td>
                                <td><a href="{{ route('generate3.pdf', ['fecha1' => $fecha1->id, 'fecha2' => $fecha2->id]) }}"
                                        class="btn btn-primary">Generar PDF</a>
                                    <a href="{{ route('generate3.xlsx', ['fecha1' => $fecha1->id, 'fecha2' => $fecha2->id]) }}"
                                        class="btn btn-primary">Generar EXCEL</a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="titulo">Subestaciones</td>
                                <td><a href="{{ route('generate4.pdf', ['fecha1' => $fecha1->id, 'fecha2' => $fecha2->id]) }}"
                                        class="btn btn-primary">Generar PDF</a>
                                    <a href="{{ route('generate4.xlsx', ['fecha1' => $fecha1->id, 'fecha2' => $fecha2->id]) }}"
                                        class="btn btn-primary">Generar EXCEL</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="panel4" role="tabpanel" aria-labelledby="panel4-tab">
                <div class="card shadow-lg">
                    <div class="card-body">
                        @php
                            $heads = [
                                ['no-export' => true, 'width' => 1],
                                'AÑO',
                                'Energía anual recibida',
                                'Energía anual entregada',
                                'Energía anual perdida',
                                'Energía porcentual perdida',
                            ];
                            $btnEdit = '';
                            $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Delete">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                  </button>';
                            $config = [
                                'language' => [
                                    'url' => 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                                ],
                                'lengthMenu' => [[12, 25, 50, -1], [12, 25, 50, 'All']],
                                'pageLength' => 12,
                                'dom' => 'Bfrtip',
                                'buttons' => [
                                    [
                                        'extend' => 'copy',
                                        'title' => 'Reporte Anual',
                                        'exportOptions' => ['columns' => ':not(:first-child)'],
                                    ],
                                    [
                                        'extend' => 'csv',
                                        'title' => 'Reporte Anual',
                                        'exportOptions' => ['columns' => ':not(:first-child)'],
                                    ],
                                    [
                                        'extend' => 'excel',
                                        'title' => 'Reporte Anual',
                                        'exportOptions' => ['columns' => ':not(:first-child)'],
                                    ],
                                    [
                                        'extend' => 'pdf',
                                        'title' => 'Reporte Anual',
                                        'exportOptions' => ['columns' => ':not(:first-child)'],
                                    ],
                                    [
                                        'extend' => 'print',
                                        'title' => 'Reporte Anual',
                                        'exportOptions' => ['columns' => ':not(:first-child)'],
                                    ],
                                ],
                            ];
                        @endphp
                        <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$config">
                            @foreach ($historico as $his)
                                <tr>
                                    <td></td>
                                    <td>20{{ $his->id_year }}</td>
                                    <td>{{ number_format($his->energia_anual_recibida, 0, '.', ',') }} KWh</td>
                                    <td>{{ number_format($his->energia_anual_entregada, 0, '.', ',') }} KWh</td>
                                    <td>{{ number_format($his->energia_anual_perdida, 0, '.', ',') }} KWh</td>
                                    <td>{{ number_format($his->porcentaje, 4, '.', ',') }} % </td>
                                </tr>
                            @endforeach
                        </x-adminlte-datatable>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="panel2" role="tabpanel" aria-labelledby="panel2-tab">
                <center>
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="canvas-container">
                                @foreach ($historico as $index => $his2)
                                    <canvas id="grafic{{ $index }}" width="270" height="250"></canvas>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var chrt{{ $index }} = document.getElementById('grafic{{ $index }}').getContext('2d');
                                            var chart{{ $index }} = new Chart(chrt{{ $index }}, {
                                                type: 'doughnut',
                                                data: {
                                                    labels: ['Energía recibida', 'Energía entregada', 'Energía perdida'],
                                                    datasets: [{
                                                        label: 'KWh',
                                                        data: [
                                                            {{ $his2->energia_anual_recibida }},
                                                            {{ $his2->energia_anual_entregada }},
                                                            {{ $his2->energia_anual_perdida }}
                                                        ],
                                                        backgroundColor: ['#0C4009', '#5AB354', '#F51010'],
                                                        hoverOffset: 5
                                                    }],
                                                },
                                                options: {
                                                    responsive: false,
                                                    plugins: {
                                                        title: {
                                                            display: true,
                                                            text: 'Energía anual 20{{ $his2->id_year }}'
                                                        }
                                                    }
                                                },
                                            });
                                        });
                                    </script>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </center>
            </div>

            <div class="tab-pane fade" id="panel3" role="tabpanel" aria-labelledby="panel3-tab">

                <div class="card shadow-lg">
                    <div class="card-body">
                        <canvas id="grafica1">
                        </canvas>
                    </div>
                </div>

                <div class="card shadow-lg">
                    <div class="card-body">
                        <canvas id="grafica2">
                        </canvas>
                    </div>
                </div>

                <div class="card shadow-lg">
                    <div class="card-body">
                        <canvas id="grafica3">
                        </canvas>
                    </div>
                </div>

                @php
                    $e_perdida = $historico;
                @endphp
            </div>
        </div>
    @endif
    @if ($usuarioActivo->privilegios == 2)
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="panel4-tab" data-toggle="tab" href="#panel4" role="tab"
                    aria-controls="panel4" aria-selected="true">Datos anuales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="panel2-tab" data-toggle="tab" href="#panel2" role="tab"
                    aria-controls="panel2" aria-selected="false">Gráficos anuales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="panel3-tab" data-toggle="tab" href="#panel3" role="tab"
                    aria-controls="panel3" aria-selected="false">Gráficos totales</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="panel4" role="tabpanel" aria-labelledby="panel4-tab">
                <div class="card shadow-lg">
                    <div class="card-body">
                        @php
                            $heads = [
                                ['no-export' => true, 'width' => 1],
                                'AÑO',
                                'Energía anual recibida',
                                'Energía anual entregada',
                                'Energía anual perdida',
                                'Energía porcentual perdida',
                            ];
                            $btnEdit = '';
                            $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Delete">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                  </button>';
                            $config = [
                                'language' => [
                                    'url' => 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                                ],
                                'lengthMenu' => [[12, 25, 50, -1], [12, 25, 50, 'All']],
                                'pageLength' => 12,
                                'dom' => 'Bfrtip',
                                'buttons' => [
                                    [
                                        'extend' => 'copy',
                                        'title' => 'Reporte Anual',
                                        'exportOptions' => ['columns' => ':not(:first-child)'],
                                    ],
                                    [
                                        'extend' => 'csv',
                                        'title' => 'Reporte Anual',
                                        'exportOptions' => ['columns' => ':not(:first-child)'],
                                    ],
                                    [
                                        'extend' => 'excel',
                                        'title' => 'Reporte Anual',
                                        'exportOptions' => ['columns' => ':not(:first-child)'],
                                    ],
                                    [
                                        'extend' => 'pdf',
                                        'title' => 'Reporte Anual',
                                        'exportOptions' => ['columns' => ':not(:first-child)'],
                                    ],
                                    [
                                        'extend' => 'print',
                                        'title' => 'Reporte Anual',
                                        'exportOptions' => ['columns' => ':not(:first-child)'],
                                    ],
                                ],
                            ];
                        @endphp
                        <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$config">
                            @foreach ($historico as $his)
                                <tr>
                                    <td></td>
                                    <td>20{{ $his->id_year }}</td>
                                    <td>{{ number_format($his->energia_anual_recibida, 0, '.', ',') }} KWh</td>
                                    <td>{{ number_format($his->energia_anual_entregada, 0, '.', ',') }} KWh</td>
                                    <td>{{ number_format($his->energia_anual_perdida, 0, '.', ',') }} KWh</td>
                                    <td>{{ number_format($his->porcentaje, 4, '.', ',') }} % </td>
                                </tr>
                            @endforeach
                        </x-adminlte-datatable>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="panel2" role="tabpanel" aria-labelledby="panel2-tab">
                <center>
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="canvas-container">
                                @foreach ($historico as $index => $his2)
                                    <canvas id="grafic{{ $index }}" width="270" height="250"></canvas>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var chrt{{ $index }} = document.getElementById('grafic{{ $index }}').getContext('2d');
                                            var chart{{ $index }} = new Chart(chrt{{ $index }}, {
                                                type: 'doughnut',
                                                data: {
                                                    labels: ['Energía recibida', 'Energía entregada', 'Energía perdida'],
                                                    datasets: [{
                                                        label: 'KWh',
                                                        data: [
                                                            {{ $his2->energia_anual_recibida }},
                                                            {{ $his2->energia_anual_entregada }},
                                                            {{ $his2->energia_anual_perdida }}
                                                        ],
                                                        backgroundColor: ['#0C4009', '#5AB354', '#F51010'],
                                                        hoverOffset: 5
                                                    }],
                                                },
                                                options: {
                                                    responsive: false,
                                                    plugins: {
                                                        title: {
                                                            display: true,
                                                            text: 'Energía anual 20{{ $his2->id_year }}'
                                                        }
                                                    }
                                                },
                                            });
                                        });
                                    </script>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </center>
            </div>

            <div class="tab-pane fade" id="panel3" role="tabpanel" aria-labelledby="panel3-tab">

                <div class="card shadow-lg">
                    <div class="card-body">
                        <canvas id="grafica1">
                        </canvas>
                    </div>
                </div>

                <div class="card shadow-lg">
                    <div class="card-body">
                        <canvas id="grafica2">
                        </canvas>
                    </div>
                </div>

                <div class="card shadow-lg">
                    <div class="card-body">
                        <canvas id="grafica3">
                        </canvas>
                    </div>
                </div>

                @php
                    $e_perdida = $historico;
                @endphp
            </div>
        </div>
    @endif

@stop

@section('css')
    <style>
        .canvas-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        canvas {
            margin: 10px;
        }
    </style>
    <style>
        .titulo {
            color: white;
            background-color: #2C2C2C;
            width: auto;
            height: 60px;
        }

        #table4 {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid white;
            overflow-x: auto;
        }

        #table4 th,
        #table4 td {
            text-align: left;
            padding: 8px;
            border: 1px solid white;
        }

        #table4 thead {
            border: 1px solid white;
        }

        @media only screen and (max-width: 600px) {

            #table4 th,
            #table4 td {
                width: auto;
                display: block;
                white-space: nowrap;
            }

            #table4 th:nth-of-type(1),
            #table4 td:nth-of-type(1) {
                display: none;
            }
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx1 = document.querySelector('#grafica1').getContext('2d');
            const labels1 = {!! json_encode(
                $e_perdida->pluck('id_year')->map(function ($year) {
                    return '20' . (int) $year;
                }),
            ) !!};
            const data1 = {!! json_encode($e_perdida->pluck('energia_anual_perdida')) !!};
            const barChartHorizontal = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: labels1,
                    datasets: [{
                        label: 'KWh',
                        data: data1,
                        backgroundColor: '#F51010',
                        borderColor: '#F51010',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Energía anual perdida',
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            stacked: true
                        },
                        y: {
                            stacked: true
                        }
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx2 = document.querySelector('#grafica2').getContext('2d');
            const labels2 = {!! json_encode(
                $e_perdida->pluck('id_year')->map(function ($year) {
                    return '20' . (int) $year;
                }),
            ) !!};
            const data2 = {!! json_encode($e_perdida->pluck('energia_anual_recibida')) !!};
            const data3 = {!! json_encode($e_perdida->pluck('energia_anual_entregada')) !!};
            const data4 = {!! json_encode($e_perdida->pluck('energia_anual_perdida')) !!};
            const barChartHorizontal = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: labels2,
                    datasets: [{
                            label: 'Energía anual recibida (KWh)',
                            data: data2,
                            backgroundColor: '#0C4009',
                            borderColor: '#0C4009',
                            borderWidth: 3
                        },
                        {
                            label: 'Energía anual entregada (KWh)',
                            data: data3,
                            backgroundColor: '#5AB354',
                            borderColor: '#5AB354',
                            borderWidth: 3
                        },
                        {
                            label: 'Energía anual perdida (KWh)',
                            data: data4,
                            backgroundColor: '#F51010',
                            borderColor: '#F51010',
                            borderWidth: 3
                        }
                    ]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Balance histórico de energía anual',
                            position: 'top'
                        }
                    },
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctxA = document.querySelector('#grafica3').getContext('2d');
            const labelsA = {!! json_encode(
                $e_perdida->pluck('id_year')->map(function ($year) {
                    return '20' . (int) $year;
                }),
            ) !!};
            const dataA = {!! json_encode($e_perdida->pluck('energia_anual_recibida')) !!};
            const dataB = {!! json_encode($e_perdida->pluck('energia_anual_entregada')) !!};
            const dataC = {!! json_encode($e_perdida->pluck('energia_anual_perdida')) !!};
            const barChartHorizontal = new Chart(ctxA, {
                type: 'bar',
                data: {
                    labels: labelsA,
                    datasets: [{
                            label: 'Energía anual recibida (KWh)',
                            data: dataA,
                            backgroundColor: '#0C4009',
                            borderColor: '#0C4009',
                            borderWidth: 1
                        },
                        {
                            label: 'Energía anual entregada (KWh)',
                            data: dataB,
                            backgroundColor: '#5AB354',
                            borderColor: '#5AB354',
                            borderWidth: 1
                        },
                        {
                            label: 'Energía anual perdida (KWh)',
                            data: dataC,
                            backgroundColor: '#F51010',
                            borderColor: '#F51010',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Balance histórico de energía anual',
                            position: 'top'
                        }
                    },
                    scales: {
                        xAxes: [{
                            stacked: true
                        }],
                        yAxes: [{
                            stacked: true
                        }]
                    }
                }
            });
        });
    </script>
@stop
