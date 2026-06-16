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
            
            $direccionActual = $usuario->miDireccion;
            $crearNueva = false;

            if (!$direccionActual) {
                // Si es la primera vez que guarda una dirección, se marca para crear
                $crearNueva = true;
            } else {
                // Si ya tiene una, verificamos si algún dato cambió
                if (
                    strtolower(trim($direccionActual->direccion)) !== strtolower(trim($request->direccion)) ||
                    strtolower(trim($direccionActual->provincia)) !== strtolower(trim($request->provincia)) ||
                    strtolower(trim($direccionActual->localidad)) !== strtolower(trim($request->localidad)) ||
                    trim($direccionActual->codigo_postal) !== trim($request->codigo_postal)
                ) {
                    $crearNueva = true;
                    // Archiva la dirección vieja (Soft Delete) para no romper el historial de envíos
                    $direccionActual->delete(); 
                }
            }

            if ($crearNueva) {
                // Creamos el nuevo registro inmutable
                $nuevaDireccion = \App\Models\Direccion::create([
                    'direccion'     => trim($request->direccion),
                    'provincia'     => trim($request->provincia),
                    'localidad'     => trim($request->localidad),
                    'codigo_postal' => trim($request->codigo_postal),
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
