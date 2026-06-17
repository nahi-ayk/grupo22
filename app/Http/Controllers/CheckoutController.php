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
        
        //Obtiene la dirección activa del usuario
        $direccionActual = Auth::user()->direccion; 
        
        return view('frontend.checkout', compact('metodosPago', 'direccionActual'));
    }

    public function store(Request $request)
    {
        // Validación de todos los campos
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

        // Buscar el carrito actual del usuario
        $pedido = Pedido::where('usuario_id', Auth::id())
                        ->where('estado', 'carrito')
                        ->first();

        // Si no hay carrito o no tiene productos, lo devolvemos
        if (!$pedido || $pedido->detalles()->count() === 0) {
            return redirect()->route('cliente.carrito')->with('error', 'Tu carrito está vacío o la sesión expiró.');
        }

        // --- VALIDACIÓN DE STOCK ANTES DE COMPRAR ---
        foreach ($pedido->detalles as $detalle) {
            $producto = $detalle->producto;
            
            // Verificamos si la cantidad pedida es mayor al stock real
            if ($detalle->cantidad > $producto->stock_actual) {
                return redirect()->route('cliente.carrito')->with('error', 'Lo sentimos, no hay stock suficiente para el producto: ' . $producto->nombre . '. Stock disponible: ' . $producto->stock_actual);
            }
        }

        // Obtener el subtotal sumando los detalles (por seguridad)
        $subtotal = $pedido->detalles()->sum('subtotal');
        $costo_envio = 0;
        $tarifa_id = null;

        // Lógica de costo de envío dinámica y actualización de direcciones
        if ($request->tipo_entrega === 'envio') {
            $usuario = Auth::user();
            $direccionActual = $usuario->direccion;
            $direccionFinalId = null;
            $crearNueva = false;

            // Limpiamos los inputs del formulario
            $dirReq  = trim($request->direccion);
            $provReq = trim($request->provincia);
            $locReq  = trim($request->localidad);
            $cpReq   = trim($request->codigo_postal);

            if (!$direccionActual) {
                // Es la primera vez que compra con envío
                $nuevaDireccion = \App\Models\Direccion::create([
                    'direccion'     => $dirReq,
                    'provincia'     => $provReq,
                    'localidad'     => $locReq,
                    'codigo_postal' => $cpReq,
                ]);
                
                $direccionFinalId = $nuevaDireccion->id;
                $usuario->direccion_id = $direccionFinalId;
                $usuario->save();

            } else {
                // Extraemos los datos actuales de la BD
                $dbDir  = trim($direccionActual->direccion);
                $dbProv = trim($direccionActual->provincia);
                $dbLoc  = trim($direccionActual->localidad);
                $dbCp   = trim($direccionActual->codigo_postal);

                // Comparamos usando operadores estrictos (===)
                $cambioCalle = $dbDir !== $dirReq;
                $cambioProv  = $dbProv !== $provReq;
                $cambioLoc   = $dbLoc !== $locReq;
                $cambioCP    = $dbCp !== $cpReq;

                if ($cambioCalle || $cambioProv || $cambioLoc || $cambioCP) {
                    
                    // Verificamos si fue un CAMBIO REAL (Ignorando mayúsculas/minúsculas)
                    $cambioReal = (
                        mb_strtolower($dbDir) !== mb_strtolower($dirReq) ||
                        mb_strtolower($dbProv) !== mb_strtolower($provReq) ||
                        mb_strtolower($dbLoc) !== mb_strtolower($locReq) ||
                        $dbCp !== $cpReq
                    );

                    if ($cambioReal) {
                        // Es un cambio real: Soft Delete a la vieja y creamos nueva
                        $direccionActual->delete(); 
                        
                        $nuevaDireccion = \App\Models\Direccion::create([
                            'direccion'     => $dirReq,
                            'provincia'     => $provReq,
                            'localidad'     => $locReq,
                            'codigo_postal' => $cpReq,
                        ]);
                        
                        $direccionFinalId = $nuevaDireccion->id;
                        $usuario->direccion_id = $direccionFinalId;
                        $usuario->save();

                    } else {
                        // Es un cambio cosmético: Actualizamos el registro actual forzando la BD
                        \App\Models\Direccion::where('id', $direccionActual->id)->update([
                            'direccion'     => $dirReq,
                            'provincia'     => $provReq,
                            'localidad'     => $locReq,
                            'codigo_postal' => $cpReq,
                        ]);
                        $direccionFinalId = $direccionActual->id;
                    }
                } else {
                    // No hubo ningún tipo de cambio
                    $direccionFinalId = $direccionActual->id;
                }
            }

            // Lógica de cálculo de tarifas
            $localidad = strtolower(trim($request->localidad));
            $cp = trim($request->codigo_postal);
            
            if ($cp === '3400' || str_contains($localidad, 'corrientes')) {
                $tarifa = TarifaEnvio::find(1); 
            } elseif (str_contains($localidad, 'resistencia') || $cp === '3500') {
                $tarifa = TarifaEnvio::find(2); 
            } else {
                $tarifa = TarifaEnvio::find(3); 
            }

            $costo_envio = $tarifa ? $tarifa->precio : 0;
            $tarifa_id = $tarifa ? $tarifa->id : null;

            
            $envio = new Envio();
            $envio->pedido_id       = $pedido->id;
            $envio->tarifa_envio_id = $tarifa_id; 
            $envio->direccion_id    = $direccionFinalId; 
            $envio->costo_envio     = $costo_envio; 
            $envio->estado_envio    = 'preparacion'; 
            $envio->save();
        }

        //  Calcula el gran total
        $totalPedido = $subtotal + $costo_envio;

        // Actualizar el pedido
        $estadoFinal = 'confirmado'; 
        $metodo = MetodoPago::find($request->metodo_pago_id);

        if ($metodo && in_array($metodo->descripcion, ['Efectivo al retirar', 'Transferencia Bancaria'])) {
            $estadoFinal = 'pendiente_pago';
        }

        
        $pedido->update([
            'subtotal'       => $subtotal,
            'total'          => $totalPedido,
            'estado'         => $estadoFinal, 
            'metodo_pago_id' => $request->metodo_pago_id,
            'fecha_venta'    => now(),
        ]);

        // DESCONTAR STOCK DE LOS PRODUCTOS
        foreach ($pedido->detalles as $detalle) {
            $producto = $detalle->producto;
            if ($producto) {
                $producto->stock_actual -= $detalle->cantidad;
                if ($producto->stock_actual < 0) {
                    $producto->stock_actual = 0;
                }
                $producto->save();
            }
        }

        // Redirigimos a la pantalla de éxito pasando el ID del pedido
        return redirect()->route('compra.confirmada')->with('pedido_id', $pedido->id);
    }
}