<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Direccion extends Model
{
    use HasFactory, SoftDeletes; // 

    protected $table = 'direcciones';

    protected $fillable = [
        'direccion',
        'provincia',
        'localidad',
        'codigo_postal',
    ];

    // Relación con Usuarios
    public function usuarios()
    {
        // Usa User::class si tu modelo de Laravel por defecto es User, 
        // o Usuario::class si lo renombraste.
        return $this->hasMany(Usuario::class, 'direccion_id'); 
    }

    // Relación con Envíos (¡La nueva que agregamos!)
    public function envios()
    {
        return $this->hasMany(Envio::class, 'direccion_id');
    }
}