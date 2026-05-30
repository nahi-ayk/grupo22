<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;

class CatalogoController extends Controller
{
    public function index()
    {
        $productos = Producto::where('activo', true)->get();

        $categorias = Categoria::where('activo', true)->get();

        $favoritos = auth()->check()
            ? auth()->user()->favoritos->pluck('id')->toArray()
            : [];

        return view('catalogo', compact(
            'productos',
            'categorias',
            'favoritos'
        ));
    }

    public function categoria($id)
    {
        $productos = Producto::where('categoria_id', $id)
            ->where('activo', true)
            ->get();

        $categorias = Categoria::where('activo', true)->get();

        $favoritos = auth()->check()
            ? auth()->user()->favoritos->pluck('id')->toArray()
            : [];

        return view('catalogo', compact(
            'productos',
            'categorias',
            'favoritos'
        ));
    }

    public function mostrar($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);

        $favoritos = auth()->check()
            ? auth()->user()->favoritos->pluck('id')->toArray()
            : [];

        return view('infoProducto', compact(
            'producto',
            'favoritos'
        ));
    }
}
