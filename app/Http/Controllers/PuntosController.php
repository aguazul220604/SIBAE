<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puntos;
use App\Models\Zonas;
use App\Models\Entidad;
use Illuminate\Support\Facades\Auth;


class PuntosController extends Controller
{
    public function puntos()
    {
        //
        $puntos = Puntos::all();

        $puntos1 = Puntos::join('zonas', 'zonas.id', '=', 'puntos.id_zona')
            ->join('entidad', 'entidad.id', '=', 'puntos.id_entidad')
            ->select('puntos.id', 'puntos.cipe', 'puntos.nombre', 'puntos.tipo', 'zonas.id as idz', 'zonas.zona', 'entidad.id as ide', 'entidad.descripcion')
            ->where('puntos.id_zona', 1)
            ->get();
        $puntos2 = Puntos::join('zonas', 'zonas.id', '=', 'puntos.id_zona')
            ->join('entidad', 'entidad.id', '=', 'puntos.id_entidad')
            ->select('puntos.id', 'puntos.cipe', 'puntos.nombre', 'puntos.tipo', 'zonas.id as idz', 'zonas.zona', 'entidad.id as ide', 'entidad.descripcion')
            ->where('puntos.id_zona', 2)
            ->get();
        $puntos3 = Puntos::join('zonas', 'zonas.id', '=', 'puntos.id_zona')
            ->join('entidad', 'entidad.id', '=', 'puntos.id_entidad')
            ->select('puntos.id', 'puntos.cipe', 'puntos.nombre', 'puntos.tipo', 'zonas.id as idz', 'zonas.zona', 'entidad.id as ide', 'entidad.descripcion')
            ->where('puntos.id_zona', 3)
            ->get();
        $puntos4 = Puntos::join('zonas', 'zonas.id', '=', 'puntos.id_zona')
            ->join('entidad', 'entidad.id', '=', 'puntos.id_entidad')
            ->select('puntos.id', 'puntos.cipe', 'puntos.nombre', 'puntos.tipo', 'zonas.id as idz', 'zonas.zona', 'entidad.id as ide', 'entidad.descripcion')
            ->where('puntos.id_zona', 4)
            ->get();

        $zonas = Zonas::all();
        $entidades = Entidad::all();

        $usuarioActivo = Auth::user();

        return view('sistema.puntos.puntos', compact('puntos1', 'puntos2', 'puntos3', 'puntos4', 'usuarioActivo', 'zonas', 'entidades'));
    }

    public function guardar1(Request $request)
    {
        $validacion = $request->validate([
            'cipe' => 'required',
            'nombre' => 'required',
            'id_entidad' => 'required',
            'id_zona' => 'required',
        ]);

        $puntos = new Puntos();
        $puntos->cipe = $request->input('cipe');
        $puntos->nombre = $request->input('nombre');
        $puntos->id_entidad = $request->input('id_entidad');
        $puntos->id_zona = $request->input('id_zona');
        if ($puntos->save()) {
            return back()->with('message', 'ok');
        } else {
            return back()->withErrors(['error' => 'Error']);
        }
    }


    public function update1(Request $request, string $id)
    {
        $validacion = $request->validate([
            'cipe' => 'required',
            'nombre' => 'required',
            'id_entidad' => 'required',
            'id_zona' => 'required',
        ]);

        $puntos = Puntos::find($id);
        $puntos->cipe = $request->input('cipe');
        $puntos->nombre = $request->input('nombre');
        $puntos->id_entidad = $request->input('id_entidad');
        $puntos->id_zona = $request->input('id_zona');

        if ($puntos->save()) {
            return back()->with('message1', 'update1');
        } else {
            return back()->with(['message1' => 'error1']);
        }
    }


    public function update2(Request $request, string $id)
    {
        $validacion = $request->validate([
            'cipe' => 'required',
            'nombre' => 'required',
            'id_entidad' => 'required',
            'id_zona' => 'required',
        ]);

        $puntos = Puntos::find($id);
        $puntos->cipe = $request->input('cipe');
        $puntos->nombre = $request->input('nombre');
        $puntos->id_entidad = $request->input('id_entidad');
        $puntos->id_zona = $request->input('id_zona');

        if ($puntos->save()) {
            return back()->with('message2', 'update2');
        } else {
            return back()->with(['message2' => 'error2']);
        }
    }


    public function update3(Request $request, string $id)
    {
        $validacion = $request->validate([
            'cipe' => 'required',
            'nombre' => 'required',
            'id_entidad' => 'required',
            'id_zona' => 'required',
        ]);

        $puntos = Puntos::find($id);
        $puntos->cipe = $request->input('cipe');
        $puntos->nombre = $request->input('nombre');
        $puntos->id_entidad = $request->input('id_entidad');
        $puntos->id_zona = $request->input('id_zona');

        if ($puntos->save()) {
            return back()->with('message3', 'update3');
        } else {
            return back()->with(['message3' => 'error3']);
        }
    }


    public function update4(Request $request, string $id)
    {
        $validacion = $request->validate([
            'cipe' => 'required',
            'nombre' => 'required',
            'id_entidad' => 'required',
            'id_zona' => 'required',
        ]);

        $puntos = Puntos::find($id);
        $puntos->cipe = $request->input('cipe');
        $puntos->nombre = $request->input('nombre');
        $puntos->id_entidad = $request->input('id_entidad');
        $puntos->id_zona = $request->input('id_zona');

        if ($puntos->save()) {
            return back()->with('message4', 'update4');
        } else {
            return back()->with(['message4' => 'error4']);
        }
    }


    public function destroy1($id)
    {
        $puntos = Puntos::findOrFail($id);
        $puntos->delete();
        return back();
    }
}
