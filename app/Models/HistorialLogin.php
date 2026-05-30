<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialLogin extends Model
{
    protected $table = 'historial_logins';

    protected $fillable = [
        'usuario_id',
        'fecha_login',
    ];

    public $timestamps = true;
}