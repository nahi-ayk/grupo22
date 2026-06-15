<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetodoPago;
use App\Models\Pedido;
use App\Models\Envio;
use App\Models\TarifaEnvio;
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

        // --- NUEVA VALIDACIÓN DE STOCK ANTES DE COMPRAR ---
        foreach ($pedido->detalles as $detalle) {
            $producto = $detalle->producto;
            
            // Verificamos si la cantidad pedida es mayor al stock real
            if ($detalle->cantidad > $producto->stock_actual) {
                return redirect()->route('cliente.carrito')->with('error', 'Lo sentimos, no hay stock suficiente para el producto: ' . $producto->nombre . '. Stock disponible: ' . $producto->stock_actual);
            }
        }

        // 3. Obtener el subtotal sumando los detalles (por seguridad)
        $subtotal = $pedido->detalles()->sum('subtotal');
        $costo_envio = 0;
        
        // 4. Lógica de costo de envío dinámica
        $tarifa_id = null;

        if ($request->tipo_entrega === 'envio') {
            $localidad = strtolower(trim($request->localidad));
            $cp = trim($request->codigo_postal);
            
            // Buscamos la tarifa en la BD dependiendo de la zona
            if ($cp === '3400' || str_contains($localidad, 'corrientes')) {
                $tarifa = TarifaEnvio::find(1); // ID 1: Local
            } elseif (str_contains($localidad, 'resistencia') || $cp === '3500') {
                $tarifa = TarifaEnvio::find(2); // ID 2: Interprovincial
            } else {
                $tarifa = TarifaEnvio::find(3); // ID 3: Nacional
            }

            // Si por alguna razón borraron la tarifa de la BD, ponemos 0 para no romper el sistema
            $costo_envio = $tarifa ? $tarifa->precio : 0;
            $tarifa_id = $tarifa ? $tarifa->id : null;

            // Crear y guardar los datos logísticos en la tabla "envios"
            $envio = new Envio();
            $envio->pedido_id       = $pedido->id;
            $envio->tarifa_envio_id = $tarifa_id; // Guardamos la FK
            $envio->direccion       = $request->direccion;
            $envio->provincia       = $request->provincia;
            $envio->localidad       = $request->localidad;
            $envio->codigo_postal   = $request->codigo_postal;
            $envio->costo_envio     = $costo_envio; // Congelamos el precio histórico
            $envio->estado_envio    = 'preparacion'; 
            $envio->save();
        }

        // 5. Calculamos el gran total
        $totalPedido = $subtotal + $costo_envio;

        // 6. Actualizamos el pedido que era "carrito" para convertirlo en una compra real
        // Por defecto, asumimos que si es tarjeta, ya está confirmado/pagado
        $estadoFinal = 'confirmado'; 

        // Buscamos el método de pago seleccionado
        $metodo = MetodoPago::find($request->metodo_pago_id);

        // Si es Efectivo o Transferencia, cambiamos el estado a pendiente
        // OJO: Asegúrate de que los textos coincidan EXACTAMENTE con lo que tienes en la columna 'descripcion' (o 'nombre') de tu tabla 'metodos_pago'
        if ($metodo && in_array($metodo->descripcion, ['Efectivo al retirar', 'Transferencia Bancaria'])) {
            $estadoFinal = 'pendiente_pago';
        }

        // Actualizamos el pedido que era "carrito" para convertirlo en una compra real
        $pedido->update([
            'subtotal'       => $subtotal,
            'total'          => $totalPedido,
            'estado'         => $estadoFinal, // Usamos la variable dinámica que creamos arriba
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