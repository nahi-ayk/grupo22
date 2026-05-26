<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pedidos';

    protected $fillable = [
        'numero_pedido',
        'usuario_id',
        'subtotal',
        'total',
        'metodo_pago',
    ];

    protected $casts = [
        'subtotal' => 'float',
        'total' => 'float',
    ];

    /**
     * Relación: Un Pedido pertenece a un Usuario (Muchos a Uno)
     * 
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id'); // O 'Usuario::class' si cambiaste el nombre del modelo Auth
    }

    /**
     * Relación: Un Pedido tiene un único Envío (Uno a Uno)
     * 
     */
    public function envio()
    {
        return $this->hasOne(Envio::class, 'pedido_id');
    }

    /**
     * Relación: Un Pedido tiene muchos detalles/productos (Uno a Muchos)
     * 
     */
    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class, 'pedido_id'); 
    }
}