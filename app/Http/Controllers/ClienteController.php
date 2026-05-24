<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class ClienteController extends Controller
{
    public function cuenta()
    {
        $usuario = Auth::user();

        return view('backend.cliente.cuentaCliente', compact('usuario'));
    }

    public function actualizar(Request $request)
    {
        $usuario = Usuario::find(Auth::id());

        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->dni = $request->dni;
        $usuario->email = $request->email;

        $usuario->save();

        return redirect()
            ->route('cliente.cuenta')
            ->with('success', 'Datos actualizados correctamente');
    }
}
