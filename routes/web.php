<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;

//ruta de inicio
Route::get('/', function () {
    return view('inicio');
});

//ruta de catalogo
Route::get('/catalogo', function () {
    return view('catalogo');
});

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

    Route::get('backend/cliente/clienteCarrito', function () {
        return view('backend.cliente.clienteCarrito');
    })->name('clienteCarrito');

    Route::get('backend/cliente/clienteCompras', function () {
        return view('backend.cliente.clienteCompras');
    })->name('clienteCompras');

    Route::get('backend/cliente/cuentaCliente', [ClienteController::class, 'cuenta'])
    ->name('cliente.cuenta');

    Route::put('backend/cliente/cuentaCliente', [ClienteController::class, 'actualizar'])
    ->name('cliente.actualizar');

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

    Route::get('/admin', function () {
        return view('backend.administrador.cuentaAdmin');
    })->name('admin.cuenta');

});



//ruta de categorias que se van a borrar
Route::get('categorias/juguetes', function () {
    return view('categorias.juguetes');
});

Route::get('categorias/primera-infancia', function () {
    return view('categorias.primera-infancia');
});

Route::get('categorias/juegos-de-mesa', function () {
    return view('categorias.juegos-de-mesa');
});

Route::get('categorias/fig-coleccionables', function () {
    return view('categorias.fig-coleccionables');
});

Route::get('categorias/legos', function () {
    return view('categorias.legos');
});

Route::get('categorias/peluches', function () {
    return view('categorias.peluches');
});


//ruta de controlador de formulario
Route::post('/contacto', [ContactoController::class, 'procesar']);