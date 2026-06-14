<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class InicioController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        $favoritos = Producto::withCount('usuariosFavoritos')
            ->where('activo', true)
            ->orderByDesc('usuarios_favoritos_count')
            ->take(3)
            ->get();

        return view(
            'inicio',
            compact(
                'categorias',
                'favoritos'
            )
        );
    }
}