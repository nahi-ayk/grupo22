<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetodoPago;
use App\Models\Pedido;
use App\Models\Envio;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $metodosPago = MetodoPago::all();
        
        return view('frontend.checkout', compact('metodosPago'));
    }

    public function store(Request $request)
    {
        // 1. Validación de los campos
        $request->validate([
            'metodo_pago_id' => 'required|exists:metodos_pago,id',
            'tipo_entrega'   => 'required|in:retiro,envio',
            
            // Validaciones de tarjeta
            'numero_tarjeta' => 'required_if:metodo_pago_id,1|nullable|string',
            'nombre_titular' => 'required_if:metodo_pago_id,1|nullable|string',
            'vencimiento'    => 'required_if:metodo_pago_id,1|nullable|string',
            'cvv'            => 'required_if:metodo_pago_id,1|nullable|string',
            
            // Validaciones de envío
            'direccion'      => 'required_if:tipo_entrega,envio|nullable|string',
            'provincia'      => 'required_if:tipo_entrega,envio|nullable|string',
            'localidad'      => 'required_if:tipo_entrega,envio|nullable|string',
            'codigo_postal'  => 'required_if:tipo_entrega,envio|nullable|string',
        ]);

        // 2. Buscar el carrito actual del usuario (El pedido en estado 'carrito')
        $pedido = Pedido::where('usuario_id', Auth::id())
                        ->where('estado', 'carrito')
                        ->first();

        // Si no hay carrito o no tiene productos, lo devolvemos
        if (!$pedido || $pedido->detalles()->count() === 0) {
            return redirect()->route('cliente.carrito')->with('error', 'Tu carrito está vacío o la sesión expiró.');
        }

        // 3. Obtener el subtotal sumando los detalles (por seguridad)
        $subtotal = $pedido->detalles()->sum('subtotal');
        $costo_envio = 0;

        // 4. Lógica de costo de envío
        if ($request->tipo_entrega === 'envio') {
            $localidad = strtolower(trim($request->localidad));
            $cp = trim($request->codigo_postal);
            
            // Evaluamos tarifas según la zona
            if ($cp === '3400' || str_contains($localidad, 'corrientes')) {
                $costo_envio = 1500; // Tarifa local
            } elseif (str_contains($localidad, 'resistencia') || $cp === '3500') {
                $costo_envio = 2500; // Tarifa interurbana
            } else {
                $costo_envio = 4500; // Tarifa nacional
            }

            // Crear y guardar los datos logísticos en la tabla "envios"
            $envio = new Envio();
            $envio->pedido_id     = $pedido->id;
            $envio->direccion     = $request->direccion;
            $envio->provincia     = $request->provincia;
            $envio->localidad     = $request->localidad;
            $envio->codigo_postal = $request->codigo_postal;
            $envio->costo_envio   = $costo_envio;
            $envio->estado_envio  = 'preparacion'; 
            $envio->save();
        }

        // 5. Calculamos el gran total
        $totalPedido = $subtotal + $costo_envio;

        // 6. Actualizamos el pedido que era "carrito" para convertirlo en una compra real
        $pedido->update([
            'subtotal'       => $subtotal,
            'total'          => $totalPedido,
            'estado'         => 'confirmado', // Cambiamos el estado para cerrar el carrito
            'metodo_pago_id' => $request->metodo_pago_id,
            'fecha_venta'    => now(),
        ]);

        // ---------------------------------------------------------
        // 7. LÓGICA NUEVA: DESCONTAR STOCK DE LOS PRODUCTOS
        // ---------------------------------------------------------
        foreach ($pedido->detalles as $detalle) {
            $producto = $detalle->producto;
            
            if ($producto) {
                // Restamos la cantidad comprada al stock actual
                $producto->stock_actual -= $detalle->cantidad;
                
                // Medida de seguridad: evitar que el stock quede en negativo
                if ($producto->stock_actual < 0) {
                    $producto->stock_actual = 0;
                }
                
                // Guardamos el cambio en la base de datos
                $producto->save();
            }
        }

        // 8. Redirigimos a la pantalla de éxito pasando el ID del pedido
        return redirect()->route('compra.confirmada')->with('pedido_id', $pedido->id);
    }
}