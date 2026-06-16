<?php

namespace App\Http\Controllers;

use App\Models\TarifaEnvio;
use Illuminate\Http\Request;

class TarifaEnvioController extends Controller
{
    public function index()
    {
        $tarifas = TarifaEnvio::all();
        return view('backend.administrador.tarifasEnvio', compact('tarifas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'zona' => 'required',
            'precio' => 'required|numeric'
        ]);

        TarifaEnvio::create($request->all());

        return redirect()->back()->with('success', 'Tarifa creada correctamente');
    }

    public function update(Request $request, $id)
    {
        $tarifa = TarifaEnvio::findOrFail($id);

        $request->validate([
            'zona' => 'required',
            'precio' => 'required|numeric'
        ]);

        $tarifa = TarifaEnvio::findOrFail($id);
        $tarifa->update($request->only('zona', 'precio'));

        return redirect()->back()->with('success', 'Tarifa actualizada correctamente');
    }

    public function destroy($id)
    {
        TarifaEnvio::destroy($id);

        return redirect()->back()->with('success', 'Tarifa eliminada correctamente');
    }
}