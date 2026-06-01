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
        //Modifica el default de estado
        $table->string('estado')->default('carrito')->change();

        // Agrega un default de 0 a total
        $table->decimal('total', 10, 2)->default(0)->change(); 
    });
}

public function down(): void
{
    Schema::table('pedidos', function (Blueprint $table) {
        // Revertimos ambos campos a como estaban originalmente
        $table->string('estado')->default('pendiente')->change();
        
        // Si antes no tenía default, puedes quitarlo volviendo a definir la columna sin él
        $table->decimal('total', 10, 2)->change(); 
    });
}
};