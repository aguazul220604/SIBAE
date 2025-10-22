@extends('adminlte::page')

@section('title', 'SIBAE')

@section('content_header')
    <h6>SIBAE: Sistema de Gestión de Balance de Energía</h6>
    <h1>Control de subestaciones</h1>
@stop

@section('content')
    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                text: "{{ $errors->first() }}",
                icon: "warning",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session('message') === 'ok')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                text: "Registro exitoso",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session()->has('message') && session('message') == 'error')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                text: "Campos incompletos",
                icon: "error",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session()->has('message') && session('message') == 'update')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                text: "Registros actualizados",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session()->has('message') && session('message') == 'error')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                text: "Error de carga",
                icon: "error",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session()->has('message') && session('message') == 'ok1')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                text: "Registro actualizado",
                icon: "success",
                confirmButtonColor: "#00532C",
                showConfirmButton: true
            });
        </script>
    @endif
    <br>
    <form id="fechaForm" method="GET" action="{{ route('subestaciones.create') }}">
        <div class="styled-select">
            <select id="selectYear" name="year">
                @foreach ($years as $year1)
                    <option value="{{ $year1->id }}">20{{ $year1->id }}</option>
                @endforeach
            </select>
            <select id="selectMes" name="mes">
                @foreach ($meses as $mes)
                    <option value="{{ $mes->id }}">{{ $mes->mes }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Consultar</button>
    </form>
    @php
        echo "<h1>Diagrama unifilar de subestaciones: $idFecha->fecha</h1>";
    @endphp
    <br>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="panel1-tab" data-toggle="tab" href="#panel1" role="tab"
                aria-controls="panel1" aria-selected="true">Diagrama unifilar</a>
        </li>
        @if ($usuarioActivo->privilegios == 1)
            <li class="nav-item">
                <a class="nav-link" id="panel2-tab" data-toggle="tab" href="#panel2" role="tab" aria-controls="panel2"
                    aria-selected="false">Registro de energía</a>
            </li>
        @endif
    </ul>

    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade show active" id="panel1" role="tabpanel" aria-labelledby="panel1-tab">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="zoom-buttons">
                        <br>
                        <button class="zbtn" onclick="zoomIn()">+</button>
                        <button class="zbtn" onclick="zoomOut()">-</button>
                    </div>
                    <br>
                    Energía total perdida <input type="text" class="energiaperdida" readonly
                        value="{{ $etp ? number_format($etp, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                    <div class="zoom-container" id="zoomContainer">
                        <div class="zoom-content" id="zoomContent">
                            <table class="custom-table">
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                        <td><input type="text" class="celda-ajuste"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="6" class="celda2">ZONA SJR SE BOQ</td>
                                        <td></td>
                                        <td
                                            style="vertical-align: bottom; height: 60px; border: 1px solid rgb(255, 255, 255);">
                                            <img src="{{ asset('vendor/adminlte/dist/img/dgl.png') }}" width="60px"
                                                height="20px" style="display: block; margin: 0 auto;">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td class="borde-superior"></td>
                                        <td></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text1">73550</p>
                                        </td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda40">
                                            <div class="cell-content">
                                                <input type="text" readonly
                                                    value="{{ $circuito44 ? number_format($circuito44->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="5" class="celda2">ZONA SJR SE EZM</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="4" class="celda2">ZONA SJR ACUEDUCTO II</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td id="ppd15">
                                            <div class="cell-content">
                                                <p class="text2">Pérdidas(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd15 ? number_format($ppd15->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd15 ? number_format($ppd15->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total TCZ</td>
                                        <td></td>
                                        <td colspan="2" id="stt1"><input class="energia1" type="text"
                                                readonly
                                                value="{{ $total1 ? number_format($total1->suma_energia, 2, '.', ',') . ' KWh' : '0.00' }}">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="vertical-align: bottom;"><img
                                                src="{{ asset('vendor/adminlte/dist/img/dgl.png') }}" width="60px"
                                                height="20px" style="display: block;"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior borde-izquierdo"></td>
                                        <td class="borde-inferior"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo borde-inferior"></td>
                                        <td class="borde-inferior">
                                            <p class="text4">CASA DE MÁQUINAS</p>
                                        </td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="celda-ajuste"><input type="text"
                                                class="celda-ajuste"><input type="text" class="celda-ajuste"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda1">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[32]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[32]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito33 ? number_format($circuito33->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd1">
                                            <div class="cell-content">
                                                <p class="text2">Pérdidas(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd1 ? number_format($ppd1->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd1 ? number_format($ppd1->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda2">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[31]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[31]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito32 ? number_format($circuito32->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd2">
                                            <div class="cell-content">
                                                <p class="text2">Pérdidas(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd2 ? number_format($ppd2->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd2 ? number_format($ppd2->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda3">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[33]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[33]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito34 ? number_format($circuito34->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd3">
                                            <div class="cell-content">
                                                <p class="text2">Pérdidas(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd3 ? number_format($ppd3->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd3 ? number_format($ppd3->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda4">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[36]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[36]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito37 ? number_format($circuito37->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd4">
                                            <div class="cell-content">
                                                <p class="text2">Pérdidas(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd4 ? number_format($ppd4->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd4 ? number_format($ppd4->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda5">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[37]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[37]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito38 ? number_format($circuito38->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" id="stt4"><input class="energia1" type="text"
                                                readonly
                                                value="{{ $total4 ? number_format($total4->suma_energia, 2, '.', ',') . ' KWh' : '0.00' }}">
                                        </td>
                                        <td>HUM + ZIM</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text5">
                                                KV <input type="text" readonly value="115/34.5"><br>
                                                MVA <input type="text" readonly value="12/16/20/22.4">
                                            </p>
                                        </td>
                                        <td colspan="2"><img src="{{ asset('vendor/adminlte/dist/img/tranf.png') }}"
                                                width="100px" height="50px"></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text5">
                                                KV <input type="text" readonly value="115/13.8"><br>
                                                MVA <input type="text" readonly value="12/16/20/22.4">
                                            </p>
                                        </td>
                                        <td colspan="2"><img src="{{ asset('vendor/adminlte/dist/img/tranf.png') }}"
                                                width="100px" height="50px"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior borde-derecho"></td>
                                        <td colspan="2" class="celda1" id="celda39">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[35]->nombre }}</p>
                                                <input type="text" readonly
                                                    value="{{ $circuito35 ? number_format($circuito35->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td>HUM</td>
                                        <td colspan="2" id="stt2"><input class="energia1" type="text"
                                                readonly
                                                value="{{ $total2 ? number_format($total2->suma_energia, 2, '.', ',') . ' KWh' : '0.00' }}">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior">ZIM</td>
                                        <td class="borde-inferior" colspan="2" id="stt3"><input class="energia1"
                                                type="text" readonly
                                                value="{{ $total3 ? number_format($total3->suma_energia, 2, '.', ',') . ' KWh' : '0.00' }}">
                                        </td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text4">S. E. TECOZAUTLA</p>
                                        </td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text4">S. E. JUANDHO</p>
                                        </td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td class="borde-derecho">
                                            <p class="text4">S. E. ZIMAPÁN</p>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda6">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[16]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[15]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito16 ? number_format($circuito16->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd5">
                                            <div class="cell-content">
                                                <p class="text2">Desviación(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd5 ? number_format($ppd5->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd5 ? number_format($ppd5->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda7">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[19]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[19]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito20 ? number_format($circuito20->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd6">
                                            <div class="cell-content">
                                                <p class="text2">Desviación(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd6 ? number_format($ppd6->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd6 ? number_format($ppd6->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda8">
                                            <div class="cell-content">
                                                <p class="text1">Medidor</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[39]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito40 ? number_format($circuito40->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd7">
                                            <div class="cell-content">
                                                <p class="text2">Pérdidas(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd7 ? number_format($ppd7->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd7 ? number_format($ppd7->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda9">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[35]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[35]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito36 ? number_format($circuito36->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd8">
                                            <div class="cell-content">
                                                <p class="text2">Pérdidas(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd8 ? number_format($ppd8->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd8 ? number_format($ppd8->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text5">
                                                KV <input type="text" readonly value="110/23"><br>
                                                MVA <input type="text" readonly value="10/12.5">
                                            </p>
                                        </td>
                                        <td colspan="2"><img src="{{ asset('vendor/adminlte/dist/img/tranf.png') }}"
                                                width="100px" height="50px"></td>
                                        <td></td>
                                        <td>
                                            <p class="text5">
                                                KV <input type="text" readonly value="115/23"><br>
                                                MVA <input type="text" readonly value="12/16/20">
                                            </p>
                                        </td>
                                        <td colspan="2"><img src="{{ asset('vendor/adminlte/dist/img/tranf.png') }}"
                                                width="100px" height="50px"></td>
                                        <td></td>
                                        <td>
                                            <p class="text5">
                                                KV <input type="text" readonly value="115/34.5"><br>
                                                MVA <input type="text" readonly value="7.5/9.4">
                                            </p>
                                        </td>
                                        <td colspan="2"><img src="{{ asset('vendor/adminlte/dist/img/tranf.png') }}"
                                                width="100px" height="50px"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="celda-ajuste"><input type="text"
                                                class="celda-ajuste"><input type="text" class="celda-ajuste"></td>
                                        <td></td>
                                        <td class="borde-superior borde-izquierdo"></td>
                                        <td class="borde-superior borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-superior borde-izquierdo"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior borde-izquierdo"></td>
                                        <td class="borde-superior borde-derecho"></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda10">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[13]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[13]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito14 ? number_format($circuito14->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda11">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[14]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[14]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito15 ? number_format($circuito15->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda12">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[16]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[16]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito17 ? number_format($circuito17->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda13">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[17]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[17]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito18 ? number_format($circuito18->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda14">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[18]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[18]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito19 ? number_format($circuito19->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda15">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[30]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[30]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito31 ? number_format($circuito31->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda16">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[22]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[22]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito23 ? number_format($circuito23->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd9">
                                            <div class="cell-content">
                                                <p class="text2">Desviación(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd9 ? number_format($ppd9->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd9 ? number_format($ppd9->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda17">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[25]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[25]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito26 ? number_format($circuito26->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd10">
                                            <div class="cell-content">
                                                <p class="text2">Desviación(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd10 ? number_format($ppd10->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd10 ? number_format($ppd10->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda18">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[27]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[27]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito28 ? number_format($circuito28->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd11">
                                            <div class="cell-content">
                                                <p class="text2">Desviación(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd11 ? number_format($ppd11->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd11 ? number_format($ppd11->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td id="ppd14">
                                            <div class="cell-content">
                                                <p class="text2">Desviación(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd14 ? number_format($ppd14->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd14 ? number_format($ppd14->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text4">S. E. HUMEDADES</p>
                                        </td>
                                        <td class="borde-izquierdo"></td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text5">
                                                KV <input type="text" readonly value="115/13.8"><br>
                                                MVA <input type="text" readonly value="12/16/20">
                                            </p>
                                        </td>
                                        <td colspan="2"><img src="{{ asset('vendor/adminlte/dist/img/tranf.png') }}"
                                                width="100px" height="50px"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text5">
                                                KV <input type="text" readonly value="85/23"><br>
                                                MVA <input type="text" readonly value="10/12.5">
                                            </p>
                                        </td>
                                        <td colspan="2">
                                            <img src="{{ asset('vendor/adminlte/dist/img/tranf.png') }}" width="100px"
                                                height="50px">
                                        </td>
                                        <td>
                                            <p class="text5">
                                                KV <input type="text" readonly value="115/23"><br>
                                                MVA <input type="text" readonly value="18/24/30">
                                            </p>
                                        </td>
                                        <td colspan="2"><img src="{{ asset('vendor/adminlte/dist/img/tranf.png') }}"
                                                width="100px" height="50px"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-derecho borde-superior"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-derecho borde-superior"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="celda-ajuste"><input type="text"
                                                class="celda-ajuste"><input type="text" class="celda-ajuste"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text4">S. E. HUICHAPAN</p>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda19">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[12]->nombre }}</p>
                                                <img
                                                    src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[12]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito13 ? number_format($circuito13->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd13">
                                            <div class="cell-content">
                                                <p class="text2">Desviación(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd13 ? number_format($ppd13->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd13 ? number_format($ppd13->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda20">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[6]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[6]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito7 ? number_format($circuito7->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td id="ppd12">
                                            <div class="cell-content">
                                                <p class="text2">Desviación(%)</p>
                                                <input type="text" readonly
                                                    value="{{ $ppd12 ? number_format($ppd12->porcentaje, 4, '.', ',') . '%' : '0.00%' }}">
                                                <br>
                                                <input type="text" class="energiaperdida" readonly
                                                    value="{{ $ppd12 ? number_format($ppd12->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda21">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[5]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[5]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito6 ? number_format($circuito6->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda22">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[20]->nombre }}</p>
                                                <img
                                                    src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[20]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito21 ? number_format($circuito21->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda23">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[21]->nombre }}</p>
                                                <img
                                                    src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[21]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito22 ? number_format($circuito22->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda24">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[23]->nombre }}</p>
                                                <img
                                                    src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[23]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito24 ? number_format($circuito24->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda25">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[24]->nombre }}</p>
                                                <img
                                                    src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[24]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito25 ? number_format($circuito25->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda26">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[26]->nombre }}</p>
                                                <img
                                                    src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[26]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito27 ? number_format($circuito27->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="celda-ajuste"><input type="text"
                                                class="celda-ajuste"><input type="text" class="celda-ajuste"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="celda-ajuste"><input type="text"
                                                class="celda-ajuste"><input type="text" class="celda-ajuste"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-izquierdo borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-izquierdo borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-izquierdo borde-superior"></td>
                                        <td class="borde-superior borde-derecho"></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo"></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda27">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[0]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[0]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito1 ? number_format($circuito1->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda28">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[1]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[1]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito2 ? number_format($circuito2->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda29">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[2]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[2]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito3 ? number_format($circuito3->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda30">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[3]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[3]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito4 ? number_format($circuito4->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda31">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[4]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[4]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito5 ? number_format($circuito5->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td class="borde-izquierdo">
                                            <p class="text4">S. E. TRANCAS</p>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="text5">
                                                KV <input type="text" readonly value="23/34.5"><br>
                                                MVA <input type="text" readonly value="2.5/3.125">
                                            </p>
                                        </td>
                                        <td colspan="2">
                                            <img src="{{ asset('vendor/adminlte/dist/img/tranf.png') }}" width="100px"
                                                height="50px">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="celda-ajuste"><input type="text"
                                                class="celda-ajuste"><input type="text" class="celda-ajuste"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-superior borde-izquierdo"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior borde-izquierdo"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior borde-izquierdo"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior borde-izquierdo"></td>
                                        <td class="borde-superior borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda32">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[7]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[7]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito8 ? number_format($circuito8->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda33">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[8]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[8]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito9 ? number_format($circuito9->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda34">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[9]->nombre }}</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[9]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito10 ? number_format($circuito10->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda35">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[10]->nombre }}</p>
                                                <img
                                                    src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[10]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito11 ? number_format($circuito11->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td colspan="2" class="celda1" id="celda36">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[11]->nombre }}</p>
                                                <img
                                                    src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[11]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito12 ? number_format($circuito12->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-superior borde-izquierdo">
                                            <p class="text4">CERRO BOLUDO</p>
                                        </td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td class="borde-superior"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo borde-superior"></td>
                                        <td class="borde-inferior"></td>
                                        <td style="vertical-align: bottom; border: 1px solid rgb(255, 255, 255);">
                                            <img src="{{ asset('vendor/adminlte/dist/img/dgl.png') }}" width="60px"
                                                height="20px" style="display: block; margin: 0 auto;">
                                        </td>
                                        <td class="borde-izquierdo borde-inferior"></td>
                                        <td class="celda2">JACALA</td>
                                        <td class="borde-inferior"></td>
                                        <td class="borde-inferior"
                                            style="vertical-align: bottom; border: 1px solid rgb(255, 255, 255);">
                                            <img src="{{ asset('vendor/adminlte/dist/img/dgl.png') }}" width="60px"
                                                height="20px" style="display: block; margin: 0 auto;">
                                        </td>
                                        <td class="borde-inferior"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-izquierdo borde-superior"></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p>Puerto del Aire</p>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="borde-derecho"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda37">
                                            <div class="cell-content">
                                                <p class="text1">TRA5020</p>
                                                <img src="{{ asset('vendor/adminlte/dist/img/abierto.png') }}">
                                                <input type="text" readonly value="ABIERTO">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2" class="celda1" id="celda38">
                                            <div class="cell-content">
                                                <p class="text1">{{ $circuitos[38]->nombre }}</p>
                                                <img
                                                    src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[38]->img) }}">
                                                <input type="text" readonly
                                                    value="{{ $circuito39 ? number_format($circuito39->energia, 0, '.', ',') : '0.00' }}"
                                                    class="textE">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($usuarioActivo->privilegios == 1)
            <div class="tab-pane fade" id="panel2" role="tabpanel" aria-labelledby="panel2-tab">
                <?php if ($registro == 1) { ?>
                @php
                    $heads = [['no-export' => true, 'width' => 1], 'Circuito', 'Fecha', 'Consumo', 'Actualizar'];
                    $configSubestaciones = [
                        'language' => [
                            'url' => 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                        ],
                        'lengthMenu' => [[44, -1], [44, 'All']],
                        'pageLength' => 44,
                        'dom' => 'Bfrtip',
                        'buttons' => [
                            [
                                'extend' => 'copy',
                                'title' => 'Reporte de Consumos: SUBESTACIONES',
                                'exportOptions' => ['columns' => ':not(:last-child)'],
                            ],
                            [
                                'extend' => 'csv',
                                'title' => 'Reporte de Consumos: SUBESTACIONES',
                                'exportOptions' => ['columns' => ':not(:last-child)'],
                            ],
                            [
                                'extend' => 'excel',
                                'title' => 'Reporte de Consumos: SUBESTACIONES',
                                'exportOptions' => ['columns' => ':not(:last-child)'],
                            ],
                            [
                                'extend' => 'pdf',
                                'title' => 'Reporte de Consumos: SUBESTACIONES',
                                'exportOptions' => ['columns' => ':not(:last-child)'],
                            ],
                            [
                                'extend' => 'print',
                                'title' => 'Reporte de Consumos: SUBESTACIONES',
                                'exportOptions' => ['columns' => ':not(:last-child)'],
                            ],
                        ],
                    ];
                @endphp
                <div class="card shadow-lg">
                    <div class="card-body">
                        <form id="mainForm2" action="{{ route('subestaciones.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="year" value="{{ $year1 }}">
                            <input type="hidden" name="mes" value="{{ $id_mes }}">
                            <input type="hidden" name="idfecha" value="{{ $idFecha->id }}">
                            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$configSubestaciones">
                                @foreach ($consumos as $consumos1)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="hidden" name="idc[]" value="{{ $consumos1->id_circuito }}">
                                            {{ $consumos1->circuito_nombre }}
                                        </td>
                                        <td>
                                            {{ $idFecha->fecha }}
                                        </td>
                                        <td>{{ number_format($consumos1->energia, 4, '.', ',') }}</td>
                                        <td>
                                            <input type="number" name="energia[]" step="any"
                                                value="{{ $consumos1->energia }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </x-adminlte-datatable>
                        </form>
                        <br>
                        <div class="col-md-7 text-right">
                            <button type="button" class="btn btn-primary custom-btn" id="actualizarBtn">Actualizar
                                registros</button>
                        </div>
                        <br>
                    </div>
                </div>
                <?php } else { ?>
                @php
                    $heads = ['Circuito', 'Fecha', 'Consumo'];
                    $config = [
                        'language' => [
                            'url' => 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                        ],
                    ];
                @endphp
                <div class="card shadow-lg">
                    <div class="card-body">
                        <form id="mainForm1" action="{{ route('subestaciones.guardar') }}" method="post">
                            @csrf
                            <input type="hidden" name="year" value="{{ $year1 }}">
                            <input type="hidden" name="mes" value="{{ $id_mes }}">
                            <input type="hidden" name="idfecha" value="{{ $idFecha->id }}">
                            <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$config">
                                @foreach ($circuitos as $circuito)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="idc[]" value="{{ $circuito->id_circuito }}">
                                            {{ $circuito->nombre }}
                                        </td>
                                        <td>
                                            {{ $idFecha->fecha }}
                                        </td>
                                        <td>
                                            <input type="number" name="energia[]" step="any">
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </x-adminlte-datatable>
                        </form>
                        <br>
                        <div class="col-md-7 text-right">
                            <button type="button" class="btn btn-primary custom-btn" id="guardarBtn">Guardar
                                registros</button>
                        </div>
                        <br>
                    </div>
                </div>
                <?php } ?>
            </div>
        @endif
    </div>

    @if ($usuarioActivo->privilegios == 1)
        <x-adminlte-modal id="medidor1" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[32]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[32]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito33 ? number_format($circuito33->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[32]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[32]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[32]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[32]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[32]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[32]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[32]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[32]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[32]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor2" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>

            <form id="frmActualizarFoto2" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[31]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[31]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito32 ? number_format($circuito32->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[31]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[31]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[31]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[31]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[31]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[31]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[31]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[31]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[31]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto2"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor3" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto3" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[33]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[33]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito34 ? number_format($circuito34->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[33]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[33]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[33]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[33]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[33]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[33]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[33]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[33]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[33]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto3"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor4" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto4" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[36]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[36]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito37 ? number_format($circuito37->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[36]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[36]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[36]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[36]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[36]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[36]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[36]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[36]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[36]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto4"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor5" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto5" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[37]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[37]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito38 ? number_format($circuito38->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[37]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[37]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[37]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[37]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[37]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[37]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[37]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[37]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[37]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto5"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor6" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto6" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[15]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[15]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito16 ? number_format($circuito16->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[15]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[15]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[15]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[15]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[15]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[15]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[15]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[15]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[15]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto6"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor7" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto7" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[19]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[19]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito20 ? number_format($circuito20->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[19]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[19]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[19]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[19]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[19]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[19]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[19]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[19]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[19]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto7"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor8" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto8" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[39]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[39]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito40 ? number_format($circuito40->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[39]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[39]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[39]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[39]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[39]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[39]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[39]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[39]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[39]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto8"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor9" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto9" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[35]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[35]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito36 ? number_format($circuito36->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[35]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[35]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[35]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[35]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[35]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[35]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[35]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[35]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[35]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto9"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor10" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto10" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[13]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[13]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito14 ? number_format($circuito14->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[13]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[13]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[13]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[13]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[13]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[13]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[13]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[13]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[13]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto10"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor11" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto11" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[14]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[14]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito15 ? number_format($circuito15->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[14]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[14]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[14]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[14]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[14]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[14]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[14]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[14]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[14]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto11"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor12" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto12" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[16]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[16]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito17 ? number_format($circuito17->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[16]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[16]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[16]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[16]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[16]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[16]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[16]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[16]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[16]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto12"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor13" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto13" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[17]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[17]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito18 ? number_format($circuito18->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[17]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[17]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[17]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[17]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[17]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[17]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[17]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[17]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[17]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto13"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor14" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto14" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[18]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[18]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito19 ? number_format($circuito19->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[18]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[18]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[18]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[18]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[18]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[18]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[18]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[18]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[18]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto14"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor15" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto15" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[30]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[30]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito31 ? number_format($circuito31->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[30]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[30]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[30]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[30]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[30]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[30]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[30]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[30]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[30]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto15"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor16" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto16" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[22]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[22]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito23 ? number_format($circuito23->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[22]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[22]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[22]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[22]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[22]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[22]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[22]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[22]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[22]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto16"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor17" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto17" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[25]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[25]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito26 ? number_format($circuito26->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[25]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[25]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[25]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[25]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[25]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[25]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[25]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[25]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[25]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto17"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor18" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto18" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[27]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[27]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito28 ? number_format($circuito28->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[27]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[27]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[27]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[27]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[27]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[27]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[27]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[27]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[27]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto18"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor19" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto19" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[12]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[12]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito13 ? number_format($circuito13->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[12]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[12]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[12]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[12]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[12]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[12]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[12]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[12]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[12]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto19"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor20" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto20" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[6]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[6]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito7 ? number_format($circuito7->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[6]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[6]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[6]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[6]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[6]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[6]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[6]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[6]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[6]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto20"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor21" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto21" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[5]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[5]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito6 ? number_format($circuito6->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[5]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[5]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[5]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[5]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[5]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[5]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[5]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[5]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[5]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto21"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor22" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto22" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[20]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[20]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito21 ? number_format($circuito21->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[20]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[20]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[20]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[20]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[20]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[20]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[20]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[20]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[20]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto22"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor23" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto23" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[21]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[21]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito22 ? number_format($circuito22->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[21]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[21]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[21]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[21]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[21]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[21]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[21]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[21]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[21]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto23"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor24" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto24" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[23]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[23]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito24 ? number_format($circuito24->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[23]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[23]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[23]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[23]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[23]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[23]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[23]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[23]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[23]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto24"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor25" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto25" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[24]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[24]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito25 ? number_format($circuito25->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[24]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[24]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[24]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[24]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[24]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[24]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[24]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[24]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[24]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto25"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor26" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto26" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[26]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[26]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito27 ? number_format($circuito27->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[26]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[26]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[26]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[26]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[26]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[26]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[26]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[26]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[26]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto26"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor27" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto27" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[0]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[0]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito1 ? number_format($circuito1->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[0]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[0]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[0]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[0]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[0]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[0]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[0]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[0]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[0]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto27"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor28" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto28" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[1]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[1]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito2 ? number_format($circuito2->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[1]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[1]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[1]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[1]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[1]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[1]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[1]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[1]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[1]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto28"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor29" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto29" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[2]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[2]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito3 ? number_format($circuito3->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[2]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[2]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[2]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[2]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[2]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[2]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[2]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[2]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[2]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto29"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor30" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto30" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[3]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[3]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito4 ? number_format($circuito4->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[3]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[3]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[3]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[3]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[3]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[3]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[3]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[3]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[3]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto30"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor31" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto31" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[4]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[4]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito5 ? number_format($circuito5->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[4]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[4]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[4]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[4]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[4]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[4]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[4]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[4]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[4]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto31"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor32" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto32" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[7]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[7]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito8 ? number_format($circuito8->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[7]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[7]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[7]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[7]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[7]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[7]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[7]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[7]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[7]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto32"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor33" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto33" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[8]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[8]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito9 ? number_format($circuito9->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[8]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[8]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[8]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[8]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[8]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[8]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[8]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[8]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[8]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto33"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor34" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto34" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[9]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[9]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito10 ? number_format($circuito10->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[9]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[9]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[9]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[9]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[9]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[9]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[9]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[9]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[9]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto34"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor35" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto35" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[10]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[10]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito11 ? number_format($circuito11->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[10]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[10]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[10]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[10]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[10]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[10]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[10]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[10]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[10]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto35"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor36" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto36" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[11]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[11]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito12 ? number_format($circuito12->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[11]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[11]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[11]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[11]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[11]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[11]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[11]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[11]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[11]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto36"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor37" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto37" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/abierto.png') }}" width="60px" height="100px">
                <BR></BR>
                <input type="text" readonly value="ABIERTO">
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto37"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor38" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto38" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[38]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[38]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito39 ? number_format($circuito39->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[38]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[38]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[38]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[38]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[38]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[38]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[38]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[38]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[38]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto38"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor39" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto39" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[34]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[34]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito35 ? number_format($circuito35->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[34]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[34]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[34]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[34]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[34]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[34]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[34]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[34]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[34]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto39"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
        <x-adminlte-modal id="medidor40" title="Circuito" size="md" theme="primary" icon="fas fa-circle"
            v-centered static-backdrop scrollable>
            <form id="frmActualizarFoto" action="{{ route('subestaciones.updateimage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('vendor/adminlte/dist/img/' . $circuitos[43]->img) }}" width="60px"
                    height="100px">
                <br><br>
                <input type="file" name="img" id="img">
                <input type="hidden" name="idc" value="{{ $circuitos[43]->id_circuito }}">
                <br>

                <label>------------------------------------------------------------------------------------</label>
                <br>
                <input type="text" class="celda-ajuste" value= "Energía (KWh)" readonly>
                <input type="text" readonly
                    value="{{ $circuito44 ? number_format($circuito44->energia, 0, '.', ',') : '0.00' }}"
                    class="celda-ajuste1">
                <label>------------------------------------------------------------------------------------</label>
                <br>
                <label>Características de circuito</label>
                <table>
                    <tr>
                        <td style="text-align: left">Nombre circuito</td>
                        <td><input type="text" readonly name="nom_med" id=""
                                value="{{ $circuitos[43]->nombre }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Poblado</td>
                        <td><input type="text" name="pob_med" id=""
                                value="{{ $circuitos[43]->poblado }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Marca de medidor</td>
                        <td><input type="text" name="mar_med" id=""
                                value="{{ $circuitos[43]->marca_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Número de medidor</td>
                        <td><input type="text" name="num_med" id=""
                                value="{{ $circuitos[43]->num_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Modelo de medidor</td>
                        <td><input type="text" name="mod_med" id=""
                                value="{{ $circuitos[43]->modelo_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">IP de medidor</td>
                        <td><input type="text" name="ip_med" id=""
                                value="{{ $circuitos[43]->ip_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTC de medidor</td>
                        <td><input type="text" name="rtc_med" id=""
                                value="{{ $circuitos[43]->rtc_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">RTP de medidor</td>
                        <td><input type="text" name="rtp_med" id=""
                                value="{{ $circuitos[43]->rtp_medidor }}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Tensión de medidor</td>
                        <td><input type="text" name="ten_med" id=""
                                value="{{ $circuitos[43]->tension_medidor }}"></td>
                    </tr>
                </table>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="primary" label="Actualizar datos" id="actualizarBtnFoto"
                        type="button" class="bg-primary text-white" />
                    <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                        type="button" />
                </x-slot>
            </form>
        </x-adminlte-modal>
    @endif

    <x-adminlte-modal id="ppdd1" title="Pérdidas" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">PÉRDIDA TCZ-72020</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de pérdida" readonly> <input type="text"
            readonly value="{{ $ppd1 ? number_format($ppd1->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía        (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd1 ? number_format($ppd1->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd2" title="Pérdidas" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">PÉRDIDA TCZ-72010</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de pérdida" readonly> <input type="text"
            readonly value="{{ $ppd2 ? number_format($ppd2->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía        (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd2 ? number_format($ppd2->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd3" title="Pérdidas" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">PÉRDIDA TCZ-73880</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de pérdida" readonly> <input type="text"
            readonly value="{{ $ppd3 ? number_format($ppd3->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía        (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd3 ? number_format($ppd3->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd4" title="Pérdidas" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">PÉRDIDA ZIM-73620</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de pérdida" readonly> <input type="text"
            readonly value="{{ $ppd4 ? number_format($ppd4->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía        (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd4 ? number_format($ppd4->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd5" title="Desviaciones" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">DESVIACIÓN RESPALDO TCZ-52020</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de desviación" readonly> <input type="text"
            readonly value="{{ $ppd5 ? number_format($ppd5->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía           (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd5 ? number_format($ppd5->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd6" title="Desviaciones" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">DESVIACIÓN RESPALDO TCZ-42010</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de desviación" readonly> <input type="text"
            readonly value="{{ $ppd6 ? number_format($ppd6->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía           (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd6 ? number_format($ppd6->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd7" title="Pérdidas" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">PÉRDIDA JDO-85</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de pérdida" readonly> <input type="text"
            readonly value="{{ $ppd7 ? number_format($ppd7->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía        (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd7 ? number_format($ppd7->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd8" title="Pérdidas" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">PÉRDIDA ZIM-73700</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de pérdida" readonly> <input type="text"
            readonly value="{{ $ppd8 ? number_format($ppd8->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía        (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd8 ? number_format($ppd8->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd9" title="Desviaciones" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">DESVIACIÓN RESPALDO ZIM-52010</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de desviación" readonly> <input type="text"
            readonly value="{{ $ppd9 ? number_format($ppd9->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía           (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd9 ? number_format($ppd9->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd10" title="Desviaciones" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">DESVIACIÓN RESPALDO ZIM-52020</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de desviación" readonly> <input type="text"
            readonly value="{{ $ppd10 ? number_format($ppd10->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía           (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd10 ? number_format($ppd10->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd11" title="Desviaciones" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">DESVIACIÓN RESPALDO ZIM-52030</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de desviación" readonly> <input type="text"
            readonly value="{{ $ppd11 ? number_format($ppd11->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía           (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd11 ? number_format($ppd11->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd12" title="Desviaciones" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">DESVIACIÓN S.E. HUMEDADES</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de desviación" readonly> <input type="text"
            readonly value="{{ $ppd12 ? number_format($ppd12->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía           (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd12 ? number_format($ppd12->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd13" title="Desviaciones" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">DESVIACIÓN RESPALDO HCH-42020</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de desviación" readonly> <input type="text"
            readonly value="{{ $ppd13 ? number_format($ppd13->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía           (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd13 ? number_format($ppd13->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd14" title="Desviaciones" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">PÉRDIDA-14</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de pérdida" readonly> <input type="text"
            readonly value="{{ $ppd14 ? number_format($ppd14->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía        (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd14 ? number_format($ppd14->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="ppdd15" title="Desviaciones" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">PÉRDIDA-15</p>
        <BR></BR>
        <input type="text" class="celda-ajuste" value="Porcentaje de pérdida" readonly> <input type="text"
            readonly value="{{ $ppd15 ? number_format($ppd15->porcentaje, 4, '.', ',') . '%' : '0.00%' }}"
            class="textE">
        <br>
        <input type="text" class="celda-ajuste" value= "Energía        (KWh)" readonly> <input type="text"
            readonly value="{{ $ppd15 ? number_format($ppd15->energia, 0, '.', ',') . ' KWh' : '0.00 KWh' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>


    <x-adminlte-modal id="st1" title="Totales" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">Total (Suma): Tecozautla</p>
        <BR></BR>
        Consumo <input type="text" readonly
            value="{{ $total1 ? number_format($total1->suma_energia, 2, '.', ',') . ' KWh' : '0.00' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="st4" title="Totales" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">Total (Suma): Humedades - Zimapán</p>
        <BR></BR>
        Consumo <input type="text" readonly
            value="{{ $total4 ? number_format($total4->suma_energia, 2, '.', ',') . ' KWh' : '0.00' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="st2" title="Totales" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">Total (Suma): Humedades</p>
        <BR></BR>
        Consumo <input type="text" readonly
            value="{{ $total2 ? number_format($total2->suma_energia, 2, '.', ',') . ' KWh' : '0.00' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="st3" title="Totales" size="md" theme="primary" icon="fas fa-circle"
        v-centered static-backdrop scrollable>
        <p class="text1">Total (Suma): Zimapán</p>
        <BR></BR>
        Consumo <input type="text" readonly
            value="{{ $total3 ? number_format($total3->suma_energia, 2, '.', ',') . ' KWh' : '0.00' }}"
            class="textE">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelar"
                type="button" />
        </x-slot>
    </x-adminlte-modal>

@stop

@section('css')
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
    <style>
        .cell-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }

        .cell-content img {
            max-width: 90px;
            max-height: 120px;
            margin-bottom: 10px;
        }

        .cell-content input {
            width: 80%;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        td {
            text-align: center;
            border-radius: 10px;
        }

        .celda1 {
            background-color: #ffffff;
            border-radius: 10px;
        }

        .celda2 {
            outline: 1px solid black;
            background-color: #ffffff;
            color: rgb(255, 0, 0);
            font-weight: bold;
            border-radius: 10px;
        }

        .custom-table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #dee2e6;
        }

        .custom-table th,
        .custom-table td {
            border: none;
            padding: 8px;
            border-radius: 10px;
        }

        .custom-table .borde-superior {
            border-top: 2px solid black;
        }

        .custom-table .borde-inferior {
            border-bottom: 2px solid black;
        }

        .custom-table .borde-derecho {
            border-right: 2px solid black;
        }

        .custom-table .borde-izquierdo {
            border-left: 2px solid black;
        }

        .energia1 {
            background-color: yellow;
            border-radius: 10px;
            color: black;
            text-align: center;
        }

        .zoom-container {
            position: relative;
            overflow: auto;
            width: 100%;
            height: 1000px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .zoom-content {
            transform-origin: top left;
            transition: transform 0.3s;
            display: inline-block;
        }

        .zoom-buttons {
            margin-top: 1px;
        }

        .zoom-buttons button {
            margin-right: 1px;
        }

        .zbtn {
            width: 40px;
        }

        .text1 {
            color: red;
            font-weight: bold;
        }

        .text2 {
            color: rgb(48, 46, 46);
            font-weight: bold;
        }

        .text4 {
            color: green;
            font-weight: bold;
        }

        .text5 {
            font-size: 9.5px;
        }

        .textE {
            color: blue;
            font-weight: bold;
            text-align: center;
        }

        .energiaperdida {
            background-color: red;
            border-radius: 10px;
            color: white;
        }

        .celda-ajuste {
            border: none;
        }

        .celda-ajuste1 {
            border: none;
            color: blue;
            font-weight: bold;
        }
    </style>
@stop

@section('js')
    <script>
        document.getElementById('celda1').addEventListener('click', function() {
            $('#medidor1').modal('show');
        });
        document.getElementById('celda2').addEventListener('click', function() {
            $('#medidor2').modal('show');
        });
        document.getElementById('celda3').addEventListener('click', function() {
            $('#medidor3').modal('show');
        });
        document.getElementById('celda4').addEventListener('click', function() {
            $('#medidor4').modal('show');
        });
        document.getElementById('celda5').addEventListener('click', function() {
            $('#medidor5').modal('show');
        });
        document.getElementById('celda6').addEventListener('click', function() {
            $('#medidor6').modal('show');
        });
        document.getElementById('celda7').addEventListener('click', function() {
            $('#medidor7').modal('show');
        });
        document.getElementById('celda8').addEventListener('click', function() {
            $('#medidor8').modal('show');
        });
        document.getElementById('celda9').addEventListener('click', function() {
            $('#medidor9').modal('show');
        });
        document.getElementById('celda10').addEventListener('click', function() {
            $('#medidor10').modal('show');
        });
        document.getElementById('celda11').addEventListener('click', function() {
            $('#medidor11').modal('show');
        });
        document.getElementById('celda12').addEventListener('click', function() {
            $('#medidor12').modal('show');
        });
        document.getElementById('celda13').addEventListener('click', function() {
            $('#medidor13').modal('show');
        });
        document.getElementById('celda14').addEventListener('click', function() {
            $('#medidor14').modal('show');
        });
        document.getElementById('celda15').addEventListener('click', function() {
            $('#medidor15').modal('show');
        });
        document.getElementById('celda16').addEventListener('click', function() {
            $('#medidor16').modal('show');
        });
        document.getElementById('celda17').addEventListener('click', function() {
            $('#medidor17').modal('show');
        });
        document.getElementById('celda18').addEventListener('click', function() {
            $('#medidor18').modal('show');
        });
        document.getElementById('celda19').addEventListener('click', function() {
            $('#medidor19').modal('show');
        });
        document.getElementById('celda20').addEventListener('click', function() {
            $('#medidor20').modal('show');
        });
        document.getElementById('celda21').addEventListener('click', function() {
            $('#medidor21').modal('show');
        });
        document.getElementById('celda22').addEventListener('click', function() {
            $('#medidor22').modal('show');
        });
        document.getElementById('celda23').addEventListener('click', function() {
            $('#medidor23').modal('show');
        });
        document.getElementById('celda24').addEventListener('click', function() {
            $('#medidor24').modal('show');
        });
        document.getElementById('celda25').addEventListener('click', function() {
            $('#medidor25').modal('show');
        });
        document.getElementById('celda26').addEventListener('click', function() {
            $('#medidor26').modal('show');
        });
        document.getElementById('celda27').addEventListener('click', function() {
            $('#medidor27').modal('show');
        });
        document.getElementById('celda28').addEventListener('click', function() {
            $('#medidor28').modal('show');
        });
        document.getElementById('celda29').addEventListener('click', function() {
            $('#medidor29').modal('show');
        });
        document.getElementById('celda30').addEventListener('click', function() {
            $('#medidor30').modal('show');
        });
        document.getElementById('celda31').addEventListener('click', function() {
            $('#medidor31').modal('show');
        });
        document.getElementById('celda32').addEventListener('click', function() {
            $('#medidor32').modal('show');
        });
        document.getElementById('celda33').addEventListener('click', function() {
            $('#medidor33').modal('show');
        });
        document.getElementById('celda34').addEventListener('click', function() {
            $('#medidor34').modal('show');
        });
        document.getElementById('celda35').addEventListener('click', function() {
            $('#medidor35').modal('show');
        });
        document.getElementById('celda36').addEventListener('click', function() {
            $('#medidor36').modal('show');
        });
        document.getElementById('celda37').addEventListener('click', function() {
            $('#medidor37').modal('show');
        });
        document.getElementById('celda38').addEventListener('click', function() {
            $('#medidor38').modal('show');
        });
        document.getElementById('celda39').addEventListener('click', function() {
            $('#medidor39').modal('show');
        });
        document.getElementById('celda40').addEventListener('click', function() {
            $('#medidor40').modal('show');
        });

        document.getElementById('ppd1').addEventListener('click', function() {
            $('#ppdd1').modal('show');
        });
        document.getElementById('ppd2').addEventListener('click', function() {
            $('#ppdd2').modal('show');
        });
        document.getElementById('ppd3').addEventListener('click', function() {
            $('#ppdd3').modal('show');
        });
        document.getElementById('ppd4').addEventListener('click', function() {
            $('#ppdd4').modal('show');
        });
        document.getElementById('ppd5').addEventListener('click', function() {
            $('#ppdd5').modal('show');
        });
        document.getElementById('ppd6').addEventListener('click', function() {
            $('#ppdd6').modal('show');
        });
        document.getElementById('ppd7').addEventListener('click', function() {
            $('#ppdd7').modal('show');
        });
        document.getElementById('ppd8').addEventListener('click', function() {
            $('#ppdd8').modal('show');
        });
        document.getElementById('ppd9').addEventListener('click', function() {
            $('#ppdd9').modal('show');
        });
        document.getElementById('ppd10').addEventListener('click', function() {
            $('#ppdd10').modal('show');
        });
        document.getElementById('ppd11').addEventListener('click', function() {
            $('#ppdd11').modal('show');
        });
        document.getElementById('ppd12').addEventListener('click', function() {
            $('#ppdd12').modal('show');
        });
        document.getElementById('ppd13').addEventListener('click', function() {
            $('#ppdd13').modal('show');
        });
        document.getElementById('ppd14').addEventListener('click', function() {
            $('#ppdd14').modal('show');
        });
        document.getElementById('ppd15').addEventListener('click', function() {
            $('#ppdd15').modal('show');
        });



        document.getElementById('stt1').addEventListener('click', function() {
            $('#st1').modal('show');
        });
        document.getElementById('stt4').addEventListener('click', function() {
            $('#st4').modal('show');
        });
        document.getElementById('stt2').addEventListener('click', function() {
            $('#st2').modal('show');
        });
        document.getElementById('stt3').addEventListener('click', function() {
            $('#st3').modal('show');
        });
    </script>
    <script>
        document.getElementById('guardarBtn').addEventListener('click', function() {
            document.getElementById('mainForm1').submit();
        });
    </script>
    <script>
        document.getElementById('actualizarBtn').addEventListener('click', function() {
            document.getElementById('mainForm2').submit();
        });
    </script>
    <script>
        document.getElementById('actualizarBtnFoto').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto').submit();
        });
        document.getElementById('actualizarBtnFoto2').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto2').submit();
        });
        document.getElementById('actualizarBtnFoto3').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto3').submit();
        });
        document.getElementById('actualizarBtnFoto4').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto4').submit();
        });
        document.getElementById('actualizarBtnFoto5').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto5').submit();
        });
        document.getElementById('actualizarBtnFoto6').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto6').submit();
        });
        document.getElementById('actualizarBtnFoto7').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto7').submit();
        });
        document.getElementById('actualizarBtnFoto8').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto8').submit();
        });
        document.getElementById('actualizarBtnFoto9').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto9').submit();
        });
        document.getElementById('actualizarBtnFoto10').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto10').submit();
        });
        document.getElementById('actualizarBtnFoto11').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto11').submit();
        });
        document.getElementById('actualizarBtnFoto12').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto12').submit();
        });
        document.getElementById('actualizarBtnFoto13').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto13').submit();
        });
        document.getElementById('actualizarBtnFoto14').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto14').submit();
        });
        document.getElementById('actualizarBtnFoto15').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto15').submit();
        });
        document.getElementById('actualizarBtnFoto16').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto16').submit();
        });
        document.getElementById('actualizarBtnFoto17').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto17').submit();
        });
        document.getElementById('actualizarBtnFoto18').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto18').submit();
        });
        document.getElementById('actualizarBtnFoto19').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto19').submit();
        });
        document.getElementById('actualizarBtnFoto20').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto20').submit();
        });
        document.getElementById('actualizarBtnFoto21').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto21').submit();
        });
        document.getElementById('actualizarBtnFoto22').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto22').submit();
        });
        document.getElementById('actualizarBtnFoto23').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto23').submit();
        });
        document.getElementById('actualizarBtnFoto24').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto24').submit();
        });
        document.getElementById('actualizarBtnFoto25').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto25').submit();
        });
        document.getElementById('actualizarBtnFoto26').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto26').submit();
        });
        document.getElementById('actualizarBtnFoto27').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto27').submit();
        });
        document.getElementById('actualizarBtnFoto28').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto28').submit();
        });
        document.getElementById('actualizarBtnFoto29').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto29').submit();
        });
        document.getElementById('actualizarBtnFoto30').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto30').submit();
        });
        document.getElementById('actualizarBtnFoto31').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto31').submit();
        });
        document.getElementById('actualizarBtnFoto32').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto32').submit();
        });
        document.getElementById('actualizarBtnFoto33').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto33').submit();
        });
        document.getElementById('actualizarBtnFoto34').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto34').submit();
        });
        document.getElementById('actualizarBtnFoto35').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto35').submit();
        });
        document.getElementById('actualizarBtnFoto36').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto36').submit();
        });
        document.getElementById('actualizarBtnFoto37').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto37').submit();
        });
        document.getElementById('actualizarBtnFoto38').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto38').submit();
        });
        document.getElementById('actualizarBtnFoto39').addEventListener('click', function() {
            document.getElementById('frmActualizarFoto39').submit();
        });
    </script>
    <script>
        let scale = 1;
        const zoomStep = 0.1;
        const maxScale = 3;
        const minScale = 0.4;

        function zoomIn() {
            if (scale < maxScale) {
                scale += zoomStep;
                applyZoom();
            }
        }

        function zoomOut() {
            if (scale > minScale) {
                scale -= zoomStep;
                applyZoom();
            }
        }

        function applyZoom() {
            const zoomContent = document.getElementById('zoomContent');
            zoomContent.style.transform = `scale(${scale})`;
            zoomContent.style.width = `${100 / scale}%`;
        }
    </script>
@stop
