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
        $pedidos = Pedido::with('usuario')->orderBy('created_at', 'desc')->get();

        // Retorna la vista pasando la variable $pedidos
        return view('backend.administrador.pedidosAdmin', compact('pedidos'));
    }

    // Muestra el detalle de un pedido desde la perspectiva del admin
    public function show(Pedido $pedido) 
    {   

        $pedido->load(['usuario', 'detalles.producto', 'metodoPago', 'envio']);
        
        return view('backend.administrador.detallePedidosAdmin', compact('pedido'));
    }

    public function misCompras()
    {

        $pedidos = Pedido::where('usuario_id', Auth::id())
                    ->where('estado', 'confirmado') 
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
    // Busca el pedido con sus relaciones (ajusta los nombres según tu BD)
    $pedido = Pedido::with(['envio', 'metodoPago', 'detalles'])
            ->where('id', $id)
            ->where('usuario_id', Auth::id())
            ->firstOrFail();

    // Cargamos una vista de Blade especial para el PDF y le pasamos los datos
    $pdf = Pdf::loadView('backend.cliente.factura_pdf', compact('pedido'));

    // Retorna la descarga del archivo
    return $pdf->download('Comprobante_Pedido_'.$pedido->id.'.pdf');
    }

    // Método para que el admin confirme manualmente un pago pendiente
    public function confirmarPago(Pedido $pedido)
    {
        // Actualizar el estado
        $pedido->update([
            'estado' => 'confirmado'
        ]);

        // Redirigir de vuelta a la tabla con un mensaje de éxito
        return back()->with('success', 'El pago del pedido #' . $pedido->numero_pedido . ' ha sido confirmado.');
    }

}