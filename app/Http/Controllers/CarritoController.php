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

}