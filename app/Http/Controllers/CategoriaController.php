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
            'nombre' => 'required|max:255|unique:categorias,nombre',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $rutaImagen = null;

        if ($request->hasFile('imagen')) {

            $archivo = $request->file('imagen');

            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(
                public_path('img/catInicio'),
                $nombreImagen
            );

            $rutaImagen = 'img/catInicio/' . $nombreImagen;
        }
        Categoria::create([
            'nombre' => ucwords(strtolower($request->nombre)),
            'descripcion' => $request->descripcion,
            'imagen' => $rutaImagen,
            'activo' => true
        ]);

        return redirect()
            ->route('admin.categorias.crear')
            ->with('success', 'Categoría creada correctamente');
    }

    public function bajaCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->activo = false;
        $categoria->save();

        $categoria->productos()->update([
            'activo' => false
        ]);

        return back()->with(
            'success',
            'Categoría y productos asociados dados de baja.'
        );
    }

    public function altaCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->activo = true;
        $categoria->save();

        return back()->with(
            'success',
            'Categoría activada correctamente.'
        );
    }

    public function mostrarCategorias(Request $request)
    {
        $query = Categoria::with('productos');

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        if ($request->estado == 'activo') {
            $query->where('activo', true);
        }

        if ($request->estado == 'inactivo') {
            $query->where('activo', false);
        }

        $categorias = $query->get();

        return view(
            'backend.administrador.categorias',
            compact('categorias')
        );
    }
}