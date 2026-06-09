<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodosPagoSeeder extends Seeder
{
    public function run()
    {
        DB::table('metodos_pago')->insert([
            ['descripcion' => 'Tarjeta de Crédito', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Tarjeta de Débito', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Transferencia Bancaria', 'created_at' => now(), 'updated_at' => now()],
            ['descripcion' => 'Efectivo al retirar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

