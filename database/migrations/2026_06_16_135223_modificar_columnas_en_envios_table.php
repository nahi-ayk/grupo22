<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('envios', function (Blueprint $table) {
            // 1. Agregamos solo la nueva clave foránea para la dirección
            $table->foreignId('direccion_id')->nullable()->after('pedido_id')->constrained('direcciones');

            // 2. Eliminamos los campos de texto viejos
            $table->dropColumn(['direccion', 'localidad', 'codigo_postal', 'provincia']);
        });
    }

    public function down(): void
    {
        Schema::table('envios', function (Blueprint $table) {
            // 1. Eliminamos la relación y la columna nueva
            $table->dropForeign(['direccion_id']);
            $table->dropColumn('direccion_id');

            // 2. Volvemos a crear las columnas de texto (por si haces rollback)
            $table->string('direccion')->nullable();
            $table->string('provincia')->nullable();
            $table->string('localidad')->nullable();
            $table->string('codigo_postal', 10)->nullable();
        });
    }
};
