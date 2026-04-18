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

Route::get('/terminos', function () {
    return view('terminos');
});