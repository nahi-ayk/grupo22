<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TarifaEnvio extends Model
{
    use HasFactory;
    protected $table = 'tarifas_envios';
    protected $fillable = ['zona', 'precio'];
}
