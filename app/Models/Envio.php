<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Envio extends Model
{
    use HasFactory, SoftDeletes;

    // Indicamos explícitamente el nombre de la tabla
    protected $table = 'envios';

    // Campos que permitimos cargar masivamente
    protected $fillable = [
        'pedido_id',
        'tarifa_envio_id',
        'direccion_id',
        'costo_envio',
        'estado_envio',
    ];

    // Casteamos los tipos de datos para que PHP los reconozca correctamente
    protected $casts = [
        'costo_envio' => 'float', // Convierte el decimal a número flotante en PHP
    ];

    /**
     * Relación: Un Envío pertenece a un Pedido (Relación Uno a Uno Inversa)
     * Esto te permitirá hacer: $envio->pedido
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    /**
     * Relación: Un Envío pertenece a una Tarifa de Envío (Muchos a Uno)
     */
    public function tarifaEnvio()
    {
    return $this->belongsTo(TarifaEnvio::class, 'tarifa_envio_id');
    }
    
    public function direccion()
    {
        // Indicamos que incluya las direcciones borradas lógicamente
        // para que el historial de envíos viejos siga funcionando.
        return $this->belongsTo(Direccion::class, 'direccion_id')->withTrashed();
    }
}
