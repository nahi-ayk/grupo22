PHP
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
        Schema::table('pedidos', function (Blueprint $table) {
            // 1. Borramos el campo string viejo
            $table->dropColumn('metodo_pago');

            // 2. Agregamos el estado
            $table->string('estado')->default('pendiente')->after('numero_pedido');

            // 3. Agregamos la nueva Clave Foránea apuntando a metodos_pago
            $table->foreignId('metodo_pago_id')->nullable()->constrained('metodos_pago')->onDelete('set null')->after('usuario_id');

            // 4. Agregamos la fecha de venta
            $table->timestamp('fecha_venta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Pasos inversos para el rollback:
            
            // 1. Quitamos la FK y borramos los campos nuevos
            $table->dropForeign(['metodo_pago_id']);
            $table->dropColumn(['estado', 'metodo_pago_id', 'fecha_venta']);
            
            // 2. Volvemos a crear el campo viejo tal como estaba antes
            $table->string('metodo_pago')->after('total'); 
        });
    }
};