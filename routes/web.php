<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\TarifaEnvioController;


// Retorna vista al inicio de la pagina
Route::get('/', [InicioController::class, 'index']);

//========= CatalogoController ==========
// Retorna la vista del catalogo junto con los productos que estan activos y las categorias de los productos
Route::get('/catalogo', [CatalogoController::class, 'index'])
    ->name('catalogo');

// Retorna la vista del catalogo pero solo muestra los productos de la categoria elegida (filtrado)
Route::get('/categorias/{id}', [CatalogoController::class, 'categoria'])
    ->name('catalogo.categoria');

// Envía el producto y los favoritos a una vista diferente llamada infoProducto (la ficha técnica del producto).
Route::get('/producto/{id}', [CatalogoController::class, 'mostrar'])
->name('producto.mostrar');

Route::get('/buscar', [CatalogoController::class, 'index'])
->name('buscar');

Route::get('/buscar-productos', [CatalogoController::class, 'buscarAjax']);

//ruta de contacto
Route::get('/contacto', function () {
    return view('contacto');
});

//ruta de nosotros 
Route::get('/nosotros', function () {
    return view('nosotros');
});

//ruta de comercializacion 
Route::get('/comercializacion', function () {
    return view('comercializacion');
});

//ruta de terminos
Route::get('/terminos', function () {
    return view('terminos');
});

//ruta de privacidad
Route::get('/privacidad', function () {
    return view('privacidad');
});






// =======================Middleware CLIENTE =============================
// Solo un cliente autenticado puede acceder a las siguientes rutas
Route::middleware(['auth', 'cliente'])->group(function () {
    
    // ----CARRITO----
    // Devuelve la vista del carrito con sus items
    Route::get('backend/cliente/clienteCarrito', [CarritoController::class, 'index'])
    ->name('cliente.carrito');

    // Agrega un producto al carrito o actualizar su cantidad si ya existe
    Route::post('backend/cliente/clienteCarrito/agregar', [CarritoController::class, 'agregar'])
    ->name('carrito.agregar');

    // Elimina un producto del carrito
    Route::delete('backend/cliente/clienteCarrito/eliminar/{id}', [CarritoController::class, 'eliminar'])
    ->name('carrito.eliminar');

    // Favoritos del cliente
    Route::get('/cliente/favoritos', [FavoritoController::class, 'index'])
    ->name('cliente.favoritos');

    // Confirmar la compra 
    Route::post('backend/cliente/clienteCarrito/confirmar', [CheckoutController::class, 'store'])
    ->name('carrito.confirmar');
    
    // Actualiza la cantidad de unidades de los productos del carrito
    Route::put('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');

    // Vacia el carrito
    Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    

    // Redirecciona a la vista de compra confirmada
    Route::get('/compra-confirmada', function () {
    if (!session('pedido_id')) {
        return redirect()->route('catalogo')->with('error', 'No tienes una compra reciente para mostrar.');
    }

    
    $pedido = \App\Models\Pedido::with(['metodoPago', 'envio'])->find(session('pedido_id'));

    if (!$pedido) {
        return redirect()->route('catalogo')->with('error', 'Pedido no encontrado.');
    }

    return view('backend.cliente.compra-confirmada', compact('pedido'));
    })->name('compra.confirmada');


    // Devuelve la vista que muestra los datos del cliente
    Route::get('backend/cliente/cuentaCliente', [ClienteController::class, 'cuenta'])
    ->name('cliente.cuenta');

    // Actualiza los datos del cliente
    Route::put('backend/cliente/cuentaCliente', [ClienteController::class, 'actualizar'])
    ->name('cliente.actualizar');

    // Toggle favorito (agregar o quitar)
    Route::post('/favoritos/{producto}', [FavoritoController::class, 'toggle'])
    ->name('favoritos.toggle');


    
    // Muestra el apartado de compras del cliente
    Route::get('backend/cliente/clienteCompras', [PedidoController::class, 'misCompras'])->name('cliente.compras');

    Route::get('/mis-pedidos/{pedido}', [PedidoController::class, 'verPedidoCliente'])->name('cliente.compras.detalle');
    
    // Descargar factura en PDF
    Route::get('/pedido/{id}/factura', [PedidoController::class, 'descargarFactura'])->name('pedido.factura');


});

    //Ruta de controlador de formulario
    Route::post('/contacto', [ContactoController::class, 'procesar']);


//============ Rutas del inicio de sesión ===================
//ruta para cerrar sesion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//ruta para formulario de inicio de sesion 
Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login');

//ruta para autenticacion 
Route::post('/login', [AuthController::class, 'autenticar']);

