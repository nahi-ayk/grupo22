<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta; // <---- Se importa el modelo

class ContactoController extends Controller
{    
    public function procesar(Request $request)
    {
        // Validaciòn del lado del servidor 
        $request->validate([
            'nombre'  => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'mensaje' => 'required|string',
        ]);

        // Se guardan datos en la BD
        Consulta::create([
            'nombre'  => $request->nombre,
            'email'   => $request->email,
            'mensaje' => $request->mensaje,
        ]);

        // Retorna la respuesta JSON al Fetch de la vista
        return response()->json([
            'success' => true,
            'mensaje' => '¡Tu mensaje fue enviado correctamente y guardado en el sistema!'
        ]);
    }
}

