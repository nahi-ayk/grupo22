<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\HistorialLogin;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Consulta;

class AdminController extends Controller
{
    public function admin()
    {
        $clientes = Usuario::where('rol_id', 2)
            ->latest()
            ->get();

        $totalClientes = $clientes->count();

        $totalProductos = Producto::count();

        $totalPedidos = Pedido::count();

        $clientesNuevos = $clientes
            ->where(
                'created_at',
                '>=',
                now()->subDays(30)
        )->count();

        $comprasUltimos30Dias = Pedido::where(
            'created_at',
            '>=',
            now()->subDays(30)
        )->count();

        $consultasUltimos30Dias = Consulta::where(
            'created_at',
            '>=',
            now()->subDays(30)
        )->count();

       $logins = HistorialLogin::join('usuarios', 'historial_logins.usuario_id', '=', 'usuarios.id')
            ->selectRaw('DATE(historial_logins.fecha_login) as dia, COUNT(*) as total')
            ->where('usuarios.rol_id', 2)
            ->where('historial_logins.fecha_login', '>=', now()->subDays(30))
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        $maxLogin = max($logins->max('total'), 1);

        return view(
            'backend.administrador.cuentaAdmin',
            compact(
                'clientes',
                'totalClientes',
                'totalProductos',
                'totalPedidos',
                'clientesNuevos',
                'comprasUltimos30Dias',
                'consultasUltimos30Dias',
                'logins',
                'maxLogin'
            )
        );
    }
    
    public function clientes(Request $request)
    {
        $query = Usuario::where('rol_id', 2);

        if ($request->filled('buscar')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%')
                ->orWhere('apellido', 'like', '%' . $request->buscar . '%');
            });
        }

        $clientes = $query->latest()->get();

        $totalClientes = Usuario::where('rol_id', 2)->count();

        $clientesNuevos = Usuario::where('rol_id', 2)
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        $clientesActivos = Usuario::where('rol_id', 2)
            ->where('ultimo_login', '>=', now()->subDays(30))
            ->count();

        $clientes = Usuario::where('rol_id', 2)
            ->withCount('pedidos')
            ->when($request->filled('buscar'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('nombre', 'like', '%' . $request->buscar . '%')
                    ->orWhere('apellido', 'like', '%' . $request->buscar . '%');
                });
            })
            ->latest()
            ->get();
        
            $topCompradorId = $clientes->sortByDesc('pedidos_count')->first()?->id;

        return view('backend.administrador.clientesAdmin', compact(
            'clientes',
            'totalClientes',
            'clientesNuevos',
            'clientesActivos',
            'topCompradorId'
        ));
    }
}

