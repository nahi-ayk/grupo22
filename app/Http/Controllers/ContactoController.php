<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller{    
    public function procesar(Request $request){
        return response()->json([
            'success' => true,
            'mensaje' => '¡Tu mensaje fue enviado correctamente!'
        ]);
    }
}

