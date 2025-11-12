<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pasillo;
use App\Models\PuntoDestino;
use App\Models\PuntoReferencia;

class Piso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
    ];

    // 🔹 Si se relaciona con PuntosReferencia
    public function puntosReferencia()
    {
        return $this->hasMany(PuntoReferencia::class, 'id_pisos');
    }

    // 🔹 Si se relaciona con PuntosDestino (opcional)
    public function puntosDestino()
    {
        return $this->hasMany(PuntoDestino::class, 'id_pisos');
    }
    
        public function pasillo()
    {
        return $this->hasMany(Pasillo::class, 'id_pisos');
    }
}
