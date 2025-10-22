<?php

namespace App\Http\Controllers;

use App\Models\Tarifas;
use App\Models\Ventas;
use App\Models\Fechas;
use App\Models\Energia_recibida;
use App\Models\Energia_entregada;
use App\Models\Energia_sub_mt;
use App\Models\E_r_mt;
use App\Models\E_e_mt;
use App\Models\Consumo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF_ventas($fecha1, $fecha2)
    {
        $fecha_1 = Fechas::where('id', $fecha1)->first();
        $fecha_2 = Fechas::where('id', $fecha2)->first();

        if ($fecha_1 > $fecha_2) {
            $data1 = Ventas::join('fechas', 'ventas.id_fecha', '=', 'fechas.id')
                ->join('tarifas', 'ventas.id_tarifa', '=', 'tarifas.id')
                ->select('tarifas.codigo as codigo', 'tarifas.descripcion as descripcion', 'fechas.fecha as fecha', 'ventas.monto as monto', 'ventas.id as ID')
                ->whereBetween('id_fecha', [$fecha2, $fecha1])
                ->orderBy('ventas.id')
                ->get();
            $total = $data1->sum('monto');
        } else {
            $data1 = Ventas::join('fechas', 'ventas.id_fecha', '=', 'fechas.id')
                ->join('tarifas', 'ventas.id_tarifa', '=', 'tarifas.id')
                ->select('tarifas.codigo as codigo', 'tarifas.descripcion as descripcion', 'fechas.fecha as fecha', 'ventas.monto as monto', 'ventas.id as ID')
                ->whereBetween('id_fecha', [$fecha1, $fecha2])
                ->orderBy('ventas.id')
                ->get();
            $total = $data1->sum('monto');
        }

        $pdf = Pdf::loadView('myPDF1', compact('data1', 'fecha_1', 'fecha_2', 'total'));
        return $pdf->stream();
    }

    public function generatePDF_alta_tension($fecha1, $fecha2)
    {
        $fecha_1 = Fechas::where('id', $fecha1)->first();
        $fecha_2 = Fechas::where('id', $fecha2)->first();
        if ($fecha_1 > $fecha_2) {
            $data1 = Energia_recibida::join('fechas', 'energia_recibida.id_fecha', '=', 'fechas.id')
                ->join('puntos', 'energia_recibida.id_punto', '=', 'puntos.id')
                ->select('energia_recibida.id as idr', 'energia_recibida.energia as energia', 'fechas.fecha', 'puntos.*')
                ->whereBetween('id_fecha', [$fecha2, $fecha1])
                ->orderBy('energia_recibida.id')
                ->get();
            $total1 = $data1->sum('energia');
            $data2 = Energia_entregada::join('fechas', 'energia_entregada.id_fecha', '=', 'fechas.id')
                ->join('puntos', 'energia_entregada.id_punto', '=', 'puntos.id')
                ->select('energia_entregada.id as ide', 'energia_entregada.energia as energia', 'fechas.fecha', 'puntos.*')
                ->whereBetween('id_fecha', [$fecha2, $fecha1])
                ->orderBy('energia_entregada.id')
                ->get();
            $total2 = $data2->sum('energia');
        } else {
            $data1 = Energia_recibida::join('fechas', 'energia_recibida.id_fecha', '=', 'fechas.id')
                ->join('puntos', 'energia_recibida.id_punto', '=', 'puntos.id')
                ->select('energia_recibida.id as idr', 'energia_recibida.energia as energia', 'fechas.fecha', 'puntos.*')
                ->whereBetween('id_fecha', [$fecha1, $fecha2])
                ->orderBy('energia_recibida.id')
                ->get();
            $total1 = $data1->sum('energia');
            $data2 = Energia_entregada::join('fechas', 'energia_entregada.id_fecha', '=', 'fechas.id')
                ->join('puntos', 'energia_entregada.id_punto', '=', 'puntos.id')
                ->select('energia_entregada.id as ide', 'energia_entregada.energia as energia', 'fechas.fecha', 'puntos.*')
                ->whereBetween('id_fecha', [$fecha1, $fecha2])
                ->orderBy('energia_entregada.id')
                ->get();
            $total2 = $data2->sum('energia');
        }
        $pdf = Pdf::loadView('myPDF2', compact('data1', 'data2', 'fecha_1', 'fecha_2', 'total1', 'total2'));
        return $pdf->stream();
    }
    public function generatePDF_media_tension($fecha1, $fecha2)
    {
        $fecha_1 = Fechas::where('id', $fecha1)->first();
        $fecha_2 = Fechas::where('id', $fecha2)->first();
        if ($fecha_1 > $fecha_2) {
            $data1 = Energia_sub_mt::select(
                'energia_sub_mt.id as ID',
                'sub_ermt.id AS ids',
                'cipes_mt.codigo AS cipe',
                'subestaciones.nombre AS subestacion',
                'puntos_intercambio.codigo AS punto',
                'medidores.numero AS medidor',
                'tc.rtc AS rtc',
                'tp.rtp AS rtp',
                'f.fecha AS fecha',
                'energia_sub_mt.energia as energias'
            )
                ->join('fechas as f', 'energia_sub_mt.id_fecha', '=', 'f.id')
                ->join('sub_ermt', 'energia_sub_mt.id_sub_ermt', '=', 'sub_ermt.id')  // Primero se une con sub_ermt
                ->join('cipes_mt', 'sub_ermt.id_cipe', '=', 'cipes_mt.id')
                ->join('subestaciones', 'sub_ermt.id_sub', '=', 'subestaciones.id')
                ->join('puntos_intercambio', 'sub_ermt.id_punto_i', '=', 'puntos_intercambio.id')
                ->join('medidores', 'sub_ermt.id_medidor', '=', 'medidores.id')
                ->join('tc', 'sub_ermt.id_tc', '=', 'tc.id')
                ->join('tp', 'sub_ermt.id_tp', '=', 'tp.id')
                ->whereBetween('id_fecha', [$fecha2, $fecha1])
                ->orderBy('energia_sub_mt.id', 'asc')
                ->get();
            $total1 = $data1->sum('energias');
            $data2 = E_r_mt::with(['zona', 'fecha'])
                ->join('fechas as f', 'e_r_mt.id_fecha', '=', 'f.id')
                ->join('zona_er_mt as z', 'e_r_mt.id_zona', '=', 'z.id')
                ->select('z.id as Código', 'z.nombre as Fuente', 'f.fecha as Fecha', 'e_r_mt.energia as Energia', 'e_r_mt.id as ID')
                ->whereBetween('id_fecha', [$fecha2, $fecha1])
                ->orderBy('e_r_mt.id', 'asc')
                ->get();
            $total2 = $data2->sum('Energia');
            $data3 = E_e_mt::with(['zona', 'fecha'])
                ->join('fechas as f', 'e_e_mt.id_fecha', '=', 'f.id')
                ->join('zona_ee_mt as z', 'e_e_mt.id_zona', '=', 'z.id')
                ->select('z.id as Código', 'z.nombre as Fuente', 'f.fecha as Fecha', 'e_e_mt.energia as Energia', 'e_e_mt.id as ID')
                ->whereBetween('id_fecha', [$fecha2, $fecha1])
                ->orderBy('e_e_mt.id', 'asc')
                ->get();
            $total3 = $data3->sum('Energia');
        } else {
            $data1 = Energia_sub_mt::select(
                'energia_sub_mt.id as ID',
                'sub_ermt.id AS ids',
                'cipes_mt.codigo AS cipe',
                'subestaciones.nombre AS subestacion',
                'puntos_intercambio.codigo AS punto',
                'medidores.numero AS medidor',
                'tc.rtc AS rtc',
                'tp.rtp AS rtp',
                'f.fecha AS fecha',
                'energia_sub_mt.energia as energias'
            )
                ->join('fechas as f', 'energia_sub_mt.id_fecha', '=', 'f.id')
                ->join('sub_ermt', 'energia_sub_mt.id_sub_ermt', '=', 'sub_ermt.id')  // Primero se une con sub_ermt
                ->join('cipes_mt', 'sub_ermt.id_cipe', '=', 'cipes_mt.id')
                ->join('subestaciones', 'sub_ermt.id_sub', '=', 'subestaciones.id')
                ->join('puntos_intercambio', 'sub_ermt.id_punto_i', '=', 'puntos_intercambio.id')
                ->join('medidores', 'sub_ermt.id_medidor', '=', 'medidores.id')
                ->join('tc', 'sub_ermt.id_tc', '=', 'tc.id')
                ->join('tp', 'sub_ermt.id_tp', '=', 'tp.id')
                ->whereBetween('id_fecha', [$fecha1, $fecha2])
                ->orderBy('energia_sub_mt.id', 'asc')
                ->get();
            $total1 = $data1->sum('energias');
            $data2 = E_r_mt::with(['zona', 'fecha'])
                ->join('fechas as f', 'e_r_mt.id_fecha', '=', 'f.id')
                ->join('zona_er_mt as z', 'e_r_mt.id_zona', '=', 'z.id')
                ->select('z.id as Código', 'z.nombre as Fuente', 'f.fecha as Fecha', 'e_r_mt.energia as Energia', 'e_r_mt.id as ID')
                ->whereBetween('id_fecha', [$fecha1, $fecha2])
                ->orderBy('e_r_mt.id', 'asc')
                ->get();
            $total2 = $data2->sum('Energia');
            $data3 = E_e_mt::with(['zona', 'fecha'])
                ->join('fechas as f', 'e_e_mt.id_fecha', '=', 'f.id')
                ->join('zona_ee_mt as z', 'e_e_mt.id_zona', '=', 'z.id')
                ->select('z.id as Código', 'z.nombre as Fuente', 'f.fecha as Fecha', 'e_e_mt.energia as Energia', 'e_e_mt.id as ID')
                ->whereBetween('id_fecha', [$fecha1, $fecha2])
                ->orderBy('e_e_mt.id', 'asc')
                ->get();
            $total3 = $data3->sum('Energia');
        }

        $pdf = Pdf::loadView('myPDF3', compact('data1', 'data2', 'data3', 'fecha_1', 'fecha_2', 'total1', 'total2', 'total3'))->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
    public function generatePDF_subestaciones($fecha1, $fecha2)
    {
        $fecha_1 = Fechas::where('id', $fecha1)->first();
        $fecha_2 = Fechas::where('id', $fecha2)->first();
        if ($fecha_1 > $fecha_2) {
            $data1 = Consumo::join('fechas', 'consumo.id_fecha', '=', 'fechas.id')
                ->join('circuito', 'consumo.id_circuito', '=', 'circuito.id_circuito')
                ->select('circuito.id_circuito as ipm', 'circuito.nombre as nombre', 'fechas.fecha as fecha', 'consumo.energia as energia', 'consumo.id as ID')
                ->whereBetween('id_fecha', [$fecha2, $fecha1])
                ->orderBy('consumo.id')
                ->get();
            $total1 = $data1->sum('energia');
        } else {
            $data1 = Consumo::join('fechas', 'consumo.id_fecha', '=', 'fechas.id')
                ->join('circuito', 'consumo.id_circuito', '=', 'circuito.id_circuito')
                ->select('circuito.id_circuito as ipm', 'circuito.nombre as nombre', 'fechas.fecha as fecha', 'consumo.energia as energia', 'consumo.id as ID')
                ->whereBetween('id_fecha', [$fecha1, $fecha2])
                ->orderBy('consumo.id')
                ->get();
            $total1 = $data1->sum('energia');
        }
        $pdf = Pdf::loadView('myPDF4', compact('data1', 'fecha_1', 'fecha_2', 'total1'));
        return $pdf->stream();
    }
}
