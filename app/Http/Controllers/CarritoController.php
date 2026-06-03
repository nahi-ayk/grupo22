<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;   
use App\Models\Producto;
use App\Models\Envio;

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
    return view('backend.cliente.clienteCarrito', compact('carrito', 'items'));
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

// Confirma el pedido: cambia estado a 'confirmado', guarda fecha y muestra resumen
public function confirmar(Request $request)
{
    $carrito = $this->obtenerCarrito();

    // 1. Validación de seguridad rigurosa
    if (!$carrito || $carrito->detalles()->count() === 0) {
        return redirect()->route('cliente.carrito')->with('error', 'Tu carrito está vacío o el pedido ya fue procesado.');
    }

    // 2. Guardamos ítems y totales antes de cerrar el pedido
    $items = $carrito->detalles()->with('producto')->get();
    $total = $carrito->total;
    $tipoEntrega = $request->input('tipo_entrega', 'retiro');

    // 3. SI ES ENVÍO: Registramos los datos en la tabla 'envios'
    if ($tipoEntrega === 'envio') {
        // Validamos que los datos del formulario del modal hayan llegado
        $request->validate([
            'direccion'     => 'required|string|max:255',
            'provincia'     => 'required|string|max:255',
            'localidad'     => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
        ]);

        // Creamos el registro usando la relación de tu modelo Pedido
        $carrito->envio()->create([
            'direccion'     => $request->direccion,
            'provincia'     => $request->provincia,
            'localidad'     => $request->localidad,
            'codigo_postal' => $request->codigo_postal,
            'costo_envio'   => 0, // Como es académico, lo dejamos en 0 o el valor base que quieras
            'estado_envio'  => 'Pendiente de preparación'
        ]);
    }

    // 4. Cambia el estado del pedido para que deje de ser un "carrito" activo
    $carrito->update([
        'estado'      => 'confirmado', 
        'fecha_venta' => now(),
    ]);

    // 5. Redireccionamos a la pantalla de éxito con los datos cargados en sesión array
    return redirect()->route('compra.confirmada')
        ->with('items', $items->toArray())
        ->with('total', $total)
        ->with('numero_pedido', $carrito->numero_pedido)
        ->with('tipo_entrega', $tipoEntrega);
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