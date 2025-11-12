<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Piso;
use App\Models\Materias;

class PuntoReferencia extends Model
{
    use HasFactory;

    protected $table = 'puntos_referencias';
    protected $fillable = [
        'nombres',
        'coordenadas',
        'id_pisos',
    ];

    protected $casts = [
        'coordenadas' => 'array',
    ];

    public function piso()
    {
        return $this->belongsTo(Piso::class, 'id_pisos');
    }
}
