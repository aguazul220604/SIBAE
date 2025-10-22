<?php

namespace App\Http\Controllers;

use App\Mail\ClienteRegistrado;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class ClienteController extends Controller
{
    public function create()
    {
        $clientes = User::all();
        $usuarioActivo = Auth::user(); // Obtén el usuario autenticado
        return view('sistema.addUsuario', compact('clientes', 'usuarioActivo'));
    }
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:75',
            'correo' => 'required|email|unique:users,email|max:75',
            'área' => 'required',
            'permisos' => 'required',
        ]);
        $nombre = $request->input('nombre');
        $correo = $request->input('correo');
        $area = $request->input('área');
        $permisos = $request->input('permisos');

        $contraseña = ("CFE" . strlen($nombre) . strtoupper(substr($nombre, 0, 2)) . strlen($correo) . strtoupper(substr($correo, 0, 3)));
        $contraseña1 = Hash::make($contraseña);

        $cliente = new User();
        $cliente->name = $nombre;
        $cliente->email = $correo;
        $cliente->password = $contraseña1;
        $cliente->area = $area;
        $cliente->privilegios = $permisos;

        if ($cliente->save()) {
            Mail::to($correo)->send(new ClienteRegistrado($nombre, $contraseña));
            return back()->with('message', 'ok');
        } else {
            return back()->withErrors(['error' => 'Error']);
        }
    }
    public function update(Request $request, string $id)
    {
        $validacion = $request->validate([
            'Nombre' => 'required',
            'Correo' => 'required',
            'Área' => 'required',
            'Permisos' => 'required',
        ]);
        $cliente = User::find($id);
        $cliente->name = $request->input('Nombre');
        $cliente->email = $request->input('Correo');
        $cliente->area = $request->input('Área');
        $cliente->privilegios = $request->input('Permisos');
        if ($cliente->save()) {
            return back()->with('message', 'update');
        } else {
            return back()->with(['message' => 'error']);
        }
    }
    public function destroy(string $id)
    {
        $cliente = User::find($id);
        $cliente->delete();
        return back();
    }
}
