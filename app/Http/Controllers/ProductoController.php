<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')
            ->latest()
            ->get();

        return view(
            'backend.administrador.productosAdmin',
            compact('productos')
        );
    }

    public function crear()
    {
        $categorias = Categoria::where('activo', true)
            ->get();

        return view(
            'backend.administrador.crearProducto',
            compact('categorias')
        );
    }

    public function guardar(Request $request)
    {
        $request->validate([

            'nombre' => 'required|max:255',

            'precio_venta' => 'required|numeric|min:0',

            'stock_actual' => 'required|integer|min:0',

            'stock_minimo' => 'required|integer|min:0',

            'categoria_id' => 'required|exists:categorias,id',

            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $rutaImagen = null;

        if ($request->hasFile('imagen')) {

            $archivo = $request->file('imagen');

            $nombre = time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(public_path('img/catalogo'), $nombre);

            $rutaImagen = 'img/catalogo/' . $nombre;
        }

        Producto::create([

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'precio_venta' => $request->precio_venta,

            'stock_actual' => $request->stock_actual,

            'stock_minimo' => $request->stock_minimo,

            'categoria_id' => $request->categoria_id,

            'imagen' => $rutaImagen,

            'activo' => true
        ]);

        return redirect()
            ->route('crear.producto')
            ->with('success', 'Producto creado correctamente');
    }
}