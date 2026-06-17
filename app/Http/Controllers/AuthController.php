<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\HistorialLogin;

class AuthController extends Controller{
    public function formularioRegistro(){
        return view("register");
    }

    public function formularioLogin(){
        return view("login");
    }

    public function registrar(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|numeric|digits:8|unique:usuarios,dni',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:8|confirmed',
        ]
        , [
            // Mensajes personalizados
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.max' => 'El apellido no puede tener más de 255 caracteres.',
            
            'dni.required' => 'El DNI es obligatorio.',
            'dni.numeric' => 'El DNI solo debe contener números.',
            'dni.digits' => 'El DNI debe tener exactamente 8 números.',
            'dni.unique' => 'Este DNI ya se encuentra registrado.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya se encuentra registrado.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'email' => $request->email,
            'password' => $request->password,

            // cliente por defecto
            'rol_id' => 2
        ]);

        return redirect('/login');
    }

    public function autenticar(Request $request){

        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credenciales)) {

            $request->session()->regenerate();

            $user = Auth::user();

            $user->update([
                'ultimo_login' => now()
            ]);

            HistorialLogin::create([
                'usuario_id' => $user->id,
                'fecha_login' => now(),
            ]);

            if ($user->rol->nombre === 'admin') {
                return redirect()->route('admin.cuenta');
            }

            return redirect()->route('cliente.cuenta');
        }

        return back()->withErrors([
            'email' => 'Email o contraseña incorrectos'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}


