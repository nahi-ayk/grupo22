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
        
        // Gracias a la relación belongsTo, obtenemos la dirección activa del usuario
        $direccionActual = Auth::user()->direccion; 
        
        return view('frontend.checkout', compact('metodosPago', 'direccionActual'));
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
        
        // 4. Lógica de costo de envío dinámica y actualización de direcciones
        $tarifa_id = null;

        if ($request->tipo_entrega === 'envio') {
            $usuario = Auth::user();
            $direccionActual = $usuario->direccion;
            $direccionFinalId = null;
            $crearNueva = false;

            // Verificamos si el usuario ya tenía una dirección o si debemos crear una nueva
            if (!$direccionActual) {
                $crearNueva = true; 
            } else {
                // Comparamos si algún dato del formulario es distinto al de la BD
                if (
                    strtolower(trim($direccionActual->direccion)) !== strtolower(trim($request->direccion)) ||
                    strtolower(trim($direccionActual->provincia)) !== strtolower(trim($request->provincia)) ||
                    strtolower(trim($direccionActual->localidad)) !== strtolower(trim($request->localidad)) ||
                    trim($direccionActual->codigo_postal) !== trim($request->codigo_postal)
                ) {
                    $crearNueva = true;
                    // Aplicamos Soft Delete a la dirección vieja para no romper envíos pasados
                    $direccionActual->delete(); 
                }
            }

            // Si detectamos cambios (o no existía), creamos el nuevo registro
            if ($crearNueva) {
                $nuevaDireccion = \App\Models\Direccion::create([
                    'direccion'     => trim($request->direccion),
                    'provincia'     => trim($request->provincia),
                    'localidad'     => trim($request->localidad),
                    'codigo_postal' => trim($request->codigo_postal),
                ]);
                
                $direccionFinalId = $nuevaDireccion->id;

                // Vinculamos la nueva dirección al usuario como su dirección principal
                $usuario->direccion_id = $direccionFinalId;
                $usuario->save();
            } else {
                $direccionFinalId = $direccionActual->id;
            }

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
            $envio->tarifa_envio_id = $tarifa_id; 
            $envio->direccion_id    = $direccionFinalId; // Guardamos la FK hacia direcciones
            $envio->costo_envio     = $costo_envio; 
            $envio->estado_envio    = 'preparacion'; 
            $envio->save();
        }

        // 5. Calculamos el gran total
        $totalPedido = $subtotal + $costo_envio;

        // 6. Actualizamos el pedido que era "carrito" para convertirlo en una compra real
        $estadoFinal = 'confirmado'; 

        // Buscamos el método de pago seleccionado
        $metodo = MetodoPago::find($request->metodo_pago_id);

        // Si es Efectivo o Transferencia, cambiamos el estado a pendiente
        if ($metodo && in_array($metodo->descripcion, ['Efectivo al retirar', 'Transferencia Bancaria'])) {
            $estadoFinal = 'pendiente_pago';
        }

        // Actualizamos el pedido 
        $pedido->update([
            'subtotal'       => $subtotal,
            'total'          => $totalPedido,
            'estado'         => $estadoFinal, 
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