<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuntoDestino;
use App\Models\Piso;

class PuntoDestinoController extends Controller
{
    // 🔹 Listar todos los puntos destino con su piso
    public function index()
    {
       
        return response()->json(PuntoDestino::with('Piso')->get());
    }

    // 🔹 Crear un nuevo punto destino
    public function store(Request $request)
    {
        $validated = $request->validate([
    'nombres' => 'required|string|max:255',
    'id_pisos' => 'required|exists:pisos,id',
    'coordenadas' => 'required|array|min:1',
    'coordenadas' => 'required|array|size:2', 
    'coordenadas.0' => 'numeric',             
    'coordenadas.1' => 'numeric',             
        ]);

        $punto = PuntoDestino::create($validated);

        return response()->json([
            'message' => 'Punto Destino Creado Correctamente',
            'data' => $punto,
        ], 201);
    }

    // 🔹 Actualizar un punto destino
    public function update(Request $request, $id)
    {
        $punto = PuntoDestino::findOrFail($id);

        $validated = $request->validate([
            'nombres' => 'required|string|max:255',
    'coordenadas' => 'required|array|size:2', 
    'coordenadas.0' => 'numeric',             
    'coordenadas.1' => 'numeric', 
            'id_pisos' => 'required|exists:pisos,id',
        ]);

        $punto->update($validated);

        return response()->json([
            'message' => 'Punto destino actualizado correctamente',
            'data' => $punto,
        ]);
    }
    // busca por id
    public function showId($id)
    {
      $punto = PuntoDestino::findOrFail($id);
    
        return response()->json($punto);

    }
    // 🔹 Eliminar un punto destino
    public function destroy($id)
    {
        $punto = PuntoDestino::findOrFail($id);
        $punto->delete();

        return response()->json([
            'message' => 'Punto destino eliminado correctamente',
        ]);
    }
}
