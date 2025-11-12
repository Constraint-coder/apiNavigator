<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Piso; // 👈 Usa "App" con mayúscula (Laravel es case-sensitive)

class PuntoDestino extends Model
{
    use HasFactory;

    // Si tu tabla en la base de datos se llama "puntos_destinos", no necesitas definir $table.
    // Pero si se llama diferente, agrega:
    // protected $table = 'puntos_destinos';
        protected $table='puntos_destinos';

    protected $fillable = ['nombres', 'coordenadas', 'id_pisos'];

    protected $casts = [
        'coordenadas' => 'array', // convierte JSON a array automáticamente
    ];

    public function piso()
    {
        return $this->belongsTo(Piso::class, 'id_pisos');
    }
    
    /// Materias relacion

        public function materias()
    {
        return $this->hasMany(Materias::class, 'id_puntos_destinos');
    }

}
