<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('direcciones', function (Blueprint $table) {
            // Agrega la columna 'deleted_at'
            $table->softDeletes(); 
            
            // Agregar FK a la tabla usuarios
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios');
        });
    }

    public function down(): void
    {
        Schema::table('direcciones', function (Blueprint $table) {
            // Revierte el cambio eliminando la columna 'deleted_at'
            $table->dropSoftDeletes();
        });
    }
};
