<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Crea la columna nullable (importante para que los usuarios viejos no den error)
            $table->unsignedBigInteger('direccion_id')->nullable()->after('rol_id');

            // Crea la relación de clave foránea
            $table->foreign('direccion_id')
                ->references('id')
                ->on('direcciones')
                ->onDelete('set null'); // Si se borra la dirección, el usuario no se borra, solo queda en null
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Para revertir, primero se borra la foránea y luego la columna
            $table->dropForeign(['direccion_id']);
            $table->dropColumn('direccion_id');
        });
    }
};
