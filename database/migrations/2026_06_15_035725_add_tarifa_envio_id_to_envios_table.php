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
        Schema::table('envios', function (Blueprint $table) { 
            $table->unsignedBigInteger('tarifa_envio_id')->nullable()->after('pedido_id');
            $table->foreign('tarifa_envio_id')->references('id')->on('tarifas_envios')->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('envios', function (Blueprint $table) {
            $table->dropForeign(['tarifa_envio_id']);
            $table->dropColumn('tarifa_envio_id');
    });
    }
};
