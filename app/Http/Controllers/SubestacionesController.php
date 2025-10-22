<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Fechas;
use App\Models\Years;
use App\Models\Meses;
use App\Models\Consumo;
use App\Models\Circuito;
use App\Models\Suma_total;
use App\Models\Porcentaje_perdesv;
use Illuminate\Http\Request;

class SubestacionesController extends Controller
{
    public function create(Request $request)
    {
        $usuarioActivo = Auth::user();

        //Acumulador
        $registro = 0;
        //Fecha por defecto (Formulario)
        $year1 = $request->input('year', 23);
        $id_mes = $request->input('mes', 1);

        //Consulta de fecha
        $idFecha = Fechas::where('id_mes', $id_mes)->where('id_year', $year1)->first();

        //Filtro de datos
        $years = Years::where('id', '>', 22)->get();
        $meses = Meses::all();

        $circuitos = Circuito::all();

        //Humedades
        $circuito1 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 1)->first();
        $circuito2 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 2)->first();
        $circuito3 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 3)->first();
        $circuito4 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 4)->first();
        $circuito5 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 5)->first();
        //Humedades-Respaldo
        $circuito6 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 6)->first();
        $circuito7 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 7)->first();

        //Huichapan
        $circuito8 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 8)->first();
        $circuito9 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 9)->first();
        $circuito10 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 10)->first();
        $circuito11 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 11)->first();
        $circuito12 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 12)->first();
        //Huichapan-Respaldo
        $circuito13 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 13)->first();

        //Tecozautla
        $circuito14 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 14)->first();
        $circuito15 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 15)->first();
        //Tecozautla-Respaldo1
        $circuito16 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 16)->first();
        //Tecozautla
        $circuito17 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 17)->first();
        $circuito18 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 18)->first();
        $circuito19 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 19)->first();
        //Tecozautla-Respaldo2
        $circuito20 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 20)->first();

        //Zimapán
        $circuito21 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 21)->first();
        $circuito22 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 22)->first();
        //Zimapán-Respaldo1
        $circuito23 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 23)->first();
        //Zimapán
        $circuito24 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 24)->first();
        $circuito25 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 25)->first();
        //Zimapán-Respaldo2
        $circuito26 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 26)->first();
        //Zimapán
        $circuito27 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 27)->first();
        //Zimapán-Respaldo3
        $circuito28 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 28)->first();

        //CEMEX
        $circuito29 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 29)->first();

        //PEMEX
        $circuito30 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 30)->first();

        //Humedades
        $circuito31 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 31)->first();

        //Tecozautla
        $circuito32 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 32)->first();
        $circuito33 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 33)->first();

        //Zimapán
        $circuito34 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 34)->first();
        $circuito35 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 35)->first();
        $circuito36 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 36)->first();

        //Casa de Máquinas
        $circuito37 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 37)->first();
        $circuito38 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 38)->first();

        //Cerro Boludo
        $circuito39 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 39)->first();

        //Juandho
        $circuito40 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 40)->first();

        //Extras añadidos
        $circuito41 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 41)->first();
        $circuito42 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 42)->first();
        $circuito43 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 43)->first();
        $circuito44 = Consumo::where('id_fecha', $idFecha->id)->where('id_circuito', 44)->first();


        //Pérdidas y desviaciones
        $ppd1 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 1)->first();
        $ppd2 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 2)->first();
        $ppd3 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 3)->first();
        $ppd4 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 4)->first();
        $ppd5 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 5)->first();
        $ppd6 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 6)->first();
        $ppd7 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 7)->first();
        $ppd8 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 8)->first();
        $ppd9 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 9)->first();
        $ppd10 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 10)->first();
        $ppd11 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 11)->first();
        $ppd12 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 12)->first();
        $ppd13 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 13)->first();
        $ppd14 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 14)->first();
        $ppd15 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->where('id_perdesv', 15)->first();

        //Totales
        $total1 = Suma_total::where('id_fecha', $idFecha->id)->where('id_total', 1)->first();
        $total2 = Suma_total::where('id_fecha', $idFecha->id)->where('id_total', 2)->first();
        $total3 = Suma_total::where('id_fecha', $idFecha->id)->where('id_total', 3)->first();
        $total4 = Suma_total::where('id_fecha', $idFecha->id)->where('id_total', 4)->first();

        // Energia total perdida
        $etp1 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)->sum('energia');

        $etp2 = Porcentaje_perdesv::where('id_fecha', $idFecha->id)
            ->where('id_perdesv', 9)
            ->first();

        $etp = $etp1 + ($etp2 ? $etp2->energia : 0);

        if ($idFecha) {
            $existeRegistro = Consumo::where('id_fecha', $idFecha->id)->exists();
            if ($existeRegistro) {
                $registro = $registro + 1;
            }
        }

        $consumos = Consumo::join('circuito as ci', 'consumo.id_circuito', '=', 'ci.id_circuito')
            ->select('consumo.id', 'consumo.id_fecha', 'consumo.id_circuito', 'consumo.energia', 'ci.nombre as circuito_nombre')
            ->where('consumo.id_fecha', '=', $idFecha->id)
            ->get();


        return view('sistema.subestaciones.subestaciones', compact(
            'meses',
            'years',
            'idFecha',
            'circuito1',
            'circuito2',
            'circuito3',
            'circuito4',
            'circuito5',
            'circuito6',
            'circuito7',
            'circuito8',
            'circuito9',
            'circuito10',
            'circuito11',
            'circuito12',
            'circuito13',
            'circuito14',
            'circuito15',
            'circuito16',
            'circuito17',
            'circuito18',
            'circuito19',
            'circuito20',
            'circuito21',
            'circuito22',
            'circuito23',
            'circuito24',
            'circuito25',
            'circuito26',
            'circuito27',
            'circuito28',
            'circuito29',
            'circuito30',
            'circuito31',
            'circuito32',
            'circuito33',
            'circuito34',
            'circuito35',
            'circuito36',
            'circuito37',
            'circuito38',
            'circuito39',
            'circuito40',
            'circuito41',
            'circuito42',
            'circuito43',
            'circuito44',
            'ppd1',
            'ppd2',
            'ppd3',
            'ppd4',
            'ppd5',
            'ppd6',
            'ppd7',
            'ppd8',
            'ppd9',
            'ppd10',
            'ppd11',
            'ppd12',
            'ppd13',
            'ppd14',
            'ppd15',
            'total1',
            'total2',
            'total3',
            'total4',
            'registro',
            'circuitos',
            'year1',
            'id_mes',
            'usuarioActivo',
            'etp',
            'consumos'
        ));
    }
    public function guardar(Request $request)
    {
        $id_year = $request->input('year');
        $mes = $request->input('mes');
        $idCircuitos = $request->input('idc');
        $idFecha = $request->input('idfecha');
        $Energias = $request->input('energia');

        if (count($idCircuitos) !== count($Energias)) {
            return redirect()->back()->withErrors(['Datos incompletos o desalineados']);
        }

        $errors = [];

        foreach ($idCircuitos as $index => $idCircuito) {
            $Energia = $Energias[$index];

            // Si $Energia es null o está vacío, asignar 0
            if ($Energia === null || $Energia === '') {
                $Energia = 0;
            }

            $ConsumoSubestaciones = new Consumo();
            $ConsumoSubestaciones->id_fecha = $idFecha;
            $ConsumoSubestaciones->id_circuito = $idCircuito;
            $ConsumoSubestaciones->energia = $Energia;

            if (!$ConsumoSubestaciones->save()) {
                $errors[] = "Error al guardar el consumo para el circuito ID $idCircuito.";
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        return redirect()->back()->with('message', 'ok');
    }
    public function update(Request $request)
    {
        $id_year = $request->input('year');
        $mes = $request->input('mes');
        $idCircuitos = $request->input('idc');
        $idFecha = $request->input('idfecha');
        $Energias = $request->input('energia');

        if (count($idCircuitos) !== count($Energias)) {
            return redirect()->back()->withErrors(['Datos incompletos o desalineados']);
        }

        $errors = [];

        foreach ($idCircuitos as $index => $idCircuito) {
            $energia = $Energias[$index];

            // Si $energia es null o está vacío, asignar 0
            if ($energia === null || $energia === '') {
                $energia = 0;
            }

            // Buscar el registro basado en id_fecha y id_circuito
            $consumoSubestaciones = Consumo::where('id_fecha', $idFecha)
                ->where('id_circuito', $idCircuito)
                ->first();

            if ($consumoSubestaciones) {
                $consumoSubestaciones->energia = $energia;
                $consumoSubestaciones->save();
            } else {
                $errors[] = "No se encontró el registro para el circuito $idCircuito en la fecha $idFecha";
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        return redirect()->back()->with('message', 'update');
    }
    public function updateimage(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'img.required' => 'Foto no seleccionada',
        ]);

        $idCircuito = $request->input('idc');

        try {
            // Obtener el circuito
            $circuito = Circuito::findOrFail($idCircuito);

            // Verificar si se ha subido una imagen
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('vendor/adminlte/dist/img');
                $file->move($destinationPath, $fileName);

                // Actualizar el registro de la imagen en la base de datos
                $circuito->img = $fileName;
            }

            // Actualizar otros campos del formulario
            $circuito->marca_medidor = $request->input('mar_med');
            $circuito->num_medidor = $request->input('num_med');
            $circuito->ip_medidor = $request->input('ip_med');
            $circuito->rtc_medidor = $request->input('rtc_med');
            $circuito->rtp_medidor = $request->input('rtp_med');
            $circuito->modelo_medidor = $request->input('mod_med');
            $circuito->tension_medidor = $request->input('ten_med');
            $circuito->poblado = $request->input('pob_med');
            $circuito->save();

            return redirect()->back()->with('message', 'ok1');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar los datos: ' . $e->getMessage());
        }
    }
}
