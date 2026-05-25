<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [

            [
                'nombre' => 'Nahiara Ayelen',
                'apellido' => 'Meza',
                'dni' => '46923097',
                'email' => 'mezanahiara07@gmail.com',
                'password' => 'nahi1234',
                'rol_id' => 2
            ],

            [
                'nombre' => 'Tn Toys',
                'apellido' => ' Administrador',
                'dni' => '00000000',
                'email' => 'tntoysjugueteria@gmail.com',
                'password' => 'tntoys1',
                'rol_id' => 1
            ],

            [
                'nombre' => 'Maria',
                'apellido' => 'Lopez',
                'dni' => '12345678',
                'email' => 'maria@gmail.com',
                'password' => '123456',
                'rol_id' => 2
            ],
        ];

        foreach ($usuarios as $usuario) {

            Usuario::updateOrCreate(

                ['email' => $usuario['email']],

                [
                    'nombre' => $usuario['nombre'],
                    'apellido' => $usuario['apellido'],
                    'dni' => $usuario['dni'],
                    'email' => $usuario['email'],
                    'password' => Hash::make($usuario['password']),
                    'rol_id' => $usuario['rol_id']
                ]

            );
        }
    }
}