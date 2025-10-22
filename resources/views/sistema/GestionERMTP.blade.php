@extends('adminlte::page')

@section('title', 'SIBAE')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h6>SIBAE: Sistema de Gestión de Balance de Energía</h6>
            <h1>Administración de registros</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('control.control') }} ">
                <button type="button" class="btn btn-primary custom-btn"><i class="fa fa-arrow-circle-left"></i>
                    Control</button>
            </a>
        </div>
    </div>
@stop


@section('content')
    <br>
    <form id="mesForm" method="GET" action="{{ route('control.ermp', ['id_year' => $id_year]) }}">
        <div class="styled-select">
            <select id="id_mes" name="mes">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
        </div>
        <button type="submit">Consultar</button>
    </form>
    <br>
    @php
        echo "<h1>Administración de Energías Recibidas (Puntos): 20$id_year</h1>";
        echo '<h3>Balance Energético de Media Tensión</h3>';
    @endphp
    <br>
    <div class="card shadow-lg">
        <div class="card-body">
            @php
                $heads = ['Código', 'Fuente', 'Fecha', 'Energía'];
                $config = [
                    'language' => [
                        'url' => 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                    ],
                ];
            @endphp
            <form id="mainForm" action="{{ route('control.ermpguardar') }}" method="post">
                @csrf
                <input type="hidden" name="year" value="{{ $id_year }}">
                <input type="hidden" name="mes" value="{{ $id_mes }}">
                <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$config">
                    @foreach ($zonas as $zona)
                        <tr>
                            <td><input type="hidden" name="idz[]" value="{{ $zona->id }}">{{ $zona->id }}</td>
                            <input type="hidden" name="idfecha[]" value="{{ $idFecha->id }}">
                            <td>{{ $zona->nombre }}</td>
                            <td>{{ $idFecha->fecha }}</td>
                            <td><input type="number" name="energia[]" step="any"></td>
                            <td></td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </form>
            <br>
            <div class="col-md-7 text-right">
                <button type="button" class="btn btn-primary custom-btn" id="guardarBtn">Guardar registros</button>
            </div>
            <br>
        </div>
    </div>
@stop

@section('js')
    <script>
        document.getElementById('guardarBtn').addEventListener('click', function() {
            document.getElementById('mainForm').submit();
        });
    </script>
@stop

@section('css')
    <style>
        .custom-btn:hover {
            background-color: #046e45;
            border-color: #095e3b;
        }
    </style>
    <style>
        .styled-select {
            display: inline-block;
            position: relative;
            margin-right: 10px;
        }

        .styled-select select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #fff;
            font-size: 14px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .styled-select select:focus {
            outline: none;
        }

        .styled-select select::-ms-expand {
            display: none;
        }

        .styled-select button {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            background-color: #1e8449;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }

        .styled-select button:hover {
            background-color: #186534;
        }
    </style>
@stop
