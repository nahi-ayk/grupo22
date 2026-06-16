<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;

class CatalogoController extends Controller
{
    public function index()
    {
        $query = Producto::where('activo', true)
            ->where('stock_actual', '>', 0);

        if (request('buscar')) {
            $query->where('nombre', 'like', '%' . request('buscar') . '%');
        }

        $productos = $query->get();

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

    public function buscarAjax()
    {
        $texto = request('q');

        $productos = Producto::where('activo', true)
            ->where('stock_actual', '>', 0)
            ->where('nombre', 'like', "%{$texto}%")
            ->limit(5)
            ->get();

        return response()->json($productos);
    }

    public function categoria($id)
    {
        $productos = Producto::where('categoria_id', $id)
            ->where('activo', true)
            ->where('stock_actual', '>', 0)
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
        $producto = Producto::with('categoria')
        ->where('activo', true)
        ->where('stock_actual', '>', 0)
        ->findOrFail($id);

        $favoritos = auth()->check()
            ? auth()->user()->favoritos->pluck('id')->toArray()
            : [];

        return view('infoProducto', compact(
            'producto',
            'favoritos'
        ));
    }
}
