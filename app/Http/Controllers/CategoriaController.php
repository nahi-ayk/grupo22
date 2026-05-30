<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function crear()
    {
        return view('backend.administrador.crearCategoria');
    }

    public function guardar(Request $request)
    {
        $request->validate([

            'nombre' => 'required|max:255|unique:categorias,nombre'
        ]);

        Categoria::create([

            'nombre' => ucwords(strtolower($request->nombre)),

            'descripcion' => $request->descripcion,

            'activo' => true
        ]);

        return redirect()
            ->route('admin.categorias.crear')
            ->with('success', 'Categoría creada correctamente');
    }
}