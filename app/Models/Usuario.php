<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'usuarios';
    protected $fillable = ['nombre', 'apellido', 'dni', 'email', 'password', 'ultimo_login', 'rol_id', 'direccion_id'];
    protected $hidden = ['password', 'remember_token']; // nunca expuestos en JSON

    protected function casts(): array {
        return [
        'password' => 'hashed', // hashea automáticamente al asignar
        'ultimo_login' => 'datetime',
        ];
    }

    // Relación: un Usuario pertenece a un Rol → se usa como $usuario->rol
    public function rol() {
    return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function favoritos()
    {
        return $this->belongsToMany(
            Producto::class,
            'favoritos',
            'usuario_id',
            'producto_id'
        );
    }

    // Relación: Un Usuario tiene una Dirección (o le pertenece una dirección)
    public function miDireccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }
}

