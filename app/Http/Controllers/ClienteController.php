<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Direccion;

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

        // Actualizar los datos personales
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->dni = $request->dni;
        $usuario->email = $request->email;

        // Lógica para los datos de envío
        // Comprobamos si el usuario escribió algo en los campos de dirección
        if ($request->filled('direccion') || $request->filled('provincia') || $request->filled('localidad') || $request->filled('codigo_postal')) {
            
            if ($usuario->direccion_id) {
                // Si ya tiene una dirección asignada, simplemente se actualiza
                $usuario->miDireccion->update([
                    'direccion'     => $request->direccion,
                    'provincia'     => $request->provincia,
                    'localidad'     => $request->localidad,
                    'codigo_postal' => $request->codigo_postal,
                ]);
            } else {
                // Si es la primera vez que guarda una dirección, se crea el registro
                $nuevaDireccion = \App\Models\Direccion::create([
                    'direccion'     => $request->direccion,
                    'provincia'     => $request->provincia,
                    'localidad'     => $request->localidad,
                    'codigo_postal' => $request->codigo_postal,
                ]);
                
                // Le asignamos el ID de esta nueva dirección a nuestro usuario
                $usuario->direccion_id = $nuevaDireccion->id;
            }
        }

        // Guarda los cambios en el modelo usuario (se guarda el nombre, etc. y el direccion_id si es nuevo)
        $usuario->save();

        return redirect()
            ->route('cliente.cuenta')
            ->with('success', 'Datos y dirección actualizados correctamente');
    }

    
}
