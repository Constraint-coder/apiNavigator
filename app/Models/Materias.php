<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PuntoDestino; // 👈 Usa "App" con mayúscula (Laravel es case-sensitive)


class Materias extends Model
{
     use HasFactory;

    // Si tu tabla en la base de datos se llama "puntos_destinos", no necesitas definir $table.
    // Pero si se llama diferente, agrega:
    // protected $table = 'puntos_destinos';
        protected $table='materias';

    protected $fillable = ['nombres', 'horarios', 'id_puntos_destinos'];

    public function aula()
    {
        return $this->belongsTo(PuntoDestino ::class, 'id_puntos_destinos');
    }
}
