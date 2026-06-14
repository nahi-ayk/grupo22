<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class FavoritoController extends Controller
{
    public function index()
    {
        $favoritos = Auth::user()->favoritos;

        return view('backend.cliente.clienteFavoritos', compact('favoritos'));
    }

    public function toggle($productoId)
    {
        $usuario = Auth::user();

        $existe = $usuario->favoritos()
            ->where('producto_id', $productoId)
            ->exists();

        if ($existe) {
            $usuario->favoritos()->detach($productoId);
        } else {
            $usuario->favoritos()->attach($productoId);
        }

        return back();
    }
}