//ruta para formulario de registro
Route::get('/register', [AuthController::class, 'formularioRegistro']);

//ruta de registro
Route::post('/register', [AuthController::class, 'registrar']);




// =======================Middleware ADMIN =============================
// Primero exige sesión iniciada, luego exige que sea admin
Route::middleware(['auth', 'admin'])->group(function () {

    //ruta de roles
    Route::resource('roles', RolController::class);

    //ruta de usuarios 
    Route::resource('usuarios', UsuarioController::class);

    // Devuelve la vista de Estadisticas Generales (Panel de administrador) y los datos que usa
    Route::get('/admin', [AdminController::class, 'admin'])
    ->name('admin.cuenta');

    // Devuelve la vista de gestion de clientes y los datos del cliente
    Route::get('/clientes', [AdminController::class, 'clientes'])
    ->name('admin.clientes');

    // Devuelve la vista de gestion de productos y los datos de los productos
    Route::get('/productos', [ProductoController::class, 'index'])
    ->name('admin.productos');
    
    // Devuelve la vista de crear producto 
    Route::get('/crear_producto', [ProductoController::class, 'crear'])
    ->name('crear.producto');

    Route::post('/productos/{id}/baja',[ProductoController::class, 'baja'])
    ->name('producto.baja');

    Route::post('/productos/{id}/alta',[ProductoController::class, 'alta'])
    ->name('producto.alta');

    Route::get('/admin/categorias', [CategoriaController::class, 'mostrarCategorias'])
    ->name('admin.categorias');
    
    Route::post('/categorias/{id}/baja',[CategoriaController::class, 'bajaCategoria'])
    ->name('categoria.baja');

    Route::post('/categorias/{id}/alta',[CategoriaController::class, 'altaCategoria'])
    ->name('categoria.alta');
    
    // Ruta a la funcion "guardar" que crea y guarda un nuevo producto
    Route::post('/admin/productos/guardar', [ProductoController::class, 'guardar'])
    ->name('admin.productos.guardar');
    
    // Devuelve la vista de editar producto
    Route::get('/admin/productos/editar/{producto}', [ProductoController::class, 'editar'])
    ->name('producto.editar');
    
    // Ruta a la función "actualizar" que actualiza los campos de un producto
    Route::put('/admin/productos/actualizar/{producto}', [ProductoController::class, 'actualizar'])
    ->name('producto.actualizar');

    // Devuelve la vista para crear categorias
    Route::get('/admin/categorias/crear',[CategoriaController::class, 'crear'])
    ->name('admin.categorias.crear');
    
    // Ruta a la función "guardar" que crea y guarda una nueva categoria
    Route::post('/admin/categorias/guardar',[CategoriaController::class, 'guardar'])
    ->name('admin.categorias.guardar');

    // Devuelve la vista de bandeja de consultas y los datos de cada consulta 
    Route::get('/backend/administrador/consultasAdmin', [ContactoController::class, 'index'])
    ->name('admin.consultas.index');
    
    // Devuelve la vista detalleConsultasAdmin para ver el detalle de cada consulta
    Route::get('/admin/consultas/{id}', [ContactoController::class, 'show'])->name('admin.consultas.show');

    //  Ruta a la función "responder" que permite responder a las consultas de los clientes
    Route::post('/backend/administrador/consultas/{id}/responder', [ContactoController::class, 'responder'])
    ->name('admin.consultas.responder');
    
    // Devuelve la vista del listado de pedidos y los datos de cada pedido
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('admin.pedidos.index');

    // Devuelve la vista detallePedidosAdmin para ver el detalle de cada pedido
    Route::get('/admin/pedidos/{pedido}', [App\Http\Controllers\PedidoController::class, 'show'])->name('pedidos.show');

    // Confirma un pedido pendiente de pago
    Route::patch('/admin/pedidos/{pedido}/confirmar', [App\Http\Controllers\PedidoController::class, 'confirmarPago'])->name('pedidos.confirmar');

    Route::prefix('admin')->group(function () {
    
    // Tarifa controller
    Route::get('/tarifas-envio', [TarifaEnvioController::class, 'index'])
        ->name('admin.tarifas.index');

    Route::post('/tarifas-envio', [TarifaEnvioController::class, 'store'])
        ->name('admin.tarifas.store');

    Route::put('/tarifas-envio/{id}', [TarifaEnvioController::class, 'update'])
        ->name('admin.tarifas.update');

    Route::delete('/tarifas-envio/{id}', [TarifaEnvioController::class, 'destroy'])
        ->name('admin.tarifas.destroy');
});
});

