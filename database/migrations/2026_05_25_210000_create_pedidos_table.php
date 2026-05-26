<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            
            // Número único de cara al cliente 
            $table->string('numero_pedido')->unique();
            
            // Relación con la tabla 'usuarios' (Quién compra)
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('restrict');
            
            // Dinero de la transacción
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total', 10, 2); // subtotal + costo_envio
            
            // Información del Pago
            $table->string('metodo_pago'); // 'MercadoPago', 'Transferencia', etc.
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};