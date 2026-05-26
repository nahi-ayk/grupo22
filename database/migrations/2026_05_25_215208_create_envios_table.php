<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            
            // Relación Uno a Uno con Pedidos: Cada envío pertenece a un único pedido
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            
            // Datos del destino (Congelados en el momento de la compra)
            $table->string('direccion');
            $table->string('localidad');
            $table->string('codigo_postal', 10);
            
            // Lógica propia del envío
            $table->decimal('costo_envio', 10, 2)->default(0.00);
            $table->string('estado_envio')->default('pendiente'); // 'pendiente', 'despachado', 'en_camino', 'entregado'
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
