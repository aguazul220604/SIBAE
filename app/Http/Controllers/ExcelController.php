<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fechas;
use App\Models\Ventas;
use App\Models\Energia_recibida;
use App\Models\Energia_entregada;
use App\Models\Energia_sub_mt;
use App\Models\E_r_mt;
use App\Models\E_e_mt;
use App\Models\Consumo;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends Controller
{
    public function generateXLSX_ventas($fecha1, $fecha2)
    {
        // Obtén los registros de fecha
        $fecha_1 = Fechas::where('id', $fecha1)->first();
        $fecha_2 = Fechas::where('id', $fecha2)->first();

        // Crea una nueva instancia de Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establece los encabezados
        $sheet->setCellValue('A1', 'SIBAE: Sistema de Gestión de Balance de Energía');
        $sheet->setCellValue('A2', 'Registro de información: VENTAS');
        $sheet->setCellValue('A3', 'Periodo de consulta: ' . $fecha_1->fecha . ' - ' . $fecha_2->fecha);


        if ($fecha2 > $fecha1) {
            $rango = [$fecha1, $fecha2];
        } else {
            $rango = [$fecha2, $fecha1];
        }

        // Obtén los datos de ventas
        $data1 = Ventas::join('fechas', 'ventas.id_fecha', '=', 'fechas.id')
            ->join('tarifas', 'ventas.id_tarifa', '=', 'tarifas.id')
            ->select('tarifas.codigo as codigo', 'tarifas.descripcion as descripcion', 'fechas.fecha as fecha', 'ventas.monto as monto', 'ventas.id as ID')
            ->whereBetween('id_fecha', [$rango[0], $rango[1]])
            ->orderBy('ventas.id')
            ->get();

        $total = $data1->sum('monto');
        $sheet->setCellValue('A4', 'Energía total facturada (KWh): ' . number_format($total, 0, '.', ','));

        // Establece los encabezados de la tabla
        $sheet->setCellValue('A6', 'ID_Tarifa');
        $sheet->setCellValue('B6', 'Tarifa');
        $sheet->setCellValue('C6', 'Fecha');
        $sheet->setCellValue('D6', 'Monto');
        $sheet->setCellValue('E6', 'ID_Venta');

        // Define el estilo para el color de relleno gris
        $headerStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'D3D3D3', // Gris claro
                ],
            ],
            'font' => [
                'bold' => true,
            ],
        ];

        // Aplica el estilo solo a las celdas de encabezado
        $sheet->getStyle('A6:E6')->applyFromArray($headerStyle);

        // Rellena los datos
        $row = 7;
        foreach ($data1 as $venta) {
            $sheet->setCellValue('A' . $row, $venta->codigo);
            $sheet->setCellValue('B' . $row, $venta->descripcion);
            $sheet->setCellValue('C' . $row, $venta->fecha);
            $sheet->setCellValue('D' . $row, number_format($venta->monto, 0, '.', ','));
            $sheet->setCellValue('E' . $row, $venta->ID);
            $row++;
        }

        // Ajustar el ancho de las columnas automáticamente
        foreach (['B', 'C', 'D', 'E'] as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Alinear todo el texto a la izquierda
        $textStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];

        $sheet->getStyle('A1:E' . ($row - 1))->applyFromArray($textStyle);

        // Crea el writer y guarda el archivo
        $writer = new Xlsx($spreadsheet);
        $filename = 'ventas_' . $fecha1 . '_' . $fecha2 . '.xlsx';
        $filePath = storage_path('app/public/' . $filename);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    public function generateXLSX_alta_tension($fecha1, $fecha2)
    {
        // Obtén los registros de fecha
        $fecha_1 = Fechas::where('id', $fecha1)->first();
        $fecha_2 = Fechas::where('id', $fecha2)->first();

        // Crea una nueva instancia de Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establece los encabezados
        $sheet->setCellValue('A1', 'SIBAE: Sistema de Gestión de Balance de Energía');
        $sheet->setCellValue('A2', 'Registro de información: ALTA TENSIÓN');
        $sheet->setCellValue('A3', 'Periodo de consulta: ' . $fecha_1->fecha . ' - ' . $fecha_2->fecha);

        if ($fecha2 > $fecha1) {
            $rango = [$fecha1, $fecha2];
        } else {
            $rango = [$fecha2, $fecha1];
        }

        // Datos ER
        $data1 = Energia_recibida::join('fechas', 'energia_recibida.id_fecha', '=', 'fechas.id')
            ->join('puntos', 'energia_recibida.id_punto', '=', 'puntos.id')
            ->select('energia_recibida.id as idr', 'energia_recibida.energia as energia', 'fechas.fecha', 'puntos.*')
            ->whereBetween('id_fecha', [$rango[0], $rango[1]])
            ->orderBy('energia_recibida.id')
            ->get();
        $total1 = $data1->sum('energia');

        // Datos EE
        $data2 = Energia_entregada::join('fechas', 'energia_entregada.id_fecha', '=', 'fechas.id')
            ->join('puntos', 'energia_entregada.id_punto', '=', 'puntos.id')
            ->select('energia_entregada.id as ide', 'energia_entregada.energia as energia', 'fechas.fecha', 'puntos.*')
            ->whereBetween('id_fecha', [$rango[0], $rango[1]])
            ->orderBy('energia_entregada.id')
            ->get();
        $total2 = $data2->sum('energia');

        $sheet->setCellValue('A5', 'Energía recibida');
        $sheet->setCellValue('A6', 'Energía total recibida (KWh): ' . number_format($total1, 0, '.', ','));

        $sheet->setCellValue('G5', 'Energía entregada');
        $sheet->setCellValue('G6', 'Energía total entregada (KWh): ' . number_format($total2, 0, '.', ','));

        // Establece los encabezados de la tabla1
        $sheet->setCellValue('A8', 'ID');
        $sheet->setCellValue('B8', 'CIPE');
        $sheet->setCellValue('C8', 'Punto');
        $sheet->setCellValue('D8', 'Fecha');
        $sheet->setCellValue('E8', 'Energía (KWh)');

        // Establece los encabezados de la tabla2
        $sheet->setCellValue('G8', 'ID');
        $sheet->setCellValue('H8', 'CIPE');
        $sheet->setCellValue('I8', 'Punto');
        $sheet->setCellValue('J8', 'Fecha');
        $sheet->setCellValue('K8', 'Energía (KWh)');

        // Define el estilo para el color de relleno gris
        $headerStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'D3D3D3', // Gris claro
                ],
            ],
            'font' => [
                'bold' => true,
            ],
        ];

        // Aplica el estilo solo a las celdas de encabezado
        $sheet->getStyle('A8:E8')->applyFromArray($headerStyle);
        $sheet->getStyle('G8:K8')->applyFromArray($headerStyle);

        // Rellena los datos
        $row1 = 9;
        foreach ($data1 as $er) {
            $sheet->setCellValue('A' . $row1, $er->idr);
            $sheet->setCellValue('B' . $row1, $er->cipe);
            $sheet->setCellValue('C' . $row1, $er->nombre);
            $sheet->setCellValue('D' . $row1, $er->fecha);
            $sheet->setCellValue('E' . $row1, number_format($er->energia, 0, '.', ','));
            $row1++;
        }

        $row2 = 9;
        foreach ($data2 as $ee) {
            $sheet->setCellValue('G' . $row2, $ee->ide);
            $sheet->setCellValue('H' . $row2, $ee->cipe);
            $sheet->setCellValue('I' . $row2, $ee->nombre);
            $sheet->setCellValue('J' . $row2, $ee->fecha);
            $sheet->setCellValue('K' . $row2, number_format($ee->energia, 0, '.', ','));
            $row2++;
        }

        // Ajustar el ancho de las columnas automáticamente
        foreach (['B', 'C', 'D', 'E', 'H', 'I', 'J', 'K'] as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Alinear todo el texto a la izquierda
        $textStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];

        $sheet->getStyle('A1:K' . ($row2 - 1))->applyFromArray($textStyle);

        // Crea el writer y guarda el archivo
        $writer = new Xlsx($spreadsheet);
        $filename = 'alta_tension_' . $fecha1 . '_' . $fecha2 . '.xlsx';
        $filePath = storage_path('app/public/' . $filename);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    public function generateXLSX_media_tension($fecha1, $fecha2)
    {
        // Obtén los registros de fecha
        $fecha_1 = Fechas::where('id', $fecha1)->first();
        $fecha_2 = Fechas::where('id', $fecha2)->first();

        // Crea una nueva instancia de Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establece los encabezados
        $sheet->setCellValue('A1', 'SIBAE: Sistema de Gestión de Balance de Energía');
        $sheet->setCellValue('A2', 'Registro de información: MEDIA TENSIÓN');
        $sheet->setCellValue('A3', 'Periodo de consulta: ' . $fecha_1->fecha . ' - ' . $fecha_2->fecha);

        if ($fecha2 > $fecha1) {
            $rango = [$fecha1, $fecha2];
        } else {
            $rango = [$fecha2, $fecha1];
        }

        // Datos ER
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
            ->whereBetween('id_fecha', [$rango[0], $rango[1]])
            ->orderBy('energia_sub_mt.id', 'asc')
            ->get();
        $total1 = $data1->sum('energias');
        $data2 = E_r_mt::with(['zona', 'fecha'])
            ->join('fechas as f', 'e_r_mt.id_fecha', '=', 'f.id')
            ->join('zona_er_mt as z', 'e_r_mt.id_zona', '=', 'z.id')
            ->select('z.id as Código', 'z.nombre as Fuente', 'f.fecha as Fecha', 'e_r_mt.energia as Energia', 'e_r_mt.id as ID')
            ->whereBetween('id_fecha', [$rango[0], $rango[1]])
            ->orderBy('e_r_mt.id', 'asc')
            ->get();
        $total2 = $data2->sum('Energia');
        // Datos EE
        $data3 = E_e_mt::with(['zona', 'fecha'])
            ->join('fechas as f', 'e_e_mt.id_fecha', '=', 'f.id')
            ->join('zona_ee_mt as z', 'e_e_mt.id_zona', '=', 'z.id')
            ->select('z.id as Código', 'z.nombre as Fuente', 'f.fecha as Fecha', 'e_e_mt.energia as Energia', 'e_e_mt.id as ID')
            ->whereBetween('id_fecha', [$rango[0], $rango[1]])
            ->orderBy('e_e_mt.id', 'asc')
            ->get();
        $total3 = $data3->sum('Energia');

        $sheet->setCellValue('A5', 'Energía recibida: SUBESTACIONES');
        $sheet->setCellValue('A6', 'Energía total recibida (KWh): ' . number_format($total1, 0, '.', ','));

        $sheet->setCellValue('J5', 'Energía recibida: PUNTOS');
        $sheet->setCellValue('J6', 'Energía total recibida (KWh): ' . number_format($total2, 0, '.', ','));

        $sheet->setCellValue('O5', 'Energía entregada: PUNTOS');
        $sheet->setCellValue('O6', 'Energía total entregada (KWh): ' . number_format($total3, 0, '.', ','));

        // Establece los encabezados de la tabla1
        $sheet->setCellValue('A8', 'CIPE');
        $sheet->setCellValue('B8', 'Subestación');
        $sheet->setCellValue('C8', 'Punto');
        $sheet->setCellValue('D8', 'Medidor');
        $sheet->setCellValue('E8', 'RTC');
        $sheet->setCellValue('F8', 'RTP');
        $sheet->setCellValue('G8', 'Fecha');
        $sheet->setCellValue('H8', 'Energía (KWh)');

        // Establece los encabezados de la tabla2
        $sheet->setCellValue('J8', 'CIPE');
        $sheet->setCellValue('K8', 'Fuente');
        $sheet->setCellValue('L8', 'Fecha');
        $sheet->setCellValue('M8', 'Energía (KWh)');

        // Establece los encabezados de la tabla3
        $sheet->setCellValue('O8', 'CIPE');
        $sheet->setCellValue('P8', 'Fuente');
        $sheet->setCellValue('Q8', 'Fecha');
        $sheet->setCellValue('R8', 'Energía (KWh)');


        // Define el estilo para el color de relleno gris
        $headerStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'D3D3D3', // Gris claro
                ],
            ],
            'font' => [
                'bold' => true,
            ],
        ];

        // Aplica el estilo solo a las celdas de encabezado
        $sheet->getStyle('A8:H8')->applyFromArray($headerStyle);
        $sheet->getStyle('J8:M8')->applyFromArray($headerStyle);
        $sheet->getStyle('O8:R8')->applyFromArray($headerStyle);

        // Rellena los datos
        $row1 = 9;
        foreach ($data1 as $er1) {
            $sheet->setCellValue('A' . $row1, $er1->cipe);
            $sheet->setCellValue('B' . $row1, $er1->subestacion);
            $sheet->setCellValue('C' . $row1, $er1->punto);
            $sheet->setCellValue('D' . $row1, $er1->medidor);
            $sheet->setCellValue('E' . $row1, $er1->rtc);
            $sheet->setCellValue('F' . $row1, $er1->rtp);
            $sheet->setCellValue('G' . $row1, $er1->fecha);
            $sheet->setCellValue('H' . $row1, number_format($er1->energias, 0, '.', ','));
            $row1++;
        }

        $row2 = 9;
        foreach ($data2 as $er2) {
            $sheet->setCellValue('J' . $row2, $er2->Código);
            $sheet->setCellValue('K' . $row2, $er2->Fuente);
            $sheet->setCellValue('L' . $row2, $er2->Fecha);
            $sheet->setCellValue('M' . $row2, number_format($er2->Energia, 0, '.', ','));
            $row2++;
        }

        $row3 = 9;
        foreach ($data3 as $ee1) {
            $sheet->setCellValue('O' . $row3, $ee1->Código);
            $sheet->setCellValue('P' . $row3, $ee1->Fuente);
            $sheet->setCellValue('Q' . $row3, $ee1->Fecha);
            $sheet->setCellValue('R' . $row3, number_format($ee1->Energia, 0, '.', ','));
            $row3++;
        }

        // Ajustar el ancho de las columnas automáticamente
        foreach (['B', 'C', 'D', 'E', 'F', 'G', 'H', 'K', 'L', 'M', 'P', 'Q', 'R'] as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Alinear todo el texto a la izquierda
        $textStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];

        $sheet->getStyle('A1:R' . ($row3 - 1))->applyFromArray($textStyle);

        // Crea el writer y guarda el archivo
        $writer = new Xlsx($spreadsheet);
        $filename = 'media_tension_' . $fecha1 . '_' . $fecha2 . '.xlsx';
        $filePath = storage_path('app/public/' . $filename);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    public function generateXLSX_subestaciones($fecha1, $fecha2)
    {
        // Obtén los registros de fecha
        $fecha_1 = Fechas::where('id', $fecha1)->first();
        $fecha_2 = Fechas::where('id', $fecha2)->first();

        // Crea una nueva instancia de Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establece los encabezados
        $sheet->setCellValue('A1', 'SIBAE: Sistema de Gestión de Balance de Energía');
        $sheet->setCellValue('A2', 'Registro de información: SUBESTACIONES');
        $sheet->setCellValue('A3', 'Periodo de consulta: ' . $fecha_1->fecha . ' - ' . $fecha_2->fecha);

        if ($fecha2 > $fecha1) {
            $rango = [$fecha1, $fecha2];
        } else {
            $rango = [$fecha2, $fecha1];
        }

        // Obtén los datos de subestaciones
        $data1 = Consumo::join('fechas', 'consumo.id_fecha', '=', 'fechas.id')
            ->join('circuito', 'consumo.id_circuito', '=', 'circuito.id_circuito')
            ->select('circuito.id_circuito as ipm', 'circuito.nombre as nombre', 'fechas.fecha as fecha', 'consumo.energia as energia', 'consumo.id as ID')
            ->whereBetween('id_fecha', [$rango[0], $rango[1]])
            ->orderBy('consumo.id')
            ->get();
        $total1 = $data1->sum('energia');
        $sheet->setCellValue('A4', 'Energía total registrada (KWh): ' . number_format($total1, 0, '.', ','));

        // Establece los encabezados de la tabla
        $sheet->setCellValue('A6', 'IP_Medidor');
        $sheet->setCellValue('B6', 'Nombre');
        $sheet->setCellValue('C6', 'Fecha');
        $sheet->setCellValue('D6', 'Energía (KWh)');
        $sheet->setCellValue('E6', 'ID_Consumo');

        // Define el estilo para el color de relleno gris
        $headerStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'D3D3D3', // Gris claro
                ],
            ],
            'font' => [
                'bold' => true,
            ],
        ];

        // Aplica el estilo solo a las celdas de encabezado
        $sheet->getStyle('A6:E6')->applyFromArray($headerStyle);

        // Rellena los datos
        $row = 7;
        foreach ($data1 as $sub) {
            $sheet->setCellValue('A' . $row, $sub->ipm);
            $sheet->setCellValue('B' . $row, $sub->nombre);
            $sheet->setCellValue('C' . $row, $sub->fecha);
            $sheet->setCellValue('D' . $row, number_format($sub->energia, 0, '.', ','));
            $sheet->setCellValue('E' . $row, $sub->ID);
            $row++;
        }

        // Ajustar el ancho de las columnas automáticamente
        foreach (['B', 'C', 'D', 'E'] as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Alinear todo el texto a la izquierda
        $textStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ];

        $sheet->getStyle('A1:E' . ($row - 1))->applyFromArray($textStyle);

        // Crea el writer y guarda el archivo
        $writer = new Xlsx($spreadsheet);
        $filename = 'subestaciones_' . $fecha1 . '_' . $fecha2 . '.xlsx';
        $filePath = storage_path('app/public/' . $filename);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
