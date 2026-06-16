<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;   
use App\Models\Producto;
use App\Models\Envio;
use App\Models\MetodoPago;

class CarritoController extends Controller
{

// Busca el carrito activo o crea uno nuevo vacío
private function obtenerCarrito()
{
    return Pedido::firstOrCreate(
        [
            'usuario_id' => auth()->id(),
            'estado' => 'carrito',
        ],
        [
            'total' => 0,
            // Genera un numero de pedido tipo PED-4920493 usando un número aleatorio
            'numero_pedido' => 'PED-' . rand(100000, 999999), 

            'subtotal' => 0,
        ]
    );
}



// Muestra el carrito con sus items
public function index()
{
    $carrito = $this->obtenerCarrito();
    // with('producto') evita N+1: una sola consulta para todos los productos
    $items = $carrito->detalles()->with('producto')->get();
    $metodosPago = MetodoPago::all();
    return view('backend.cliente.clienteCarrito', compact('carrito', 'items', 'metodosPago'));
}



// Agrega un producto al carrito o actualiza su cantidad si ya existe
public function agregar(Request $request) {
    $request->validate([
    'producto_id' => 'required|exists:productos,id',
    'cantidad' => 'required|integer|min:1',
]);

$producto = Producto::findOrFail($request->producto_id);

// Verificar stock antes de agregar
if ($producto->stock_actual < $request->cantidad) {
return back()->with('error', 'No hay suficiente stock');
}

$carrito = $this->obtenerCarrito();
// ¿El producto ya está en el carrito?
$item = $carrito->detalles()->where('producto_id', $producto->id)->first();
if ($item) {
// Si ya existe: suma la cantidad
$item->cantidad += $request->cantidad;
$item->subtotal = $item->cantidad * $item->precio_unitario;
$item->save();
} else {

// Si no existe: crea un nuevo ítem
$carrito->detalles()->create([
'producto_id' => $producto->id,
'cantidad' => $request->cantidad,
'precio_unitario' => $producto->precio_venta,
'subtotal' => $producto->precio_venta * $request->cantidad,
]);

}
$this->recalcularTotal($carrito);
return back()->with('success', 'Producto agregado al carrito');

}

// Quitar producto del carrito por su ID
public function eliminar($id)
{
$carrito = $this->obtenerCarrito();
// where('id',$id) evita eliminar ítems de otro carrito
$carrito->detalles()->where('id', $id)->delete();
$this->recalcularTotal($carrito);
return back()->with('success', 'Producto eliminado');
}

public function confirmar(Request $request)
{
    // 1. Validaciones iniciales
    $request->validate([
        'metodo_pago_id' => 'required|exists:metodos_pago,id',
        'tipo_entrega'   => 'required|in:retiro,envio',
    ]);

    $carrito = $this->obtenerCarrito();

    // 2. Validación de seguridad rigurosa
    if (!$carrito || $carrito->detalles()->count() === 0) {
        return redirect()->route('cliente.carrito')->with('error', 'Tu carrito está vacío o el pedido ya fue procesado.');
    }

    // --- NUEVA VALIDACIÓN DE STOCK ANTES DE COMPRAR ---
    foreach ($carrito->detalles as $detalle) {
        $producto = $detalle->producto;
        if ($detalle->cantidad > $producto->stock_actual) {
            return redirect()->route('cliente.carrito')->with('error', 'Lo sentimos, no hay stock suficiente para: ' . $producto->nombre);
        }
    }

    // 3. Guardamos ítems y preparamos totales
    $items = $carrito->detalles()->with('producto')->get();
    $total = $carrito->total;
    $tipoEntrega = $request->input('tipo_entrega');
    $costo_envio = 0;

    // 4. LÓGICA DE ENVÍO Y DIRECCIONES INMUTABLES
    if ($tipoEntrega === 'envio') {
        $request->validate([
            'direccion'     => 'required|string|max:255',
            'provincia'     => 'required|string|max:255',
            'localidad'     => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
        ]);

        $usuario = auth()->user();
        $direccionActual = $usuario->direccion;
        $direccionFinalId = null;
        $crearNueva = false;

        // Evaluamos si necesitamos crear una nueva dirección (Soft Delete)
        if (!$direccionActual) {
            $crearNueva = true; 
        } else {
            if (
                strtolower(trim($direccionActual->direccion)) !== strtolower(trim($request->direccion)) ||
                strtolower(trim($direccionActual->provincia)) !== strtolower(trim($request->provincia)) ||
                strtolower(trim($direccionActual->localidad)) !== strtolower(trim($request->localidad)) ||
                trim($direccionActual->codigo_postal) !== trim($request->codigo_postal)
            ) {
                $crearNueva = true;
                $direccionActual->delete(); // Ocultamos la vieja sin romper el historial
            }
        }

        // Creamos la nueva dirección si hubo cambios
        if ($crearNueva) {
            $nuevaDireccion = \App\Models\Direccion::create([
                'direccion'     => trim($request->direccion),
                'provincia'     => trim($request->provincia),
                'localidad'     => trim($request->localidad),
                'codigo_postal' => trim($request->codigo_postal),
            ]);
            
            $direccionFinalId = $nuevaDireccion->id;

            // Actualizamos la libreta del usuario
            $usuario->direccion_id = $direccionFinalId;
            $usuario->save();
        } else {
            $direccionFinalId = $direccionActual->id;
        }

        // Lógica de cálculo de tarifas
        $localidad = strtolower(trim($request->localidad));
        $cp = trim($request->codigo_postal);
        
        if ($cp === '3400' || str_contains($localidad, 'corrientes')) {
            $tarifa = \App\Models\TarifaEnvio::find(1); 
        } elseif (str_contains($localidad, 'resistencia') || $cp === '3500') {
            $tarifa = \App\Models\TarifaEnvio::find(2); 
        } else {
            $tarifa = \App\Models\TarifaEnvio::find(3); 
        }

        $costo_envio = $tarifa ? $tarifa->precio : 0;
        $tarifa_id = $tarifa ? $tarifa->id : null;

        // Registramos los datos en la tabla 'envios' usando la nueva FK
        $carrito->envio()->create([
            'tarifa_envio_id' => $tarifa_id,
            'direccion_id'    => $direccionFinalId, // <- Aquí está la magia relacional
            'costo_envio'     => $costo_envio,
            'estado_envio'    => 'preparacion'
        ]);

        // Sumamos el costo de envío al total
        $total += $costo_envio;
    }

    // 5. DETERMINAR EL ESTADO FINAL
    $estadoFinal = 'confirmado'; 
    $metodo = \App\Models\MetodoPago::find($request->metodo_pago_id);

    if ($metodo && in_array($metodo->descripcion, ['Efectivo al retirar', 'Transferencia Bancaria'])) {
        $estadoFinal = 'pendiente_pago';
    }

    // 6. ACTUALIZAR CARRITO A PEDIDO REAL
    $carrito->update([
        'total'          => $total,
        'estado'         => $estadoFinal, 
        'fecha_venta'    => now(),
        'metodo_pago_id' => $request->metodo_pago_id, 
    ]);

    // 7. DESCONTAR STOCK DE LOS PRODUCTOS
    foreach ($carrito->detalles as $detalle) {
        $producto = $detalle->producto;
        if ($producto) {
            $producto->stock_actual -= $detalle->cantidad;
            if ($producto->stock_actual < 0) {
                $producto->stock_actual = 0;
            }
            $producto->save();
        }
    }

    // 8. REDIRECCIONAR AL ÉXITO
    return redirect()->route('compra.confirmada')
        ->with('items', $items->toArray())
        ->with('total', $total)
        ->with('numero_pedido', $carrito->numero_pedido)
        ->with('tipo_entrega', $tipoEntrega);
}

// Actualiza la cantidad de un producto específico en el carrito
public function actualizar(Request $request, $id)
{
    // 1. Validar que la cantidad sea correcta
    $request->validate([
        'cantidad' => 'required|integer|min:1',
    ]);

    $carrito = $this->obtenerCarrito();

    // 2. Buscar el ítem asegurando que pertenezca al carrito del usuario actual
    $item = $carrito->detalles()->where('id', $id)->first();

    if (!$item) {
        return back()->with('error', 'El producto no se encontró en el pedido.');
    }

    // 3. Verificar stock antes de actualizar
    if ($item->producto->stock_actual < $request->cantidad) {
        return back()->with('error', 'No hay suficiente stock para la cantidad solicitada.');
    }

    // 4. Actualizar cantidad y subtotal del ítem
    $item->cantidad = $request->cantidad;
    $item->subtotal = $item->cantidad * $item->precio_unitario;
    $item->save();

    // 5. Recalcular el total general del carrito
    $this->recalcularTotal($carrito);

    return back()->with('success', 'Cantidad actualizada correctamente.');
}



// Recalcula el total del carrito sumando los subtotales de sus ítems
private function recalcularTotal(Pedido $carrito)
{
// sum() suma todos los subtotales de los ítems del carrito
$total = $carrito->detalles()->sum('subtotal');
$carrito->update(['total' => $total]);
}

// Vacia el carrito eliminando todos sus ítems y reiniciando montos a 0
public function vaciar()
{
    // Buscamos el carrito activo del usuario logueado usando tu método privado
    $carrito = $this->obtenerCarrito();

    if ($carrito) {
        // Eliminamos todos los detalles asociados usando la relación hasMany
        $carrito->detalles()->delete();

        // Reiniciamos los montos del pedido a 0
        $carrito->subtotal = 0;
        $carrito->total = 0;
        $carrito->save();
    }

    // Redireccionamos a la vista del carrito con un mensaje
    return redirect()->route('cliente.carrito')->with('success', 'Se han quitado todos los productos del pedido.');
}

}