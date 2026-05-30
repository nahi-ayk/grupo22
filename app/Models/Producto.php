<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_venta',
        'stock_actual',
        'stock_minimo',
        'activo',
        'imagen',
        'categoria_id',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'precio_venta' => 'float', // Para que PHP lo trate como número decimal al leerlo
    ];

    // Relación: Un producto pertenece a una Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function usuariosFavoritos()
    {
        return $this->belongsToMany(
            Usuario::class,
            'favoritos',
            'producto_id',
            'usuario_id'
        );
    }
}
