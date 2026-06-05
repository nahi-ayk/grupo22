<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('categoria');

        // Buscar por nombre
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        // Filtrar por categoría
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        // Filtrar por estado de stock
        if ($request->filled('estado')) {

            if ($request->estado == 'sin_stock') {
                $query->where('stock_actual', 0);
            }

            if ($request->estado == 'stock_minimo') {
                $query->whereColumn('stock_actual', '<=', 'stock_minimo')
                    ->where('stock_actual', '>', 0);
            }
        }

        $productos = $query->latest()->get();

        $categorias = Categoria::where('activo', true)->get();

        $totalProductos = Producto::count();

        $productosStockMinimo = Producto::whereColumn(
            'stock_actual',
            '<=',
            'stock_minimo'
        )->where('stock_actual', '>', 0)->count();

        $productosSinStock = Producto::where(
            'stock_actual',
            0
        )->count();

        return view(
            'backend.administrador.productosAdmin',
            compact(
                'productos',
                'categorias',
                'totalProductos',
                'productosStockMinimo',
                'productosSinStock'
            )
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

    public function editar(Producto $producto)
    {
        $categorias = Categoria::where('activo', true)->get();

        return view(
            'backend.administrador.editarProducto',
            compact('producto', 'categorias')
        );
    }

    public function actualizar(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'precio_venta' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'stock_minimo' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $rutaImagen = $producto->imagen;

        if ($request->hasFile('imagen')) {

            $archivo = $request->file('imagen');

            $nombre = time() . '_' . $archivo->getClientOriginalName();

            $archivo->move(
                public_path('img/catalogo'),
                $nombre
            );

            $rutaImagen = 'img/catalogo/' . $nombre;
        }

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio_venta' => $request->precio_venta,
            'stock_actual' => $request->stock_actual,
            'stock_minimo' => $request->stock_minimo,
            'categoria_id' => $request->categoria_id,
            'imagen' => $rutaImagen
        ]);

        return redirect()
            ->route('admin.productos')
            ->with(
                'success',
                'Producto actualizado correctamente'
            );
    }
}