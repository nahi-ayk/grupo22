<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\HistorialLogin;

class AdminController extends Controller
{
    public function admin()
    {
        $clientes = Usuario::where('rol_id', 2)
            ->latest()
            ->get();

        $totalClientes = $clientes->count();

        $clientesNuevos = $clientes
            ->where(
                'created_at',
                '>=',
                now()->subDays(30)
            )
            ->count();

        $logins = HistorialLogin::join('usuarios', 'historial_logins.usuario_id', '=', 'usuarios.id')
            ->selectRaw('DATE(historial_logins.fecha_login) as dia, COUNT(*) as total')
            ->where('usuarios.rol_id', 2)
            ->where('historial_logins.fecha_login', '>=', now()->subDays(30))
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        return view(
            'backend.administrador.cuentaAdmin',
            compact(
                'clientes',
                'totalClientes',
                'clientesNuevos',
                'logins'
            )
        );
    }
    
    public function clientes()
    {
        $clientes = Usuario::where('rol_id', 2)
            ->latest()
            ->get();

        $totalClientes = Usuario::where('rol_id', 2)
            ->count();

        $clientesNuevos = Usuario::where('rol_id', 2)
            ->where(
                'created_at',
                '>=',
                now()->subDays(30)
            )
            ->count();

        $clientesActivos = Usuario::where('rol_id', 2)
        ->where(
            'ultimo_login',
            '>=',
            now()->subDays(30)
        )
        ->count();

        return view(
            'backend.administrador.clientesAdmin',
            compact(
                'clientes',
                'totalClientes',
                'clientesNuevos',
                'clientesActivos'
            )
        );
    }
}

