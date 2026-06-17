<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta; 
use Illuminate\Support\Facades\Mail;


class ContactoController extends Controller
{    
    public function procesar(Request $request)
    {
        // Bloqueo de seguridad para administradores
        if (auth()->check() && auth()->user()->rol->nombre === 'admin') {
            return response()->json([
            'success' => false,
            'mensaje' => 'Acción denegada: Los administradores no pueden enviar consultas.'
        ], 403);
        }
        // Validaciòn del lado del servidor 
        $request->validate([
            'nombre'  => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        // Se guardan datos en la BD
        Consulta::create([
            'nombre'  => $request->nombre,
            'email'   => $request->email,
            'asunto'  => $request->asunto,
            'mensaje' => $request->mensaje,
        ]);

        // Retorna la respuesta JSON al Fetch de la vista
        return response()->json([
            'success' => true,
            'mensaje' => '¡Tu mensaje fue enviado correctamente y guardado en el sistema!'
        ]);
    }

    public function index()
    {
        // Traemos las consultas ordenadas por las más recientes primero
        $consultas = Consulta::latest()->get(); 
        
        // Retornamos la vista pasando la variable
        return view('backend.administrador.consultasAdmin', compact('consultas'));
    }

    public function responder(Request $request, $id)
    {
        $request->validate([
            'respuesta' => 'required|string',
        ]);

        $consulta = Consulta::findOrFail($id);

        // --- LÓGICA DE ENVÍO DE CORREO ---
        $datosEmail = [
            'nombre' => $consulta->nombre,
            'mensaje_original' => $consulta->mensaje,
            'respuesta' => $request->respuesta
        ];

        // Enviamos el correo usando una función anónima rápida
        Mail::send([], [], function ($message) use ($consulta, $request) {
            $message->to($consulta->email)
                    ->subject('Respuesta a tu consulta - Soporte')
                    ->html('
                        <h3>Hola ' . $consulta->nombre . ',</h3>
                        <p>Hemos procesado tu consulta enviada recientemente.</p>
                        <blockquote style="background:#f4f4f4; padding:10px; border-left:4px solid #007bff;">
                            <strong>Tu mensaje:</strong><br>' . nl2br(e($consulta->mensaje)) . '
                        </blockquote>
                        <p><strong>Nuestra respuesta:</strong></p>
                        <p>' . nl2br(e($request->respuesta)) . '</p>
                        <br>
                        <p>Saludos cordiales,<br>El equipo de soporte.</p>
                    ');
        });

        // --- ACTUALIZAR ESTADO EN LA BD ---
        $consulta->update([
            'contestado' => true
        ]);

        return redirect()->back()->with('success', 'La respuesta fue enviada con éxito y la consulta se marcó como contestada.');
    }

    public function show($id)
    {
    $consulta = Consulta::findOrFail($id);
    return view('backend.administrador.detalleConsultasAdmin', compact('consulta'));
    }
}

