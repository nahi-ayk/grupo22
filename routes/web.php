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

//ruta de inicio
Route::get('/', function () {
    return view('inicio');
});

//ruta de catalogo
Route::get('/catalogo', [CatalogoController::class, 'index'])
    ->name('catalogo');

Route::get('/categorias/{id}', [CatalogoController::class, 'categoria'])
    ->name('catalogo.categoria');

Route::get('/producto/{id}', [CatalogoController::class, 'mostrar'])
->name('producto.mostrar');

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

//vistas del backend cliente
Route::middleware('cliente')->group(function () {

    // Muestra el carrito con sus items
    Route::get('backend/cliente/clienteCarrito', [CarritoController::class, 'index'])
    ->name('cliente.carrito');

    // Agregar un producto al carrito o actualizar su cantidad si ya existe
    Route::post('backend/cliente/clienteCarrito/agregar', [CarritoController::class, 'agregar'])
    ->name('carrito.agregar');

    // Eliminar un producto del carrito
    Route::delete('backend/cliente/clienteCarrito/eliminar/{id}', [CarritoController::class, 'eliminar'])
    ->name('carrito.eliminar');

    // Confirmar la compra
    Route::post('backend/cliente/clienteCarrito/confirmar', [CarritoController::class, 'confirmar'])
    ->name('carrito.confirmar');

    // Vista de compra confirmada (protegida: redirige si no hay sesión)
    Route::get('/compra-confirmada', function () {
    if (!session('total')) {
    return redirect()->route('cliente.cuenta')->with('error', 'No tienes una compra reciente para mostrar    ');
    }
    return view('backend.cliente.compra-confirmada');
    })->name('compra.confirmada');

    // Vacia el carrito
    Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');



    /* Route::get('backend/cliente/clienteCarrito', function () {
        return view('backend.cliente.clienteCarrito');
    })->name('clienteCarrito');
    */
    
    // Muestra el apartado de compras del cliente
    Route::get('backend/cliente/clienteCompras', function () {
        return view('backend.cliente.clienteCompras');
    })->name('cliente.compras');
    
    Route::get('backend/cliente/cuentaCliente', [ClienteController::class, 'cuenta'])
    ->name('cliente.cuenta');

    // Actualiza los datos del cliente
    Route::put('backend/cliente/cuentaCliente', [ClienteController::class, 'actualizar'])
    ->name('cliente.actualizar');

    // Toggle favorito (agregar o quitar)
    Route::post('/favoritos/{producto}', [FavoritoController::class, 'toggle'])
    ->name('favoritos.toggle');
});

//ruta para cerrar sesion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//ruta para formulario de inicio de sesion 
Route::get('/login', [AuthController::class, 'formularioLogin']);

//ruta para autenticacion 
Route::post('/login', [AuthController::class, 'autenticar']);

//ruta para formulario de registro
Route::get('/register', [AuthController::class, 'formularioRegistro']);

//ruta de registro
Route::post('/register', [AuthController::class, 'registrar']);

//ruta para vista administrador
Route::middleware('admin')->group(function () {

    //ruta de roles
    Route::resource('roles', RolController::class);

    //ruta de usuarios 
    Route::resource('usuarios', UsuarioController::class);

    Route::get('/admin', [AdminController::class, 'admin'])
    ->name('admin.cuenta');

    //clientes
    Route::get('/clientes', [AdminController::class, 'clientes'])
    ->name('admin.clientes');

    //Productos
    Route::get('/productos', [ProductoController::class, 'index'])
    ->name('admin.productos');

    Route::get('/crear_producto', [ProductoController::class, 'crear'])
    ->name('crear.producto');

    Route::post('/admin/productos/guardar', [ProductoController::class, 'guardar'])
    ->name('admin.productos.guardar');

    Route::get('/admin/productos/editar/{producto}', [ProductoController::class, 'editar'])
    ->name('producto.editar');

    Route::put('/admin/productos/actualizar/{producto}', [ProductoController::class, 'actualizar'])
    ->name('producto.actualizar');

    //categorias
    Route::get('/admin/categorias/crear',[CategoriaController::class, 'crear'])
    ->name('admin.categorias.crear');

    Route::post('/admin/categorias/guardar',[CategoriaController::class, 'guardar'])
    ->name('admin.categorias.guardar');

    //consultas
    Route::get('/backend/administrador/consultasAdmin', [ContactoController::class, 'index'])
    ->name('admin.consultas.index');

    Route::post('/backend/administrador/consultas/{id}/responder', [ContactoController::class, 'responder'])
    ->name('admin.consultas.responder');
});

//ruta de controlador de formulario
Route::post('/contacto', [ContactoController::class, 'procesar']);