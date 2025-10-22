<?php

namespace App\Http\Controllers;

use App\Models\Fechas;
use App\Models\Meses;
use App\Models\Balance_am_at;
use App\Models\Years;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SistemaController extends Controller
{
    public function historial(Request $request)
    {
        $usuarioActivo = Auth::user();
        // Obtiene los valores de los inputs, con valores por defecto si no se proporcionan
        $id_mes1 = $request->input('mes1', 1);
        $id_year1 = $request->input('year1', 18);
        $id_mes2 = $request->input('mes2', 12);
        $id_year2 = $request->input('year2', 18);

        $fecha1 = Fechas::where('id_mes', $id_mes1)->where('id_year', $id_year1)->first();
        $fecha2 = Fechas::where('id_mes', $id_mes2)->where('id_year', $id_year2)->first();


        // Obtiene todos los registros de Meses y Years
        $meses = Meses::all();
        $years = Years::all();
        $historico = Balance_am_at::all();

        // Pasa los datos a la vista
        return view('sistema.panel.historial', compact('historico', 'meses', 'years', 'fecha1', 'fecha2', 'usuarioActivo'));
    }

    public function reportes()
    {
        return view('sistema.panel.reportes');
    }
}
