<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('direcciones', function (Blueprint $table) {
            // 1. Primero eliminamos la restricción de la clave foránea.
            // Al pasar el nombre de la columna en un array, Laravel calcula automáticamente 
            // el nombre por defecto de la restricción (direcciones_usuario_id_foreign).
            $table->dropForeign(['usuario_id']);
            
            // 2. Ahora sí podemos eliminar la columna físicamente.
            $table->dropColumn('usuario_id');
        });
    }

    public function down(): void
    {
        Schema::table('direcciones', function (Blueprint $table) {
            // Si alguna vez necesitas hacer un rollback, volvemos a crear el campo y su relación
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios');
        });
    }
};