<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TarifaEnvio;

class TarifaEnvioSeeder extends Seeder
{
public function run()
    {
        // Forzamos los IDs para que coincidan exactamente con la lógica de tu CheckoutController
        TarifaEnvio::create([
            'id' => 1,
            'zona' => 'Local (Corrientes)',
            'precio' => 3500.00,
        ]);

        TarifaEnvio::create([
            'id' => 2,
            'zona' => 'Interprovincial (Resistencia)',
            'precio' => 9000.00,
        ]);

        TarifaEnvio::create([
            'id' => 3,
            'zona' => 'Nacional',
            'precio' => 18000.00,
        ]);
    }
}
