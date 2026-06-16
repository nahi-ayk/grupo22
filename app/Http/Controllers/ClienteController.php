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
        if ($request->filled('direccion') || $request->filled('provincia') || $request->filled('localidad') || $request->filled('codigo_postal')) {
            
            
            $direccionActual = $usuario->direccion;
            
            // Limpiamos los inputs del formulario
            $dirReq  = trim($request->direccion);
            $provReq = trim($request->provincia);
            $locReq  = trim($request->localidad);
            $cpReq   = trim($request->codigo_postal);

            if (!$direccionActual) {
                // Solo si realmente NO tiene dirección, creamos una nueva
                $nuevaDireccion = \App\Models\Direccion::create([
                    'direccion'     => $dirReq,
                    'provincia'     => $provReq,
                    'localidad'     => $locReq,
                    'codigo_postal' => $cpReq,
                ]);
                
                $usuario->direccion_id = $nuevaDireccion->id;
                
            } else {
                // Extraemos y limpiamos los datos actuales de la BD para comparar correctamente
                $dbDir  = trim($direccionActual->direccion);
                $dbProv = trim($direccionActual->provincia);
                $dbLoc  = trim($direccionActual->localidad);
                $dbCp   = trim($direccionActual->codigo_postal);

                
                $cambioCalle = $dbDir !== $dirReq;
                $cambioProv  = $dbProv !== $provReq;
                $cambioLoc   = $dbLoc !== $locReq;
                $cambioCP    = $dbCp !== $cpReq;

                // Si HUBO un cambio (ya sea una letra, un espacio o toda la calle)
                if ($cambioCalle || $cambioProv || $cambioLoc || $cambioCP) {
                    
                    // Verificamos si fue un CAMBIO REAL (Ignorando mayúsculas/minúsculas)
                    $cambioReal = (
                        mb_strtolower($dbDir) !== mb_strtolower($dirReq) ||
                        mb_strtolower($dbProv) !== mb_strtolower($provReq) ||
                        mb_strtolower($dbLoc) !== mb_strtolower($locReq) ||
                        $dbCp !== $cpReq
                    );

                    if ($cambioReal) {
                        
                        $direccionActual->delete(); 
                        
                        $nuevaDireccion = \App\Models\Direccion::create([
                            'direccion'     => $dirReq,
                            'provincia'     => $provReq,
                            'localidad'     => $locReq,
                            'codigo_postal' => $cpReq,
                        ]);
                        
                        $usuario->direccion_id = $nuevaDireccion->id;

                    } else {
                        // Es un CAMBIO COSMÉTICO (Solo mayúsculas/minúsculas): Forzamos update en BD
                        \App\Models\Direccion::where('id', $direccionActual->id)->update([
                            'direccion'     => $dirReq,
                            'provincia'     => $provReq,
                            'localidad'     => $locReq,
                            'codigo_postal' => $cpReq,
                        ]);
                    }
                }
            }
        }

        // Guardamos los cambios
        $usuario->save();

        return redirect()
            ->route('cliente.cuenta')
            ->with('success', 'Datos y dirección actualizados correctamente');
    }
    
}
