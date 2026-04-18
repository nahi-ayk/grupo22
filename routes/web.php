<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/catalogo', function () {
    return view('catalogo');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/nosotros', function () {
    return view('nosotros');
});

<<<<<<< HEAD
Route::get('/terminos', function () {
    return view('terminos');
=======
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
>>>>>>> d004aa597d8667adba3e7db686b8b95d13561e6d
});