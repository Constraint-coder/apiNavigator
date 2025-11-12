<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Piso;

class Pasillo extends Model
{
    use HasFactory;

    protected $fillable = ['nombres', 'coordenadas', 'id_pisos'];

    protected $casts = [
        'coordenadas' => 'array', // almacena x, y como JSON
    ];

    public function piso()
    {
        return $this->belongsTo(Piso::class, 'id_pisos');
    }
}
