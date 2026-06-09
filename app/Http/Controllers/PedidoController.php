<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function index()
    {
        // Traemos los pedidos ordenados por los más recientes
        // Usamos with('usuario') asumiendo que tienes esa relación definida en el modelo Pedido
        $pedidos = Pedido::with('usuario')->orderBy('created_at', 'desc')->get();

        // Retornamos la vista pasando la variable $pedidos
        // Asumiendo que guardaste la vista en resources/views/backend/pedidos/index.blade.php
        return view('backend.administrador.pedidosAdmin', compact('pedidos'));
    }

    // Muestra el detalle de un pedido
    public function show(Pedido $pedido) 
    {   

        $pedido->load(['usuario', 'detalles.producto', 'metodoPago', 'envio']);
        
        return view('backend.administrador.detallePedidosAdmin', compact('pedido'));
    }

    public function misCompras()
    {

        $pedidos = Pedido::where('usuario_id', Auth::id())
                    ->where('estado', '!=', 'carrito') 
                    ->orderBy('created_at', 'desc')
                    ->get();
    
        return view('backend.cliente.clienteCompras', compact('pedidos'));
    }

    // Muestra el detalle de un pedido desde la perspectiva del cliente
    public function verPedidoCliente(Pedido $pedido) 
    {   
    // Valida que el pedido pertenezca al cliente que inició sesión
    if ($pedido->usuario_id !== Auth::id()) {
        abort(403, 'No tienes permiso para ver este pedido.');
    }

    // Carga las relaciones necesarias
    $pedido->load(['detalles.producto', 'metodoPago', 'envio']);
    
    // Retornar la vista del cliente (ajusta la ruta de la vista según tus carpetas)
    return view('backend.cliente.clienteComprasDetalle', compact('pedido'));
    }


    public function descargarFactura($id)
    {
    // Buscamos el pedido con sus relaciones (ajusta los nombres según tu BD)
    $pedido = Pedido::with(['envio', 'metodoPago', 'detalles'])
            ->where('id', $id)
            ->where('usuario_id', Auth::id())
            ->firstOrFail();

    // Cargamos una vista de Blade especial para el PDF y le pasamos los datos
    $pdf = Pdf::loadView('backend.cliente.factura_pdf', compact('pedido'));

    // Retornamos la descarga del archivo
    return $pdf->download('Comprobante_Pedido_'.$pedido->id.'.pdf');
    }

}